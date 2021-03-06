<?php
namespace App\Http\Controllers\API\Borrower;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RequestM;
use Illuminate\Support\Facades\Mail;
use DB;

class RequestController extends Controller
{
    public function addRequest(Request $request)
    { 
        date_default_timezone_set('Asia/Bangkok');
        $re = new RequestM();
        $re->Money  = $request->get('Money');
        $re->instullment_request  = $request->get('instullment');
        $re->Interest_request  = $request->get('Interest');
        $re->Interest_penalty_request  = $request->get('Interest_penalty');
        $re->status = 0;
        $re->dateRe =  date('Y-m-d');
        $re->BorrowerID = $request->get('BorrowerID');
        $re->borrowlistID = $request->get('borrowlistID');
        $re->save();
        return response()->json(array(
        'message' => 'add a  successfully',
        'status' =>'true'));
    }
    //ใช้ดูทั้งหน้าแรก และดีเทล
    public function viewRequest(Request $request)
    { 
        $BorrowerID = $request->get('BorrowerID');
        $borrowlistID  = $request->get('borrowlistID');

        $sql="SELECT request.*,loaners.*  FROM request
        INNER JOIN borrowlist ON borrowlist.borrowlistID =request.borrowlistID
        INNER JOIN loaners ON loaners.LoanerID  = borrowlist.LoanerID 
        WHERE 1 ";
        if($borrowlistID!=""){
            $sql.=" AND (request.status = 0 OR request.status = 1 OR request.status = 2 OR request.status = 3 )"; 
            $sql.=" AND borrowlist.borrowlistID =$borrowlistID AND request.BorrowerID =$BorrowerID";   
        }if($BorrowerID!="" && $borrowlistID==""){
            $sql.=" AND (request.status = 0 OR request.status = 2) "; 
            $sql.=" AND request.BorrowerID =$BorrowerID ";      
        }
     
        $recount=DB::select($sql);         
        return response()->json($recount);
    }

    public function viewUnpass(Request $request)
    { 
        $BorrowerID = $request->get('BorrowerID');
        $borrowlistID  = $request->get('borrowlistID');

        $sql="SELECT request.*,loaners.*  FROM request
        INNER JOIN borrowlist ON borrowlist.borrowlistID =request.borrowlistID
        INNER JOIN loaners ON loaners.LoanerID  =borrowlist.LoanerID 
        WHERE 1  AND (request.status = 4 OR request.status = 14) ";
        if($borrowlistID!=""){
            $sql.=" AND borrowlist.borrowlistID =$borrowlistID ";      
        }if($BorrowerID!=""){
            $sql.=" AND request.BorrowerID ='$BorrowerID' ";      
        }
     
        $recount=DB::select($sql);         
        return response()->json($recount);
    }
    public function viewConfirmed($BorrowerID){
        $sql="SELECT request.*,loaners.* FROM request 
        INNER JOIN borrowlist ON borrowlist.borrowlistID =request.borrowlistID
        INNER JOIN loaners ON loaners.LoanerID  =borrowlist.LoanerID 
        WHERE 1 AND (request.status = 1 OR request.status = 11) 
        AND request.BorrowerID =$BorrowerID";
        
        $confirm=DB::select($sql);
        return response()->json($confirm);
    }

    public function viewConfirmedDetail($RequestID){
        $sql="SELECT request.*,loaners.* FROM request
        INNER JOIN borrowlist ON borrowlist.borrowlistID =request.borrowlistID
        INNER JOIN loaners ON loaners.LoanerID  =borrowlist.LoanerID 
        WHERE 1 AND request.RequestID = $RequestID";

        $confirm=DB::select($sql)[0];
        return response()->json($confirm);
    }

    public function updateUnpassChecked($id)
    {       
        $user = RequestM::find($id);
        $user->status = 14;      
        $user->save();
        return response()->json(array(
            'message' => 'update successfully', 
            'status' => 'true'));
    }
    public function updateAccept($id)
    {       
        date_default_timezone_set('Asia/Bangkok');
        $user = RequestM::find($id);
        $user->dateAccept =  date('Y-m-d');
        $user->status = 2;      
        $user->save();
        return response()->json(array(
            'message' => 'update successfully', 
            'status' => 'true'));
    }


    public function delete($RequestID)
    { 
        $sql="DELETE FROM request WHERE RequestID=$RequestID";
        $recount=DB::select($sql);         
        return response()->json($recount);
    }

    public function cancleRequest($BorrowerID)
    { 
        date_default_timezone_set('Asia/Bangkok');
        $dateCheck =date('Y-m-d');
        $sql="UPDATE request
        SET status = 4 , comment = 'ยกเลิก', dateCheck =  '$dateCheck'
        WHERE (status = 1 OR status = 0) AND BorrowerID =$BorrowerID ;";
        $recount=DB::select($sql);         
        return response()->json($recount);
    }
    

    public function count($BorrowerID)
    { 
        $sql="SELECT DISTINCT  
                     (SELECT count(RequestID) FROM request WHERE (request.status = 0 OR request.status = 2) AND BorrowerID =$BorrowerID) as count_waiting,
                     (SELECT count(RequestID) FROM request WHERE status = 1 AND BorrowerID =$BorrowerID) as count_confirm,
                     (SELECT count(RequestID) FROM request WHERE status = 4 AND BorrowerID =$BorrowerID) as count_unpass,
                     (SELECT count(RequestID) FROM request WHERE status = 3 AND BorrowerID =$BorrowerID) as count_paying,

                     (SELECT count(RequestID) FROM request,borrowlist WHERE request.borrowlistID =borrowlist.borrowlistID AND 
                     (request.status = 0 OR request.status = 1)AND borrowlist.LoanerID  =$BorrowerID) as count_request_loaner,
                     (SELECT count(RequestID) FROM request,borrowlist WHERE request.borrowlistID =borrowlist.borrowlistID AND
                     request.status = 2 AND borrowlist.LoanerID  =$BorrowerID) as count_pay_loaner,
                     (SELECT count(RequestID) FROM request,borrowlist WHERE request.borrowlistID =borrowlist.borrowlistID AND
                     request.status = 3 AND borrowlist.LoanerID  =$BorrowerID) as count_Waitpay_loaner
        FROM request " ;//บน Borrower = BorrowerID
                        //ล่าง Loaner = LoanerID
        $recount=DB::select($sql)[0];         
        
        return response()->json($recount);
    }

    public function nextDate($BorrowDetailID){

        $sql="SELECT settlement_date FROM history 
              WHERE 1 AND  BorrowDetailID = $BorrowDetailID AND status =0";
        $data = DB::select($sql)[0];

        return response()->json($data);
    }
    public function AllSuccess($BorrowerID){
        
        $sql="SELECT loaners.*,borrowdetail.* FROM borrowdetail 
        INNER JOIN borrowlist ON borrowlist.borrowlistID = borrowdetail.borrowlistID
        INNER JOIN loaners ON loaners.LoanerID =borrowlist.LoanerID
        WHERE borrowdetail.BorrowerID = $BorrowerID  AND borrowdetail.status = 1";
        $data = DB::select($sql);
        return response()->json($data);

    }
}