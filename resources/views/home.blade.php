@extends('layouts.app')

@section('content')
<div class="container-xxl">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">Профиль</div>
                        <div class="card-body">
                            <div class="row">
                                <h3>{{Auth::user()->name}}</h3>
                                <p class="w-100">Ваш баланс составляет: {{Auth::user()->balance}} BTC</p>
                                <p>Ваш кошелек для перевода - {{Auth::user()->wallet}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">Перевод средств</div>
                        <div class="card-body">
                            <form action = '{{route('transaction.create')}}' method="post" >
                                @csrf
                                <div class="form-group">
                                    <label for="adress">Адрес получателя</label>
                                    <input type="text" name = 'recipient' class="form-control" id="adress" placeholder="2iRWASzBAG...hNC4">
                                    <x-error name="wallet"/>
                                    <x-error name="recipient"/>

                                </div>
                                <div class="form-group">
                                <div class="form-group">
                                    <label for="amount">Сумма (BTC)</label>
                                    <input class="form-control" id="amount" name = "amount" placeholder="0.3">
                                    <x-error name="amount"/>
                                </div>
                                <p>С учетом комиссии с вашего баланса спишется: <span id = 'output'>0</span> BTC</p>
                                <input name = 'sender' value = '{{Auth::user()->wallet}}' type = "hidden">

                                @if(Session::has('success'))
                                    <div class="alert alert-success">
                                        {{ Session::get('success') }}
                                    </div>
                                @endif

                                <button type="submit" class="btn btn-primary">Отправить</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top:30px">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">Исходящие транзакции</div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Получатель</th>
                                    <th scope="col">Сумма</th>
                                </tr>
                                @foreach($sent_transactions as $sent_transaction)
                                    <tr>
                                        <th scope="col">{{$sent_transaction->recipient}}</th>
                                        <th scope="col">{{$sent_transaction->amount}}</th>
                                    </tr>
                                @endforeach
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">Входящие транзакции</div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Отправитель</th>
                                    <th scope="col">Сумма</th>
                                </tr>
                                @foreach($receive_transactions as $receive_transaction)
                                    <tr>
                                        <th scope="col">{{$receive_transaction->sender}}</th>
                                        <th scope="col">{{$receive_transaction->amount}}</th>
                                    </tr>
                                @endforeach
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="{{ asset('js/calculator.js') }}" defer></script>
