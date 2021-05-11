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
use App\Models\Department;
use App\Models\Branch;
use App\DataTables\DepartmentDataTable;

class DepartmentController extends Controller
{
    //=================================================================

	public function index(DepartmentDataTable $dataTable)
	{
		return $dataTable->render('admin/departments/index');
	}

	//=================================================================

	public function add(Request $request)
	{  
	    $data['branches'] = Branch::get();	
		return view('admin/departments/add',$data);
	}

	//=================================================================
	
	public function save(Request $request)
	{
		try {
	        //dd($request); die;
			$validator = Validator::make($request->all(), [
				'branch_id' => 'required',
				'department_code' => 'required',
				'department_name' => 'required',
				
			]);

			if ($validator->fails()) { 
				return redirect('admin/departments/add')
	                        ->withErrors($validator)
	                        ->withInput();
			} else {	        
	         	$data = new Department();
             	$data->branch_id = $request->branch_id;
             	$data->department_code = $request->department_code;
             	$data->department_name = $request->department_name;
	         	$data->save();

				session()->flash('message', 'Department Created successfully');
				Session::flash('alert-type', 'success'); 
				return redirect('admin/departments/index');
			}
		} catch (\Exception $e) {
	        Log::error($e->getMessage());
	        session()->flash('message', 'Some error occured during creating Department');
            Session::flash('alert-type', 'error');
           	return redirect('admin/departments/add');  
        }
	}

	//===========================================================================

	public function edit($id)
	{
		$data = array();
		$data['branches'] = Branch::get();
		$data['result'] = Department::where('id',$id)->first();
		
		return view('admin/departments/edit',$data);
	}

	public function update(Request $request) 
	{
		try {
			$id = $request->id;
			$validator = Validator::make($request->all(), [
				'branch_id' => 'required',
				'department_code' => 'required',
				'department_name' => 'required',
			]);

			if ($validator->fails()) { 
				return redirect('admin/departments/edit'.'/'.$id)
	                        ->withErrors($validator)
	                        ->withInput();
			} else {	        
	         	$data = Department::find($id);
             	$data->branch_id = $request->branch_id;
             	$data->department_code = $request->department_code;
             	$data->department_name = $request->department_name;
	         	$data->save();

				session()->flash('message', 'Department updated successfully');
				Session::flash('alert-type', 'success'); 
				return redirect('admin/departments/index');
			}
		} catch (\Exception $e) {
	        Log::error($e->getMessage());
	        session()->flash('message', 'Some error occured!');
			Session::flash('alert-type', 'error'); 
			return redirect('admin/departments/edit'.'/'.$id);
        }
	}

	public function delete($id)
	{
		try {
			Department::where('id', $id)->delete();

			session()->flash('message', 'Department deleted successfully.');
			Session::flash('alert-type', 'success'); 
			
			return redirect('admin/departments/index');
		} catch (\Exception $e) {
            Log::error($e->getMessage());
		    session()->flash('message', 'Some error occured!');
			Session::flash('alert-type', 'error'); 
			
			return redirect('admin/departments/index');
        }
	}

	//=================================================================
	public function set_status(Request $request, $id){
		
		try {
			
			$User = Department::find($id);
			
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
			
		
			session()->flash('message', 'Department status update successfully');
	        Session::flash('alert-type', 'success');
	        return redirect('admin/departments/index');
	    } catch (\Exception $e) {
            Log::error($e->getMessage());
		    session()->flash('message', 'Some error occured during status update');
            Session::flash('alert-type', 'error');
          return redirect('admin/departments/index');
        }
    }
    //===================================================
}