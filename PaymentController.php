<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Repositories\PaymentRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Flash;
use Response;

class PaymentController extends AppBaseController
{
    /** @var  PaymentRepository */
    private $paymentRepository;

    public function __construct(PaymentRepository $paymentRepo)
    {
        $this->paymentRepository = $paymentRepo;
    }

    /**
     * Display a listing of the Payment.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    { 

      
                $conn = mysqli_connect("localhost", "root","", "Recess2");
           
                $one = "SELECT count(id) as 'agentnumber' from _agents where deleted_at IS NULL";
                $deal1 =mysqli_query($conn, $one);
                $category1 =mysqli_fetch_array($deal1);
                $numberofagents = $category1['agentnumber'];

                $highest =DB::table('_members')->whereNull('deleted_at')->distinct('District')->pluck('District');
                $count = 0;
                $countx =0;
                $highestdistrict ='';
                  foreach($highest as $district){
                    $count=DB::table('_members')
                                              
                    ->where('District', $district)
                     ->count();
                                        
                        if($count > $countx){
                        $countx = $count;
                        $highestdistrict  = $district;
                                    }
                                        
            
                                   } 
                                   
                $four = "SELECT count(id) as 'high_agents' from _agents where District_Assigned = '$highestdistrict'AND deleted_at IS NULL";
                $deal4 =mysqli_query($conn, $four);
                $category4 =mysqli_fetch_array($deal4);
                $highestagents = $category4['high_agents'];
           
                $normalagents = $numberofagents - $highestagents;
           
                $five = "SELECT count(id) as 'ALIE' from _agents where Roles = 'Agent head' AND District_Assigned!= '$highestdistrict' AND deleted_at IS NULL";
                $deal5 =mysqli_query($conn, $five);
                $category5 =mysqli_fetch_array($deal5);
                $m = $category5['ALIE'];
                
           
                $n = $normalagents - $m;
           
                $maria= 1;
           
                $N = $highestagents -$maria;
           
                $seven = "SELECT sum(Amount) as 'available' from _funds ";
                $deal7 =mysqli_query($conn, $seven);
                $category7 =mysqli_fetch_array($deal7);
                $treasury = $category7['available'];

                 
                if( date("d ")==01){
                if($treasury > 2000000){
                    $share = $treasury - 2000000;
                    $available = $share/($n + ((7/4)*$m) + (7/2) + (2*$N) + 0.5);
                    

                   $agents=DB::table('_agents')
                           ->whereNull('deleted_at')
                           ->get();
                    
                             
                    foreach ($agents as $row) {
                       $position=$row->Roles;
                       $name=$row->Name;
                       $distr=$row->District_Assigned;
           
                       if($position=='Admin'){
                           $payadmin = 0.5*$available;
                           $put = array('Agent_Name'=>$name, 'Position'=>$position, 'Salary'=>$payadmin);
                           DB::table('_payments')->insert($put);
                       }
           
                       if($position == 'Agent head' && $distr ==$highestdistrict){
                       $payhighagenthead = (7/2)*$available;
                       $put3 = array('Agent_Name'=>$name, 'Position'=>$position, 'Salary'=>$payhighagenthead);
                       DB::table('_payments')->insert($put3);
                       }
           
                       if($position == 'Agent' && $distr == $highestdistrict){
                      $payhighagent = (2*$available)/$N;
                      $put4 = array('Agent_Name'=>$name, 'Position'=>$position, 'Salary'=>$payhighagent);
                      DB::table('_payments')->insert($put4);
                       }
           
                     if($position == 'Agent head' && $distr !=$highestdistrict){
                      $payagenthead = (7/4)*$available;
                      $put2 = array('Agent_Name'=>$name, 'Position'=>$position, 'Salary'=>$payagenthead);
                      DB::table('_payments')->insert($put2);
           
                       }
                   if($position == 'Agent' && $distr != $highestdistrict){
                      $payagent = ($available)/$n;
                      $put1 = array('Agent_Name'=>$name, 'Position'=>$position, 'Salary'=>$payagent);
                      DB::table('_payments')->insert($put1);
                       }

              $payments=  DB::select('select * from _payments');
              
             
              

                    
                    }

                    

                    
                  
               
                }
                
            
            return view('payments.index',compact('payments'));
                }else{
              $payments=  DB::select('select * from _payments');

            return view('payments.index',compact('payments'));

                }
            
    }
    /**
     * Show the form for creating a new Payment.
     *
     * @return Response
     */
    public function create()
    {
        return view('payments.create');
    }

    /**
     * Store a newly created Payment in storage.
     *
     * @param CreatePaymentRequest $request
     *
     * @return Response
     */
    public function store(CreatePaymentRequest $request)
    {
        $input = $request->all();

        $payment = $this->paymentRepository->create($input);

        Flash::success('Payment saved successfully.');

        return redirect(route('payments.index'));
    }

    /**
     * Display the specified Payment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $payment = $this->paymentRepository->find($id);

        if (empty($payment)) {
            Flash::error('Payment not found');

            return redirect(route('payments.index'));
        }

        return view('payments.show')->with('payment', $payment);
    }

    /**
     * Show the form for editing the specified Payment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $payment = $this->paymentRepository->find($id);

        if (empty($payment)) {
            Flash::error('Payment not found');

            return redirect(route('payments.index'));
        }

        return view('payments.edit')->with('payment', $payment);
    }

    /**
     * Update the specified Payment in storage.
     *
     * @param int $id
     * @param UpdatePaymentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePaymentRequest $request)
    {
        $payment = $this->paymentRepository->find($id);

        if (empty($payment)) {
            Flash::error('Payment not found');

            return redirect(route('payments.index'));
        }

        $payment = $this->paymentRepository->update($request->all(), $id);

        Flash::success('Payment updated successfully.');

        return redirect(route('payments.index'));
    }

    /**
     * Remove the specified Payment from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $payment = $this->paymentRepository->find($id);

        if (empty($payment)) {
            Flash::error('Payment not found');

            return redirect(route('payments.index'));
        }

        $this->paymentRepository->delete($id);
        $payment->forceDelete($id);

        Flash::success('Payment deleted successfully.');

        return redirect(route('payments.index'));
    }
}
