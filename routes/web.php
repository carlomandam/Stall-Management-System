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
    return view('dashboard.dashboard');
});

Auth::routes();
Route::get('/Dashboard','dashboardController@index');
Route::get('/Registration/{stallid}','ApplicationController@create');
Route::get('/Registration/{stallid}/{rentid}','ApplicationController@view');
Route::get('/List', 'ApplicationController@member');
Route::get('/View', 'ApplicationController@Memview');
Route::get('/Update', 'ApplicationController@Update');
Route::get('/CreateContract','ContractController@create');
Route::get('/Contract', 'ContractController@index');
Route::get('/ViewContracts', 'ContractController@view');
Route::get('/ShowDetails', 'ContractController@showdetails');
Route::post('/checkEmail','ApplicationController@checkEmail');

Route::post('/AddVendor','ApplicationController@newApplication');
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
    return view('Maintenance.Maintenance_Buildings');
});

Route::get('/StallType', function () {
    return view('Maintenance.Maintenance_StallType');
});

Route::get('/Stall', function () {
    return view('Maintenance.Maintenance_Stall');
});

Route::get('/StallRate', function () {
    return view('Maintenance.Maintenance_StallRate');
});

Route::get('/Charges', function () {
    return view('Maintenance.Maintenance_Charges');
});

Route::resource('/kioskmap', 'MappingController');
Route::get('/kioskmap/bldg/{id}', 'MappingController@load');
Route::get('/kioskmap/floor/{id}', 'MappingController@floor');
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
Route::post('/getStallList', 'StallController@getStallList');

Route::get('/stypeTable', 'StallTypeController@getStallTypes');
Route::post('/checkSTypeName', 'StallTypeController@checkSTypeName');
Route::post('/addStallType', 'StallTypeController@addStallType');
Route::post('/getSTypeInfo', 'StallTypeController@getSTypeInfo');
Route::post('/UpdateSType', 'StallTypeController@UpdateSType');
Route::post('/deleteSType', 'StallTypeController@deleteSType');
Route::post('/getSizes', 'StallTypeController@getSizes');
Route::post('/deleteStypeSize', 'StallTypeController@deleteStypeSize');

Route::get('/stallTable', 'StallController@getStalls');
Route::post('/bldgOptions', 'StallController@getBuildingOption');
Route::post('/getStallID', 'StallController@getStallID');
Route::post('/addStall', 'StallController@addStall');
Route::post('/stypeOptions', 'StallController@getSTypeOption');
Route::post('/getUtilities', 'StallController@getUtilities');
Route::post('/getStallInfo', 'StallController@getStallInfo');
Route::post('/UpdateStall', 'StallController@updateStall');
Route::post('/UpdateStalls', 'StallController@updateStalls');
Route::post('/deleteStall', 'StallController@deleteStall');

Route::post('/addStallRate', 'RateController@addStallRate');
Route::get('/rateTable', 'RateController@getStallRates');
Route::post('/prevRatesTable', 'RateController@getPrevStallRates');
Route::post('/upRatesTable', 'RateController@getUpStallRates');
Route::post('/getRateInfo', 'RateController@getRateInfo');
Route::post('/getPrevRateInfo', 'RateController@getPrevRateInfo');
Route::post('/getUpRateInfo', 'RateController@getUpRateInfo');
Route::post('/updateStallRate', 'RateController@updateRate');
Route::post('/stypeRate', 'RateController@getStallTypes');
Route::post('/getForbidden', 'RateController@getForbidden');

Route::get('/chargeTable', 'ChargeController@getCharges');
Route::post('/addCharge', 'ChargeController@addCharge');
Route::post('/updateCharge', 'ChargeController@updateCharge');
Route::post('/chargeInfo', 'ChargeController@getChargeInfo');
Route::post('/deleteCharge', 'ChargeController@deleteCharge');

Route::post('/addFee', 'Controller@addFee');
Route::post('/updateFee', 'Controller@updateFee');
Route::post('/deleteFee', 'Controller@deleteFee');
Route::post('/getFeeInfo', 'Controller@getFeeInfo');

Route::post('/getFees', 'Controller@getFeesOpt');
Route::post('/checkRate', 'Controller@checkRate');

Route::resource('/requirements', 'RequirementsController');
Route::get('/requirements/show/{id}', 'RequirementsController@show');


Route::get('/pdfview',array('as'=>'pdfview','uses'=>'PDFController@pdfview'));
Route::post('/getVendorInfo', 'ApplicationController@getVendorInfo');
Route::get('/getVendor', 'ApplicationController@getVendor');

///////////////////ARCHIVES IN MAINTENANCE////////////////

Route::get('/BuildingArchive','ArchiveController@buildingIndex');
Route::get('/StallTypeArchive','ArchiveController@stallTypeIndex');
Route::get('/StallArchive','ArchiveController@stallIndex');
Route::get('/StallRateArchive','ArchiveController@stallRateIndex');

////////////////////MANAGE CONTRACTS////////////////////
Route::get('/getStallHolderList','ManageContractsController@getStallHolderList');

Route::get('/getStallHolders','ManageContractsController@getStallHolders');
Route::get('/getRegistrationList','ManageContractsController@getRegistrationList');


Route::get('/StallList','ManageContractsController@stallListIndex');
Route::get('/RegistrationList','ManageContractsController@regListIndex');
Route::get('/StallHolderList','ManageContractsController@stallHListIndex');
Route::get('/ContractList','ManageContractsController@contractListIndex');
Route::get('/UpdateRegistration/{rentID}','ManageContractsController@updateRegistration');
Route::get('/getStallList','ManageContractsController@getStallList');
Route::get('/getAvailableStalls','ManageContractsController@getAvailableStalls');
///////////////////PAYMENT AND COLLECTIONS///////////////
Route::get('/Payment','PaymentController@index');
Route::get('/ViewPayment',function(){
      return view('transaction.PaymentAndCollection.viewPayment');
});
Route::get('/ViewBill',function(){
    return view('transaction.PaymentAndCollection.bill');
}); 
////////////////REQUESTS////////////
Route::resource('/requestList', 'RequestController');
Route::get('requestList/getStall/{id}','RequestController@getStall');
////////////////Queries/////////////
Route::get('/Queries','QueriesController@index');

///////////////Utilities////////
Route::get('/Utilities','UtilitiesController@index');
Route::get('/testjoin','ApplicationController@testjoin');