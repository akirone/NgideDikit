<?php

namespace App\Http\Controllers;

use App\Models\Ide;
use App\Models\IdeKategori;
use App\Models\Kategori;
use Illuminate\Http\Request;

class IdeController extends Controller
{
    /**
     * Menampilkan semua ide.
     */
    public function index(Request $request)
    {
        $query = \App\Models\Ide::with('categories');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%")
                ->orWhereHas('categories', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
        }

        $ide = $query->get();
        $kategori = \App\Models\Kategori::all();

        return view('ideas.index', compact('ide', 'kategori'));
    }

    /**
     * Menyimpan ide baru ke database.
     */
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

    /**
     * Form untuk edit ide.
     */
    public function edit($id)
    {
        $idea = Ide::with('categories')->findOrFail($id);
        $kategori = Kategori::all();

        return view('ideas.edit', compact('idea', 'kategori'));
    }

    /**
     * Update ide di database.
     */
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

    /**
     * Menghapus ide dari database.
     */
    public function destroy($id)
    {
        $idea = Ide::findOrFail($id);
        $idea->delete();

        return redirect()->route('ideas.index')->with('success', 'Idea berhasil dihapus!');
    }
}
