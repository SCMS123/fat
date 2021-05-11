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
use App\Models\Currency;
use App\DataTables\CurrencyDataTable;

class CurrencyController extends Controller
{
    //=================================================================

	public function index(CurrencyDataTable $dataTable)
	{
		return $dataTable->render('admin/currency/index');
	}

	//=================================================================

	public function add(Request $request)
	{  
		
		return view('admin/currency/add');
	}

	//=================================================================
	
	public function save(Request $request)
	{
		try {
	        //dd($request); die;
			$validator = Validator::make($request->all(), [
				'currency' => 'required',
				'symbol' => 'required',
				'value' => 'required',
			]);

			if ($validator->fails()) { 
				return redirect('admin/currency/add')
	                        ->withErrors($validator)
	                        ->withInput();
			} else {	        
	         	$data = new Currency();
             	$data->currency = $request->currency;
             	$data->symbol = $request->symbol;
             	$data->value = $request->value;
             	$data->status = 1;
	         	$data->save();

				session()->flash('message', 'Currency Created successfully');
				Session::flash('alert-type', 'success'); 
				return redirect('admin/currency/index');
			}
		} catch (\Exception $e) {
	        Log::error($e->getMessage());
	        session()->flash('message', 'Some error occured during creating Currency');
            Session::flash('alert-type', 'error');
           	return redirect('admin/currency/add');  
        }
	}

	//===========================================================================

	public function edit($id)
	{
		$data = array();
		$data['result'] = Currency::where('id',$id)->first();
		
		return view('admin/currency/edit',$data);
	}

	public function update(Request $request) 
	{
		try {
			$id = $request->id;
			$validator = Validator::make($request->all(), [
				'currency' => 'required',
				'symbol' => 'required',
				'value' => 'required',
			]);

			if ($validator->fails()) { 
				return redirect('admin/currency/edit'.'/'.$id)
	                        ->withErrors($validator)
	                        ->withInput();
			} else {	        
	         	$data = Currency::find($id);
             	$data->currency = $request->currency;
             	$data->symbol = $request->symbol;
             	$data->value = $request->value;
	         	$data->save();

				session()->flash('message', 'Currency updated successfully');
				Session::flash('alert-type', 'success'); 
				return redirect('admin/currency/index');
			}
		} catch (\Exception $e) {
	        Log::error($e->getMessage());
	        session()->flash('message', 'Some error occured!');
			Session::flash('alert-type', 'error'); 
			return redirect('admin/currency/edit'.'/'.$id);
        }
	}

	public function delete($id)
	{
		try {
			Currency::where('id', $id)->delete();

			session()->flash('message', 'Currency deleted successfully.');
			Session::flash('alert-type', 'success'); 
			
			return redirect('admin/currency/index');
		} catch (\Exception $e) {
            Log::error($e->getMessage());
		    session()->flash('message', 'Some error occured!');
			Session::flash('alert-type', 'error'); 
			
			return redirect('admin/currency/index');
        }
	}

	//=================================================================
	public function status(Request $request, $id){
		
		try {
			
			$User = Currency::find($id);
			
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
			
		
			session()->flash('message', 'Currency status update successfully');
	        Session::flash('alert-type', 'success');
	        return redirect('admin/currency/index');
	    } catch (\Exception $e) {
            Log::error($e->getMessage());
		    session()->flash('message', 'Some error occured during status update');
            Session::flash('alert-type', 'error');
          return redirect('admin/currency/index');
        }
    }
    //===================================================
}