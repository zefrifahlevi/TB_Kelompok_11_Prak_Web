<?php

namespace App\Http\Controllers;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index() {
        $transactions = Transaction::orderBy('date', 'desc')->get();

        $currentBalance = $transactions->last()->balance ?? 0;
        $totalIncome = $transactions->where('type', 'income')
                                    ->whereBetween('date', [now()->startOfMonth(), now()->endOfMonth()])
                                    ->sum('amount');
        $totalExpense = $transactions->where('type', 'expense')
                                    ->whereBetween('date', [now()->startOfMonth(), now()->endOfMonth()])
                                    ->sum('amount');

        return view('dashboard', compact('transactions', 'currentBalance', 'totalIncome', 'totalExpense'));
    }

    public function create()
    {
        return view('transactions.create');
    }

    public function store(Request $request) {
    $request->validate([
        'date' => 'required|date',
        'amount' => 'required|numeric',
        'type' => 'required|in:income,expense',
        'description' => 'nullable|string',
        'payer_name' => 'nullable|string',
    ]);

    // Hitung saldo terakhir
        $lastTransaction = Transaction::orderBy('date', 'desc')->orderBy('id', 'desc')->first();
        $currentBalance = $lastTransaction ? $lastTransaction->balance : 0;

        // Perbarui saldo berdasarkan jenis transaksi
        $newBalance = $request->type === 'income'
            ? $currentBalance + $request->amount
            : $currentBalance - $request->amount;

        // Buat transaksi baru
        Transaction::create([
            'date' => $request->date,
            'amount' => $request->amount,
            'type' => $request->type,
            'description' => $request->description,
            'payer_name' => $request->payer_name,
            'balance' => $newBalance,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }


    public function edit(Transaction $transaction)
    {
        return view('transactions.edit', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction) {
        $request->validate([
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'type' => 'required|in:income,expense',
            'description' => 'nullable|string',
            'payer_name' => 'nullable|string',
        ]);

        // Hitung ulang saldo
        $lastTransaction = Transaction::orderBy('date', 'desc')->orderBy('id', 'desc')->first();
        $currentBalance = $lastTransaction ? $lastTransaction->balance : 0;

        $newBalance = $request->type === 'income'
            ? $currentBalance + $request->amount - $transaction->amount
            : $currentBalance - $request->amount + $transaction->amount;

        // Update transaksi
        $transaction->update([
            'date' => $request->date,
            'amount' => $request->amount,
            'type' => $request->type,
            'description' => $request->description,
            'payer_name' => $request->payer_name,
            'balance' => $newBalance,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy(Transaction $transaction) {
        // Hapus transaksi
        $transaction->delete();

        // Perbarui saldo semua transaksi setelah transaksi yang dihapus
        $transactions = Transaction::orderBy('date', 'asc')->orderBy('id', 'asc')->get();
        $currentBalance = 0;

        foreach ($transactions as $t) {
            $currentBalance = $t->type === 'income'
                ? $currentBalance + $t->amount
                : $currentBalance - $t->amount;

            $t->update(['balance' => $currentBalance]);
        }

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus.');
    }

}
