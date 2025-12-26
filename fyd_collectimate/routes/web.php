<?php

use App\Helpers\RouteHelpers;
use App\Http\Controllers\promotion_controller;
use App\Http\Controllers\select2_controller;
use App\Http\Controllers\tb_crm_mf_client_controller;
use App\Http\Controllers\tb_crm_mf_client_device_controller;
use App\Http\Controllers\tb_crm_mf_license_controller;
use App\Http\Controllers\tb_crm_mf_license_history_controller;
use App\Http\Controllers\tb_crm_mf_license_type_controller;
use App\Http\Controllers\tb_crm_tr_script_controller;
use App\Http\Controllers\tb_sys_mf_access_type_controller;
use App\Http\Controllers\tb_sys_mf_mod_access_type_controller;
use App\Http\Controllers\tb_sys_mf_mod_controller;
use App\Http\Controllers\tb_sys_mf_mod_group_controller;
use App\Http\Controllers\tb_sys_mf_password_controller;
use App\Http\Controllers\tb_sys_mf_status_controller;
use App\Http\Controllers\tb_sys_mf_style_controller;
use App\Http\Controllers\tb_sys_mf_tutorial_controller;
use App\Http\Controllers\tb_sys_mf_user_access_type_controller;
use App\Http\Controllers\tb_sys_mf_user_controller;
use App\Http\Controllers\tb_sys_mf_user_type_controller;
use App\Http\Controllers\tb_sys_tr_audit_controller;
use App\Http\Controllers\test_controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// SELECT SEARCHER
Route::controller(select2_controller::class)->group(function () {
    Route::post('select2', 'index')->name('select2');
    Route::post('select2/city', 'city')->name('select2.city');
    Route::post('select2/brg', 'brg')->name('select2.brg');
    Route::post('select2/devices', 'devices')->name('select2.devices');
});

//SYSTEM MODULE
Route::middleware(
    ['auth', "can:has_access,'Users'"],
    ['except' => ['users.profile-show', 'users.profile-edit', 'users.profile-update', 'users.profile-edit-password', 'users.profile-update-password', 'users.register.member', 'users.register.partner', 'users.activate-user', 'users.register.new-partner', 'users.account-edit-password']]
)->controller(tb_sys_mf_user_controller::class)->group(function () {
    Route::put('/users/profile-reset-password/{user}', 'profile_reset_password')->name('users.profile-reset-password');
    Route::get('/users/get-csv-user-access', 'get_csv_user_access')->name('users.get-csv-user-access');
    // Middleware Exceptions
    Route::get('/users/profile-show/{user}', 'profile_show')->name('users.profile-show');
    Route::get('/users/profile-edit/{user}', 'profile_edit')->name('users.profile-edit');
    Route::put('/users/profile-update/{user}', 'profile_update')->name('users.profile-update');
    Route::get('/users/profile-edit-password/{user}', 'profile_edit_password')->name('users.profile-edit-password');
    Route::put('/users/profile-update-password/{user}', 'profile_update_password')->name('users.profile-update-password');
    Route::get('/users/account-edit-password/{user}', 'account_edit_password')->name('users.account-edit-password');
    Route::put('/users/account-update-password/{user}', 'account_update_password')->name('users.account-update-password');
});

//REQUIRES AUTHENTICATED USERS
Route::middleware(['auth'])->controller(tb_sys_mf_user_controller::class)->group(function () {
    Route::put('/users/account-profile-update/{user}', 'account_profile_update')->name('users.account_profile-update');
    Route::put('/users/partner-account-profile-update/{user}', 'partner_account_profile_update')->name('users.partner_account_profile-update');
});

Route::get('/forgot-password', [tb_sys_mf_password_controller::class, 'forgot_password'])->name('passwords.forgot-password')->middleware('throttle:5,1');

Route::controller(tb_sys_mf_password_controller::class)->group(function () {
    Route::post('forgot-password/send', 'send')->name('passwords.send');
    Route::get('/forgot-password-sent', 'forgot_password_sent')->name('passwords.forgot-password-sent');
    Route::get('/reset-password-success/{email}', 'reset_password_success')->name('passwords.reset-password-success');
    Route::put('/password/update/{email}', 'update')->name('passwords.update');
});

Route::get('/reset_password', [tb_sys_mf_password_controller::class, 'reset_password'])->name('passwords.reset-password')->middleware('signed');

Route::middleware(['auth', "can:has_access,'Users'"])->resource('users', tb_sys_mf_user_controller::class);
Route::middleware(['auth', "can:has_access,'Status'"])->resource('statuses', tb_sys_mf_status_controller::class);
Route::middleware(['auth', "can:has_access,'Access Types'"])->resource('access-types', tb_sys_mf_access_type_controller::class);
Route::middleware(['auth', "can:has_access,'Mod Groups'"])->resource('mod-groups', tb_sys_mf_mod_group_controller::class);
Route::middleware(['auth', "can:has_access,'Mods'"])->resource('mods', tb_sys_mf_mod_controller::class);
Route::middleware(['auth', "can:has_access,'Styles'"])->resource('styles', tb_sys_mf_style_controller::class);

Route::middleware(['auth', "can:has_access,'Mods'"])->controller(tb_sys_mf_mod_access_type_controller::class)->group(function () {
    Route::get('/mod-access-types/create/{mod}', 'create')->name('mod-access-types.create');
    Route::post('/mod-access-types/store', 'store')->name('mod-access-types.store');
    Route::get('/mod-access-types/{mod_access_type}', 'show')->name('mod-access-types.show');
    Route::get('/mod-access-types/{mod_access_type}/edit', 'edit')->name('mod-access-types.edit');
    Route::put('/mod-access-types/{mod_access_type}', 'update')->name('mod-access-types.update');
    Route::delete('/mod-access-types/{mod_access_type}', 'destroy')->name('mod-access-types.destroy');
});

Route::middleware(['auth', "can:has_access,'Users'"])->controller(tb_sys_mf_user_access_type_controller::class)->group(function () {
    Route::get('/user-access-types/create/{user}', 'create')->name('user-access-types.create');
    Route::post('/user-access-types/store', 'store')->name('user-access-types.store');
    Route::get('/user-access-types/{user_access_type}', 'show')->name('user-access-types.show');
    Route::get('/user-access-types/{user_access_type}/edit', 'edit')->name('user-access-types.edit');
    Route::put('/user-access-types/{user_access_type}', 'update')->name('user-access-types.update');
    Route::delete('/user-access-types/{user_access_type}', 'destroy')->name('user-access-types.destroy');
});

Route::middleware(['auth', "can:has_access,'User Types'"])->controller(tb_sys_mf_user_type_controller::class)->group(function () {
    Route::get('/user-types', 'index')->name('user-types.index');
    Route::get('/user-types/create/', 'create')->name('user-types.create');
    Route::post('/user-types/store', 'store')->name('user-types.store');
    Route::get('/user-types/{user_type}', 'show')->name('user-types.show');
    Route::get('/user-types/{user_type}/edit', 'edit')->name('user-types.edit');
    Route::put('/user-types/{user_type}', 'update')->name('user-types.update');
    Route::delete('/user-types/{user_type}', 'destroy')->name('user-types.destroy');
});

Route::middleware(['auth', "can:has_access,'Clients'"])->resource('clients', tb_crm_mf_client_controller::class);
Route::middleware(['auth', "can:has_access,'Clients'"])->controller(tb_crm_mf_client_device_controller::class)->group(function () {
    Route::get('/client-devices/create/{client}', 'create')->name('client-devices.create');
    Route::post('/client-devices/store', 'store')->name('client-devices.store');
    Route::get('/client-devices/{client_device}', 'show')->name('client-devices.show');
    Route::get('/client-devices/{client_device}/edit', 'edit')->name('client-devices.edit');
    Route::put('/client-devices/{client_device}', 'update')->name('client-devices.update');
    Route::delete('/client-devices/{client_device}', 'destroy')->name('client-devices.destroy');
});

Route::middleware(['auth', "can:has_access,'LicenseTypes'"])->resource('license-types', tb_crm_mf_license_type_controller::class);

Route::middleware(['auth', "can:has_access,'Licenses'"])->resource('licenses', tb_crm_mf_license_controller::class);
Route::middleware(['auth', "can:has_access,'Licenses'"])->controller(tb_crm_mf_license_history_controller::class)->group(function () {
    Route::get('/license-histories/create/{license}', 'create')->name('license-histories.create');
    Route::post('/license-histories/store', 'store')->name('license-histories.store');
    Route::get('/license-histories/{license_history}', 'show')->name('license-histories.show');
    Route::get('/license-histories/{license_history}/edit', 'edit')->name('license-histories.edit');
    Route::put('/license-histories/{license_history}', 'update')->name('license-histories.update');
    Route::delete('/license-histories/{license_history}', 'destroy')->name('license-histories.destroy');
});

Route::middleware(['auth', "can:has_access,'Scripts'"])->resource('scripts', tb_crm_tr_script_controller::class);

Route::middleware(['auth'])->controller(tb_sys_mf_tutorial_controller::class)->group(function () {
    Route::get('/tutorials', 'index')->name('tutorials.index');
    Route::get('/tutorials/edit', 'edit')->name('tutorials.edit');
    Route::put('/tutorials/update', 'update')->name('tutorials.update');
});

Route::middleware(['auth'])->controller(test_controller::class)->group(function () {
    Route::get('/tests', 'index')->name('tests.index');
    Route::get('/tests/mail', 'mail')->name('tests.mail');
    Route::get('/tests/captcha', 'captcha')->name('tests.captcha');
    Route::post('/tests/captcha/submit', 'captcha_submit')->name('tests.captcha-submit');
});

Route::middleware(['auth', "can:has_access,'Audits'"])->controller(tb_sys_tr_audit_controller::class)->group(function () {
    Route::get('/audit-report', 'index')->name('audits.index');
});

Auth::routes(['register' => false]);

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [App\Http\Controllers\home_controller::class, 'index'])->name('home');
