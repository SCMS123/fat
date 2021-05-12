<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
  //  return view('welcome');
//});

//Auth::routes();

if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}


Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});


Route::get('/admin', array('as'=>'admin.login','uses' => 'Admin\LoginController@index'));
Route::POST('/admin/dologin', 'Admin\LoginController@postLogin');

Route::group(['prefix'=> 'admin','middleware' => ['auth']] , function(){
	Route::get('dashboard', ['as'=>'admin.dashboard', 'uses'=>'Admin\DashboardController@index']);
	Route::get('/logout', ['as'=>'admin.logout', 'uses'=>'Admin\LoginController@getLogout']);
});

Route::group(['prefix'=> 'admin','middleware' => ['auth','UserRole']] , function(){
	Route::get('/settings', ['as'=>'admin.settings', 'uses'=>'Admin\DashboardController@setting']);

	/*actions Start*/
	Route::get('actions/index',['as'=>'actions.index','uses'=>'Admin\ModulesController@index']);
	Route::get('actions/add',['as'=>'actions.add','uses'=>'Admin\ModulesController@actionsAdd']);
	Route::POST('actions/save',['as'=>'actions.save','uses'=>'Admin\ModulesController@actionsSave']);
	Route::get('actions/edit/{id}',['as'=>'actions.edit','uses'=>'Admin\ModulesController@edit']);
	Route::POST('actions/update',['as'=>'actions.update','uses'=>'Admin\ModulesController@update']);
	Route::get('actions/delete/{id}',['as'=>'actions.delete','uses'=>'Admin\ModulesController@delete']);
	/*actions End*/

	/*Section Start*/
	Route::get('sections/index',['as'=>'sections.index','uses'=>'Admin\ModulesController@sectionsList']);
	Route::get('sections/add',['as'=>'sections.add','uses'=>'Admin\ModulesController@sectionsAdd']);
	Route::POST('sections/save',['as'=>'sections.save','uses'=>'Admin\ModulesController@sectionsSave']);
	Route::get('sections/edit/{id}',['as'=>'sections.edit','uses'=>'Admin\ModulesController@sectionsEdit']);
	Route::POST('sections/update',['as'=>'sections.update','uses'=>'Admin\ModulesController@sectionsUpdate']);
	Route::get('sections/delete/{id}',['as'=>'sections.delete','uses'=>'Admin\ModulesController@sectionsDelete']);
	/*Section End*/

	/*Roles Start*/
	Route::get('roles/index',['as'=>'roles.index','uses'=>'Admin\ModulesController@rolesList']);
	Route::get('roles/add',['as'=>'roles.add','uses'=>'Admin\ModulesController@rolesAdd']);
	Route::POST('roles/save',['as'=>'roles.save','uses'=>'Admin\ModulesController@rolesSave']);
	Route::get('roles/edit/{id}',['as'=>'roles.edit','uses'=>'Admin\ModulesController@rolesEdit']);
	Route::POST('roles/update',['as'=>'roles.update','uses'=>'Admin\ModulesController@rolesUpdate']);
	Route::get('roles/delete/{id}',['as'=>'roles.delete','uses'=>'Admin\ModulesController@rolesDelete']);
	/*Roles End*/

    /// Sub Admin start ////
    Route::get('sub_admin/index', ['as'=>'sub_admin.index',  'uses'=>'Admin\SubAdminController@index']);
	Route::POST('sub_admin/add', ['as'=>'sub_admin.add',  'uses'=>'Admin\SubAdminController@add']);
	Route::POST('sub_admin/save', ['as'=>'sub_admin.save',  'uses'=>'Admin\SubAdminController@save']);
	Route::get('sub_admin/edit/{id}', ['as'=>'sub_admin.edit',  'uses'=>'Admin\SubAdminController@edit']);
	Route::POST('sub_admin/update', ['as'=>'sub_admin.update','uses'=>'Admin\SubAdminController@update']);
	Route::get('sub_admin/delete/{id}', ['as'=>'sub_admin.delete', 'uses'=>'Admin\SubAdminController@delete']);
	Route::get('sub_admin/set-status/{id}', ['as'=>'sub_admin.status', 'uses'=>'Admin\SubAdminController@set_status']);
	Route::get('sub_admin/account_type', ['as'=>'sub_admin.account_type', 'uses'=>'Admin\SubAdminController@account_type']);
	
	
     //end subadmin //
     
     /// account_type////
    Route::get('account_type/index', ['as'=>'account_type.index',  'uses'=>'Admin\AccountTypeController@index']);
    Route::get('account_type/add', ['as'=>'account_type.add', 'uses'=>'Admin\AccountTypeController@add']);
    Route::POST('account_type/save', ['as'=>'account_type.save', 'uses'=>'Admin\AccountTypeController@save']);
    Route::get('account_type/edit/{id}', ['as'=>'account_type.edit', 'uses'=>'Admin\AccountTypeController@edit']);
    Route::POST('account_type/update', ['as'=>'account_type.update', 'uses'=>'Admin\AccountTypeController@update']);
    Route::get('account_type/delete/{id}', ['as'=>'account_type.delete', 'uses'=>'Admin\AccountTypeController@delete']);
    Route::get('account_type/status/{id}', ['as'=>'account_type.status', 'uses'=>'Admin\AccountTypeController@status']);
    
     
     

  	/// Branches ////
    Route::get('branches/index', ['as'=>'branches.index',  'uses'=>'Admin\BranchController@index']);
    Route::get('branches/add', ['as'=>'branches.add', 'uses'=>'Admin\BranchController@add']);
    Route::POST('branches/save', ['as'=>'branches.save', 'uses'=>'Admin\BranchController@save']);
    Route::get('branches/edit/{id}', ['as'=>'branches.edit', 'uses'=>'Admin\BranchController@edit']);
    Route::POST('branches/update', ['as'=>'branches.update', 'uses'=>'Admin\BranchController@update']);
    Route::get('branches/delete/{id}', ['as'=>'branches.delete', 'uses'=>'Admin\BranchController@delete']);
    
    /// Departments ////
    Route::get('departments/index', ['as'=>'departments.index',  'uses'=>'Admin\DepartmentController@index']);
    Route::get('departments/add', ['as'=>'departments.add', 'uses'=>'Admin\DepartmentController@add']);
    Route::POST('departments/save', ['as'=>'departments.save', 'uses'=>'Admin\DepartmentController@save']);
    Route::get('departments/edit/{id}', ['as'=>'departments.edit', 'uses'=>'Admin\DepartmentController@edit']);
    Route::POST('departments/update', ['as'=>'departments.update', 'uses'=>'Admin\DepartmentController@update']);
    Route::get('departments/delete/{id}', ['as'=>'departments.delete', 'uses'=>'Admin\DepartmentController@delete']);
    
    /// policy_categories ////
    Route::get('policy_categories/index', ['as'=>'policy_categories.index',  'uses'=>'Admin\PolicycategoryController@index']);
    Route::get('policy_categories/add', ['as'=>'policy_categories.add', 'uses'=>'Admin\PolicycategoryController@add']);
    Route::POST('policy_categories/save', ['as'=>'policy_categories.save', 'uses'=>'Admin\PolicycategoryController@save']);
    Route::get('policy_categories/edit/{id}', ['as'=>'policy_categories.edit', 'uses'=>'Admin\PolicycategoryController@edit']);
    Route::POST('policy_categories/update', ['as'=>'policy_categories.update', 'uses'=>'Admin\PolicycategoryController@update']);
    Route::get('policy_categories/delete/{id}', ['as'=>'policy_categories.delete', 'uses'=>'Admin\PolicycategoryController@delete']);
    Route::get('policy_categories/status/{id}', ['as'=>'policy_categories.status', 'uses'=>'Admin\PolicycategoryController@status']);
  
    /// policy_sub_categories ////
    Route::get('policy_sub_categories/index', ['as'=>'policy_sub_categories.index',  'uses'=>'Admin\PolicysubcategoryController@index']);
    Route::get('policy_sub_categories/add', ['as'=>'policy_sub_categories.add', 'uses'=>'Admin\PolicysubcategoryController@add']);
    Route::POST('policy_sub_categories/save', ['as'=>'policy_sub_categories.save', 'uses'=>'Admin\PolicysubcategoryController@save']);
    Route::get('policy_sub_categories/edit/{id}', ['as'=>'policy_sub_categories.edit', 'uses'=>'Admin\PolicysubcategoryController@edit']);
    Route::POST('policy_sub_categories/update', ['as'=>'policy_sub_categories.update', 'uses'=>'Admin\PolicysubcategoryController@update']);
    Route::get('policy_sub_categories/delete/{id}', ['as'=>'policy_sub_categories.delete', 'uses'=>'Admin\PolicysubcategoryController@delete']);
    Route::get('policy_sub_categories/status/{id}', ['as'=>'policy_sub_categories.status', 'uses'=>'Admin\PolicysubcategoryController@status']);
    
    /// currency ////
    Route::get('currency/index', ['as'=>'currency.index',  'uses'=>'Admin\CurrencyController@index']);
    Route::get('currency/add', ['as'=>'currency.add', 'uses'=>'Admin\CurrencyController@add']);
    Route::POST('currency/save', ['as'=>'currency.save', 'uses'=>'Admin\CurrencyController@save']);
    Route::get('currency/edit/{id}', ['as'=>'currency.edit', 'uses'=>'Admin\CurrencyController@edit']);
    Route::POST('currency/update', ['as'=>'currency.update', 'uses'=>'Admin\CurrencyController@update']);
    Route::get('currency/delete/{id}', ['as'=>'currency.delete', 'uses'=>'Admin\CurrencyController@delete']);
    Route::get('currency/status/{id}', ['as'=>'currency.status', 'uses'=>'Admin\CurrencyController@status']);
    
    
    /// documents ////
    Route::get('documents/index', ['as'=>'documents.index',  'uses'=>'Admin\DocumentController@index']);
    Route::get('documents/add', ['as'=>'documents.add', 'uses'=>'Admin\DocumentController@add']);
    Route::POST('documents/save', ['as'=>'documents.save', 'uses'=>'Admin\DocumentController@save']);
    Route::get('documents/edit/{id}', ['as'=>'documents.edit', 'uses'=>'Admin\DocumentController@edit']);
    Route::POST('documents/update', ['as'=>'documents.update', 'uses'=>'Admin\DocumentController@update']);
    Route::get('documents/delete/{id}', ['as'=>'documents.delete', 'uses'=>'Admin\DocumentController@delete']); 
    
    /// Customers ////
    Route::get('customers/index', ['as'=>'customers.index',  'uses'=>'Admin\CustomerController@index']);
    Route::get('customers/add', ['as'=>'customers.add', 'uses'=>'Admin\CustomerController@add']);
    Route::POST('customers/save', ['as'=>'customers.save', 'uses'=>'Admin\CustomerController@save']);
    Route::get('customers/edit/{id}', ['as'=>'customers.edit', 'uses'=>'Admin\CustomerController@edit']);
    Route::POST('customers/update', ['as'=>'customers.update', 'uses'=>'Admin\CustomerController@update']);
    Route::get('customers/view/{id}', ['as'=>'customers.view', 'uses'=>'Admin\CustomerController@view']);
    Route::get('customers/delete/{id}', ['as'=>'customers.delete', 'uses'=>'Admin\CustomerController@delete']);
    Route::get('customers/status/{id}', ['as'=>'customers.status', 'uses'=>'Admin\CustomerController@status']);
    
    //checklist//
    Route::get('checklist/index', ['as'=>'checklist.index',  'uses'=>'Admin\ChecklistController@index']);
    Route::get('checklist/add', ['as'=>'checklist.add', 'uses'=>'Admin\ChecklistController@add']);
    Route::POST('checklist/save', ['as'=>'checklist.save', 'uses'=>'Admin\ChecklistController@save']);
    Route::get('checklist/edit/{id}', ['as'=>'checklist.edit', 'uses'=>'Admin\ChecklistController@edit']);
    Route::POST('checklist/update', ['as'=>'checklist.update', 'uses'=>'Admin\ChecklistController@update']);
    Route::get('checklist/delete/{id}',['as'=>'checklist.delete','uses'=>'Admin\ChecklistController@delete']);
    
    /// Motor Cycle ////
    Route::get('motor_insurance/list', ['as'=>'motor_insurance.list',  'uses'=>'Admin\MotorInsuranceController@list']);
    Route::get('motor_insurance/index', ['as'=>'motor_insurance.index',  'uses'=>'Admin\MotorInsuranceController@index']);
    Route::get('motor_insurance/add', ['as'=>'motor_insurance.add', 'uses'=>'Admin\MotorInsuranceController@add']);
    Route::POST('motor_insurance/save', ['as'=>'motor_insurance.save', 'uses'=>'Admin\MotorInsuranceController@save']);
    Route::get('motor_insurance/edit/{id}', ['as'=>'motor_insurance.edit', 'uses'=>'Admin\MotorInsuranceController@edit']);
    Route::POST('motor_insurance/update', ['as'=>'motor_insurance.update', 'uses'=>'Admin\MotorInsuranceController@update']);
    Route::get('motor_insurance/view/{id}', ['as'=>'motor_insurance.view', 'uses'=>'Admin\MotorInsuranceController@view']);
    Route::get('motor_insurance/delete/{id}', ['as'=>'motor_insurance.delete', 'uses'=>'Admin\MotorInsuranceController@delete']);
    Route::get('motor_insurance/status/{id}', ['as'=>'motor_insurance.status', 'uses'=>'Admin\MotorInsuranceController@status']);
    Route::POST('motor_insurance/comment', ['as'=>'motor_insurance.comment', 'uses'=>'Admin\MotorInsuranceController@comment']);
    
    /// Motor Private ////
    Route::get('motor_private/index', ['as'=>'motor_private.index',  'uses'=>'Admin\MotorPrivateController@index']);
    Route::get('motor_private/add', ['as'=>'motor_private.add', 'uses'=>'Admin\MotorPrivateController@add']);
    Route::POST('motor_private/save', ['as'=>'motor_private.save', 'uses'=>'Admin\MotorPrivateController@save']);
    Route::get('motor_private/edit/{id}', ['as'=>'motor_private.edit', 'uses'=>'Admin\MotorPrivateController@edit']);
    Route::POST('motor_private/update', ['as'=>'motor_private.update', 'uses'=>'Admin\MotorPrivateController@update']);
    Route::get('motor_private/view/{id}', ['as'=>'motor_private.view', 'uses'=>'Admin\MotorPrivateController@view']);
    Route::get('motor_private/delete/{id}', ['as'=>'motor_private.delete', 'uses'=>'Admin\MotorPrivateController@delete']);
    Route::get('motor_private/status/{id}', ['as'=>'motor_private.status', 'uses'=>'Admin\MotorPrivateController@status']);

    /// Motor Commercial ////
    Route::get('motor_commercial/index', ['as'=>'motor_commercial.index',  'uses'=>'Admin\MotorCommercialController@index']);
    Route::get('motor_commercial/add', ['as'=>'motor_commercial.add', 'uses'=>'Admin\MotorCommercialController@add']);
    Route::POST('motor_commercial/save', ['as'=>'motor_commercial.save', 'uses'=>'Admin\MotorCommercialController@save']);
    Route::get('motor_commercial/edit/{id}', ['as'=>'motor_commercial.edit', 'uses'=>'Admin\MotorCommercialController@edit']);
    Route::POST('motor_commercial/update', ['as'=>'motor_commercial.update', 'uses'=>'Admin\MotorCommercialController@update']);
    Route::get('motor_commercial/view/{id}', ['as'=>'motor_commercial.view', 'uses'=>'Admin\MotorCommercialController@view']);
    Route::get('motor_commercial/delete/{id}', ['as'=>'motor_commercial.delete', 'uses'=>'Admin\MotorCommercialController@delete']);
    Route::get('motor_commercial/status/{id}', ['as'=>'motor_commercial.status', 'uses'=>'Admin\MotorCommercialController@status']);

    /// Motor psv ////
    Route::get('motor_psv/index', ['as'=>'motor_psv.index',  'uses'=>'Admin\MotorPSVController@index']);
    Route::get('motor_psv/add', ['as'=>'motor_psv.add', 'uses'=>'Admin\MotorPSVController@add']);
    Route::POST('motor_psv/save', ['as'=>'motor_psv.save', 'uses'=>'Admin\MotorPSVController@save']);
    Route::get('motor_psv/edit/{id}', ['as'=>'motor_psv.edit', 'uses'=>'Admin\MotorPSVController@edit']);
    Route::POST('motor_psv/update', ['as'=>'motor_psv.update', 'uses'=>'Admin\MotorPSVController@update']);
    Route::get('motor_psv/view/{id}', ['as'=>'motor_psv.view', 'uses'=>'Admin\MotorPSVController@view']);
    Route::get('motor_psv/delete/{id}',['as'=>'motor_psv.delete','uses'=>'Admin\MotorPSVController@delete']);
    Route::get('motor_psv/status/{id}',['as'=>'motor_psv.status','uses'=>'Admin\MotorPSVController@status']);

    /// Personal Accident ////
    Route::get('personal_accident/list', ['as'=>'personal_accident.list',  'uses'=>'Admin\PersonalAccidentController@list']);
    Route::get('personal_accident/index', ['as'=>'personal_accident.index',  'uses'=>'Admin\PersonalAccidentController@index']);
    Route::get('personal_accident/add', ['as'=>'personal_accident.add', 'uses'=>'Admin\PersonalAccidentController@add']);
    Route::POST('personal_accident/save', ['as'=>'personal_accident.save', 'uses'=>'Admin\PersonalAccidentController@save']);
    Route::get('personal_accident/edit/{id}', ['as'=>'personal_accident.edit', 'uses'=>'Admin\PersonalAccidentController@edit']);
    Route::POST('personal_accident/update', ['as'=>'personal_accident.update', 'uses'=>'Admin\PersonalAccidentController@update']);
    Route::get('personal_accident/delete/{id}',['as'=>'personal_accident.delete','uses'=>'Admin\PersonalAccidentController@delete']);
    Route::get('personal_accident/status/{id}',['as'=>'personal_accident.status','uses'=>'Admin\PersonalAccidentController@status']);
   
   
    });




//=============================================================================================
/*Front Routes*/

Route::group(['namespace' => 'Front'], function(){

    /*Home*/
    //Route::get('/',['as'=>'home','uses'=>'HomeController@index']);

    /*Contact Us*/
    //Route::get('contact_us',['as'=>'contact_us','uses'=>'ContactController@contact_us']);
    //Route::POST('contact/save',['as'=>'contact.save','uses'=>'ContactController@contactSave']);

});


