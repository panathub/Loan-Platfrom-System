<?php
namespace App\Http\Controllers\API\Loaner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Borrowlist;
use DB;

class BorrowerlistController extends Controller
{
    public function index($id)
    { 
        $sql="SELECT *  FROM borrowlist 
        INNER JOIN loaners ON loaners.LoanerID  = borrowlist.LoanerID 
        WHERE loaners.LoanerID=$id";
        $recount=DB::select($sql)[0];         
        return response()->json($recount);
    }
    public function create($id)
    {
        //add user data into users table
        $borrowerlist = new Borrowlist();
        $borrowerlist->	money_min = 0;
        $borrowerlist->money_max = 1500;        
        $borrowerlist->	interest = 0;
        $borrowerlist->	Interest_penalty = 0;
        $borrowerlist->	LoanerID = $id;
         
        $borrowerlist->save();                
        return response()->json(array(
            'message' => 'add a borrowerlist successfully', 
            'status' => 'true'));  
    }
    public function update(Request $request,$id)
    {       
        $borrowerlist =Borrowlist::where('LoanerID', '=', $id)->firstOrFail();
        $borrowerlist->money_min = $request->get('money_min');
        $borrowerlist->money_max = $request->get('money_max');        
        $borrowerlist->interest = $request->get('interest');    
        $borrowerlist->Interest_penalty = $request->get('Interest_penalty');   
        $borrowerlist->instullment_max = $request->get('instullment_max');   

        $borrowerlist->save();

        return response()->json(array(
            'message' => 'update a user successfully', 
            'status' => 'true'));
    }
    public function setpublic($id,$status)
    {       
        $sql="UPDATE borrowlist SET status = $status WHERE LoanerID=$id";
        $recount=DB::select($sql);         
        return response()->json($recount);
    }
}