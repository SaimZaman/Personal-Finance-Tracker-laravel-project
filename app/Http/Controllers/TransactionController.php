<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Auth::user()->transactions()->latest()->get();
        $totalIncome = Auth::user()->transactions()->where('type', 'income')->sum('amount');
        $totalExpense = Auth::user()->transactions()->where('type', 'expense')->sum('amount');
        $balance = $totalIncome - $totalExpense;

        return view('dashboard', compact('transactions', 'totalIncome', 'totalExpense', 'balance'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0.01',
            'type' => 'required|in:income,expense',
            'category' => 'required|string|max:255',
            'transaction_date' => 'required|date',
        ]);

        Auth::user()->transactions()->create($request->all());

        return redirect()->back()->with('success', 'Transaction added successfully!');
    }

    public function update(Request $request, Transaction $transaction)
    {
        // Ensure user can only update their own transactions
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0.01',
            'type' => 'required|in:income,expense',
            'category' => 'required|string|max:255',
            'transaction_date' => 'required|date',
        ]);

        $transaction->update($request->all());

        return redirect()->back()->with('success', 'Transaction updated successfully!');
    }

    public function destroy(Transaction $transaction)
    {
        // Ensure user can only delete their own transactions
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }

        $transaction->delete();

        return redirect()->back()->with('success', 'Transaction deleted successfully!');
    }
}
