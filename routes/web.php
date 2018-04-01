<?php
// auth - managements
// Route::group(['middleware' => 'auth', 'prefix' => 'managements'], function () {
Route::group(['prefix' => 'managements'], function () {
    // employees
    Route::group(['prefix' => 'employees'], function () {
        // leader-Admin
        Route::get('leaders/list', 'AdminController@listLeaders')->name('admins.leader.list');
        Route::get('leaders/createOrUpdate', 'AdminController@createOrUpdateLeader')->name('admins.leader.createOrUpdate');
        Route::get('leaders/delete', 'AdminController@deleteLeader')->name('admins.leader.delete');

        // sale-Admin
        Route::get('sales/list', 'AdminController@listSales')->name('admins.sale.list');
        Route::get('sales/createOrUpdate', 'AdminController@createOrUpdateSale')->name('admins.sale.createOrUpdate');
        Route::get('sales/delete', 'AdminController@deleteLeader')->name('admins.sale.delete');
   });
    // customer
    Route::group(['prefix' => 'customer'], function () {
        // post-Admin
        Route::group(['prefix' => 'postCustomer'], function () {
            Route::get('list', 'AdminController@listPostCustomer')->name('admins.postCustomer.list');
            Route::get('delete', 'AdminController@deletePostCustomer')->name('admins.postCustomer.delete');
            Route::post('action', 'AdminController@actionPostCustomer')->name('admins.postCustomer.action');
            Route::get('active', 'AdminController@activePostCustomer')->name('admins.postCustomer.active');
            Route::get('detail/{customer_id}', 'AdminController@detailProductTransaction')->name('admins.postCustomer.detail');
            // product transaction
            Route::get('detailProduct/{product_id}', 'AdminController@detailProduct')->name('admins.postCustomer.detailProduct');
            Route::get('activeProductTransaction', 'AdminController@activeProductTransaction')->name('admins.postCustomer.activeProductTransaction');
            Route::get('activePaidProductTransaction', 'AdminController@activePaidProductTransaction')->name('admins.postCustomer.activePaidProductTransaction');
            Route::post('actionProductTransaction', 'AdminController@actionProductTransaction')->name('admins.postCustomer.actionProductTransaction');
            Route::get('deleteProductTransaction', 'AdminController@deleteProductTransaction')->name('admins.postCustomer.deleteProductTransaction');
        });

        // purchase-Admin
        Route::group(['prefix' => 'purchaseCustomer'], function () {
            Route::get('list', 'AdminController@listPurchaseCustomer')->name('admins.purchaseCustomer.list');
            Route::get('delete', 'AdminController@deletePostCustomer')->name('admins.postCustomer.delete');
            Route::post('action', 'AdminController@actionPostCustomer')->name('admins.postCustomer.action');
            Route::get('active', 'AdminController@activePostCustomer')->name('admins.postCustomer.active');
            Route::get('detail/{customer_id}', 'AdminController@detailProductTransaction')->name('admins.postCustomer.detail');
            // product transaction
            Route::get('detailProduct/{product_id}', 'AdminController@detailProduct')->name('admins.postCustomer.detailProduct');
            Route::get('activeProductTransaction', 'AdminController@activeProductTransaction')->name('admins.postCustomer.activeProductTransaction');
            Route::get('activePaidProductTransaction', 'AdminController@activePaidProductTransaction')->name('admins.postCustomer.activePaidProductTransaction');
            Route::post('actionProductTransaction', 'AdminController@actionProductTransaction')->name('admins.postCustomer.actionProductTransaction');
            Route::get('deleteProductTransaction', 'AdminController@deleteProductTransaction')->name('admins.postCustomer.deleteProductTransaction');
        });
        
   });

    // news
    Route::group(['prefix' => 'news'], function () {
        // post-Admin
        Route::get('list', 'AdminController@listNews')->name('admins.news.list');
        Route::get('create', 'AdminController@createNews')->name('admins.news.create');
        Route::post('create', 'AdminController@storeNews')->name('admins.news.store');
        Route::get('{id}/edit', 'AdminController@editNews')->name('admins.news.edit');
        Route::post('{id}/update', 'AdminController@updateNews')->name('admins.news.update');
        Route::get('delete', 'AdminController@deleteNews')->name('admins.news.delete');
        Route::post('action', 'AdminController@action')->name('admins.news.action');
        Route::get('active', 'AdminController@active')->name('admins.news.active');

   });
});

Route::group(['prefix' => 'common'], function () {
    // Skill - Admin
        Route::get('listDistrict', 'CommonController@listDistricts')->name('common.district.list');
});