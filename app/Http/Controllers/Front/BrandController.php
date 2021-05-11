<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

use Auth;
use Cookie;
use Illuminate\Http\Request;
use Validator;
use Input;
use App\Models\User;
use App\Models\Setting;
use Session;
use DB;
use Image;
use File;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Models\Category;
use App\Models\Dealer;
use App\Models\Product;

class BrandController extends Controller
{
    //====================================

	public function index($name)
	{
		$data = array();
		$data['dealers'] = Dealer::where('status','1')->get();
		$data['dealer'] = Dealer::where('name',$name)->where('status','1')->first();
		$data['results'] = Product::where('dealer_id',$data['dealer']->id)->get();
        
        //return view('front/brand/brands',$data);

		return view('front/brand/index',$data);
	}
	//====================================



}
