<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ide;
use App\Models\Kategori;
use App\Models\UserIdea;
use App\Models\IdeKategori;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Statistik dasar
        $totalUsers = User::count();
        $totalKategori = Kategori::count();
        $totalIde = Ide::count();
        $totalFavorites = Ide::where('is_favorite', true)->count();

        // Data users untuk tabel (limit 5 user terbaru)
        $recentUsers = User::orderBy('created_at', 'desc')->take(5)->get();

        // Semua users untuk dropdown
        $allUsers = User::orderBy('name')->get();

        // User yang dipilih (default user pertama jika tidak ada pilihan)
        $selectedUserId = $request->get('user_id');
        $selectedUser = $selectedUserId ? User::find($selectedUserId) : User::first();

        // Statistik user yang dipilih
        if ($selectedUser) {
            // Hitung ide yang dibuat user
            $userIdeCount = UserIdea::where('user_id', $selectedUser->id)->count();

            // Hitung ide favorit user (menggunakan join)
            $userFavoriteCount = UserIdea::where('user_ideas.user_id', $selectedUser->id)
                ->join('ideas', 'user_ideas.idea_id', '=', 'ideas.id')
                ->where('ideas.is_favorite', true)
                ->count();

            // Progress user
            $userIdeTarget = 20; // target 20 ide per user
            $userIdePercent = min(100, round(($userIdeCount / $userIdeTarget) * 100));
            $userFavoritePercent = $userIdeCount > 0 ? round(($userFavoriteCount / $userIdeCount) * 100) : 0;

            // Kategori yang digunakan user
            $userKategoriCount = IdeKategori::whereIn('idea_id', function ($query) use ($selectedUser) {
                $query->select('idea_id')
                    ->from('user_ideas')
                    ->where('user_id', $selectedUser->id);
            })->distinct('category_id')->count('category_id');
            $userKategoriPercent = $totalKategori > 0 ? round(($userKategoriCount / $totalKategori) * 100) : 0;

            // Activity rate (ide per hari sejak terdaftar)
            $daysSinceJoined = $selectedUser->created_at ? max(1, $selectedUser->created_at->diffInDays(now())) : 1;
            $activityRate = round($userIdeCount / $daysSinceJoined, 2);
            $activityPercent = min(100, round($activityRate * 50)); // 2 ide/hari = 100%
        } else {
            $userIdeCount = 0;
            $userFavoriteCount = 0;
            $userIdePercent = 0;
            $userFavoritePercent = 0;
            $userKategoriCount = 0;
            $userKategoriPercent = 0;
            $activityRate = 0;
            $activityPercent = 0;
        }

        // Hitung persentase progress global
        $favoritePercent = $totalIde > 0 ? round(($totalFavorites / $totalIde) * 100) : 0;
        $kategoriTarget = 20;
        $kategoriPercent = min(100, round(($totalKategori / $kategoriTarget) * 100));
        $ideTarget = 100;
        $idePercent = min(100, round(($totalIde / $ideTarget) * 100));
        $userTarget = 50;
        $userPercent = min(100, round(($totalUsers / $userTarget) * 100));
        $taskComplete = $totalIde > 0 ? round(($totalFavorites / $totalIde) * 100) : 0;

        return view('dashboard', compact(
            'totalUsers',
            'totalKategori',
            'totalIde',
            'totalFavorites',
            'recentUsers',
            'allUsers',
            'selectedUser',
            'userIdeCount',
            'userFavoriteCount',
            'userIdePercent',
            'userFavoritePercent',
            'userKategoriCount',
            'userKategoriPercent',
            'activityRate',
            'activityPercent',
            'favoritePercent',
            'kategoriPercent',
            'idePercent',
            'userPercent',
            'taskComplete'
        ));
    }
}
