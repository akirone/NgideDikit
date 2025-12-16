<?php

namespace App\Http\Controllers;

use App\Models\Ide;
use App\Models\IdeKategori;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Exports\IdeExport;
use App\Imports\IdeImport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class IdeasController extends Controller
{
    public function index(Request $request)
    {
        $queryide = Ide::with('categories');

        if ($request->filled('sortide')) {
            $sort = $request->sortide;
            $order = $request->orderide ?? 'asc';
            $queryide->orderBy($sort, $order);
        }

        if ($request->filled('searchide')) {
            $search = $request->searchide;
            $queryide->where('name', 'like', "%{$search}%")
                ->orWhereHas('categories', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
        }

        // Sort by favorite first, then by created_at
        $queryide->orderBy('is_favorite', 'desc')->orderBy('created_at', 'desc');

        $ide = $queryide->paginate(10, ['*'], 'ide_page');

        $querykategori = Kategori::query();

        if ($request->filled('sortkategori')) {
            $sort = $request->sortkategori;
            $order = $request->orderkategori ?? 'asc';
            $querykategori->orderBy($sort, $order);
        }

        if ($request->filled('searchkategori')) {
            $querykategori->where('name', 'like', '%' . $request->searchkategori . '%')
                ->orWhere('description', 'like', '%' . $request->searchkategori . '%');
        }

        $kategori = $querykategori->paginate(10, ['*'], 'kategori_page');

        return view('ide.index', compact('ide', 'kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|array',
            'category.*' => 'exists:categories,id',
        ]);

        $ide = Ide::create([
            'title' => $request->title,
        ]);

        foreach ($request->category as $categoriId) {
            IdeKategori::create([
                'idea_id' => $ide->id,
                'category_id' => $categoriId,
            ]);
        }

        return redirect()->route('ide.index')->with('successide', 'Ide berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $idea = Ide::with('categories')->findOrFail($id);
        $kategori = Kategori::all();

        return view('ide.edit', compact('idea', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $idea = Ide::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|array',
            'category.*' => 'exists:categories,id',
            'description' => 'nullable|string',
        ]);

        $idea->update([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
        ]);

        $idea->categories()->sync($validated['category']);
        return redirect()->route('ide.index')->with('successide', 'Idea berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $idea = Ide::findOrFail($id);
        $idea->delete();

        return redirect()->route('ide.index')->with('successide', 'Idea berhasil dihapus!');
    }

    public function toggleFavorite($id)
    {
        $idea = Ide::findOrFail($id);
        $idea->is_favorite = !$idea->is_favorite;
        $idea->save();

        return redirect()->route('ide.index')->with('successide', $idea->is_favorite ? 'Ide ditambahkan ke favorit!' : 'Ide dihapus dari favorit!');
    }

    public function exportExcel()
    {
        return Excel::download(new IdeExport, 'ideas-' . date('Y-m-d') . '.xlsx');
    }

    public function exportPdf()
    {
        $ideas = Ide::with('categories')->get();
        $pdf = Pdf::loadView('admin.ide.pdf', compact('ideas'));
        return $pdf->download('ideas-' . date('Y-m-d') . '.pdf');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        Excel::import(new IdeImport, $request->file('file'));

        return redirect()->route('ide.index')->with('successide', 'Data berhasil diimport!');
    }
}
