<?php

namespace App\Http\Controllers;

use App\Models\Ide;
use App\Models\IdeKategori;
use App\Models\Kategori;
use Illuminate\Http\Request;

class IdeController extends Controller
{
    public function index(Request $request)
    {
        $query = Ide::with('categories');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%")
                ->orWhereHas('categories', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
        }

        $ide = $query->paginate(10);
        $kategori = Kategori::all();

        return view('ideas.index', compact('ide', 'kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|array',
            'category.*' => 'exists:categories,id',
        ]);

        $idea = Ide::create([
            'title' => $request->title,
        ]);

        foreach ($request->category as $categoriId) {
            IdeKategori::create([
                'idea_id' => $idea->id,
                'category_id' => $categoriId,
            ]);
        }

        return redirect()->route('ideas.index')->with('success', 'Ide berhasil ditambahkan!');
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

        // Update judul dan deskripsi
        $idea->update([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
        ]);

        // Update relasi kategori
        $idea->categories()->sync($validated['category']);

        return redirect()->route('ideas.index')->with('success', 'Idea berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $idea = Ide::findOrFail($id);
        $idea->delete();

        return redirect()->route('ideas.index')->with('success', 'Idea berhasil dihapus!');
    }
}
