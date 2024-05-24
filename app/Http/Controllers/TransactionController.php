<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $transactions = $user->transactions;
        return response()->json(['balance' => $user->balance, 'transactions' => $transactions]);
    }
    public function showDeposits()
    {
        $user = Auth::user();
        $deposits = $user->transactions()->where('type', 'deposit')->get();
        return response()->json(['deposits' => $deposits]);
    }
    public function depositindex()
    {
        return view('transanction.deposit');
    }
    public function withdrawindex()
    {
        return view('transanction.withdraw');
    }

    public function showWithdrawals()
    {
        $user = Auth::user();
        $transanctions = $user->transactions()->where('type', 'withdrawal')->get();
        return view('transanction.withdrwalShow', compact('transanctions'));
    }
    public function showDeposit()
    {
        $user = Auth::user();
        $transanctions = $user->transactions()->where('type', 'deposit')->get();
        return view('transanction.depositShow', compact('transanctions'));
    }
    public function deposit(Request $request)
    {


        $request->validate([
            'amount' => 'required|numeric|min:0.01',
        ]);

        $user = Auth::user();

        $user->balance += $request->amount;
        $user->save();

        $transaction = $user->transactions()->create([
            'type' => 'deposit',
            'amount' => $request->amount,
            'balance_after' => $user->balance,
        ]);

        return back()->with('success', 'Deposit Successfully');
    }
    public function withdraw(Request $request)
    {
        $request->validate([
            // 'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
        ]);

        $user = User::find(Auth::user()->id);
        $amount = $request->amount;
        $fee = 0;

        if ($user->account_type == 'Individual') {
            $today = now()->format('l');
            $currentMonth = now()->format('Y-m');
            $monthlyWithdrawals = $user->transactions()
                ->where('type', 'withdrawal')
                ->where('created_at', 'like', "$currentMonth%")
                ->sum('amount');

            if ($today == 'Friday' || $monthlyWithdrawals + $amount <= 5000) {
                $fee = 0;
            } elseif ($amount <= 1000) {
                $fee = 0;
            } else {
                $fee = ($amount - 1000) * 0.00015;
            }
        } elseif ($user->account_type == 'Business') {
            $totalWithdrawals = $user->transactions()
                ->where('type', 'withdrawal')
                ->sum('amount');

            $fee = $totalWithdrawals > 50000 ? $amount * 0.00015 : $amount * 0.00025;
        }

        $totalAmount = $amount + $fee;
        if ($totalAmount > $user->balance) {
            return response()->json(['message' => 'Insufficient balance'], 400);
        }

        $user->balance -= $totalAmount;
        $user->save();

        $transaction = $user->transactions()->create([
            'type' => 'withdrawal',
            'amount' => $amount,
            'balance_after' => $user->balance,
        ]);

        return back()->with('success', 'Withdraw Successfully');
    }
}
