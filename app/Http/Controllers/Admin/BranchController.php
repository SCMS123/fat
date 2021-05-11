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
use App\Models\Branch;
use App\DataTables\BranchDataTable;

class BranchController extends Controller
{
    //=================================================================

	public function index(BranchDataTable $dataTable)
	{
		return $dataTable->render('admin/branches/index');
	}

	//=================================================================

	public function add(Request $request)
	{  
		
		return view('admin/branches/add');
	}

	//=================================================================
	
	public function save(Request $request)
	{
		try {
	        //dd($request); die;
			$validator = Validator::make($request->all(), [
				'branch_code' => 'required',
				'branch_name' => 'required',
			]);

			if ($validator->fails()) { 
				return redirect('admin/branches/add')
	                        ->withErrors($validator)
	                        ->withInput();
			} else {	        
	         	$data = new Branch();
             	$data->branch_code = $request->branch_code;
             	$data->branch_name = $request->branch_name;
	         	$data->save();

				session()->flash('message', 'Branch Created successfully');
				Session::flash('alert-type', 'success'); 
				return redirect('admin/branches/index');
			}
		} catch (\Exception $e) {
	        Log::error($e->getMessage());
	        session()->flash('message', 'Some error occured during creating Branch');
            Session::flash('alert-type', 'error');
           	return redirect('admin/branches/add');  
        }
	}

	//===========================================================================

	public function edit($id)
	{
		$data = array();
		$data['result'] = Branch::where('id',$id)->first();
		
		return view('admin/branches/edit',$data);
	}

	public function update(Request $request) 
	{
		try {
			$id = $request->id;
			$validator = Validator::make($request->all(), [
				'branch_code' => 'required',
				'branch_name' => 'required',
			]);

			if ($validator->fails()) { 
				return redirect('admin/branches/edit'.'/'.$id)
	                        ->withErrors($validator)
	                        ->withInput();
			} else {	        
	         	$data = Branch::find($id);
             	$data->branch_code = $request->branch_code;
             	$data->branch_name = $request->branch_name;
	         	$data->save();

				session()->flash('message', 'Branch updated successfully');
				Session::flash('alert-type', 'success'); 
				return redirect('admin/branches/index');
			}
		} catch (\Exception $e) {
	        Log::error($e->getMessage());
	        session()->flash('message', 'Some error occured!');
			Session::flash('alert-type', 'error'); 
			return redirect('admin/branches/edit'.'/'.$id);
        }
	}

	public function delete($id)
	{
		try {
			Branch::where('id', $id)->delete();

			session()->flash('message', 'Branch deleted successfully.');
			Session::flash('alert-type', 'success'); 
			
			return redirect('admin/branches/index');
		} catch (\Exception $e) {
            Log::error($e->getMessage());
		    session()->flash('message', 'Some error occured!');
			Session::flash('alert-type', 'error'); 
			
			return redirect('admin/branches/index');
        }
	}

	//=================================================================
	public function set_status(Request $request, $id){
		
		try {
			
			$User = Branch::find($id);
			
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
			
		
			session()->flash('message', 'Branch status update successfully');
	        Session::flash('alert-type', 'success');
	        return redirect('admin/branches/index');
	    } catch (\Exception $e) {
            Log::error($e->getMessage());
		    session()->flash('message', 'Some error occured during status update');
            Session::flash('alert-type', 'error');
          return redirect('admin/branches/index');
        }
    }
    //===================================================
}