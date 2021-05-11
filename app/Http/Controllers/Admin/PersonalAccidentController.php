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
use App\Models\PersonalAccident;
use App\Models\Policycategory;
use App\Models\Policysubcategory;
use App\Models\Customer;
use App\DataTables\PersonalAccidentDataTable;

class PersonalAccidentController extends Controller
{
	//=================================================================

	public function list()
	{
		$data = [];

		return view('admin/personal_accident/list');
	}
	public function index(PersonalAccidentDataTable $dataTable)
	{
		return $dataTable->render('admin/personal_accident/index');
	}

	//=================================================================

	public function add(Request $request)
	{
		$data = [];
		$data['category'] = Policycategory::where('name','LIKE','%Miscellaneous%')->first();
		$data['sub_category'] = Policysubcategory::where('category_id',$data['category']->id)
									->where('name','LIKE','%Personal Accident%')
									->where('status','1')
									->first();
		$data['customers'] = Customer::where('status','1')->get();
		
		return view('admin/personal_accident/add',$data);
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
				return redirect('admin/personal_accident/add')
	                        ->withErrors($validator)
	                        ->withInput();
			} else {	        
	         	$data = new PersonalAccident();
	         	//================================================
			 	//================================================
             	$data->category_id = $request->category_id;
             	$data->sub_category_id = $request->sub_category_id;
             	$data->customer_id = $request->customer_id;
             	$data->title = $request->title;
             	$data->dated = date('Y-m-d');
	         	$data->save();

				session()->flash('message', 'Policy Created successfully');
				Session::flash('alert-type', 'success'); 
				return redirect('admin/personal_accident/index');
			}
		} catch (\Exception $e) {
	        Log::error($e->getMessage());
	        session()->flash('message', 'Some error occured during creating Policy');
            Session::flash('alert-type', 'error');
           	return redirect('admin/personal_accident/add');  
        }
	}

	//===========================================================================

	public function edit($id)
	{
		$data = array();
		$data['result'] = PersonalAccident::where('id',$id)->first();
		$data['category'] = Policycategory::where('name','LIKE','%Miscellaneous%')->first();
		$data['sub_category'] = Policysubcategory::where('category_id',$data['category']->id)
									->where('name','LIKE','%Personal Accident%')
									->where('status','1')
									->first();
		$data['customers'] = Customer::where('status','1')->get();
		
		return view('admin/personal_accident/edit',$data);
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
				return redirect('admin/personal_accident/edit'.'/'.$id)
	                        ->withErrors($validator)
	                        ->withInput();
			} else {	        
	         	$data = PersonalAccident::find($id);
	         	//================================================
				
	         	//================================================
             	$data->category_id = $request->category_id;
             	$data->sub_category_id = $request->sub_category_id;
             	$data->customer_id = $request->customer_id;
             	$data->title = $request->title;
             	$data->dated = date('Y-m-d');
	         	$data->save();

				session()->flash('message', 'Policy updated successfully');
				Session::flash('alert-type', 'success'); 
				return redirect('admin/personal_accident/index');
			}
		} catch (\Exception $e) {
	        Log::error($e->getMessage());
	        session()->flash('message', 'Some error occured!');
			Session::flash('alert-type', 'error'); 
			return redirect('admin/personal_accident/edit'.'/'.$id);
        }
	}

	public function delete($id)
	{
		try {
			PersonalAccident::where('id', $id)->delete();

			session()->flash('message', 'Policy deleted successfully.');
			Session::flash('alert-type', 'success'); 
			
			return redirect('admin/personal_accident/index');
		} catch (\Exception $e) {
            Log::error($e->getMessage());
		    session()->flash('message', 'Some error occured!');
			Session::flash('alert-type', 'error'); 
			
			return redirect('admin/personal_accident/index');
        }
	}

	//=================================================================
	public function status(Request $request, $id){
		
		try {
			
			$User = PersonalAccident::find($id);
			
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
			
		
			session()->flash('message', 'Status update successfully');
	        Session::flash('alert-type', 'success');
	        return redirect('admin/personal_accident/index');
	    } catch (\Exception $e) {
            Log::error($e->getMessage());
		    session()->flash('message', 'Some error occured during status update');
            Session::flash('alert-type', 'error');
          return redirect('admin/personal_accident/index');
        }
    }
    
}