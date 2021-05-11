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
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Dealer;
use App\Helpers\AdminHelper;
use Carbon;

class LeadController extends Controller
{
    /*User Leads(Sales Calls)*/
    public function userLeads(Request $request)
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

        $leads = Lead::where('user_id',$request->user_id)
                        ->where(function($query) {
                            return $query->where('status','New')
                                        ->orWhere('status','In Progress')
                                        ->orWhere('status','On Hold');
                        })
                        ->get();

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

    public function getLeadComments($lead_id)
    {
        $data = LeadComment::where('lead_id',$lead_id)->get();

        if (count($data)>0) {
            return $data;
        }else{
            return [];
        }
    }


    /*Leads Details*/
    public function leadDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(array(
                                        'status' => 400,
                                        'message'=> 'Error',
                                        'error_message'=>$validator->errors()
                                    ),200);
        }

        $lead = Lead::where('id',$request->id)->first();

        $data = [];
        $data[] = [
            'id' => $lead->id,
            'user_id' => $lead->user_id,
            'name' => $lead->name,
            'email' => $lead->email,
            'phone' => $lead->phone,
            'message' => $lead->message,
            'status' => $lead->status,
            'comments' => $this->getLeadComments($lead->id),
        ];

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


    /*Update Lead Status*/
    public function updateLeadStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lead_id' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(array(
                                        'status' => 400,
                                        'message'=> 'Error',
                                        'error_message'=>$validator->errors()
                                    ),200);
        }

        $lead = Lead::find($request->lead_id);
        $lead->status = $request->status;

        if ($lead->save()) {
            return response()->json(array(
                        'status' => 200,
                        'message'=> 'Success',
                        'success_message'=>'Status updated successfully.',
                        'data' => $lead,
                    ),200);
        }else{
            return response()->json(array(
                        'status' => 400,
                        'message'=> 'Error',
                        'error_message'=>'Something went wrong!'
                    ),200);
        }
    }
    
    /*Comment on leads*/
    public function commentOnLead(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lead_id' => 'required',
            'comment_by' => 'required',
            'comment' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(array(
                                        'status' => 400,
                                        'message'=> 'Error',
                                        'error_message'=>$validator->errors()
                                    ),200);
        }

        $lead = new LeadComment;
        $lead->lead_id = $request->lead_id;
        $lead->comment_by = $request->comment_by;
        $lead->comment = $request->comment;

        if ($lead->save()) {
            return response()->json(array(
                        'status' => 200,
                        'message'=> 'Success',
                        'success_message'=>'Comment posted successfully.',
                        'data' => $lead,
                    ),200);
        }else{
            return response()->json(array(
                        'status' => 400,
                        'message'=> 'Error',
                        'error_message'=>'Something went wrong!'
                    ),200);
        }
    }


}
