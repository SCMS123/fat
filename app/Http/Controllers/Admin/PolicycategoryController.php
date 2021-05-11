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
use App\DataTables\PolicycategoryDataTable;

class PolicycategoryController extends Controller
{
    //=================================================================

	public function index(PolicycategoryDataTable $dataTable)
	{
		return $dataTable->render('admin/policycategories/index');
	}

	//=================================================================

	public function add(Request $request)
	{  
		
		return view('admin/policycategories/add');
	}

	//=================================================================
	
	public function save(Request $request)
	{
		try {
	        //dd($request); die;
			$validator = Validator::make($request->all(), [
				'name' => 'required',
				
			]);

			if ($validator->fails()) { 
				return redirect('admin/policy_categories/add')
	                        ->withErrors($validator)
	                        ->withInput();
			} else {	        
	         	$data = new Policycategory();
             	$data->name = $request->name;
             	$data->status = 1;
	         	$data->save();

				session()->flash('message', 'Policy Created successfully');
				Session::flash('alert-type', 'success'); 
				return redirect('admin/policy_categories/index');
			}
		} catch (\Exception $e) {
	        Log::error($e->getMessage());
	        session()->flash('message', 'Some error occured during creating Policy categories');
            Session::flash('alert-type', 'error');
           	return redirect('admin/policy_categories/add');  
        }
	}

	//===========================================================================

	public function edit($id)
	{
		$data = array();
		$data['result'] = Policycategory::where('id',$id)->first();
		
		return view('admin/policycategories/edit',$data);
	}

	public function update(Request $request) 
	{
		try {
			$id = $request->id;
			$validator = Validator::make($request->all(), [
				'name' => 'required',
				
			]);

			if ($validator->fails()) { 
				return redirect('admin/policy_categories/edit'.'/'.$id)
	                        ->withErrors($validator)
	                        ->withInput();
			} else {	        
	         	$data = Policycategory::find($id);
             	$data->name = $request->name;
             	$data->save();

				session()->flash('message', 'Policy category updated successfully');
				Session::flash('alert-type', 'success'); 
				return redirect('admin/policy_categories/index');
			}
		} catch (\Exception $e) {
	        Log::error($e->getMessage());
	        session()->flash('message', 'Some error occured!');
			Session::flash('alert-type', 'error'); 
			return redirect('admin/policy_categories/edit'.'/'.$id);
        }
	}

	public function delete($id)
	{
		try {
			Policycategory::where('id', $id)->delete();

			session()->flash('message', 'Policy category deleted successfully.');
			Session::flash('alert-type', 'success'); 
			
			return redirect('admin/policy_categories/index');
		} catch (\Exception $e) {
            Log::error($e->getMessage());
		    session()->flash('message', 'Some error occured!');
			Session::flash('alert-type', 'error'); 
			
			return redirect('admin/policy_categories/index');
        }
	}

	//=================================================================
	public function status(Request $request, $id){
		
		try {
			
			$User = Policycategory::find($id);
			
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
			
		
			session()->flash('message', 'Policy category status update successfully');
	        Session::flash('alert-type', 'success');
	        return redirect('admin/policy_categories/index');
	    } catch (\Exception $e) {
            Log::error($e->getMessage());
		    session()->flash('message', 'Some error occured during status update');
            Session::flash('alert-type', 'error');
          return redirect('admin/policy_categories/index');
        }
    }
    //===================================================
}