<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $users = User::select('id', 'name')->get();
        $selectedUser = $request->query('user') ? User::with(['orders','tasks'])->findOrFail($request->query('user')) : User::with(['orders','tasks'])->first();

        // prepare initial data for the selected user
        $data = $this->makeProgressData($selectedUser);

        return view('dashboard', compact('users','selectedUser','data'));
    }

    public function userProgress(User $user)
    {
        $user->load(['orders','tasks']);
        $data = $this->makeProgressData($user);

        return response()->json($data);
    }

    protected function makeProgressData(?User $user)
    {
        if (! $user) {
            return [
                'balance' => 0,
                'profit_amount' => 0,
                'profit_percent' => 0,
                'orders_count' => 0,
                'orders_percent' => 0,
                'tasks_complete_percent' => 0,
                'open_rate_percent' => 0,
                'name' => '—'
            ];
        }

        // Example targets (ubah sesuai kebutuhan)
        $profitTarget = 3000;
        $ordersTarget = 800; // contoh target orders

        $profitAmount = (float) ($user->profit_amount ?? 0);
        $profitPercent = $profitTarget > 0 ? (int) min(100, round($profitAmount / $profitTarget * 100)) : 0;

        $ordersCount = $user->orders ? $user->orders->count() : 0;
        $ordersPercent = $ordersTarget > 0 ? (int) min(100, round($ordersCount / $ordersTarget * 100)) : 0;

        $tasksTotal = $user->tasks ? $user->tasks->count() : 0;
        $tasksComplete = $user->tasks ? $user->tasks->where('status', 'complete')->count() : 0;
        $tasksCompletePercent = $tasksTotal > 0 ? (int) round($tasksComplete / $tasksTotal * 100) : 0;

        $openRate = (int) ($user->open_rate ?? 0);
        $openRatePercent = max(0, min(100, $openRate));

        return [
            'name' => $user->name,
            'balance' => number_format($user->balance ?? 0, 2),
            'profit_amount' => $profitAmount,
            'profit_percent' => $profitPercent,
            'orders_count' => $ordersCount,
            'orders_percent' => $ordersPercent,
            'tasks_complete_percent' => $tasksCompletePercent,
            'open_rate_percent' => $openRatePercent,
        ];
    }
}
