<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['middleware' => 'api_token','namespace' => 'Api'],
    function () {

    /*User*/
    Route::POST('user/login', 'UserController@login');

    /*Products*/
    Route::get('products','ProductController@products');
    Route::get('filters','ProductController@filters');
    Route::get('filterProducts','ProductController@filterProducts');
    Route::get('productDetails','ProductController@productDetails');

    /*User Leads*/
    Route::get('userLeads','LeadController@userLeads');
    Route::get('leadDetails','LeadController@leadDetails');
    Route::POST('updateLeadStatus','LeadController@updateLeadStatus');
    Route::POST('commentOnLead','LeadController@commentOnLead');

    /*Email Quotes*/
    Route::get('quoteParams','QuoteController@quoteParams');
    Route::POST('emailQuotes','QuoteController@emailQuotes');

    /*Sales Order*/
    Route::get('getSalesOrders','SalesOrderController@getSalesOrders');
    Route::POST('createSalesOrder','SalesOrderController@createSalesOrder');

    /*Reports*/
    Route::get('salesCallsReport','ReportController@salesCallsReport');
    Route::get('salesOrdersReport','ReportController@salesOrdersReport');
        
});
