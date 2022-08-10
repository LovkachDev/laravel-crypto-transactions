<?php

namespace App\Http\Controllers;

use App\Http\Requests\Transaction\CreateTransaction;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use phpDocumentor\Reflection\Types\Integer;


class TransactionsController extends Controller
{
    static public function allTransactions(){
        $transactions = Transaction::orderBy('id', 'DESC')->get();
        return view('transaction', compact('transactions'));
    }

    static public function getComission($amount):float{
        $comission = $amount * 0.01;
        return $amount + $comission;
    }


    static public function createTransaction(CreateTransaction $request){

        $data = $request->validated(); // Дефолтная валидация
        $data['status'] = 'complete';

        $totalAmount = self::getComission($request['amount']); // Получение суммы вместе с комиссией

        $recipient = User::where('wallet', $request['recipient'])->first();
        $sender = User::where('wallet', $request['sender'])->first();

        if(!$recipient){ // Если кошелек не найден
            throw ValidationException::withMessages([
                'wallet' => __('Кошелек не найден')
            ]);
        }

        if($recipient == $sender){
            throw ValidationException::withMessages([
                'wallet' => __('Вы не можете отправить средства себе')
            ]);
        }

        if($totalAmount > $sender->balance){ // Если сумма транзакции > баланса
            throw ValidationException::withMessages([
                'amount' => __('Сумма сделки больше баланса')
            ]);
        }

        $sender->balance -= $totalAmount; // Отнимаем баланс у пользователя с учетом комиссии
        $recipient->balance += $request['amount']; // Прибавляем баланс получателю
        $sender->save();
        $recipient->save();

        Transaction::create($data); // Создаем транзакцию

        return back()->with('success', __('Транзакция успешно создана'));
    }
}
