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
use App\Models\Checklist;
use App\Models\Policycategory;
use App\Models\Policysubcategory;
use App\DataTables\ChecklistDataTable;

class ChecklistController extends Controller
{
    //=================================================================

	public function index(ChecklistDataTable $dataTable)
	{
		return $dataTable->render('admin/checklist/index');
	}

	//=================================================================

	public function add(Request $request)
	{  
		$data = array();
		$data['policycategory'] = Policycategory::get();
		$data['policysubcategory'] = Policysubcategory::get();
		return view('admin/checklist/add',$data);
	}

	//=================================================================
	
	public function save(Request $request)
	{
		try {
	        //dd($request); die;
			$validator = Validator::make($request->all(), [
				'policy_category_id' => 'required',
				'policy_sub_category_id' => 'required',
			    'title' => 'required',
			]);

			if ($validator->fails()) { 
				return redirect('admin/checklist/add')
	                        ->withErrors($validator)
	                        ->withInput();
			} else {	        
	         	$data = new Checklist();
             	$data->policy_category_id = $request->policy_category_id;
             	$data->policy_sub_category_id = $request->policy_sub_category_id;
             	$data->title = $request->title;
             	
	         	$data->save();

				session()->flash('message', 'CheckList Created successfully');
				Session::flash('alert-type', 'success'); 
				return redirect('admin/checklist/index');
			}
		} catch (\Exception $e) {
	        Log::error($e->getMessage());
	        session()->flash('message', 'Some error occured during creating Checklist');
            Session::flash('alert-type', 'error');
           	return redirect('admin/checklist/add');  
        }
	}

	//===========================================================================

	public function edit($id)
	{
		$data = array();
		$data['policycategory'] = Policycategory::get();
		$data['policysubcategory'] = Policysubcategory::get();
		$data['result'] = Checklist::where('id',$id)->first();
		
		return view('admin/checklist/edit',$data);
	}

	public function update(Request $request) 
	{
		try {
			$id = $request->id;
			$validator = Validator::make($request->all(), [
				'policy_category_id' => 'required',
				'policy_sub_category_id' => 'required',
			]);

			if ($validator->fails()) { 
				return redirect('admin/checklist/edit'.'/'.$id)
	                        ->withErrors($validator)
	                        ->withInput();
			} else {	        
	         	$data = Checklist::find($id);
             	$data->policy_category_id = $request->policy_category_id;
             	$data->policy_sub_category_id = $request->policy_sub_category_id;
             	$data->title = $request->title;
	         	$data->save();

				session()->flash('message', 'checklist updated successfully');
				Session::flash('alert-type', 'success'); 
				return redirect('admin/checklist/index');
			}
		} catch (\Exception $e) {
	        Log::error($e->getMessage());
	        session()->flash('message', 'Some error occured!');
			Session::flash('alert-type', 'error'); 
			return redirect('admin/checklist/edit'.'/'.$id);
        }
	}

	public function delete($id)
	{
		try {
			Checklist::where('id', $id)->delete();

			session()->flash('message', 'Checklist deleted successfully.');
			Session::flash('alert-type', 'success'); 
			
			return redirect('admin/checklist/index');
		} catch (\Exception $e) {
            Log::error($e->getMessage());
		    session()->flash('message', 'Some error occured!');
			Session::flash('alert-type', 'error'); 
			
			return redirect('admin/checklist/index');
        }
	}

	//=================================================================
	public function set_status(Request $request, $id){
		
		try {
			
			$User = Checklist::find($id);
			
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
			
		
			session()->flash('message', 'Checklist status update successfully');
	        Session::flash('alert-type', 'success');
	        return redirect('admin/checklist/index');
	    } catch (\Exception $e) {
            Log::error($e->getMessage());
		    session()->flash('message', 'Some error occured during status update');
            Session::flash('alert-type', 'error');
          return redirect('admin/checklist/index');
        }
    }
    //===================================================
}