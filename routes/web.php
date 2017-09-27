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



Auth::routes();

Route::get('/', function () {
    return view('dashboard.dashboard');
});

// Auth::routes();
Route::get('/Dashboard','dashboardController@index');
Route::get('/Registration/{stallid}','ApplicationController@create');
Route::get('/UpdateRegistration/{rentID}','ApplicationController@updateRegistration');
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
Route::post('/acceptRental','ApplicationController@acceptRental');
Route::post('/rejectRental','ApplicationController@rejectRental');

/////MAINTENANCE///////
Route::resource('/', 'DashboardController');

Route::get('/Building', function () {
    return view('Maintenance.Maintenance_Buildings');
});

Route::get('/Holiday', function () {
    return view('Maintenance.Maintenance_Holiday');
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
Route::post('/restoreBldg', 'BuildingController@restore');

Route::get('/bldgTableTrashed', 'BuildingController@getBuildingsTrashed');

//Stall Type

Route::get('/stypeTable', 'StallTypeController@getStallTypes');
Route::post('/checkSTypeName', 'StallTypeController@checkSTypeName');
Route::post('/addStallType', 'StallTypeController@addStallType');
Route::post('/getSTypeInfo', 'StallTypeController@getSTypeInfo');
Route::post('/UpdateSType', 'StallTypeController@UpdateSType');
Route::post('/deleteSType', 'StallTypeController@deleteSType');
Route::post('/getSizes', 'StallTypeController@getSizes');
Route::post('/deleteStypeSize', 'StallTypeController@deleteStypeSize');
Route::post('/restoreSType', 'StallTypeController@restore');

Route::get('/stypeTableTrashed', 'StallTypeController@getStallTypesTrashed');

//Stall

Route::get('/stallTable', 'StallController@getStalls');
Route::get('/stallTableTrashed', 'StallController@getStallsTrashed');
Route::post('/bldgOptions', 'StallController@getBuildingOption');
Route::post('/getStallID', 'StallController@getStallID');
Route::post('/addStall', 'StallController@addStall');
Route::post('/stypeOptions', 'StallController@getSTypeOption');
Route::post('/getUtilities', 'StallController@getUtilities');
Route::post('/getStallInfo', 'StallController@getStallInfo');
Route::post('/UpdateStall', 'StallController@updateStall');
Route::post('/UpdateStalls', 'StallController@updateStalls');
Route::post('/deleteStall', 'StallController@deleteStall');

//Rate

Route::post('/addStallRate', 'RateController@addStallRate');
Route::get('/rateTable', 'RateController@getStallRates');
Route::post('/stypeRate', 'RateController@getStallTypes');
Route::post('/checkRate', 'Controller@checkRate');
Route::post('/datesDisabled', 'RateController@datesDisabled');

//Charge

Route::get('/chargeTable', 'ChargeController@getCharges');
Route::post('/addCharge', 'ChargeController@addCharge');
Route::post('/updateCharge', 'ChargeController@updateCharge');
Route::post('/chargeInfo', 'ChargeController@getChargeInfo');
Route::post('/deleteCharge', 'ChargeController@deleteCharge');
Route::post('/checkChargeName', 'ChargeController@checkChargeName');

//Requirements

Route::resource('/requirements', 'RequirementsController');
Route::get('/requirements/show/{id}', 'RequirementsController@show');
Route::get('/requirementsArchive', 'RequirementsController@archive');
Route::PUT('/requirements/restore/{id}', 'RequirementsController@restore');

Route::get('/pdfview/{rentalid}','PDFController@pdfcreate');
Route::post('/getVendorInfo', 'ApplicationController@getVendorInfo');
Route::get('/getVendor', 'ApplicationController@getVendor');

//Holiday
Route::get('/holidayTable', 'HolidayController@getHolidays');
Route::get('/holidayTableTrashed', 'HolidayController@getHolidaysTrashed');
Route::post('/addHoliday', 'HolidayController@addHoliday');
Route::post('/updateHoliday', 'HolidayController@updateHoliday');
Route::post('/getHolidayInfo', 'HolidayController@getHolidayInfo');
Route::post('/deleteHoliday', 'HolidayController@deleteHoliday');
Route::post('/CheckHolidayName', 'HolidayController@CheckHolidayName');
Route::post('/CheckHolidayDate', 'HolidayController@CheckHolidayDate');
Route::post('/restoreHoliday', 'HolidayController@restore');

///////////////////ARCHIVES IN MAINTENANCE////////////////

Route::get('/BuildingArchive','ArchiveController@buildingIndex');
Route::get('/StallTypeArchive','ArchiveController@stallTypeIndex');
Route::get('/StallArchive','ArchiveController@stallIndex');
Route::get('/StallRateArchive','ArchiveController@stallRateIndex');
Route::get('/HolidayArchive','ArchiveController@holidayIndex');
////////////////////MANAGE CONTRACTS////////////////////

Route::get('/getStallHolderList','ManageContractsController@getStallHolderList');

Route::get('/getTennants','ManageContractsController@getTennants');
Route::get('/getStallHolders','ManageContractsController@getStallHolders');
Route::get('/getRegistrationList','ManageContractsController@getRegistrationList');
Route::get('/getTennant/{tennantid}','ManageContractsController@getTennant');
Route::post('/updateTennant','ManageContractsController@updateTennant');
Route::post('/deleteTennant','ManageContractsController@deleteTennant');

Route::get('/StallList','ManageContractsController@stallListIndex');
Route::get('/RegistrationList','ManageContractsController@regListIndex');
Route::get('/StallHolderList','ManageContractsController@stallHListIndex');
Route::get('/ContractList','ManageContractsController@contractListIndex');
Route::get('/getStallList','ManageContractsController@getStallList');
Route::get('/getAvailableStalls','ManageContractsController@getAvailableStalls');

///////////////////PAYMENT AND COLLECTIONS///////////////

Route::get('/Payment','PaymentController@index');
Route::resource('/Collection','CollectionController');
Route::get('/CreateCollection/{id}','CollectionController@create');
Route::get('/ViewCollections/{id}','CollectionController@viewCollections');
Route::get('/ViewCollectionDetails/{id}/end/{endid}','CollectionController@showDetails');
Route::get('/collectionTable', 'CollectionController@getCollections');
Route::get('/ViewPayment/{id}','PaymentController@makePayment');
Route::get('/Billing','BillingController@index');
Route::resource('/Utilities','UtilityController');
Route::get('/Utilities/previous/{id}', 'UtilityController@previous');
Route::get('/getBills','PaymentController@getBills');
Route::get('/createBill/{id}','BillingController@createBill');
Route::get('/ViewBill/{id}','BillingController@viewBill');
Route::get('/getPaymentStatus','PaymentController@getPaymentStatus');
Route::get('/CheckBillingRecords','PaymentController@checkRecords');
////////////////REQUESTS////////////
Route::resource('/requestList', 'RequestController');
Route::get('/requestList/show/{id}', 'RequestController@show');
Route::get('requestList/getStall/{id}','RequestController@getStall');

Route::resource('/stocks', 'StocksController');
Route::get('/stocks/show/{id}', 'StocksController@show');

Route::resource('/borrow', 'BorrowController');
////////////////Queries/////////////
Route::get('/Queries','QueriesController@index');

///////////////Utilities////////
// Route::get('/Utilities','UtilitiesController@index');
// Route::get('/testjoin','ApplicationController@testjoin');

// /////////////////////Utilities/////////////////
Route::get('/MarketDays', 'UtilitiesController@marketDaysIndex');
Route::put('/MarketDays/{id}', 'UtilitiesController@marketDaysUpdate');
Route::get('/PeakDays', 'UtilitiesController@peakDaysIndex');
Route::put('/PeakDays/{id}', 'UtilitiesController@peakDaysUpdate');\
Route::get('/InitialFee', 'UtilitiesController@initialFeeIndex');
Route::post('/InitialFee', 'UtilitiesController@initialFeeUpdate');
Route::get('/CollectionStatus', 'UtilitiesController@collectionStatusIndex');
Route::put('/CollectionStatus/{id}', 'UtilitiesController@collectionStatusUpdate');

// Route::post('/updateApplication','ApplicationController@updateApplication');
// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
