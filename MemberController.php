<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Repositories\MemberRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Flash;
use Response;

class MemberController extends AppBaseController
{
    /** @var  MemberRepository */
    private $memberRepository;

    public function __construct(MemberRepository $memberRepo)
    {
        $this->memberRepository = $memberRepo;
    }

    /**
     * Display a listing of the Member.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $members = $this->memberRepository->all();
        $total= $this->countMembers();

       $recommenders = DB::table('_members')->distinct('Recommended_By')->pluck('Recommended_By');
       $array ="";
       $names =[];
       $check = 'fail';

       foreach($recommenders as $recommender){
           $count = DB::table('_members')->where('Recommended_By', $recommender)->count();
           if($count>2){
               $check= 'ok';
               $names = Arr::prepend($names,$recommender);
            
       }
    }
        return view('members.index',compact('members','names','total'));
    
}

    /**
     * Show the form for creating a new Member.
     *
     * @return Response
     */
    public function create()
    {
        return view('members.create');
    }

    /**
     * Store a newly created Member in storage.
     *
     * @param CreateMemberRequest $request
     *
     * @return Response
     */
    public function store(CreateMemberRequest $request)
    {
        $input = $request->all();

        $member = $this->memberRepository->create($input);

        

        Flash::success('Member saved successfully.');

        return redirect(route('members.index'));
    }

    /**
     * Display the specified Member.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $member = $this->memberRepository->find($id);

        if (empty($member)) {
            Flash::error('Member not found');

            return redirect(route('members.index'));
        }

        return view('members.show')->with('member', $member);
    }

    /**
     * Show the form for editing the specified Member.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $member = $this->memberRepository->find($id);

        if (empty($member)) {
            Flash::error('Member not found');

            return redirect(route('members.index'));
        }

        return view('members.edit')->with('member', $member);
    }

    /**
     * Update the specified Member in storage.
     *
     * @param int $id
     * @param UpdateMemberRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMemberRequest $request)
    {
        $member = $this->memberRepository->find($id);

        if (empty($member)) {
            Flash::error('Member not found');

            return redirect(route('members.index'));
        }

        $member = $this->memberRepository->update($request->all(), $id);

        Flash::success('Member updated successfully.');

        return redirect(route('members.index'));
    }

    /**
     * Remove the specified Member from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $member = $this->memberRepository->find($id);

        if (empty($member)) {
            Flash::error('Member not found');

            return redirect(route('members.index'));
        }

        $this->memberRepository->delete($id);

        Flash::success('Member deleted successfully.');

        return redirect(route('members.index'));
    }


    public function flash(){
        $recommenders = DB::table('_members')->distinct('Recommended_By')->pluck('Recommended_By');
        $array ="";
        $names =[];
        $check = 'fail';
 
        foreach($recommenders as $recommender){
            $count = DB::table('_members')->where('Recommended_By', $recommender)->count();
            if($count >2){
                $check= 'ok';
                $names = Arr::prepend($names,$recommender);
                $array =$array.",".$recommender;
            }
        }
        if(str::is('ok', $check)){
            Flash::success($array." have reached 40 recommendations");
            
        }

        return redirect(route('members.index'));

    }


    public function countMembers(){
        $total=DB::table('_members')
            
     ->count('id');
     return $total;
    }
}
