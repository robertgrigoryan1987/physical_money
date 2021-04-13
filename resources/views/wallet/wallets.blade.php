@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="row row-flex">
            @foreach($wallets as $wallet)
                    <div class="col-sm-6 col-md-4">
                        <div class="">
                            <img src="/images/wallet.png" alt="Wallet">
                            <div class="">
                                <p>Name : {{$wallet->name}}</p>
                                <p>Balanse : ${{$wallet->balance}}</p>
                            </div>
                        </div>
                    </div>
            @endforeach
            </div>
        </div>
    </div>
@endsection
