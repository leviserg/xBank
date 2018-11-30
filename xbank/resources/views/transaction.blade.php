@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
             @foreach($trans as $tran)
            <div class="card">
                <div class="card-header">Transaction ID : <b>{{$tran->id}}</b></div>
                <div class="card-body">
                    @include('errors')
                    <form action="transedit{{$tran->id}}" method="POST" class="form">
                        {{csrf_field()}}
                            <div class="form-group">
                                <input name="transName" style="display: none" value="{{$tran->id}}">                 
                                <label class="control-label">Customer Name</label>
                                    <p>{{$tran->customer}}</p>
                                <label for="amountId" class="control-label">Amount</label>
                                    <input type="text" name="amountName" id="amountId" class="form-control" value="{{$tran->amount}}"><br/>
                                <label class="control-label">Last Change</label>
                                    <p>{{$tran->updated_at}}</p>
                                <div class="row">                       
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-info" style="width:30%">Change</button>
                                        <a href="/home" class="btn btn-success" style="width:30%">Back</a>
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
