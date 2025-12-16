<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Exports\KategoriExport;
use App\Imports\KategoriImport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class KatController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $sort = $request->sort ?? 'name';
        $order = $request->order ?? 'asc';

        $kategori = Kategori::when($search, function ($q) use ($search) {
            $q->where('name', 'like', "%$search%");
        })
            ->orderBy($sort, $order)
            ->get();


        return view('ide.index', compact('kategori'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Kategori::create($validated);
        return redirect()->route('ide.index')->with('successkategori', 'Kategori berhasil ditambahkan!');
    }
    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $kategori->update($validated);
        return redirect()->route('ide.index')->with('successkategori', 'Kategori berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('ide.index')->with('successkategori', 'Kategori berhasil dihapus!');
    }

    public function exportExcel()
    {
        return Excel::download(new KategoriExport, 'categories-' . date('Y-m-d') . '.xlsx');
    }

    public function exportPdf()
    {
        $categories = Kategori::all();
        $pdf = Pdf::loadView('admin.kategori.pdf', compact('categories'));
        return $pdf->download('categories-' . date('Y-m-d') . '.pdf');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        Excel::import(new KategoriImport, $request->file('file'));

        return redirect()->route('ide.index')->with('successkategori', 'Data berhasil diimport!');
    }
}
