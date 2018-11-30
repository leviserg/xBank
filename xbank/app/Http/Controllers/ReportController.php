<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use DB;

class ReportController extends Controller
{
        public function insert(){
        	
        	$prevdate = NOW();

	        $sumTransactions = DB::table('transactions')
	        	->where('updated_at','>',' NOW() - INTERVAL 2 DAY')
	        	->sum('amount');

            $newReport = new \App\Report;
			$newReport->sumamount = floatval($sumTransactions);
			$newReport->updated_at = now();
			$newReport->created_at = now();
			$newReport->save();
			
			return redirect('/home');
    	}
}
