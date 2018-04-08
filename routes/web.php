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

        Route::get('detail/{employee_id}', 'AdminController@detailEmployee')->name('admins.employee.detail');

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
            
            Route::get('activeProductTransaction', 'AdminController@activeProductTransaction')->name('admins.postCustomer.activeProductTransaction');
            Route::get('activePaidProductTransaction', 'AdminController@activePaidProductTransaction')->name('admins.postCustomer.activePaidProductTransaction');
            Route::post('actionProductTransaction', 'AdminController@actionProductTransaction')->name('admins.postCustomer.actionProductTransaction');
            Route::get('deleteProductTransaction', 'AdminController@deleteProductTransaction')->name('admins.postCustomer.deleteProductTransaction');
        });

        // purchase-Admin
        Route::group(['prefix' => 'purchaseCustomer'], function () {
            Route::get('list', 'AdminController@listPurchaseCustomer')->name('admins.purchaseCustomer.list');
            Route::get('delete', 'AdminController@deletePurchaseCustomer')->name('admins.purchaseCustomer.delete');
            Route::post('action', 'AdminController@actionPurchaseCustomer')->name('admins.purchaseCustomer.action');
            Route::get('active', 'AdminController@activePurchaseCustomer')->name('admins.purchaseCustomer.active');
            Route::get('detail/{customer_id}', 'AdminController@detailPurchaseTransaction')->name('admins.purchaseCustomer.detail');
            // purchase transaction
            Route::get('activeDepositPurchaseTransaction', 'AdminController@activeDepositPurchaseTransaction')->name('admins.purchaseCustomer.activeDepositPurchaseTransaction');
            Route::get('activePaymentPurchaseTransaction', 'AdminController@activePaymentPurchaseTransaction')->name('admins.purchaseCustomer.activePaymentPurchaseTransaction');
            Route::post('actionPurchaseTransaction', 'AdminController@actionPurchaseTransaction')->name('admins.purchaseCustomer.actionPurchaseTransaction');
            Route::get('deletePurchaseTransaction', 'AdminController@deletePurchaseTransaction')->name('admins.purchaseCustomer.deletePurchaseTransaction');
        });

        Route::get('detail/{customer_id}', 'AdminController@detailCustomer')->name('admins.customer.detail');

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

    // products
    Route::group(['prefix' => 'products'], function () {
        // sales
        Route::group(['prefix' => 'sales'], function () {
            Route::get('list', 'AdminController@listSaleProducts')->name('admins.product.sale.list');
            Route::get('create', 'AdminController@createSaleProduct')->name('admins.product.sale.create');
            Route::post('create', 'AdminController@storeSaleProduct')->name('admins.product.sale.store');
            Route::get('{id}/edit', 'AdminController@editSaleProduct')->name('admins.product.sale.edit');
            Route::post('{id}/update', 'AdminController@updateSaleProduct')->name('admins.product.sale.update');
            Route::get('delete', 'AdminController@deleteSaleProduct')->name('admins.product.sale.delete');
            Route::post('action', 'AdminController@actionSaleProduct')->name('admins.product.sale.action');
            Route::get('status', 'AdminController@statusSaleProduct')->name('admins.product.sale.status');
        });
        // sales
        Route::group(['prefix' => 'lease'], function () {
            Route::get('list', 'AdminController@listLeaseProducts')->name('admins.product.lease.list');
            Route::get('create', 'AdminController@createLeaseProduct')->name('admins.product.lease.create');
            Route::post('create', 'AdminController@storeLeaseProduct')->name('admins.product.lease.store');
            Route::get('{id}/edit', 'AdminController@editLeaseProduct')->name('admins.product.lease.edit');
            Route::post('{id}/update', 'AdminController@updateLeaseProduct')->name('admins.product.lease.update');
            Route::get('delete', 'AdminController@deleteLeaseProduct')->name('admins.product.lease.delete');
            Route::post('action', 'AdminController@actionLeaseProduct')->name('admins.product.lease.action');
            Route::get('active', 'AdminController@activeLeaseProduct')->name('admins.product.lease.active');
        });
        Route::get('detail/{product_id}', 'AdminController@detailSaleProduct')->name('admins.product.detail');

    });

    // products
    Route::group(['prefix' => 'assign'], function () {
        Route::get('list', 'AdminController@listAssignTask')->name('admins.assign.list');
        Route::get('create', 'AdminController@createAssignTask')->name('admins.assign.create');
        Route::post('create', 'AdminController@storeAssignTask')->name('admins.assign.store');
        Route::get('delete', 'AdminController@deleteAssignTask')->name('admins.assign.delete');
        Route::post('action', 'AdminController@actionAssignTask')->name('admins.assign.action');
    });

});

Route::group(['prefix' => 'common'], function () {
    // Skill - Admin
        Route::get('listDistrict', 'CommonController@listDistricts')->name('common.district.list');
        Route::get('getItemByDistrict', 'CommonController@getItemByDistrict')->name('common.getItemByDistrict');

});