<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sent_transactions = Transaction::where('sender', Auth::user()->wallet)->get(); // Получение отправленных транзакций
        $receive_transactions = Transaction::where('recipient', Auth::user()->wallet)->get(); // Получение полученных транзакций

        return view('home', compact('sent_transactions', 'receive_transactions'));
    }
}
