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

use App\Http\Controllers\DataController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ApplicationsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\MdasController;
use App\Http\Controllers\OrganisationDashboardController;
use App\Http\Controllers\OrganisationsController;
use App\Http\Controllers\OrgCategoriesController;
use App\Http\Controllers\ActionsController;
use App\Http\Controllers\Org\LoginController as OrgLogin;
use FontLib\Table\Type\name;


// search for application
Route::get('/', [OrgLogin::class, 'index'])->name('login');

// only for guests
Route::middleware(['guest'])->group(function () {
    // organisation auth routes
    Route::get('/login', [OrgLogin::class, 'index'])->name('login');
    Route::post('/login', [OrgLogin::class, 'store']);

    // auth routes
    Route::get('/admin/login', [LoginController::class, 'index'])->name('admin.login');
    Route::post('/admin/login', [LoginController::class, 'store']);
});


// only for authenticated users
Route::middleware(['auth'])->group(function () {
    // actions
    Route::get('/actions', [ActionsController::class, 'actions'])->name('actions');
    Route::delete('/deleteAllMotorcycles', [ActionsController::class, 'deleteAllMotorcycles'])->name('deleteMotorcycles');

    // search route
    Route::post('/personnel/search-plates', [SearchController::class, 'index'])->name('search');

    // dashboard
    Route::get('/admin-dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // users routes
    Route::get('/users', [UsersController::class, 'index'])->name('users');

    // special clearance applications route
    Route::get('/applications', [ApplicationsController::class, 'index'])->name('applications');
    Route::get('/applications/add', [ApplicationsController::class, 'add'])->name('applications.add');
    Route::post('/applications/store', [ApplicationsController::class, 'store'])->name('applications.store');
    Route::get('/applications/vehicles/{application}', [ApplicationsController::class, 'addVehicles'])->name('applications.addVehicles');
    Route::post('/applications/vehicles/{application}', [ApplicationsController::class, 'storeVehicles'])->name('applications.storeVehicles');
    Route::get('/applications/results/{application}', [ApplicationsController::class, 'results'])->name('applications.results');
    Route::put('/applications/results/approve/{application}', [ApplicationsController::class, 'approveApplication'])->name('applications.approve');
    Route::put('/applications/results/approveAll', [ApplicationsController::class, 'approveAll'])->name('applications.approveAll');
    Route::put('/application/results/reject/{application}', [ApplicationsController::class, 'rejectApplication'])->name('applications.reject');
    Route::put('/application/results/rejectAll', [ApplicationsController::class, 'rejectAll'])->name('applications.rejectAll');
    Route::put('/application/results/revertAll', [ApplicationsController::class, 'revertAll'])->name('applications.revertAll');
    Route::delete('/application/results/deleteAll', [ApplicationsController::class, 'deleteAll'])->name('applications.deleteAll');
    Route::get('/applications/cleared', [ApplicationsController::class, 'cleared'])->name('applications.cleared');
    Route::get('/applications/rejected', [ApplicationsController::class, 'rejected'])->name('applications.rejected');
    Route::get('/applications/pending', [ApplicationsController::class, 'pending'])->name('applications.pending');
    Route::get('/applications/expired', [ApplicationsController::class, 'expired'])->name('applications.expired');
    Route::get('/applications/results/edit/{application}', [ApplicationsController::class, 'editApplication'])->name('applications.editApplication');
    Route::put('/applications/results/update/{application}', [ApplicationsController::class, 'updateApplication'])->name('applications.updateApplication');
    Route::get('/applications/vehicles/edit/{vehicle}', [ApplicationsController::class, 'editVehicle'])->name('applications.editVehicle');
    Route::put('/applications/vehicles/update/{vehicle}', [ApplicationsController::class, 'updateVehicle'])->name('applications.updateVehicle');
    Route::delete('/applications/vehicles/delete/{vehicle}', [ApplicationsController::class, 'deleteVehicle'])->name('applications.deleteVehicle');

    // data route -> special clearances
    Route::get('/special', [DataController::class, 'index'])->name('special.index');
    Route::get('/special/cleared', [DataController::class, 'cleared'])->name('special.cleared');
    Route::get('/special/rejected', [DataController::class, 'rejected'])->name('special.rejected');
    Route::get('/special/pending', [DataController::class, 'pending'])->name('special.pending');
    Route::get('/add', [DataController::class, 'add'])->name('add');
    Route::post('/results', [DataController::class, 'store'])->name('store');
    Route::put('/results/special/approve/{data}', [DataController::class, 'approveApplication'])->name('data.approve');
    Route::put('/results/special/reject/{data}', [DataController::class, 'rejectApplication'])->name('data.reject');
    Route::get('/results-preview/special/{data}', [DataController::class, 'preview'])->name('data.results');

    // mda
    Route::get('/mda', [MdasController::class, 'index'])->name('mda');
    Route::get('/mda/add', [MdasController::class, 'add'])->name('mda.add');
    Route::post('/mda/store', [MdasController::class, 'store'])->name('mda.store');
    Route::get('/mda/personnel/{mda}', [MdasController::class, 'addMdaPersonnel'])->name('mda.mdaPersonnel');
    Route::get('/mda/personnel/preview/{mda}', [MdasController::class, 'displayMdaPersonnel'])->name('mda.personnelPreview');
    Route::get('/results/personnel/{data}', [MdasController::class, 'personnelPreview'])->name('mda.preview');

    // auth routes
    Route::post('/register', [RegisterController::class, 'store'])->name('auth.store');
    Route::get('/reset-password', [LoginController::class, 'resetPassword'])->name('resetPassword');
    Route::post('/reset-password', [LoginController::class, 'updateReset'])->name('resetPassword.reset');
    Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

    // organisation routes
    Route::get('/dashboard/organisation', [OrganisationDashboardController::class, 'index'])->name('org.dashboard');
    Route::get('/organisation', [OrganisationsController::class, 'index'])->name('organisation');
    Route::post('/organisation', [OrganisationsController::class, 'add'])->name('organisation.add');
    Route::get('/organisation/{organisation}', [OrganisationsController::class, 'orgPersonnel'])->name('organisation.show');
    Route::delete('/organisation/{organisation}', [OrganisationDashboardController::class, 'deleteOrganisation'])->name('organisation.delete');
    Route::get('/organisation/personnel/{organisation}', [OrganisationDashboardController::class, 'showOrganisationPersonnel'])->name('organisation.personnel');
    Route::post('/organisation/{organisation}', [OrganisationsController::class, 'addPersonnel'])->name('organisation.addPersonnel');
    Route::put('/organisation/addWorkers/{organisation}', [OrganisationsController::class, 'addWorkers'])->name('organisation.addWorkers');
    Route::delete('/organisation/personnel/delete', [OrganisationsController::class, 'deletePersonnel'])->name('organisation.deletePersonnel');

    Route::get('/organisation/personnel/edit/{data}', [OrganisationsController::class, 'editPersonnel'])->name('organisation.editPersonnel');
    Route::put('/organisation/personnel/update/{data}', [OrganisationsController::class, 'updatePersonnel'])->name('organisation.updatePersonnel');
    Route::put('/results/approve/{data}', [OrganisationsController::class, 'approveApplication'])->name('organisation.approve');
    Route::put('/results/approveAll', [OrganisationsController::class, 'approveAll'])->name('organisation.approveAll');
    Route::put('/results/reject/{data}', [OrganisationsController::class, 'rejectApplication'])->name('organisation.reject');
    Route::put('/results/rejectAll', [OrganisationsController::class, 'rejectAll'])->name('organisation.rejectAll');
    Route::put('/results/revert/{data}', [OrganisationsController::class, 'revertApplication'])->name('organisation.revert');
    Route::put('/results/revertAll', [OrganisationsController::class, 'revertAll'])->name('organisation.revertAll');
    Route::get('/results-preview/{person}', [OrganisationsController::class, 'preview'])->name('results');

    // get csv
    Route::get('/csv', [OrganisationDashboardController::class, 'exportCsv'])->name('csv');


    // category route
    Route::get('/category/government', [OrgCategoriesController::class, 'government'])->name('government');
    Route::get('/category/media', [OrgCategoriesController::class, 'media'])->name('media');
    Route::get('/category/utilities', [OrgCategoriesController::class, 'utilities'])->name('utilities');
    Route::get('/category/manufacturing', [OrgCategoriesController::class, 'manufacturing'])->name('manufacturing');
    Route::get('/category/medical', [OrgCategoriesController::class, 'medical'])->name('medical');
    Route::get('/category/telecom', [OrgCategoriesController::class, 'telecom'])->name('telecom');
    Route::get('/category/construction', [OrgCategoriesController::class, 'construction'])->name('construction');
    Route::get('/category/foodProcessors', [OrgCategoriesController::class, 'foodProcessors'])->name('foodProcessors');
    Route::get('/category/agriculture', [OrgCategoriesController::class, 'agriculture'])->name('agriculture');
    Route::get('/category/fuelStations', [OrgCategoriesController::class, 'fuelStations'])->name('fuelStations');
    Route::get('/category/privateSecurity', [OrgCategoriesController::class, 'privateSecurity'])->name('privateSecurity');
    Route::get('/category/deliveryServices', [OrgCategoriesController::class, 'deliveryServices'])->name('deliveryServices');
    Route::get('/category/financialInstitutions', [OrgCategoriesController::class, 'financialInstitutions'])->name('financialInstitutions');
    Route::get('/category/emergencyServices', [OrgCategoriesController::class, 'emergencyServices'])->name('emergencyServices');
    Route::get('/category/airlineOperators', [OrgCategoriesController::class, 'airlineOperators'])->name('airlineOperators');
    Route::get('/category/restaurants', [OrgCategoriesController::class, 'restaurants'])->name('restaurants');
    Route::get('/category/hotels', [OrgCategoriesController::class, 'hotels'])->name('hotels');
    Route::get('/category/cleaning', [OrgCategoriesController::class, 'cleaning'])->name('cleaning');
    Route::get('/category/tours', [OrgCategoriesController::class, 'tours'])->name('tours');
    Route::get('/category/supermarkets', [OrgCategoriesController::class, 'supermarkets'])->name('supermarkets');
    Route::get('/category/garages', [OrgCategoriesController::class, 'garages'])->name('garages');
    Route::get('/category/insurance', [OrgCategoriesController::class, 'insurance'])->name('insurance');
    Route::get('/category/clearingAgents', [OrgCategoriesController::class, 'clearingAgents'])->name('clearingAgents');
    Route::get('/category/educationServices', [OrgCategoriesController::class, 'educationServices'])->name('educationServices');
    Route::get('/category/ngos', [OrgCategoriesController::class, 'ngos'])->name('ngos');
});

/**
 * pdf routes
 */
// cross-district travel pdf
Route::get('/results-pdf/applications/{application}', [ApplicationsController::class, 'generatePDF'])->name('applications.pdf');

// organisations pdf
Route::get('/results-pdf/{person}', [OrganisationsController::class, 'generatePDF'])->name('pdf');
