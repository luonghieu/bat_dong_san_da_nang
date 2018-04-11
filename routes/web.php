<?php
// auth - managements
// Route::group(['middleware' => 'auth', 'prefix' => 'managements'], function () {
Route::group(['prefix' => 'managements'], function () {
    // employees
    Route::group(['prefix' => 'employees'], function () {
        // leader-Admin
        Route::get('leaders/list', 'AdminController@listLeaders')->name('admins.leader.list');
        Route::get('leaders/create', 'AdminController@createLeader')->name('admins.leader.create');
        Route::get('leaders/edit/{id}', 'AdminController@editLeader')->name('admins.leader.edit');
        Route::get('leaders/createOrUpdate/{id}', 'AdminController@createOrUpdateLeader')->name('admins.leader.createOrUpdate');
        Route::get('leaders/delete', 'AdminController@deleteLeader')->name('admins.leader.delete');
        Route::get('leaders/action', 'AdminController@actionLeader')->name('admins.leader.action');
        Route::get('leaders/active', 'AdminController@activeLeader')->name('admins.leader.active');

        // sale-Admin
        Route::get('sales/list', 'AdminController@listSales')->name('admins.sale.list');
        Route::get('sales/create', 'AdminController@createSales')->name('admins.sale.create');
        Route::get('sales/edit/{id}', 'AdminController@editSales')->name('admins.sale.edit');
        Route::get('sales/createOrUpdate/{id}', 'AdminController@createOrUpdateSale')->name('admins.sale.createOrUpdate');
        Route::get('sales/delete', 'AdminController@deleteSale')->name('admins.sale.delete');
        Route::get('sales/active', 'AdminController@activeSale')->name('admins.sale.active');

        Route::get('detail/{employee_id}', 'AdminController@detailEmployee')->name('admins.employee.detail');

    }); 
    // customer
    Route::group(['prefix' => 'customer'], function () {
        // purchase-Admin
        Route::get('list', 'AdminController@listCustomer')->name('admins.customer.list');
        Route::get('delete', 'AdminController@deleteCustomer')->name('admins.customer.delete');
        Route::post('action', 'AdminController@actionCustomer')->name('admins.customer.action');
        Route::get('detail/{customer_id}', 'AdminController@detailTransaction')->name('admins.customer.detail');
        // purchase transaction
        Route::post('actionTransaction', 'AdminController@actionTransaction')->name('admins.customer.actionTransaction');
        Route::post('statusTransaction', 'AdminController@statusTransaction')->name('admins.customer.statusTransaction');
        Route::get('deleteTransaction', 'AdminController@deleteTransaction')->name('admins.customer.deleteTransaction');

        Route::get('detail/{customer_id}', 'AdminController@detailCustomer')->name('admins.customer.detail');

    });

    // post
    Route::group(['prefix' => 'post'], function () {
        Route::group(['prefix' => 'posters'], function () {
            Route::get('list', 'AdminController@listPoster')->name('admins.poster.list');
            Route::get('delete', 'AdminController@deletePoster')->name('admins.poster.delete');
            Route::post('action', 'AdminController@actionPoster')->name('admins.poster.action');
            Route::get('active', 'AdminController@activePoster')->name('admins.poster.active');
            Route::get('detail/{poster_id}', 'AdminController@detailPost')->name('admins.poster.detail');

            Route::get('detail/{poster_id}', 'AdminController@detailPoster')->name('admins.poster.detail');

        });

        Route::group(['prefix' => 'posts'], function () {
            Route::get('list', 'AdminController@listPost')->name('admins.post.list');
            Route::get('delete', 'AdminController@deletePost')->name('admins.post.delete');
            Route::post('action', 'AdminController@actionPost')->name('admins.post.action');
            Route::get('status', 'AdminController@statusPost')->name('admins.post.status');
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
        Route::get('active', 'AdminController@activeNews')->name('admins.news.active');

   });

    // products
    Route::group(['prefix' => 'assign'], function () {
        Route::get('list', 'AdminController@listAssignTask')->name('admins.assign.list');
        Route::get('create', 'AdminController@createAssignTask')->name('admins.assign.create');
        Route::post('create', 'AdminController@storeAssignTask')->name('admins.assign.store');
        Route::get('delete', 'AdminController@deleteAssignTask')->name('admins.assign.delete');
        Route::post('action', 'AdminController@actionAssignTask')->name('admins.assign.action');
    });

    // contact
    Route::group(['prefix' => 'contact'], function () {
        Route::get('list', 'AdminController@listContact')->name('admins.contact.list');
        Route::get('delete', 'AdminController@deleteContact')->name('admins.contact.delete');
        Route::post('active', 'AdminController@activeContact')->name('admins.contact.active');
        Route::post('action', 'AdminController@actionContact')->name('admins.contact.action');
    });

     // introduce
    Route::group(['prefix' => 'introduce'], function () {
        Route::get('list', 'AdminController@listIntroduce')->name('admins.introduce.list');
        Route::get('create', 'AdminController@createIntroduce')->name('admins.introduce.create');
        Route::post('create', 'AdminController@storeIntroduce')->name('admins.introduce.store');
        Route::get('{id}/edit', 'AdminController@editIntroduce')->name('admins.introduce.edit');
        Route::post('{id}/update', 'AdminController@updateIntroduce')->name('admins.introduce.update');
        Route::get('delete', 'AdminController@deleteIntroduce')->name('admins.introduce.delete');
        Route::post('action', 'AdminController@actionIntroduce')->name('admins.introduce.action');
        Route::get('active', 'AdminController@activeIntroduce')->name('admins.introduce.active');
    });

     // schedule
    Route::group(['prefix' => 'schedule'], function () {
        Route::get('list', 'AdminController@listSchedule')->name('admins.schedule.list');
        Route::get('create', 'AdminController@createSchedule')->name('admins.schedule.create');
        Route::post('create', 'AdminController@storeSchedule')->name('admins.schedule.store');
        Route::get('{id}/edit', 'AdminController@editSchedule')->name('admins.schedule.edit');
        Route::post('{id}/update', 'AdminController@updateSchedule')->name('admins.schedule.update');
        Route::get('delete', 'AdminController@deleteSchedule')->name('admins.schedule.delete');
        Route::post('action', 'AdminController@actionSchedule')->name('admins.schedule.action');
        Route::get('active', 'AdminController@activeSchedule')->name('admins.schedule.active');
    });

     // project
    Route::group(['prefix' => 'project'], function () {
        Route::get('list', 'AdminController@listProject')->name('admins.project.list');
        Route::get('create', 'AdminController@createProject')->name('admins.project.create');
        Route::post('create', 'AdminController@storeProject')->name('admins.project.store');
        Route::get('{id}/edit', 'AdminController@editProject')->name('admins.project.edit');
        Route::post('{id}/update', 'AdminController@updateProject')->name('admins.project.update');
        Route::get('delete', 'AdminController@deleteProject')->name('admins.project.delete');
        Route::post('action', 'AdminController@actionProject')->name('admins.project.action');
        Route::get('active', 'AdminController@activeProject')->name('admins.project.active');
    });

});

Route::group(['prefix' => 'common'], function () {
    // Skill - Admin
        Route::get('listDistrict', 'CommonController@listDistricts')->name('common.district.list');
        Route::get('getItemByDistrict', 'CommonController@getItemByDistrict')->name('common.getItemByDistrict');

});