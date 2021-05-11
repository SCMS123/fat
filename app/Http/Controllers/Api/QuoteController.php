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
use App\Models\Quote;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Dealer;
use App\Helpers\AdminHelper;
use Carbon;

class QuoteController extends Controller
{
    /*Quote Parameters*/
    public function quoteParams(Request $request)
    {                
        $products = Product::select('id','title')->get();
        $leads = Lead::select('id','name','email')->get();

        if (count($products)>0 && count($leads)>0) {
            return response()->json(array(
                        'status' => 200,
                        'message'=> 'Success',
                        'success_message'=>'Data found.',
                        'products' => $products,
                        'leads' => $leads
                    ),200);
        }else{
            return response()->json(array(
                        'status' => 400,
                        'message'=> 'Error',
                        'error_message'=>'No data found!'
                    ),200);
        }
    }


    /*Email Quotes*/
    public function emailQuotes(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'lead_id' => 'required',
            'price' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(array(
                                        'status' => 400,
                                        'message'=> 'Error',
                                        'error_message'=>$validator->errors()
                                    ),200);
        } else {   
            $product_id = implode(',',json_decode($request->product_id));

            $data = new Quote;
                
            //=========================================================
            $attachment = $request->file('attachment');

            if(!empty($attachment)) {
                $attachment_name = $attachment->getClientOriginalName();
                $attach_name = str_replace(' ', '',$attachment_name);

                $destinationPath = public_path('/admin/clip-one/assets/quotes');
                $attachment->move($destinationPath, $attach_name);
            } else {
                $attach_name = '';
            }

            $data->product_id = $product_id;
            $data->lead_id = $request->lead_id;
            $data->price = $request->price;
            $data->attachment = $attach_name;

            $pathToFile = url('/public/admin/clip-one/assets/quotes').'/'.$attach_name;

            if ($data->save()) {
                $leadData = Lead::find($request->lead_id);
                $emailData = array(
                    'email' => $leadData->email,
                    'title' => 'FJS Plant::Quote',
                    'pathToFile' => $pathToFile,
                );
            
                Mail::send('api.emails.emailQuote', $emailData, function ($message) use ($emailData) {
                    $message->from('user@testdmcconsultancy.com', 'FJS Plant Quote');
                    $message->to($emailData['email']);
                    $message->subject('FJS Plant::Quote!');
                    $message->attach($emailData['pathToFile']);
                });

                if( count(Mail::failures()) > 0 ) {
                    echo "There was one or more failures. They were: <br />";
                    foreach(Mail::failures() as $email_address) {
                      echo " - $email_address <br />";
                    }die;
                } else {
                    Log::info('Working');
                    echo "No errors, all sent successfully!";
                    die;
                }

                return response()->json(array(
                                            'status' => 200,
                                            'message'=> 'Success',
                                            'success_message'=>'Quote sent successfully.',
                                            'pathToFile' => $pathToFile,
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

}
