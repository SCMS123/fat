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
use App\Models\Policycategory;
use App\Models\Policysubcategory;
use App\DataTables\PolicysubcategoryDataTable;

class PolicysubcategoryController extends Controller
{
    //=================================================================

	public function index(PolicysubcategoryDataTable $dataTable)
	{
		return $dataTable->render('admin/policysubcategories/index');
	}

	//=================================================================

	public function add(Request $request)
	{  
		$data = array();
		$data['categories'] = Policycategory::where('status',1)->orderBy('name','ASC')->get();
		return view('admin/policysubcategories/add',$data);
	}

	//=================================================================
	
	public function save(Request $request)
	{
		try {
	        //dd($request); die;
			$validator = Validator::make($request->all(), [
				'name' => 'required',
				'category_id' => 'required',
				
			]);

			if ($validator->fails()) { 
				return redirect('admin/policy_sub_categories/add')
	                        ->withErrors($validator)
	                        ->withInput();
			} else {	        
	         	$data = new Policysubcategory();
	         	$data->category_id = $request->category_id;
             	$data->name = $request->name;
             	$data->status = 1;
	         	$data->save();

				session()->flash('message', 'Policy Subsub category Created successfully');
				Session::flash('alert-type', 'success'); 
				return redirect('admin/policy_sub_categories/index');
			}
		} catch (\Exception $e) {
	        Log::error($e->getMessage());
	        session()->flash('message', 'Some error occured during creating Policy sub categories');
            Session::flash('alert-type', 'error');
           	return redirect('admin/policy_sub_categories/add');  
        }
	}

	//===========================================================================

	public function edit($id)
	{
		$data = array();
		
		$data['categories'] = Policycategory::where('status',1)->orderBy('name','ASC')->get();
		$data['result'] = Policysubcategory::where('id',$id)->first();
		
		return view('admin/policysubcategories/edit',$data);
	}

	public function update(Request $request) 
	{
		try {
			$id = $request->id;
			$validator = Validator::make($request->all(), [
				'name' => 'required',
				'category_id' => 'required',
				
			]);

			if ($validator->fails()) { 
				return redirect('admin/policy_sub_categories/edit'.'/'.$id)
	                        ->withErrors($validator)
	                        ->withInput();
			} else {	        
	         	$data = Policysubcategory::find($id);
             	$data->name = $request->name;
             	$data->category_id = $request->category_id;
             	$data->save();

				session()->flash('message', 'Policy Sub category updated successfully');
				Session::flash('alert-type', 'success'); 
				return redirect('admin/policy_sub_categories/index');
			}
		} catch (\Exception $e) {
	        Log::error($e->getMessage());
	        session()->flash('message', 'Some error occured!');
			Session::flash('alert-type', 'error'); 
			return redirect('admin/policy_sub_categories/edit'.'/'.$id);
        }
	}

	public function delete($id)
	{
		try {
			Policysubcategory::where('id', $id)->delete();

			session()->flash('message', 'Policy sub category deleted successfully.');
			Session::flash('alert-type', 'success'); 
			
			return redirect('admin/policy_sub_categories/index');
		} catch (\Exception $e) {
            Log::error($e->getMessage());
		    session()->flash('message', 'Some error occured!');
			Session::flash('alert-type', 'error'); 
			
			return redirect('admin/policy_sub_categories/index');
        }
	}

	//=================================================================
	public function status(Request $request, $id){
		
		try {
			
			$User = Policysubcategory::find($id);
			
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
			
		
			session()->flash('message', 'Policy sub category status update successfully');
	        Session::flash('alert-type', 'success');
	        return redirect('admin/policy_sub_categories/index');
	    } catch (\Exception $e) {
            Log::error($e->getMessage());
		    session()->flash('message', 'Some error occured during status update');
            Session::flash('alert-type', 'error');
          return redirect('admin/policy_sub_categories/index');
        }
    }
    //===================================================
}