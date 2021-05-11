<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Validator;
use Input;
use Auth;
use Cookie;
use Session;
use DB;
use Image;
use File;
use Exception;
use App\Models\Document;
use App\Models\AdminPermission;
use App\DataTables\DocumentDataTable;
use App\Helpers\AdminHelper;

class DocumentController extends Controller
{
    //=================================================================

	public function index(DocumentDataTable $dataTable)
	{
		return $dataTable->render('admin/documents/index');
	}

	//=================================================================

	public function add()
	{
		return view('admin/documents/add');
	}

	//=================================================================

	public function save(Request $request)
	{
		try {
			$validator = Validator::make($request->all(), [
				'title' => 'required',
				'description' => 'required',
				'image' => 'required',
			]);
			if ($validator->fails()) { 
	            return redirect('admin/documents/add')
	                        ->withErrors($validator)
	                        ->withInput();
			} else {			        
		        $data = new Document;

		        //====== page product=====================================
				$image = $request->file('image');
				//dd($product); die;
				if(!empty($image)) {
		        	$imagename = time().'.'.$image->getClientOriginalExtension();
			       
					$destinationPath = public_path('/admin/clip-one/assets/documents/original');
			        $image->move($destinationPath, $imagename);


				} else {
					$imagename = '';
				}
					
		        //=========================================================
		        $data->title = $request->title;
		        
		        $data->description = $request->description;
		        $data->image = $imagename;
		        $data->save();
                
			
		        
		        session()->flash('message', 'Document added successfully');
				Session::flash('alert-type', 'success'); 
				return redirect('admin/documents/index');
			}
		} catch (\Exception $e) {
	        Log::error($e->getMessage());
	        session()->flash('message', 'Some error occured during save Document');
            Session::flash('alert-type', 'error');
           	return redirect('admin/documents/add');
        }
	}

	//=================================================================

	public function edit($id)
	{
		$data = array();
		$data['result'] = Document::find($id);
	    return view('admin/documents/edit',$data);
	}

	//=================================================================

	public function update(Request $request)
	{
		try {
			$validator = Validator::make($request->all(), [
				'title' => 'required',
				'description' => 'required',
							]);
			if ($validator->fails()) { 
	            return redirect('admin/documents/edit/'.$request->id)
	                        ->withErrors($validator)
	                        ->withInput();
			} else {			        
		        $data = Document::find($request->id);

		        //====== page product=====================================
				$image = $request->file('image');
				//dd($product); die;
				if(!empty($image)) {
				
        			$file2 = public_path().'/admin/clip-one/assets/banner/original/'.$data->image;
        			// echo "<pre>";
        			// print_r($file1);die;

        			File::delete($file2);

		        	$imagename = time().'.'.$image->getClientOriginalExtension();
			       
					$destinationPath = public_path('/admin/clip-one/assets/documents/original');
			        $image->move($destinationPath, $imagename);

			       
				} else {
					$imagename = $data->image;
				}
				
					
		        //=========================================================
		        $data->title = $request->title;
		        $data->description = $request->description;
		        
		        
		        $data->image = $imagename;
		        $data->save();
		         
		        
		        
				session()->flash('message', 'Document updated successfully');
				Session::flash('alert-type', 'success'); 
				return redirect('admin/documents/index');
			}
		} catch (\Exception $e) {
	        Log::error($e->getMessage());
	        session()->flash('message', 'Some error occured during save Document');
            Session::flash('alert-type', 'error');
           	return redirect('admin/documents/edit/'.$request->id);
        }
	}

	//=================================================================

	public function delete($id){
		
		try {
			$data = Document::find($id);

		//	$file1 = public_path().'/admin/clip-one/assets/banner/thumbnail/'.$data->image;
			$file2 = public_path().'/admin/clip-one/assets/banner/original/'.$data->image;
			File::delete($file2);

			$delete = Document::where('id',$id)->delete();
		
			session()->flash('message', 'Document deleted successfully');
	        Session::flash('alert-type', 'success');

	        return redirect('admin/documents/index');
	    } catch (\Exception $e) {
            Log::error($e->getMessage());
		    session()->flash('message', 'Some error occured');
            Session::flash('alert-type', 'error');

          	return redirect('admin/documents/index');
        }
    }
 




    //===================================================
	
	

    //===================================================

}
