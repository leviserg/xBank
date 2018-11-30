<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;

class TransactionController extends Controller
{
    	public function update(Request $request){
    		$validator = Validator::make($request->all(), [
				'amountName'=>'required|numeric|between:0,99999.99',
			]);
			if($validator->fails()){
				return redirect('/transaction'.$request->transName)
					->withErrors($validator);
			}

	    	DB::table('transactions')
	            ->where('id', '=', $request->transName)
	            ->update(['amount' => $request->amountName, 'updated_at' => now()]);
	        return redirect('/home');
    	}

    	public function insert(Request $request){
			$validator = Validator::make($request->all(), [
				'amountName'=>'required|numeric|between:0,99999.99',
				'custname'=>'required|numeric|min:1',
			]);
			if($validator->fails()){
				return redirect('/home')
					->withErrors($validator);
			}
			$newTransaction = new \App\Transaction;
			$newTransaction->amount = $request->amountName;
			$newTransaction->customerId = $request->custname;
			$newTransaction->created = today();
			$newTransaction->updated_at = now();
			$newTransaction->created_at = now();
			$newTransaction->save();
		    return redirect('/home');
    	}

}
