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


Route::get('/Registration','ApplicationController@create');
Route::get('/List', 'ApplicationController@member');
Route::get('/View', 'ApplicationController@Memview');
Route::get('/Update', 'ApplicationController@Update');
Route::get('/CreateContract','ContractController@create');
Route::get('/Contract', 'ContractController@index');
Route::get('/ViewContracts', 'ContractController@view');
Route::get('/ShowDetails', 'ContractController@showdetails');
Route::post('/checkEmail','ApplicationController@checkEmail');

Route::post('/AddVendor','ApplicationController@addVendor');
Route::get('/getVendor','ApplicationController@getVendor');
Route::get('/contractTable','ApplicationController@contractTable');
Route::post('/getVendorInfo','ApplicationController@getVendorInfo');
Route::post('/UpdateVendor','ApplicationController@updateVendor');
Route::get('/rentInfo','ContractController@getRentInfo');
Route::get('/searchVendor','ApplicationController@searchVendor');
Route::get('displaySearch','ApplicationController@displaySearch');
Route::get('/Stalls','ApplicationController@stall');
Route::get('/htmltopdfview/{rentid}',['uses' => 'ContractController@htmltopdfview',
										'as' => 'htmltopdfview']);

Route::get('/getStalls','StallController@getStalls');

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

Route::resource('/kioskmap', 'MappingController');
Route::get('/kioskmap/bldg/{id}', 'MappingController@load');
Route::get('/kioskmap/floor/{id}', 'MappingController@floor');

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

//Building

Route::post('/AddBuilding', 'BuildingController@addBuilding');
Route::get('/bldgTable', 'BuildingController@getBuildings');
Route::post('/checkBldgName', 'BuildingController@checkBldgName');
Route::post('/checkBldgCode', 'BuildingController@checkBldgCode');
Route::post('/getBuildingInfo', 'BuildingController@getBuildingInfo');
Route::post('/UpdateBuilding', 'BuildingController@UpdateBuilding');
Route::post('/deleteBuilding', 'BuildingController@deleteBuilding');
Route::post('/getCode', 'BuildingController@getBuildingCode');
Route::post('/getFloorsUp', 'BuildingController@getFloors');

Route::get('/stypeTable', 'StallTypeController@getStallTypes');
Route::post('/checkSTypeName', 'StallTypeController@checkSTypeName');
Route::post('/addStallType', 'StallTypeController@addStallType');
Route::post('/getSTypeInfo', 'StallTypeController@getSTypeInfo');
Route::post('/UpdateSType', 'StallTypeController@UpdateSType');
Route::post('/deleteSType', 'StallTypeController@deleteSType');
Route::post('/getSizes', 'StallTypeController@getSizes');
Route::post('/deleteStypeSize', 'StallTypeController@deleteStypeSize');

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
Route::post('/checkRate', 'Controller@checkRate');

Route::get('/pdfview',array('as'=>'pdfview','uses'=>'PDFController@pdfview'));
Route::post('/getVendorInfo', 'ApplicationController@getVendorInfo');
Route::get('/getVendor', 'ApplicationController@getVendor');

///////////////////ARCHIVES IN MAINTENANCE////////////////

Route::get('/BuildingArchive','ArchiveController@buildingIndex');
Route::get('/StallTypeArchive','ArchiveController@stallTypeIndex');
Route::get('/StallArchive','ArchiveController@stallIndex');
Route::get('/StallRateArchive','ArchiveController@stallRateIndex');

////////////////////MANAGE CONTRACTS////////////////////

Route::get('/StallList','ManageContractsController@stallListIndex');
Route::get('/RegistrationList','ManageContractsController@regListIndex');
Route::get('/StallHolderList','ManageContractsController@stallHListIndex');


///////////////////PAYMENT AND COLLECTIONS///////////////
Route::get('/Payment','PaymentController@paymentIndex');