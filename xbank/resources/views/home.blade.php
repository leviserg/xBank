@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('errors')
            <form action="{{ url('customer')}}" method="POST" class="form-horizontal">
                {{csrf_field()}}
                    <div class="form-group">
                        <label for="customerNameid" class="control-label">New customer</label>
                        <div class="row">
                            <div class="col-md-9">
                                <input type="text" name="customername" id="customerNameid" class="form-control" placeholder="New Customer">
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-success">Add customer</button>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
        <div class="col-md-1">
            <div class="clear-fix"></div>
        </div>
        <div class="col-md-8">        
            <form action="{{ url('transaction')}}" method="POST" class="form-horizontal">
                {{csrf_field()}}
                    <div class="form-group">
                        <label for="amountId" class="control-label">New transaction</label>
                        <div class="row">
                            <div class="col-md-5">
                                <select class="form-control" name="custname" id="custid">
                                    <option value="0">Select customer...</option>
                                    @if(count($vars['custs'])>0)
                                        @foreach($vars['custs'] as $cust)
                                            <option value="{{$cust->id}}">{{$cust->customername}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="amountName" id="amountId" class="form-control" placeholder="0.00">
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-success">Add transaction</button>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>

    <!-- include dataTable -->
    @if($vars['trans'] > 0)

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <h5>Transactions. Search :
                        <input type="text" name="searchName" id="searchId" value="{{$vars['srch']}}">
                            <span style="margin:10px">limit</span>
                            <input type="number" name="limName" id="limId" class="lim" value="{{$vars['lim']}}">
                            <a href="/home" class="btn">Reset filter</a>
                    </h5>
                </div>

            </div>
        </div>
    </div>

        <div class="table table-responsive container"><br/>
            <table id="tblid" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="5%" class="text-center">ID</th>
                        <th width="20%" class="text-center">Customer</th>
                        <th width="15%" class="text-center">
                            <div class="desc" id="sortdesc"></div>
                                Amount
                            <div class="asc" id="sortasc"></div>
                        </th>
                        <th width="20%" class="text-center">Updated</th>
                        <th width="20%" class="text-center">Created</th>
                        <th width="10%" class="text-center">Edit</th>
                        <th width="10%" class="text-center">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                    <tr>
                        <td class="table-text" id="tr_id{{$transaction->id}}">
                            {{$transaction->id}}
                        </td>
                        <td class="table-text" id="tr_cust{{$transaction->id}}">
                            {{$transaction->customer}}
                        </td>
                        <td class="table-text text-center" id="tr_am{{$transaction->id}}">
                            <strong>{{$transaction->amount}}</strong>
                        </td>
                        <td class="table-text text-center" id="tr_cr{{$transaction->id}}"">
                            {{$transaction->updated_at}}
                        </td>
                        <td class="table-text text-center">
                            {{$transaction->created_at}}
                        </td>
                        <td class="text-center">
                            <a href="transaction/{{$transaction->id}}"><button class="btn btn-info" style="width:80%">Edit</button></a>
                        </td>
                        <td class="text-center">
                            <form action="{{url('transaction/'.$transaction->id)}}" method="POST">
                                {{csrf_field()}}
                                {{method_field('delete')}}
                                <button class="btn btn-danger" style="width:80%">Delete</button>
                            </form>
                        </td>
                    </tr>               
                    @endforeach
                </tbody>
            </table>
        </div>
    {{$transactions->links()}}
        <script src="{{ asset('js/myscripts.js') }}"></script>
    @endif
    <p>Total Transactions : <? echo($vars['trans']) ?></p>
</div>        
@endsection
