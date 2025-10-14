<?php

namespace App\Http\Controllers;

use App\Models\WebSetting;
use Illuminate\Http\Request;

class WebSettingController extends Controller
{
    /**
     * Menampilkan semua pengaturan web.
     */
    public function index()
    {
        $settings = WebSetting::all();

        return view('settings.index', compact('settings'));
    }

    /**
     * Menyimpan atau memperbarui setting berdasarkan key.
     */
    public function updateOrCreate(Request $request)
    {
        $validated = $request->validate([
            'key'   => 'required|string|max:100',
            'value' => 'required|string|max:255',
        ]);

        WebSetting::updateOrCreate(
            ['key' => $validated['key']],
            ['value' => $validated['value']]
        );

        return redirect()
            ->route('settings.index')
            ->with('success', 'Setting berhasil disimpan!');
    }
}
