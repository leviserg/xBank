<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use DB;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vars = [
            'custs' => App\Customer::all(),
            'trans' => App\Transaction::count('id'),
            'srch'  => '',
            'lim'   => ''
        ];
     
        $transactions = DB::table('transactions')
            ->join('customers', 'transactions.customerId', '=', 'customers.id')
            ->select('transactions.id', 'customers.customername as customer', 'amount','transactions.updated_at','transactions.created_at')
            ->orderBy('transactions.id', 'asc')
            ->paginate(5);
            return view('home', compact('vars','transactions'));
    }

    public function indexdesc()
    {
        $vars = [
            'custs' => App\Customer::all(),
            'trans' => App\Transaction::count('id'),
            'srch'  => '',
            'lim'   => ''
        ];
        $transactions = DB::table('transactions')
            ->join('customers', 'transactions.customerId', '=', 'customers.id')
            ->select('transactions.id', 'customers.customername as customer', 'amount','transactions.updated_at','transactions.created_at')
            ->orderBy('amount', 'desc')
            ->paginate(5);
        return view('home', compact('vars','transactions'));
    }

    public function indexasc()
    {
        $vars = [
            'custs' => App\Customer::all(),
            'trans' => App\Transaction::count('id'),
            'srch'  => '',
            'lim'   => ''
        ];
        $transactions = DB::table('transactions')
            ->join('customers', 'transactions.customerId', '=', 'customers.id')
            ->select('transactions.id', 'customers.customername as customer', 'amount','transactions.updated_at','transactions.created_at')
            ->orderBy('amount', 'asc')
            ->paginate(5);
        return view('home', compact('vars','transactions'));
    }


    public function show($id){
        $trans = DB::table('transactions')
            ->join('customers', 'transactions.customerId', '=', 'customers.id')
            ->select('transactions.id', 'customers.customername as customer', 'amount','transactions.updated_at','transactions.created_at')
            ->where('transactions.id', '=', $id)
            ->get();
        return view('transaction', compact('trans'));
    }

    public function search($val){

        $vars = [
            'custs' => App\Customer::all(),
            'trans' => App\Transaction::count('id'),
            'srch'  => $val,
            'lim'   => ''
        ];

            if(is_numeric($val)){
                $transactions = DB::table('transactions')
                    ->join('customers', 'transactions.customerId', '=', 'customers.id')
                    ->select('transactions.id', 'customers.customername as customer', 'amount','transactions.updated_at','transactions.created_at')
                    ->where('amount', '>=', $val)
                    ->paginate(5);
            }
            else{
                $transactions = DB::table('transactions')
                    ->join('customers', 'transactions.customerId', '=', 'customers.id')
                    ->select('transactions.id', 'customers.customername as customer', 'amount','transactions.updated_at','transactions.created_at')
                    ->where('customers.customername', 'like', '%'.$val.'%')
                    ->paginate(5);
            }
        return view('home', compact('vars','transactions'));
    }

    public function searchlim($val, $lim){
            $vars = [
                'custs' => App\Customer::all(),
                'trans' => App\Transaction::count('id'),
                'srch'  => $val,
                'lim'   => $lim
            ];
            if(is_numeric($val)){
                $transactions = DB::table('transactions')
                    ->join('customers', 'transactions.customerId', '=', 'customers.id')
                    ->select('transactions.id', 'customers.customername as customer', 'amount','transactions.updated_at','transactions.created_at')
                    ->where('amount', '>=', $val)
                    ->skip(0)
                    ->take($lim)
                    //->get();
                    ->paginate($lim);
            }
            else{
                $transactions = DB::table('transactions')
                    ->join('customers', 'transactions.customerId', '=', 'customers.id')
                    ->select('transactions.id', 'customers.customername as customer', 'amount','transactions.updated_at','transactions.created_at')
                    ->where('customers.customername', 'like', '%'.$val.'%')
                    ->skip(0)
                    ->take($lim)
                    //->get();
                    ->paginate($lim);
            }
        return view('home', compact('vars','transactions'));
    }


        public function searchdesc($val){
            $vars = [
                'custs' => App\Customer::all(),
                'trans' => App\Transaction::count('id'),
                'srch'  => $val,
                'lim'   => ''
            ];
            if(is_numeric($val)){
                $transactions = DB::table('transactions')
                    ->join('customers', 'transactions.customerId', '=', 'customers.id')
                    ->select('transactions.id', 'customers.customername as customer', 'amount','transactions.updated_at','transactions.created_at')
                    ->where('amount', '>=', $val)
                    ->orderBy('amount', 'desc')
                    ->paginate(5);
            }
            else{
                $transactions = DB::table('transactions')
                    ->join('customers', 'transactions.customerId', '=', 'customers.id')
                    ->select('transactions.id', 'customers.customername as customer', 'amount','transactions.updated_at','transactions.created_at')
                    ->where('customers.customername', 'like', '%'.$val.'%')
                    ->orderBy('amount', 'desc')
                    ->paginate(5);
            }
        return view('home', compact('vars','transactions'));
    }

        public function searchlimdesc($val, $lim){
            $vars = [
                'custs' => App\Customer::all(),
                'trans' => App\Transaction::count('id'),
                'srch'  => $val,
                'lim'   => $lim
            ];
            if(is_numeric($val)){
                $transactions = DB::table('transactions')
                    ->join('customers', 'transactions.customerId', '=', 'customers.id')
                    ->select('transactions.id', 'customers.customername as customer', 'amount','transactions.updated_at','transactions.created_at')
                    ->where('amount', '>=', $val)
                    ->skip(0)
                    ->take($lim)
                    ->orderBy('amount', 'desc')
                    ->paginate($lim);
            }
            else{
                $transactions = DB::table('transactions')
                    ->join('customers', 'transactions.customerId', '=', 'customers.id')
                    ->select('transactions.id', 'customers.customername as customer', 'amount','transactions.updated_at','transactions.created_at')
                    ->where('customers.customername', 'like', '%'.$val.'%')
                    ->skip(0)
                    ->take($lim)
                    ->orderBy('amount', 'desc')
                    ->paginate($lim);
            }
        return view('home', compact('vars','transactions'));
    }

       public function searchasc($val){
            $vars = [
                'custs' => App\Customer::all(),
                'trans' => App\Transaction::count('id'),
                'srch'  => $val,
                'lim'   => ''
            ];
            if(is_numeric($val)){
                $transactions = DB::table('transactions')
                    ->join('customers', 'transactions.customerId', '=', 'customers.id')
                    ->select('transactions.id', 'customers.customername as customer', 'amount','transactions.updated_at','transactions.created_at')
                    ->where('amount', '>=', $val)
                    ->orderBy('amount', 'asc')
                    ->paginate(5);
            }
            else{
                $transactions = DB::table('transactions')
                    ->join('customers', 'transactions.customerId', '=', 'customers.id')
                    ->select('transactions.id', 'customers.customername as customer', 'amount','transactions.updated_at','transactions.created_at')
                    ->where('customers.customername', 'like', '%'.$val.'%')
                    ->orderBy('amount', 'asc')
                    ->paginate(5);
            }
        return view('home', compact('vars','transactions'));
    }

        public function searchlimasc($val, $lim){
            $vars = [
                'custs' => App\Customer::all(),
                'trans' => App\Transaction::count('id'),
                'srch'  => $val,
                'lim'   => $lim
            ];
            if(is_numeric($val)){
                $transactions = DB::table('transactions')
                    ->join('customers', 'transactions.customerId', '=', 'customers.id')
                    ->select('transactions.id', 'customers.customername as customer', 'amount','transactions.updated_at','transactions.created_at')
                    ->where('amount', '>=', $val)
                    ->skip(0)
                    ->take($lim)
                    ->orderBy('amount', 'asc')
                    ->paginate($lim);
            }
            else{
                $transactions = DB::table('transactions')
                    ->join('customers', 'transactions.customerId', '=', 'customers.id')
                    ->select('transactions.id', 'customers.customername as customer', 'amount','transactions.updated_at','transactions.created_at')
                    ->where('customers.customername', 'like', '%'.$val.'%')
                    ->skip(0)
                    ->take($lim)
                    ->orderBy('amount', 'asc')
                    ->paginate($lim);
            }
        return view('home', compact('vars','transactions'));
    }

}
