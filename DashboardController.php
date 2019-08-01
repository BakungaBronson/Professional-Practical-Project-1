<?php

namespace App\Http\Controllers;
use Charts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Models\Fund;
use App\Models\Agent;
use App\Models\Member;

class DashboardController extends Controller
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
   
   
    $users = Fund::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();
    $chart = Charts::database($users, 'bar', 'chartjs')
			      ->title("funding per month")
			      ->elementLabel("monthly funds")
			      ->dimensions(1000, 500)
			      ->responsive(false)
                  ->groupByMonth(date('Y'), true);
                  

        $users1 = Agent::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();
        $chart2 = Charts::database($users1, 'bar', 'chartjs')
			      ->title("agents per month")
			      ->elementLabel("agents")
			      ->dimensions(1000, 500)
			      ->responsive(false)
                  ->groupByMonth(date('Y'), true);


                  //for percentage change in members

                  $perc = DB::select(DB::raw("SELECT DATE_FORMAT(created_at,'%M %Y') as month,COUNT(*) as total from _members GROUP BY month"));
                  
                  $value=array();
    $updatedvalue=array();
    $month=array();
    foreach($perc as $i)
    {
    array_push($value,$i->total);
    array_push($month,$i->month);
    }
    for($i=0;$i<count($value)-1;$i++){
        array_push($updatedvalue,(($value[$i+1]-$value[$i])/$value[$i]));
    }
    // return $month;
        $chart3 = Charts::create('bar', 'chartjs')
			      ->title("Percentage Change")
                  ->elementLabel("Per months")
                  ->labels($month)
                  ->dimensions(1000, 500)
                  ->values($updatedvalue)
                  ->responsive(false);
      
                   
                  $users = Member::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();
    $chart4 = Charts::database($users, 'line', 'chartjs')
			      ->title("Members enrolled")
			      ->elementLabel("Members")
			      ->dimensions(1000, 500)
			      ->responsive(false)
                  ->groupByMonth(date('Y'), true);
                  

                  

                  


        return view('dashboard',compact('chart','chart2','chart3','chart4'));
            
            
    }
}
