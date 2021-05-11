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
use App\Models\Customer;
use App\DataTables\CustomerDataTable;

class CustomerController extends Controller
{
    //=================================================================

	public function index(CustomerDataTable $dataTable)
	{
		return $dataTable->render('admin/customers/index');
	}

	//=================================================================

	public function add(Request $request)
	{  
		
		return view('admin/customers/add');
	}

	//=================================================================
	
	public function save(Request $request)
	{
		try {
	        //dd($request); die;
			$validator = Validator::make($request->all(), [
				'first_name' => 'required',
				'last_name' => 'required',
				'email' => 'required',
				'phone' => 'required',
				'city' => 'required',
				'state' => 'required',
				'country' => 'required',
				'TIN_number' => 'required',
				'customer_type' => 'required',
				'license' => 'required',
				'area' => 'required',
				
			]);

			if ($validator->fails()) { 
				return redirect('admin/customers/add')
	                        ->withErrors($validator)
	                        ->withInput();
			} else {	        
	         	$data = new Customer();
             	$data->first_name = $request->first_name;
             	$data->middle_name = $request->middle_name;
             	$data->last_name = $request->last_name;
             	$data->email = $request->email;
             	$data->phone = $request->phone;
             	$data->address = $request->address;
             	$data->bio = $request->bio;
             	$data->city = $request->city;
             	$data->state = $request->state;
             	$data->country = $request->country;
             	$data->TIN_number = $request->TIN_number;
             	$data->customer_type = $request->customer_type;
             	$data->license = $request->license;
             	$data->area = $request->area;
             	$data->status = '1';
	         	$data->save();

				session()->flash('message', 'Customer Created successfully');
				Session::flash('alert-type', 'success'); 
				return redirect('admin/customers/index');
			}
		} catch (\Exception $e) {
	        Log::error($e->getMessage());
	        session()->flash('message', 'Some error occured during creating Customer');
            Session::flash('alert-type', 'error');
           	return redirect('admin/customers/add');  
        }
	}

	//===========================================================================

	public function edit($id)
	{
		$data = array();
		$data['result'] = Customer::where('id',$id)->first();
		
		return view('admin/customers/edit',$data);
	}

	public function update(Request $request) 
	{
		try {
			$id = $request->id;
			$validator = Validator::make($request->all(), [
				'first_name' => 'required',
				'last_name' => 'required',
				'email' => 'required',
				'phone' => 'required',
				'city' => 'required',
				'state' => 'required',
				'country' => 'required',
				'TIN_number' => 'required',
				'customer_type' => 'required',
				'license' => 'required',
				'area' => 'required',
			]);

			if ($validator->fails()) { 
				return redirect('admin/branches/edit'.'/'.$id)
	                        ->withErrors($validator)
	                        ->withInput();
			} else {	        
	         	$data = Customer::find($id);
             	$data->first_name = $request->first_name;
             	$data->middle_name = $request->middle_name;
             	$data->last_name = $request->last_name;
             	$data->email = $request->email;
             	$data->phone = $request->phone;
             	$data->address = $request->address;
             	$data->bio = $request->bio;
             	$data->city = $request->city;
             	$data->state = $request->state;
             	$data->country = $request->country;
             	$data->TIN_number = $request->TIN_number;
             	$data->customer_type = $request->customer_type;
             	$data->license = $request->license;
             	$data->area = $request->area;
	         	$data->save();

				session()->flash('message', 'Customer  updated successfully');
				Session::flash('alert-type', 'success'); 
				return redirect('admin/customers/index');
			}
		} catch (\Exception $e) {
	        Log::error($e->getMessage());
	        session()->flash('message', 'Some error occured!');
			Session::flash('alert-type', 'error'); 
			return redirect('admin/customers/edit'.'/'.$id);
        }
	}

	public function delete($id)
	{
		try {
			Customer::where('id', $id)->delete();

			session()->flash('message', 'Customer deleted successfully.');
			Session::flash('alert-type', 'success'); 
			
			return redirect('admin/customers/index');
		} catch (\Exception $e) {
            Log::error($e->getMessage());
		    session()->flash('message', 'Some error occured!');
			Session::flash('alert-type', 'error'); 
			
			return redirect('admin/customers/index');
        }
	}

	//=================================================================
	public function status(Request $request, $id){
		
		try {
			
			$User = Customer::find($id);
			
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
			
		
			session()->flash('message', 'Customer status update successfully');
	        Session::flash('alert-type', 'success');
	        return redirect('admin/customers/index');
	    } catch (\Exception $e) {
            Log::error($e->getMessage());
		    session()->flash('message', 'Some error occured during status update');
            Session::flash('alert-type', 'error');
          return redirect('admin/customers/index');
        }
    }
    //===================================================
}