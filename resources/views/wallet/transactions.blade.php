@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <table data-toggle="table">
                <thead>
                <tr>
                    <th>User</th>
                    <th>Wallet</th>
                    <th>Type</th>
                    <th>Ammount</th>
                </tr>
                </thead>
                <tbody>
                @foreach($transactions as $transaction)
                    <tr>
                        <td><?php echo \App\Models\User::where('id',$transaction->payable_id)->first()->name ?></td>
                        <td><?php echo \App\Models\Wallet::where('id',$transaction->wallet_id)->first()->name ?> </td>
                        <td>{{$transaction->type}}</td>
                        <td>{{$transaction->amount}}</td>

                    </tr>
                @endforeach

                </tbody>
            </table>

        </div>
    </div>
@endsection
