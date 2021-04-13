@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-20">
                <div class="card">
                    <div class="card-header">
                        <img src="/images/1.jpg" alt=""> Profile <a href="#"><i class="ti-arrow-top-right"></i></a>
                    </div>
                    <div class="card-body">
                        <p> <strong>{{$user->name}}</strong></p>
                        <p></p>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-20">
                <div class="card">
                    <div class="card-header">
                        <h3>BALANCE</h3>
                    </div>
                    <div class="card-body">
                        <p> <strong>${{$balance_sum}}</strong></p>
                        <p></p>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-20">
                <div class="card">
                    <div class="card-header">
                        <h3>BANK ACCOUNT</h3>
                    </div>
                    <div class="card-body">
                        <p> <strong>HSBC BANK</strong></p>
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="padding-top: 20px;">
            <div class="container">
                <div class="call-to-action centered">
                    <div class="section-title">
                        <h4 style="text-align: center;"><span>Transfer </span>With my wallet</h4>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-12 col-lg-12 col-sm-12">
                            <form class="form-inline" method="post" action="">
                                @csrf
                                <div class="form-group mx-sm-3 mb-2">
                                    <label for="staticEmail2" class="sr-only">From</label>
                                    <select class="form-control" id="" name="from">
                                        <option>Select Wallet</option>
                                        @foreach($wallets as $wallet)
                                            <option value="{{$wallet->id}}">{{$wallet->name}}:${{$wallet->balance}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mx-sm-3 mb-2">
                                    <label for="inputPassword2" class="sr-only">To</label>
                                    <select class="form-control" id="" name="to">
                                        <option>Select Wallet</option>
                                        @foreach($wallets as $wallet)
                                            <option value="{{$wallet->id}}">{{$wallet->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mx-sm-3 mb-2">
                                    <label for="inputPassword2" class="sr-only" >Ammount</label>
                                    <input type="number" name="ammount" placeholder="Amount" />
                                </div>
                                <button type="submit" class="btn btn-primary mb-2">Transfer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="padding-top: 20px;">
            <div class="container">
                <div class="call-to-action centered">
                    <div class="section-title">
                        <h4 style="text-align: center;"><span>Transfer </span>to another user</h4>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-12 col-lg-12 col-sm-12">
                            <form class="form-inline" method="post" action="{{route('wallet.transfer_user.post')}}">
                                @csrf
                                <div class="form-group mx-sm-3 mb-2">
                                    <label for="staticEmail2" class="sr-only">From</label>
                                    <select class="form-control" id="" name="from_me">
                                        <option>Select Wallet</option>
                                        @foreach($wallets as $wallet)
                                            <option value="{{$wallet->id}}">{{$wallet->name}}:${{$wallet->balance}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mx-sm-3 mb-2">
                                    <label for="inputPassword2" class="sr-only">User</label>
                                    <select class="form-control" id="user-select" name="user">
                                        <option>Select User</option>
                                        @foreach($users as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mx-sm-3 mb-2 usser-wallet">

                                </div>
                                <div class="form-group mx-sm-3 mb-2">
                                    <label for="inputPassword2" class="sr-only" >Ammount</label>
                                    <input type="number" name="ammount" placeholder="Amount" />
                                </div>
                                <button type="submit" class="btn btn-primary mb-2">Transfer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
