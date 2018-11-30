<?php
	namespace App\Console\Commands;
	use Illuminate\Console\Command;
	//use Illuminate\Support\Facades\DB;
	use DB;
	use Illuminate\Http\Request;
	use App;

	class ReportCommand extends Command{

		protected $signature = 'custom:report';
		protected $description = 'Make report every 2 days';

		public function __construct(){
			parent::__construct();
		}

		public function handle(){
			$prevdate = NOW();
            $sumTransactions = DB::table('transactions')
                ->where('updated_at','>',' NOW() - INTERVAL 2 DAY')
                ->sum('amount');

            $newReport = new \App\Report;
            $newReport->sumamount = floatval($sumTransactions);
            $newReport->updated_at = now();
            $newReport->created_at = now();
            $newReport->save();
            $this->info('Report saved success');
		}

	}