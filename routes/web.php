
<?php
use App\Http\Controllers\Patient\AppointmentController;
use App\Http\Controllers\Admin\AppointmentController as AdminAppointmentController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\ServiceController;

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Patients
    Route::delete('patients/destroy', 'PatientController@massDestroy')->name('patients.massDestroy');
    Route::post('patients/media', 'PatientController@storeMedia')->name('patients.storeMedia');
    Route::resource('patients', 'PatientController');

    // Tests
    Route::delete('tests/destroy', 'TestController@massDestroy')->name('tests.massDestroy');
    Route::resource('tests', 'TestController');

    // Prescriptions
    Route::delete('prescriptions/destroy', 'PrescriptionController@massDestroy')->name('prescriptions.massDestroy');
    Route::resource('prescriptions', 'PrescriptionController');

    // Medicines
    Route::delete('medicines/destroy', 'MedicineController@massDestroy')->name('medicines.massDestroy');
    Route::resource('medicines', 'MedicineController');

   // Schedules
    Route::prefix('schedules')->name('schedules.')->group(function () {
        Route::get('settings', 'ScheduleController@settings')->name('settings');
        Route::post('settings', 'ScheduleController@saveSettings')->name('settings.update');
        Route::get('/', 'ScheduleController@index')->name('index');
        Route::get('create', 'ScheduleController@create')->name('create');
        Route::post('/', 'ScheduleController@store')->name('store');
    });
    Route::get('/available-days', [ScheduleController::class, 'getAvailableDays']);
    Route::post('schedules/settings', [ScheduleController::class, 'saveSettings'])->name('schedules.saveSettings');

    Route::delete('reports/destroy', 'ReportController@massDestroy')->name('reports.massDestroy');
    Route::resource('reports', 'ReportController');
    
    //Doctors
    Route::resource('doctors', 'DoctorController');
    Route::post('doctors/media', 'DoctorController@storeMedia')->name('doctors.storeMedia');

    //Request
    Route::get('appointments', 'AppointmentController@index')->name('appointments.index');
    Route::get('appointments/requests', 'AppointmentController@requests')->name('appointments.requests');

    //Payments
    Route::get('payments', 'PaymentController@index')->name('payments.index');
    Route::get('payments/setup', 'PaymentController@setup')->name('payments.setup');
    Route::post('payments/store', 'PaymentController@store')->name('payments.store');
    Route::get('payments/setup', [PaymentController::class, 'setup'])->name('payments.setup');

    //Gateway
    Route::get('gateway', 'GatewayController@index')->name('gateway.index');
    Route::get('gateway/setup', 'GatewayController@setup')->name('gwateway.setup');
    Route::get('gateway/remind/{patient}', 'GatewayController@sendReminder')->name('gateway.remind');
    //Categories
    
    Route::get('/categories', 'App\Http\Controllers\Admin\CategoryController@index');
    Route::resource('categories', 'CategoryController');
    //Service
    Route::get('/services', 'App\Http\Controllers\Admin\ServiceController@index');
    //Route::resource('services', 'ServiceController');
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::resource('services', ServiceController::class);
    //Appointment
    Route::get('appointment-counts', 'AppointmentController@getAppointmentCounts')->name('appointment.counts');
        // Inside the admin routes group
    Route::get('appointments/create', 'AppointmentController@create')->name('appointments.create');
    //Route::get('appointments/{appointment}', 'AppointmentController@show')->name('appointments.show');
    Route::get('appointments/{appointment}/edit', 'AppointmentController@edit')->name('appointments.edit');
    Route::put('appointments/{appointment}', 'AppointmentController@update')->name('appointments.update'); // Added this line
    Route::delete('appointments/{appointment}', 'AppointmentController@destroy')->name('appointments.destroy');
    Route::get('/appointments/{appointment}', [AppointmentController::class, 'show'])->name('appointments.show');

});

// User/Patient routes (new addition)
Route::group(['prefix' => 'patient', 'as' => 'patient.', 'namespace' => 'Patient', 'middleware' => ['auth', 'patient']], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    // Profile routes
    Route::get('/profile', [App\Http\Controllers\Patient\ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [App\Http\Controllers\Patient\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [App\Http\Controllers\Patient\ProfileController::class, 'update'])->name('profile.update');
    Route::get('/appointments', 'AppointmentController@index')->name('appointments.index');
    Route::get('/appointments/{appointment}', [AppointmentController::class, 'show'])->name('appointments.show');
    Route::get('/appointments/create', 'AppointmentController@create')->name('appointments.create');
    Route::post('/appointments', 'AppointmentController@store')->name('appointments.store');
    //Route::get('/appointments/counts', 'AppointmentController@getAppointmentCounts')->name('appointments.counts');

    Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
    Route::get('/prescriptions', 'PrescriptionController@index')->name('prescriptions.index');
    Route::get('/test-results', 'TestResultController@index')->name('test-results.index');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    //Route::get('/patient/dashboard', [PatientController::class, 'dashboard'])->name('patient.dashboard');
    Route::get('/patient/services', [App\Http\Controllers\Patient\PrescriptionController::class, 'index'])->name('patient.services.index');
    Route::get('/patient/about', [App\Http\Controllers\Patient\TestResultController::class, 'index'])->name('patient.about.index');
});

Route::middleware(['auth:web'])->group(function () {
    Route::post('/save-settings', 'AdminController@saveSettings');
});


// Homepage and general routes
Route::get('/', 'HomeController@index')->name('home');
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/services', 'HomeController@services')->name('services');
Route::get('/contact', 'HomeController@contact')->name('contact');
// Add this outside any route group in web.php
Route::get('/appointments/counts', [App\Http\Controllers\Patient\AppointmentController::class, 'getAppointmentCounts']);
Route::get('/schedules/days', [App\Http\Controllers\Admin\ScheduleController::class, 'getDays']);
Route::get('/schedules/available-days', [App\Http\Controllers\Admin\ScheduleController::class, 'getAvailableDays']);

Route::get('/signup', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('signup');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('signup.submit');