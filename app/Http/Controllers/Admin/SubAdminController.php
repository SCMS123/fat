<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth;
use Cookie;
use Illuminate\Http\Request;
use Validator;
use Input;
use App\User;
use App\Models\Cms;
use App\Models\Category;
use App\Models\AccountType;
use App\Models\Branch;
use App\Models\Department;
use App\Models\AdminPermission;
use Session;
use DB;
use Image;
use File;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\DataTables\SubAdminDataTable;

class SubAdminController extends Controller
{
    //=================================================================

	public function index(SubAdminDataTable $dataTable)
	{
		return $dataTable->render('admin/sub_admin/index');
	}

	//=================================================================


    
    public function account_type(Request $request)
	{   
	    
	    $data = array();
	   	$data['accounts']=AccountType::orderBy('account_name', 'asc')->get();
	   
	    return view('admin/sub_admin/account_type',$data);
	}
	public function add(Request $request)
	{   
	    
	    $data = array();
	    $sec=AccountType::where('id',$request->account_type)->first();
	    $exp_section=explode(',',$sec->section);
	    $data['accounts']=AccountType::orderBy('account_name', 'asc')->get();
	    $data['branches']=Branch::orderBy('Branch_name', 'asc')->get();
	    $data['account_type']=$request->account_type;
	    $data['departments']=Department::orderBy('department_name', 'asc')->get();
	    $data['sections'] = DB::table('sections')->where('section_slug','!=','modules')->whereIn('id',$exp_section)->orderBy('section_order','ASC')->get();
	    return view('admin/sub_admin/add',$data);
	}

	//=================================================================
	
	public function save(Request $request)
	{
		try {
	        //dd($request); die;
			$validator = Validator::make($request->all(), [
				'name' => 'required',
				'email' => 'required',
				'password' => 'required',
				'mobile' => 'required',
				'branch_id' => 'required',
				'department_id' => 'required',
				'address' => 'required',
				'bio' => 'required',
			]);

			if ($validator->fails()) { 
				return redirect('admin/sub_admin/add')
	                        ->withErrors($validator)
	                        ->withInput();
			} else {	        
	         	$user = new User();
             	$user->user_type = 'sub_admin';
             	$user->account_type = $request->account_type;
             	$user->name = $request->name;
	         	$user->email = $request->email;
	         	$user->password = Hash::make($request->password);
	         	$user->mobile = $request->mobile;
	         	$user->branch_id = $request->branch_id;
	         	$user->department_id = $request->department_id;
	         	$user->address = $request->address;
	         	$user->bio = $request->bio;
	         	$user->status = '1';
	         	$user->save();

             	$subadmin_id = $user->id;

             	//code for save user permissions
              	$total_row=$request->total_row;
              	for($i=1; $i<=$total_row;$i++)
              	{
                 	$actid = $request['action_id'.$i];
                 	$rolid = $request['role_id'.$i];

                 	if(!empty($rolid) && !empty($actid)) 
                  	{
                 		$acc=implode(',',$actid);

                 		if (in_array('add', $actid)) {
                 			$save = ',save';
                 		}else{
                 			$save = '';
                 		}
                 		if (in_array('edit', $actid)) {
                 			$edit = ',update';
                 		}else{
                 			$edit = '';
                 		}

                 		$adminpermission = new AdminPermission();
                 		$adminpermission->user_id = $subadmin_id;
	             		$adminpermission->role_id = $rolid;
	             		$adminpermission->action_id = 'index,list,'.$acc.$save.$edit;
	             		$adminpermission->save();
                  	}
              	}             
				session()->flash('message', 'Sub Admin Created successfully');
				Session::flash('alert-type', 'success'); 
				return redirect('admin/sub_admin/index');
			}
		} catch (\Exception $e) {
	        Log::error($e->getMessage());
	        session()->flash('message', 'Some error occured during save Sub Admin');
            Session::flash('alert-type', 'error');
           	return redirect('admin/sub_admin/add');  
        }
	}

	//===========================================================================

	public function edit($id)
	{
		$data = array();
		$data['accounts']=AccountType::orderBy('account_name', 'asc')->get();
		$data['branches']=Branch::orderBy('Branch_name', 'asc')->get();
	    $data['departments']=Department::orderBy('department_name', 'asc')->get();
		$data['user'] = User::where('id',$id)->first();
		
		return view('admin/sub_admin/edit',$data);
	}

	public function update(Request $request) 
	{
		try {
			$id = $request->id;

			$validator = Validator::make($request->all(), [
				'name' => 'required',
				'email' => 'required',
				'mobile' => 'required',
				'branch_id' => 'required',
				'department_id' => 'required',
				'address' => 'required',
				'bio' => 'required',
			]);

			if ($validator->fails()) { 
				return redirect('admin/sub_admin/edit'.'/'.$id)
	                        ->withErrors($validator)
	                        ->withInput();
			} else {	        
	         	$user = User::find($id);

             	$user->user_type = 'sub_admin';
             	$user->name = $request->name;
             	$user->account_type = $request->account_type;
	         	$user->email = $request->email;
	         	$user->password = $request->password != '' ? Hash::make($request->password) : $user->password;
	         	$user->mobile = $request->mobile;
	         	$user->branch_id = $request->branch_id;
	         	$user->department_id = $request->department_id;
	         	$user->address = $request->address;
	         	$user->bio = $request->bio;
	         	$user->status = $user->status;
	         	$user->save();

             	$subadmin_id = $user->id;

             	//code for save user permissions
             	DB::table('admin_permissions')->where('user_id',$id)->delete();

              	$total_row=$request->total_row;
              	for($i=1; $i<=$total_row;$i++)
              	{
                 	$actid=$request['action_id'.$i];
                 	$rolid=$request['role_id'.$i];

                 	if(!empty($rolid) && !empty($actid)) 
                  	{
                 		$acc=implode(',',$actid);

                 		if (in_array('add', $actid)) {
                 			$save = ',save';
                 		}else{
                 			$save = '';
                 		}
                 		if (in_array('edit', $actid)) {
                 			$edit = ',update';
                 		}else{
                 			$edit = '';
                 		}
                 		
                 		$adminpermission = new AdminPermission();
                 		$adminpermission->user_id = $subadmin_id;
	             		$adminpermission->role_id = $rolid;
	             		$adminpermission->action_id = 'index,list,'.$acc.$save.$edit;
	             		$adminpermission->save();
                  	}
              	}             
				session()->flash('message', 'Sub Admin Created successfully');
				Session::flash('alert-type', 'success'); 
				return redirect('admin/sub_admin/index');
			}
		} catch (\Exception $e) {
	        Log::error($e->getMessage());
	        session()->flash('message', 'Some error occured!');
			Session::flash('alert-type', 'error'); 
			return redirect('admin/sub_admin/edit'.'/'.$id);
        }
	}

	public function delete($id)
	{
		try {
			User::where('id', $id)->delete();
			AdminPermission::where('user_id', $id)->delete();

			session()->flash('message', 'Sub Admin deleted successfully.');
			Session::flash('alert-type', 'success'); 
			
			return redirect('admin/sub_admin/index');
		} catch (\Exception $e) {
            Log::error($e->getMessage());
		    session()->flash('message', 'Some error occured!');
			Session::flash('alert-type', 'error'); 
			
			return redirect('admin/sub_admin/index');
        }
	}

	//=================================================================
	public function set_status(Request $request, $id){
		
		try {
			
			$User = User::find($id);
			
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
			
		
			session()->flash('message', 'Sub Admin status update successfully');
	        Session::flash('alert-type', 'success');
	        return redirect('admin/sub_admin/index');
	    } catch (\Exception $e) {
            Log::error($e->getMessage());
		    session()->flash('message', 'Some error occured during status update');
            Session::flash('alert-type', 'error');
          return redirect('admin/sub_admin/index');
        }
    }

    //===================================================
	
	


}
