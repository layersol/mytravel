<?php

use App\Http\Controllers\Attendance\AttendanceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\settings\AirportsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Roles_Permissions\RolesandPermissionsController;
use PhpParser\Node\Expr\Assign;
use App\Http\Controllers\Roles_Permissions\PermissionManage;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\SearchController;
use App\Http\Controllers\frontend\BookingController;
use App\Http\Controllers\Booking\BookingManageController;
use App\Http\Controllers\settings\SettingController;
use App\Http\Controllers\settings\BlogController;
use App\Http\Controllers\settings\GeneralController;
use App\Http\Controllers\settings\TravelDealsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/flight-to-{areaName}', [HomeController::class, 'dealIndex'])->name('home-deal');// for deals page 
Route::get('/about', [HomeController::class, 'about'])->name('/about');
Route::get('/contact', [HomeController::class, 'contact'])->name('/contact');
Route::get('/terms', [HomeController::class, 'terms'])->name('/terms');
Route::get('/home7', [HomeController::class, 'home7'])->name('/home7');
Route::get('/faq', [HomeController::class, 'faq'])->name('/faq');
Route::post('/contact', [HomeController::class, 'contactSave'])->name('/contactSave');

Route::prefix('/blog')->group(function () { 
Route::get('/list/{category?}', [HomeController::class, 'blogList'])->name('/blog-list');   
Route::get('/{blog}', [HomeController::class, 'blogSingle'])->name('/blog-single');   
});

Route::prefix('/flight')->group(function () { 
     Route::get('/list/{data?}', [SearchController::class, 'search'])->name('flight-list');
     Route::match(['get', 'post'], '/book', [BookingController::class, 'book'])->name('/flight-book');
     Route::post('/book-form', [BookingController::class, 'bookingForm'])->name('/flight-form');
     Route::get('/final/{data}', [BookingController::class, 'final'])->name('/flight-final');      
});

Route::prefix('/payment')->group(function () { 
    Route::match(['get', 'post'],'/payment-proceed/{id}', [BookingController::class, 'paymentProceed'])->name('/payment-proceed');
  
});

Route::get('/dashboard', function () {
    return view('backend/dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // can view attendances 
    Route::get('/attendance',[AttendanceController::class,'index'])->name('Accounts/attendance.index');
    Route::get('/attendance/create',[AttendanceController::class,'create'])->name('Accounts/attendance.create');
    Route::post('/attendance',[AttendanceController::class,'store'])->name('Accounts/attendance.store');
    Route::post('/attendance/{id}',[AttendanceController::class,'endShift'])->name('Accounts/attendance.endShift');
});

// users routes: can perform  users crud operations
Route::middleware(['auth','permission:manage users'])->group(function () {
    
    Route::resource('users', UserController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
});
    // roles routes: can perform  roles crud operations
    Route::middleware(['auth','permission:manage roles'])->group(function () {

    Route::get('/RolesandPermissions/roles', [RolesandPermissionsController::class, 'rolesIndex'])->name('RolesandPermissions/roles.index');  // index page
    Route::get('/RolesandPermissions/roles/create', [RolesandPermissionsController::class, 'rolesCreate'])->name('RolesandPermissions/roles.create'); //  create form
    Route::post('/RolesandPermissions/roles', [RolesandPermissionsController::class, 'rolesStore'])->name('RolesandPermissions/roles.store'); // update method
    Route::get('/RolesandPermissions/roles/{role}/edit', [RolesandPermissionsController::class, 'rolesEdit'])->name('RolesandPermissions/roles.edit'); // edit form
    Route::post('/RolesandPermissions/roles/{role}', [RolesandPermissionsController::class, 'rolesUpdate'])->name('RolesandPermissions/roles.Update');  // edit-update form 
});  

    // Permissions routes: can perform  permissions crud operations 
    Route::middleware(['auth','permission:manage permissions'])->group(function () {

    Route::get('/RolesandPermissions/permissions', [RolesandPermissionsController::class, 'PermissionsIndex'])->name('RolesandPermissions/permissions.index');  // index page
    Route::get('/RolesandPermissions/permissions/create', [RolesandPermissionsController::class, 'permissionsCreate'])->name('RolesandPermissions/permissions.create'); //  create form
    Route::post('/RolesandPermissions/permissions', [RolesandPermissionsController::class, 'permissionsStore'])->name('RolesandPermissions/permissions.store'); // update method
     Route::get('/RolesandPermissions/permissions/{permission}/edit', [RolesandPermissionsController::class, 'permissionsEdit'])->name('RolesandPermissions/permissions.edit'); // edit form
     Route::post('/RolesandPermissions/permissions/{permission}', [RolesandPermissionsController::class, 'permissionUpdate'])->name('RolesandPermissions/permission.Update');  // edit-update form 

      //  Assign or revoke single permission to user or role 
    Route::post('assign-permission/{permission}', [PermissionManage::class, 'assignRevokePermission'])->name('assignRevokePermission');

    Route::post('assign-permission-role/{role}', [PermissionManage::class, 'assignRevokePermissionRole'])->name('assignRevokePermissionRole');

    Route::post('assign-permission-user/{user}', [PermissionManage::class, 'assignRevokePermissionUser'])->name('assignRevokePermissionUser');
}); 

// manage booking routes 

Route::middleware(['auth'])->group(function () {
    Route::prefix('/booking')->group(function () { 
    Route::get('/list/{data?}', [BookingManageController::class, 'index'])->name('/booking-list');
    Route::get('/view-ticket/{id}', [BookingManageController::class, 'viewTicket'])->name('/view-ticket');
 
   });
});
// only admin can access 
Route::middleware(['auth','permission:manage bookings'])->group(function () {
        Route::prefix('/booking')->group(function () { 
        Route::get('/edit-ticket/{id}', [BookingManageController::class, 'editTicket'])->name('/edit-ticket');
        Route::post('/update-ticket/{id}', [BookingManageController::class, 'updateTicket'])->name('/update-ticket');
        Route::post('/update-passengers/{id}', [BookingManageController::class, 'updatePassengers'])->name('/update-passengers');
        
        
   });
});

Route::middleware(['auth','permission:manage booking inquiries'])->group(function () {
    Route::get('/booking-inquiry/{id?}', [BookingManageController::class, 'bookingInquiry'])->name('booking-inquiry');
    Route::post('/booking-inquiry-update/{id}', [BookingManageController::class, 'bookingInquiryUpdate'])->name('booking-inquiry-update');
 
});


// settings routes 

Route::prefix('/settings')->middleware(['auth','permission:manage settings'])->group(function () { 
    Route::get('/sections', [SettingController::class, 'sectionsIndex'])->name('/settings/section.index');
    Route::get('/sections/edit/{section}', [SettingController::class, 'sectionsEdit'])->name('/settings/section.edit');
    Route::post('/sections/update/{section}', [SettingController::class, 'sectionUpdate'])->name('/settings/section.update');
    Route::get('/sections/add/{section}', [SettingController::class, 'sectionAdd'])->name('/settings/section.add');
    Route::post('/sections/add/{section}', [SettingController::class, 'sectionCreate'])->name('/settings/section.create');

    Route::get('/sections/removeContent/{sectionId}/{contentIndex}', [SettingController::class, 'removeContent'])
    ->name('/section.removeContent');
    // section routes ends // 

    Route::get('/site-identity', [SettingController::class, 'siteIdentityIndex'])->name('/settings/siteIdentity.index');
    Route::post('/site-identity/update/{section}', [SettingController::class, 'siteIdentityUpdate'])->name('/settings/site-identity.update');
    // site identity route ends//

    Route::resource('/testimonials', SettingController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    // testimonials route ends //

    Route::get('/pages/about', [SettingController::class, 'aboutPageIndex'])->name('/settings/about.index');
    Route::post('/pages/about/update/{about}', [SettingController::class, 'aboutPageUpdate'])->name('/settings/pages/aboutPage.update');
    // about route ends //

    Route::get('/pages/contact', [SettingController::class, 'contactPageIndex'])->name('/settings/contact.index');
    Route::post('/pages/contact/update/{contact}', [SettingController::class, 'contactPageUpdate'])->name('/settings/pages/contactPage.update');
    // contact route ends //
    

    Route::get('/blog', [BlogController::class, 'blogPageIndex'])->name('/settings/blogs.index');
    Route::post('/blog/upload-image', [BlogController::class, 'uploadImage'])->name('/settings/blogs.uploadImage');
    Route::get('/blog/create', [BlogController::class, 'blogCreate'])->name('/settings/blogs.create');

    Route::post('/blog/save', [BlogController::class, 'blogSave'])->name('/settings/blogs.save');
    Route::get('/blog/edit/{id}', [BlogController::class, 'blogEdit'])->name('/settings/blogs.edit');
    Route::post('/blog/update/{id}', [BlogController::class, 'blogUpdate'])->name('/settings/blogs.update');
    Route::delete('/settings/blogs/delete/{id}', [BlogController::class, 'blogDelete'])->name('/settings/blogs.delete');

    // blogs routes //

    Route::get('/terms', [SettingController::class, 'termsIndex'])->name('/settings/terms.index');
    Route::get('/terms/edit/{id}', [SettingController::class, 'termsEdit'])->name('/settings/terms.edit');
    Route::post('/terms/update/{id}', [SettingController::class, 'termsUpdate'])->name('/settings/terms.update');

    // terms routes end
    
    Route::resource('travel-deals', TravelDealsController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

    Route::resource('/airports', AirportsController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

});

// general mangement routes: can perform  general operations
Route::prefix('/general')->middleware(['auth','permission:general management'])->group(function () {
    
    Route::get('/contact-queries', [GeneralController::class,'contactQueries'])->name('/general/contact-queries');
    Route::post('/contact-queries', [GeneralController::class,'updateMessageStatus'])->name('/general/updateMessageStatus');
    Route::delete('/contact-queries/delete/{id}', [GeneralController::class,'deleteMessage'])->name('/general/delete-message');
});

Route::get('/airports/search', [AirportsController::class,'search'])->name('airports.search');
   
require __DIR__.'/auth.php';

