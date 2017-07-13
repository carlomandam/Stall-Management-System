<?php

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

Route::get('/', function () {
    return view('layout.app');
});

Route::get('/Registration', 'ApplicationController@create');
Route::post('/Registration','ApplicationController@addVendorInfo');
Route::get('/List', 'ApplicationController@member');
Route::get('/View', 'ApplicationController@Memview');
Route::get('/Update', 'ApplicationController@Update');
Route::get('/CreateContract','ContractController@create');
Route::get('/Contract', 'ContractController@index');
Route::get('/ViewContracts', 'ContractController@view');
Route::get('/ShowDetails', 'ContractController@showdetails');
//Route::post('/Registration/Create','Controller@addVendorInfo');
//Route::resource('transaction','ApplicationController');


/////MAINTENANCE///////


Route::get('/Building', function () {
    return view('Maintenance_Buildings');
});

Route::get('/StallType', function () {
    return view('Maintenance_StallType');
});

Route::get('/Stall', function () {
    return view('Maintenance_Stall');
});

Route::get('/StallRate', function () {
    return view('Maintenance_StallRate');
});

Route::get('/Fee', function () {
    return view('Maintenance_Fees');
});

Route::get('/Penalty', function () {
    return view('Maintenance_Penalty');
});

Route::get('/Utility', function () {
    return view('Maintenance_Utility');
});

Route::post('/AddBuilding', 'Controller@addBuilding');
Route::get('/bldgTable', 'Controller@getBuildings');
Route::post('/checkBldgName', 'Controller@checkBldgName');
Route::post('/checkBldgCode', 'Controller@checkBldgCode');
Route::post('/getBuildingInfo', 'Controller@getBuildingInfo');
Route::post('/UpdateBuilding', 'Controller@UpdateBuilding');
Route::post('/deleteBuilding', 'Controller@deleteBuilding');
Route::get('/stypeTable', 'Controller@getStallTypes');
Route::post('/checkSTypeName', 'Controller@checkSTypeName');
Route::post('/addStallType', 'Controller@addStallType');
Route::post('/getSTypeInfo', 'Controller@getSTypeInfo');
Route::post('/UpdateSType', 'Controller@UpdateSType');
Route::post('/deleteSType', 'Controller@deleteSType');
Route::get('/stallTable', 'Controller@getStalls');
Route::post('/bldgOptions', 'Controller@getBuildingOption');
Route::post('/getStallID', 'Controller@getStallID');
Route::post('/addStall', 'Controller@addStall');
Route::post('/stypeOptions', 'Controller@getSTypeOption');
Route::post('/getUtilities', 'Controller@getUtilities');
Route::post('/getStallInfo', 'Controller@getStallInfo');
Route::post('/UpdateStall', 'Controller@updateStall');
Route::post('/deleteStall', 'Controller@deleteStall');
Route::post('/addStallRate', 'Controller@addStallRate');
Route::get('/rateTable', 'Controller@getStallRates');
Route::post('/getRateInfo', 'Controller@getRateInfo');
Route::post('/updateRate', 'Controller@updateRate');
Route::get('/feeTable', 'Controller@getFees');
Route::post('/addFee', 'Controller@addFee');
Route::post('/updateFee', 'Controller@updateFee');
Route::post('/deleteFee', 'Controller@deleteFee');
Route::post('/getFeeInfo', 'Controller@getFeeInfo');
Route::get('/penTable', 'Controller@getPenalties');
Route::post('/addPenalty', 'Controller@addPenalty');
Route::post('/updatePenalty', 'Controller@updatePenalty');
Route::post('/deletePenalty', 'Controller@deletePenalty');
Route::post('/getPenaltyInfo', 'Controller@getPenaltyInfo');
Route::get('/utilTable', 'Controller@getUtilitiesTable');
Route::post('/addUtility', 'Controller@addUtility');
Route::post('/updateUtility', 'Controller@updateUtility');
Route::post('/deleteUtility', 'Controller@deleteUtility');
Route::post('/getUtilityInfo', 'Controller@getUtilityInfo');
Route::post('/getFees', 'Controller@getFeesOpt');

Route::get('/pdfview',array('as'=>'pdfview','uses'=>'PDFController@pdfview'));
Route::post('/getVendorInfo', 'ApplicationController@getVendorInfo');
Route::get('/getVendor', 'ApplicationController@getVendor');