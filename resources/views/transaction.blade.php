@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Все транзакции</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Отправитель</th>
                                <th scope="col">Получатель</th>
                                <th scope="col">Сумма</th>
                                <th scope="col">Статус</th>
                            </tr>
                             @foreach($transactions as $transaction)

                                </thead>
                                <tbody>
                                <tr>
                                    <td id = "sender">{{$transaction->sender}}</td>
                                    <td>{{$transaction->recipient}}</td>
                                    <td>{{$transaction->amount}} BTC</td>
                                    <td>{{$transaction->status}}</td>
                                </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{ asset('js/shorter.js') }}" defer></script>
