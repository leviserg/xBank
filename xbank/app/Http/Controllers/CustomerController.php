<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;

class CustomerController extends Controller
{
        public function addCustomer(Request $request){
			$validator = Validator::make($request->all(), [
				'customername'=>'required|max:20',
			]);
			if($validator->fails()){
				return redirect('/home')
					->withErrors($validator);
			}
			$newcustomer = new \App\Customer;
			$newcustomer->customername = $request->customername;
			$newcustomer->save();
		    return redirect('/home');
    	}
}
