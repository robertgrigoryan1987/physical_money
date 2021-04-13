@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{route('wallet.add.post')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Name*</label>
                    <input type="text" class="form-control" id="name" name="name" aria-describedby="Name" placeholder="Enter name">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Balance*</label>
                    <input type="number" class="form-control"  placeholder="Balance" name="balance">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
