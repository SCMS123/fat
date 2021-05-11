<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Validator;
use Input;
use Auth;
use Cookie;
use Session;
use DB;
use Image;
use File;
use Exception;
use Mail;
use App\User;
use App\Models\Lead;
use App\Models\LeadComment;
use App\Models\SalesOrder;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Dealer;
use App\Helpers\AdminHelper;
use Carbon;

class ReportController extends Controller
{
    /*Leads Reports by user (Sales Calls)*/
    public function salesCallsReport(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(array(
                                        'status' => 400,
                                        'message'=> 'Error',
                                        'error_message'=>$validator->errors()
                                    ),200);
        }

        if (!empty($request->date) || !empty($request->status)) {
            $queryData = Lead::join('users','leads.user_id','=','users.id');

            if (!empty($request->date)) {
                $queryData = $queryData->where('leads.date',$request->date);
            }
            if (!empty($request->status)) {
                $queryData = $queryData->where('leads.status',$request->status);
            }
                        
            $leads = $queryData->where('leads.user_id',$request->user_id)
                                ->select('leads.*','users.name as user_name')
                                ->get();

        }else{
            $leads = Lead::join('users','leads.user_id','=','users.id')
                            ->where('leads.user_id',$request->user_id)
                            ->select('leads.*','users.name as user_name')
                            ->get();
        }

        $data = [];
        foreach ($leads as $key => $lead) {
            $data[] = [
                'id' => $lead->id,
                'user_id' => $lead->user_id,
                'name' => $lead->name,
                'email' => $lead->email,
                'phone' => $lead->phone,
                //'message' => $lead->message,
                'status' => $lead->status,
                'date' => date('Y-m-d',strtotime($lead->created_at)),
                //'comments' => $this->getLeadComments($lead->id),
            ];
        }

        if (count($data)>0) {
            return response()->json(array(
                        'status' => 200,
                        'message'=> 'Success',
                        'success_message'=>'Data found.',
                        'data' => $data,
                    ),200);
        }else{
            return response()->json(array(
                        'status' => 400,
                        'message'=> 'Error',
                        'error_message'=>'No data found!'
                    ),200);
        }
    }

    /*Sales Order Report by user (Sales Calls)*/
    public function salesOrdersReport(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(array(
                                        'status' => 400,
                                        'message'=> 'Error',
                                        'error_message'=>$validator->errors()
                                    ),200);
        }

        if (!empty($request->date)) {
            $data = SalesOrder::join('quotes','sales_orders.quote_id','=','quotes.id')
                            ->join('leads','quotes.lead_id','=','leads.id')
                            ->join('users','leads.user_id','=','users.id')
                            ->select('sales_orders.*','leads.name as lead_name','leads.email','leads.phone','leads.user_id','quotes.product_id','quotes.lead_id','users.name as user_name','leads.status as lead_status')
                            ->where('sales_orders.date',$request->date)
                            ->where('leads.user_id',$request->user_id)
                            ->get();

        }else{
            $data = SalesOrder::join('quotes','sales_orders.quote_id','=','quotes.id')
                            ->join('leads','quotes.lead_id','=','leads.id')
                            ->join('users','leads.user_id','=','users.id')
                            ->select('sales_orders.*','leads.name as lead_name','leads.email','leads.phone','leads.user_id','quotes.product_id','quotes.lead_id','users.name as user_name','leads.status as lead_status')
                            ->where('leads.user_id',$request->user_id)
                            ->get();
        }

        if (count($data)>0) {
            return response()->json(array(
                        'status' => 200,
                        'message'=> 'Success',
                        'success_message'=>'Data found.',
                        'data' => $data,
                    ),200);
        }else{
            return response()->json(array(
                        'status' => 400,
                        'message'=> 'Error',
                        'error_message'=>'No data found!'
                    ),200);
        }
    }

}
