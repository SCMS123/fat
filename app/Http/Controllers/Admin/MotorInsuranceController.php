<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth;
use Cookie;
use Illuminate\Http\Request;
use Validator;
use Input;
use File;
use DB;
use Session;
use Image;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Models\MotorInsurance;
use App\Models\Motorprivate;
use App\Models\Policycategory;
use App\Models\Policysubcategory;
use App\Models\Customer;
use App\DataTables\MotorInsuranceDataTable;

class MotorInsuranceController extends Controller
{
	//=================================================================

	public function list()
	{
		$data = [];

		return view('admin/motor_insurance/list');
	}

    //=================================================================

	public function index(MotorInsuranceDataTable $dataTable)
	{
		return $dataTable->render('admin/motor_insurance/index');
	}

	//=================================================================

	public function add(Request $request)
	{
		$data = [];
		$data['category'] = Policycategory::where('name','LIKE','%motor%')->first();
		$data['sub_category'] = Policysubcategory::where('category_id',$data['category']->id)
									->where('name','LIKE','%cycle%')
									->where('status','1')
									->first();
		$data['customers'] = Customer::where('status','1')->get();
		
		return view('admin/motor_insurance/add',$data);
	}

	//=================================================================
	
	public function save(Request $request)
	{
		try {
	        //dd($request); die;
			$validator = Validator::make($request->all(), [
				'category_id' => 'required',
				'sub_category_id' => 'required',
				'customer_id' => 'required',
				'title' => 'required',
			]);
			if ($validator->fails()) { 
				return redirect('admin/motor_insurance/add')
	                        ->withErrors($validator)
	                        ->withInput();
			} else {	        
	         	$data = new MotorInsurance();
	         	//================================================
				$attachment = $request->file('renewal_notice');

				if(!empty($attachment)) {
		        	$renewal_notice = rand('1111','9999').'_'.$attachment->getClientOriginalName();

					$destinationPath = public_path('/admin/clip-one/assets/motor_insurance/renewal_notice');
			        $attachment->move($destinationPath, $renewal_notice);
				} else {
					$renewal_notice = '';
				}
	         	//================================================
             	$data->category_id = $request->category_id;
             	$data->sub_category_id = $request->sub_category_id;
             	$data->customer_id = $request->customer_id;
             	$data->title = $request->title;
             	$data->registration_number = $request->registration_number;
             	$data->make = $request->make;
             	$data->cubic_capacity = $request->cubic_capacity;
             	$data->manufacture_year = $request->manufacture_year;
             	$data->chassis_number = $request->chassis_number;
             	$data->seating_capacity = $request->seating_capacity;
             	$data->max_carrying_capacity = $request->max_carrying_capacity;
             	$data->price_paid = $request->price_paid;
             	$data->purchase_date = $request->purchase_date;
             	$data->present_value_estimate = $request->present_value_estimate;
             	$data->renewal_notice = $renewal_notice;
             	$data->insurance_cover = $request->insurance_cover;
             	$data->dated = date('Y-m-d');
	         	$data->save();

				session()->flash('message', 'Motor Insurance Created successfully');
				Session::flash('alert-type', 'success'); 
				return redirect('admin/motor_insurance/index');
			}
		} catch (\Exception $e) {
	        Log::error($e->getMessage());
	        session()->flash('message', 'Some error occured during creating Motor Insurance');
            Session::flash('alert-type', 'error');
           	return redirect('admin/motor_insurance/add');  
        }
	}

	//===========================================================================

	public function edit($id)
	{
		$data = array();
		$data['result'] = MotorInsurance::where('id',$id)->first();
		$data['category'] = Policycategory::where('name','LIKE','%motor%')->first();
		$data['sub_category'] = Policysubcategory::where('category_id',$data['category']->id)
									->where('name','LIKE','%cycle%')
									->where('status','1')
									->first();
		$data['customers'] = Customer::where('status','1')->get();
		$data['icons'] = [
					        'pdf' => 'pdf',
					        'doc' => 'word',
					        'docx' => 'word',
					        'xls' => 'excel',
					        'xlsx' => 'excel',
					        'ppt' => 'powerpoint',
					        'pptx' => 'powerpoint',
					        'txt' => 'alt',
					    ];
		if (!empty($data['result']->renewal_notice)) {
          	$data['ext'] = explode('.', $data['result']->renewal_notice);
       	}else{
          	$data['ext'] = '';
       	}
		
		return view('admin/motor_insurance/edit',$data);
	}

	public function update(Request $request) 
	{
		try {
			$id = $request->id;
			$validator = Validator::make($request->all(), [
				'category_id' => 'required',
				'sub_category_id' => 'required',
				'customer_id' => 'required',
				'title' => 'required',
			]);
			if ($validator->fails()) { 
				return redirect('admin/motor_insurance/edit'.'/'.$id)
	                        ->withErrors($validator)
	                        ->withInput();
			} else {	        
	         	$data = MotorInsurance::find($id);
	         	//================================================
				$attachment = $request->file('renewal_notice');

				if(!empty($attachment)) {
		        	$renewal_notice = rand('1111','9999').'_'.$attachment->getClientOriginalName();

					$destinationPath = public_path('/admin/clip-one/assets/motor_insurance/renewal_notice');
			        $attachment->move($destinationPath, $renewal_notice);
				} else {
					$renewal_notice = $data->renewal_notice;
				}
	         	//================================================
             	$data->category_id = $request->category_id;
             	$data->sub_category_id = $request->sub_category_id;
             	$data->customer_id = $request->customer_id;
             	$data->title = $request->title;
             	$data->registration_number = $request->registration_number;
             	$data->make = $request->make;
             	$data->cubic_capacity = $request->cubic_capacity;
             	$data->manufacture_year = $request->manufacture_year;
             	$data->chassis_number = $request->chassis_number;
             	$data->seating_capacity = $request->seating_capacity;
             	$data->max_carrying_capacity = $request->max_carrying_capacity;
             	$data->price_paid = $request->price_paid;
             	$data->purchase_date = $request->purchase_date;
             	$data->present_value_estimate = $request->present_value_estimate;
             	$data->renewal_notice = $renewal_notice;
             	$data->insurance_cover = $request->insurance_cover;
             	$data->dated = date('Y-m-d');
	         	$data->save();

				session()->flash('message', 'Motor Insurance  updated successfully');
				Session::flash('alert-type', 'success'); 
				return redirect('admin/motor_insurance/index');
			}
		} catch (\Exception $e) {
	        Log::error($e->getMessage());
	        session()->flash('message', 'Some error occured!');
			Session::flash('alert-type', 'error'); 
			return redirect('admin/motor_insurance/edit'.'/'.$id);
        }
	}

	public function delete($id)
	{
		try {
			MotorInsurance::where('id', $id)->delete();

			session()->flash('message', 'Motor Insurance deleted successfully.');
			Session::flash('alert-type', 'success'); 
			
			return redirect('admin/motor_insurance/index');
		} catch (\Exception $e) {
            Log::error($e->getMessage());
		    session()->flash('message', 'Some error occured!');
			Session::flash('alert-type', 'error'); 
			
			return redirect('admin/motor_insurance/index');
        }
	}

	//=================================================================
	public function status(Request $request, $id){
		
		try {
			
			$User = MotorInsurance::find($id);
			
			if($User->status == '1')
			{
				$status = '0';
			} 
			else 
			{
				$status = '1';
			}
			$User->status = $status;
			$User->save();
			
		
			session()->flash('message', 'Motor Insurance status update successfully');
	        Session::flash('alert-type', 'success');
	        return redirect('admin/motor_insurance/index');
	    } catch (\Exception $e) {
            Log::error($e->getMessage());
		    session()->flash('message', 'Some error occured during status update');
            Session::flash('alert-type', 'error');
          return redirect('admin/motor_insurance/index');
        }
    }
}