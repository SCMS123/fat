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
use App\Models\AccountType;
use App\DataTables\AccountTypeDataTable;

class AccountTypeController extends Controller
{
    //=================================================================

	public function index(AccountTypeDataTable $dataTable)
	{
		return $dataTable->render('admin/account_type/index');
	}

	//=================================================================

	public function add(Request $request)
	{  
		
		return view('admin/account_type/add');
	}

	//=================================================================
	
	public function save(Request $request)
	{
		try {
	        //dd($request); die;
			$validator = Validator::make($request->all(), [
				'account_name' => 'required',
				
			]);

			if ($validator->fails()) { 
				return redirect('admin/account_type/add')
	                        ->withErrors($validator)
	                        ->withInput();
			} else {	        
	         	$data = new AccountType();
	         	$section=implode(',',$request->section);
             	$data->account_name = $request->account_name;
             	$data->section = $section;
	         	$data->save();

				session()->flash('message', 'Account Type Created successfully');
				Session::flash('alert-type', 'success'); 
				return redirect('admin/account_type/index');
			}
		} catch (\Exception $e) {
	        Log::error($e->getMessage());
	        session()->flash('message', 'Some error occured during creating Account Type');
            Session::flash('alert-type', 'error');
           	return redirect('admin/account_type/add');  
        }
	}

	//===========================================================================

	public function edit($id)
	{
		$data = array();
		$data['result'] = AccountType::where('id',$id)->first();
		
		return view('admin/account_type/edit',$data);
	}

	public function update(Request $request) 
	{
		try {
			$id = $request->id;
			$validator = Validator::make($request->all(), [
				'account_name' => 'required',
				
			]);

			if ($validator->fails()) { 
				return redirect('admin/account_type/edit'.'/'.$id)
	                        ->withErrors($validator)
	                        ->withInput();
			} else {
			    $section=implode(',',$request->section);
	         	$data = AccountType::find($id);
             	$data->account_name = $request->account_name;
             	$data->section = $section;
	         	$data->save();

				session()->flash('message', 'Account Type updated successfully');
				Session::flash('alert-type', 'success'); 
				return redirect('admin/account_type/index');
			}
		} catch (\Exception $e) {
	        Log::error($e->getMessage());
	        session()->flash('message', 'Some error occured!');
			Session::flash('alert-type', 'error'); 
			return redirect('admin/account_type/edit'.'/'.$id);
        }
	}

	public function delete($id)
	{
		try {
			AccountType::where('id', $id)->delete();

			session()->flash('message', 'Account Type deleted successfully.');
			Session::flash('alert-type', 'success'); 
			
			return redirect('admin/account_type/index');
		} catch (\Exception $e) {
            Log::error($e->getMessage());
		    session()->flash('message', 'Some error occured!');
			Session::flash('alert-type', 'error'); 
			
			return redirect('admin/account_type/index');
        }
	}

	//=================================================================
	public function status(Request $request, $id){
		
		try {
			
			$User = AccountType::find($id);
			
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
			
		
			session()->flash('message', 'Account Type status update successfully');
	        Session::flash('alert-type', 'success');
	        return redirect('admin/account_type/index');
	    } catch (\Exception $e) {
            Log::error($e->getMessage());
		    session()->flash('message', 'Some error occured during status update');
            Session::flash('alert-type', 'error');
          return redirect('admin/account_type/index');
        }
    }
    //===================================================
}