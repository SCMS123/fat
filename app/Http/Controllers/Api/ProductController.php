<?php
namespace App\Http\Controllers\Api;

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
use Mail;
use App\User;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Dealer;
use App\Helpers\AdminHelper;
use Carbon;

class ProductController extends Controller
{
    /*Product Listing*/
    public function products(Request $request)
    {
        $products = Product::join('dealers','products.dealer_id','=','dealers.id')
                        ->join('categories','products.category_id','=','categories.id')
                        ->select('products.*','dealers.name as dealer_name','categories.name as category_name')
                        ->get();

        $data = [];
        foreach ($products as $key => $product) {
            $data[] = [
                'id' => $product->id,
                'category_id' => $product->category_id,
                'category_name' => $product->category_name,
                'dealer_id' => $product->dealer_id,
                'dealer_name' => $product->dealer_name,
                'stock_number' => $product->stock_number,
                'backorder_number' => $product->backorder_number,
                'date' => $product->date,
                'title' => $product->title,
                'make' => $product->make,
                'model' => $product->model,
                'year' => $product->year,
                'hours' => $product->hours,
                'weight' => $product->weight,
                'description' => $product->description,
                'price' => $product->price,
                'type' => $product->type,
                'attachment' => $product->attachment,
                'status' => $product->status,
                'images' => $this->getProductImages($product->id),
            ];
        }

        if (count($data)>0) {
            return response()->json(array(
                        'status' => 200,
                        'message'=> 'Success',
                        'success_message'=>'Data found.',
                        'image_path' => url('/public/admin/clip-one/assets/products/original/'),
                        'attachment_path' => url('/public/admin/clip-one/assets/products/attachment/'),
                        'data' => $data,
                    ),200);
        }else{
            return response()->json(array(
                        'status' => 400,
                        'message'=> 'Error',
                        'error_message'=>'No data found!'
                    ),200);
        }
    }

    public function getProductImages($id)
    {
        $data = ProductImage::where('product_id',$id)->get();

        if (count($data)>0) {
            return $data;
        }else{
            return [];
        }
    }


    /*Filters Data*/
    public function filters(Request $request)
    {
        $categories = Category::get();
        $dealers = Dealer::get();
        $make = Product::select('make')->groupBy('make')->get();
        $model = Product::select('model')->groupBy('model')->get();
        $status = ['In Stock','Coming Soon'];
        $type = ['New','Used'];

        return response()->json(array(
                                    'status' => 200,
                                    'message'=> 'Success',
                                    'success_message'=>'Data found.',
                                    'categories' => $categories,
                                    'dealers' => $dealers,
                                    'make' => $make,
                                    'model' => $model,
                                    'stat' => $status,
                                    'type' => $type
                                ),200);
    }


    /*Filter Products Listing*/
    public function filterProducts(Request $request)
    {
        $query = Product::join('dealers','products.dealer_id','=','dealers.id')
                        ->join('categories','products.category_id','=','categories.id');

        if (!empty($request->category_id)) {
            $category_id = json_decode($request->category_id);
            $query = $query->whereIn('category_id',$category_id);
        }
        if (!empty($request->dealer_id)) {
            $dealer_id = json_decode($request->dealer_id);
            $query = $query->whereIn('dealer_id',$dealer_id);
        }
        if (!empty($request->make)) {
            $make = json_decode($request->make);
            $query = $query->whereIn('make',$make);
        }
        if (!empty($request->model)) {
            $model = json_decode($request->model);
            $query = $query->whereIn('model',$model);
        }
        if (!empty($request->year_from) && !empty($request->year_to)) {
            $query = $query->where('year','>=',$request->year_from)
                            ->where('year','<=',$request->year_to);
        }
        if (!empty($request->hours_from) && !empty($request->hours_to)) {
            $query = $query->where('hours','>=',$request->hours_from)
                            ->where('hours','<=',$request->hours_to);
        }
        if (!empty($request->weight_from) && !empty($request->weight_to)) {
            $query = $query->where('weight','>=',$request->weight_from)
                            ->where('weight','<=',$request->weight_to);
        }
        if (!empty($request->status) && !empty($request->status)) {
            $query = $query->where('status',$request->status);
        }
        if (!empty($request->type) && !empty($request->type)) {
            $query = $query->where('type',$request->type);
        }
                    
        $products = $query->select('products.*','dealers.name as dealer_name','categories.name as category_name')->get();

        $data = [];
        foreach ($products as $key => $product) {
            $data[] = [
                'id' => $product->id,
                'category_id' => $product->category_id,
                'category_name' => $product->category_name,
                'dealer_id' => $product->dealer_id,
                'dealer_name' => $product->dealer_name,
                'stock_number' => $product->stock_number,
                'backorder_number' => $product->backorder_number,
                'date' => $product->date,
                'title' => $product->title,
                'make' => $product->make,
                'model' => $product->model,
                'year' => $product->year,
                'hours' => $product->hours,
                'weight' => $product->weight,
                'description' => $product->description,
                'price' => $product->price,
                'type' => $product->type,
                'attachment' => $product->attachment,
                'status' => $product->status,
                'images' => $this->getProductImages($product->id),
            ];
        }

        if (count($data)>0) {
            return response()->json(array(
                        'status' => 200,
                        'message'=> 'Success',
                        'success_message'=>'Data found.',
                        'image_path' => url('/public/admin/clip-one/assets/products/original/'),
                        'attachment_path' => url('/public/admin/clip-one/assets/products/attachment/'),
                        'data' => $data,
                    ),200);
        }else{
            return response()->json(array(
                        'status' => 400,
                        'message'=> 'Error',
                        'error_message'=>'No data found!'
                    ),200);
        }
    }


    /*Product Detail*/
    public function productDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(array(
                                        'status' => 400,
                                        'message'=> 'Error',
                                        'error_message'=>$validator->errors()
                                    ),200);
        }

        $product = Product::join('dealers','products.dealer_id','=','dealers.id')
                        ->join('categories','products.category_id','=','categories.id')
                        ->select('products.*','dealers.name as dealer_name','categories.name as category_name')
                        ->where('products.id',$request->id)
                        ->first();

        $data = [];
        $data = [
            'id' => $product->id,
            'category_id' => $product->category_id,
            'category_name' => $product->category_name,
            'dealer_id' => $product->dealer_id,
            'dealer_name' => $product->dealer_name,
            'stock_number' => $product->stock_number,
            'backorder_number' => $product->backorder_number,
            'date' => $product->date,
            'title' => $product->title,
            'make' => $product->make,
            'model' => $product->model,
            'year' => $product->year,
            'hours' => $product->hours,
            'weight' => $product->weight,
            'description' => $product->description,
            'price' => $product->price,
            'type' => $product->type,
            'attachment' => $product->attachment,
            'status' => $product->status,
            'images' => $this->getProductImages($product->id),
        ];

        if (count($data)>0) {
            return response()->json(array(
                        'status' => 200,
                        'message'=> 'Success',
                        'success_message'=>'Data found.',
                        'image_path' => url('/public/admin/clip-one/assets/products/original/'),
                        'attachment_path' => url('/public/admin/clip-one/assets/products/attachment/'),
                        'data' => $data,
                    ),200);
        }else{
            return response()->json(array(
                        'status' => 400,
                        'message'=> 'Error',
                        'error_message'=>'No data found!'
                    ),200);
        }
    }


}
