<?php

/*
|--------------------------------------------------------------------------
| Admin Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Helper\Helper;
use App\Helper\SettingHelper;
use Illuminate\Support\Facades\Schema;

if (Schema::hasTable('site_settings') !== false && !session()->has('site_settings')) {
    SettingHelper::loadOptions();
}


Route::group(['middleware' => ['preventBackHistory', 'auth:admin'], 'prefix' => 'admin'], function () {
    Route::get('error-logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');
    Route::post('change-password', 'AdminListController@resetPassword')->name('admin.change-password');
    Route::get('generatesitemap', 'GenerateSiteMapController@generate')->name('admin.generatesitemap.index');

    /* ==============   admin  ====================  */
    Route::resource('admin-type', 'AdminTypeController', ['as' => 'admin']);
    Route::post('admin-type/change-status', array('as' => 'admin.admin-type.change-status', 'uses' => 'AdminTypeController@changeStatus'));

    Route::prefix('admin-access')->group(function () {
        Route::get('/{admin_type_id}/create', 'AdminAccessController@create')->name('admin.admin-access.create');
        Route::post('/{admin_type_id}/store', 'AdminAccessController@store')->name('admin.admin-access.store');
    });

    Route::prefix('admin-list')->group(function () {
        Route::get('/{admin_type_id}', 'AdminListController@index')->name('admin.admin-list.index');
        Route::get('/{admin_type_id}/create', 'AdminListController@create')->name('admin.admin-list.create');
        Route::post('/{admin_type_id}/store', 'AdminListController@store')->name('admin.admin-list.store');
        Route::get('/{admin_type_id}/edit', 'AdminListController@edit')->name('admin.admin-list.edit');
        Route::post('change-status', 'AdminListController@changeStatus')->name('admin.admin-list.change-status');
        Route::delete('/{admin_type_id}/{admin_id}', 'AdminListController@destroy')->name('admin.admin-list.destroy');
    });
    Route::post('/admin-list/{admin_type_id}/update', 'AdminListController@update')->name('admin.admin-list.update');

    /* ==============   setting  ====================  */
    Route::resource('setting', 'SiteSettingController', ['as' => 'admin']);
    Route::get('/', 'SiteSettingController@index')->name('admin.setting.index');
    Route::post('setting/change-status', array('as' => 'admin.setting.change-status', 'uses' => 'SiteSettingController@changeStatus'));

    Route::get('/create', 'SiteSettingController@create')->name('admin.setting.create');
    Route::post('/store', 'SiteSettingController@store')->name('admin.setting.store');
    Route::delete('destroy/{id}', 'SiteSettingController@destroy')->name('admin.setting.destroy');
    Route::get('edit/{id}', 'SiteSettingController@edit')->name('admin.setting.edit');
    Route::post('/{id}/update', 'SiteSettingController@update')->name('admin.setting.update');

    /* ==============   Module  ====================  */
    Route::resource('module', 'ModuleController', ['as' => 'admin']);
    Route::post('module/sort', ['as' => 'admin.module.sort', 'uses' => 'ModuleController@sort']);
    Route::post('module/toggle-menu', ['as' => 'admin.module.toggle-menu', 'uses' => 'ModuleController@toggleMenu']);

    Route::resource('users', 'UserApproveController', ['as' => 'admin']);
    Route::get('users/change-status/{id}', array('as' => 'admin.users.change-status', 'uses' => 'UserApproveController@changeStatus'));


});
