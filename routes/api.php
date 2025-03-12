<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Patients
    Route::post('patients/media', 'PatientApiController@storeMedia')->name('patients.storeMedia');
    Route::apiResource('patients', 'PatientApiController');

    // Tests
    Route::apiResource('tests', 'TestApiController');

    // Prescriptions
    Route::apiResource('prescriptions', 'PrescriptionApiController');

    // Medicines
    Route::apiResource('medicines', 'MedicineApiController');
});
