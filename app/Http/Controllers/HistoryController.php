<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * Menampilkan semua history milik user tertentu.
     */
    public function index(Request $request)
    {
        $histories = History::with(['user', 'idea'])
            ->where('user_id', $request->user()->id) // user login
            ->get();

        return response()->json($histories, 200);
    }

    /**
     * Menambahkan history baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'idea_id'   => 'required|exists:ideas,id',
            'status'    => 'required|in:' . History::STATUS_DONE . ',' . History::STATUS_NOT_DONE,
            'file_path' => 'nullable|string|max:255',
            'notes'     => 'nullable|string',
        ]);

        $history = History::create([
            'user_id'   => $request->user()->id, // ambil dari user login
            'idea_id'   => $validated['idea_id'],
            'status'    => $validated['status'],
            'file_path' => $validated['file_path'] ?? null,
            'notes'     => $validated['notes'] ?? null,
        ]);

        return response()->json(['message' => 'History berhasil ditambahkan', 'data' => $history], 201);
    }

    /**
     * Update status history.
     */
    public function update(Request $request, $id)
    {
        $history = History::findOrFail($id);

        $validated = $request->validate([
            'status'    => 'in:' . History::STATUS_DONE . ',' . History::STATUS_NOT_DONE,
            'file_path' => 'nullable|string|max:255',
            'notes'     => 'nullable|string',
        ]);

        $history->update($validated);

        return response()->json(['message' => 'History berhasil diperbarui', 'data' => $history], 200);
    }

    /**
     * Hapus history.
     */
    public function destroy($id)
    {
        $history = History::findOrFail($id);
        $history->delete();

        return response()->json(['message' => 'History berhasil dihapus'], 200);
    }
}
