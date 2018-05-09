<?php
// auth - managements
// Route::group(['middleware' => 'auth', 'prefix' => 'managements'], function () {
Route::group(['prefix' => 'managements'], function () {
    //profile
    Route::get('profile', 'AdminController@profile')->name('admins.profile');
    Route::post('profile', 'AdminController@updateProfile')->name('admins.profile.update');
    // employees
    Route::group(['prefix' => 'employees'], function () {
        // leader-Admin
        Route::get('leaders/list', 'AdminController@listLeaders')->name('admins.leader.list');

        Route::get('leaders/create', 'AdminController@createLeader')->name('admins.leader.create');
        Route::post('leaders/create', 'AdminController@storeLeader')->name('admins.leader.store');
        Route::get('leaders/{id}/edit', 'AdminController@editLeader')->name('admins.leader.edit');
        Route::post('leaders/{id}/update', 'AdminController@updateLeader')->name('admins.leader.update');

        Route::get('leaders/delete', 'AdminController@deleteLeader')->name('admins.leader.delete');
        Route::post('leaders/action', 'AdminController@actionLeader')->name('admins.leader.action');
        Route::get('leaders/active', 'AdminController@activeLeader')->name('admins.leader.active');

        // sale-Admin
        Route::get('sales/list', 'AdminController@listSales')->name('admins.sale.list');
        Route::get('sales/create', 'AdminController@createSale')->name('admins.sale.create');
        Route::post('sales/create', 'AdminController@storeSale')->name('admins.sale.store');
        Route::get('sales/{id}/edit', 'AdminController@editSale')->name('admins.sale.edit');
        Route::post('sales/{id}/update', 'AdminController@updateSale')->name('admins.sale.update');
        Route::get('sales/delete', 'AdminController@deleteSale')->name('admins.sale.delete');
        Route::post('sales/action', 'AdminController@actionSale')->name('admins.sale.action');
        Route::get('sales/active', 'AdminController@activeSale')->name('admins.sale.active');

        Route::get('detail/{employee_id}', 'AdminController@detailEmployee')->name('admins.employee.detail');

    }); 
    // customer
    Route::group(['prefix' => 'customer'], function () {
        // purchase-Admin
        Route::get('list', 'AdminController@listCustomer')->name('admins.customer.list');
        Route::get('delete', 'AdminController@deleteCustomer')->name('admins.customer.delete');
        Route::post('action', 'AdminController@actionCustomer')->name('admins.customer.action');

        // detail customer
        Route::get('detail/{customer_id}', 'AdminController@detailCustomer')->name('admins.customer.detail');
        Route::get('store/detail', 'AdminController@storeDetailCustomer')->name('admins.customer.storeDetail');
        Route::get('update/detail', 'AdminController@updateDetailCustomer')->name('admins.customer.updateDetail');
        Route::get('get/detail', 'AdminController@getDetailCustomer')->name('admins.customer.getDetail');
        Route::get('delete/detail', 'AdminController@deleteDetailCustomer')->name('admins.customer.deleteDetail');
        Route::post('action/detail', 'AdminController@actionDetailCustomer')->name('admins.customer.actionDetail');

        // register
        Route::get('register/store', 'AdminController@storeRegister')->name('admins.customer.storeRegister');
        Route::get('register/add', 'AdminController@addRegister')->name('admins.customer.addRegister');
        Route::post('register/storeAll', 'AdminController@storeAllRegister')->name('admins.customer.storeAllRegister');
        Route::get('register/remove', 'AdminController@removeRegister')->name('admins.customer.removeRegister');
        Route::get('register/get', 'AdminController@getRegister')->name('admins.customer.getRegister');

        // transaction
        Route::get('{registerId}/transaction', 'AdminController@detailTransaction')->name('admins.customer.detailTransaction');
        Route::get('transaction/create/{registerId}', 'AdminController@createTransaction')->name('admins.customer.createTransaction');
        Route::post('transaction/create', 'AdminController@storeTransaction')->name('admins.customer.storeTransaction');
        Route::get('transaction/edit/{transactionId}', 'AdminController@editTransaction')->name('admins.customer.editTransaction');
        Route::post('transaction/update', 'AdminController@updateTransaction')->name('admins.customer.updateTransaction');
        Route::get('transaction/getFloorByProduct', 'AdminController@getFloorByProduct')->name('admins.customer.getFloorByProduct');
        Route::post('actionTransaction', 'AdminController@actionTransaction')->name('admins.customer.actionTransaction');
        Route::get('statusTransaction', 'AdminController@statusTransaction')->name('admins.customer.statusTransaction');
        Route::post('ratingTransaction', 'AdminController@ratingTransaction')->name('admins.customer.ratingTransaction');
        Route::get('deleteTransaction', 'AdminController@deleteTransaction')->name('admins.customer.deleteTransaction');

        

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
            Route::get('listPostByPoster/{id}', 'AdminController@listPostByPoster')->name('admins.post.listByPoster');
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
        Route::get('detail/{id}', 'AdminController@detailProject')->name('admins.project.detail');
        Route::get('create', 'AdminController@createProject')->name('admins.project.create');
        Route::post('create', 'AdminController@storeProject')->name('admins.project.store');
        Route::get('{id}/edit', 'AdminController@editProject')->name('admins.project.edit');
        Route::post('{id}/update', 'AdminController@updateProject')->name('admins.project.update');
        Route::get('delete', 'AdminController@deleteProject')->name('admins.project.delete');
        Route::post('action', 'AdminController@actionProject')->name('admins.project.action');
        Route::get('active', 'AdminController@activeProject')->name('admins.project.active');
        Route::get('status/{id}', 'AdminController@statusProject')->name('admins.project.status');
        Route::get('getFloorByBlock', 'AdminController@getFloorByBlock')->name('admins.project.getFloorByBlock');
        Route::get('search', 'AdminController@searchTransaction')->name('admins.project.searchTransaction');
        Route::get('statusProject', 'AdminController@changeStatusProject')->name('admins.project.statusProject');
    });

     // product
    Route::group(['prefix' => 'product'], function () {
        Route::get('list', 'AdminController@listProduct')->name('admins.product.list');
        Route::get('detail/{id}', 'AdminController@detailProduct')->name('admins.product.detail');
        Route::get('create/{projectId}', 'AdminController@createProduct')->name('admins.product.create');
        Route::get('create', 'AdminController@storeProduct')->name('admins.product.store');
        Route::post('update', 'AdminController@updateProduct')->name('admins.product.update');
        Route::get('delete', 'AdminController@deleteProduct')->name('admins.product.delete');
    });

     // slider
    Route::group(['prefix' => 'slider'], function () {
        // post-Admin
        Route::get('list', 'AdminController@listSlider')->name('admins.slider.list');
        Route::get('create', 'AdminController@createSlider')->name('admins.slider.create');
        Route::post('create', 'AdminController@storeSlider')->name('admins.slider.store');
        Route::get('{id}/edit', 'AdminController@editSlider')->name('admins.slider.edit');
        Route::post('{id}/update', 'AdminController@updateSlider')->name('admins.slider.update');
        Route::get('delete', 'AdminController@deleteSlider')->name('admins.slider.delete');
        Route::post('action', 'AdminController@actionSlider')->name('admins.slider.action');
        Route::get('active', 'AdminController@activeSlider')->name('admins.slider.active');

    });

    // announcement
    Route::group(['prefix' => 'announcement'], function () {
        // post-Admin
        Route::get('list', 'AdminController@listAnnouncement')->name('admins.announcement.list');
        Route::get('create', 'AdminController@createAnnouncement')->name('admins.announcement.create');
        Route::post('create', 'AdminController@storeAnnouncement')->name('admins.announcement.store');
        Route::get('{id}/edit', 'AdminController@editAnnouncement')->name('admins.announcement.edit');
        Route::post('{id}/update', 'AdminController@updateAnnouncement')->name('admins.announcement.update');
        Route::get('delete', 'AdminController@deleteAnnouncement')->name('admins.announcement.delete');
        Route::post('action', 'AdminController@actionAnnouncement')->name('admins.announcement.action');
        Route::get('active', 'AdminController@activeAnnouncement')->name('admins.announcement.active');
    });

     // notification
    Route::group(['prefix' => 'consult'], function () {
        // post-Admin
        Route::get('list', 'AdminController@listConsult')->name('admins.consult.list');
        Route::get('save/{id}', 'AdminController@saveConsult')->name('admins.consult.save');
        Route::get('delete', 'AdminController@deleteConsult')->name('admins.consult.delete');
        Route::post('action', 'AdminController@actionConsult')->name('admins.consult.action');
    });

    // notification
    Route::group(['prefix' => 'notification'], function () {
        // post-Admin
        Route::get('list', 'NotificationScheduleController@listNotification')->name('admins.notification.list');
        Route::get('create/{type}', 'NotificationScheduleController@createNotification')->name('admins.notification.create');
        Route::post('create', 'NotificationScheduleController@storeNotification')->name('admins.notification.store');
        Route::get('{id}/edit', 'NotificationScheduleController@editNotification')->name('admins.notification.edit');
        Route::post('{id}/update', 'NotificationScheduleController@updateNotification')->name('admins.notification.update');
        Route::get('delete', 'NotificationScheduleController@deleteNotification')->name('admins.notification.delete');
        Route::post('action', 'NotificationScheduleController@actionNotification')->name('admins.notification.action');
        Route::post('status', 'NotificationScheduleController@statusNotification')->name('admins.notification.status');
    });

});

Route::group(['prefix' => 'common'], function () {
    // Skill - Admin
    Route::get('listDistrict', 'CommonController@listDistricts')->name('common.district.list');
    Route::get('getItemByDistrict', 'CommonController@getItemByDistrict')->name('common.getItemByDistrict');

    Route::get('getLoaiNhaDat', 'CommonController@getLoaiNhaDat')->name('common.getLoaiNhaDat');
    Route::get('getCustomerByUserLogin', 'CommonController@getCustomerByUserLogin')->name('common.getCustomerByUserLogin');
    Route::get('getSaleSearch', 'CommonController@getSaleSearch')->name('common.getSaleSearch');
    Route::get('getLeaseSearch', 'CommonController@getLeaseSearch')->name('common.getLeaseSearch');

});

    // Login
    Route::group(['namespace' =>'Auth'],function(){
    
    Route::get('login', 'AuthController@login')->name('auth.login');
    Route::post('login', 'AuthController@postLogin')->name('auth.login');
    Route::get('logout', 'AuthController@logout')->name('auth.logout');

        
});


// =====================public=========================
Route::group(['prefix' => 'batdongsan'], function () {
    // index
    Route::get('', 'PublicController@index')->name('public.trangchu');

    Route::get('gioithieu', 'PublicController@gioithieu')->name('public.gioithieu');

    Route::get('duan', 'PublicController@duan')->name('public.duan');
    Route::get('chitietduan/{id}', 'PublicController@chitietduan')->name('public.chitietduan');

    Route::get('sangiaodich/type/{type}', 'PublicController@sangiaodich')->name('public.sangiaodich');
    Route::get('sangiaodich/type/{type}/{id}', 'PublicController@sangiaodichtheloai')->name('public.sangiaodich.theloai');
    Route::get('chitietsanbatdongsan/{id}', 'PublicController@chitietsanbatdongsan')->name('public.chitietsanbatdongsan');

    Route::get('lienhe', 'PublicController@lienhe')->name('public.lienhe');
    Route::post('lienhe', 'PublicController@taolienhe')->name('public.taolienhe');

    Route::get('tintuc', 'PublicController@listtintuc')->name('public.tintuc.list');
    Route::get('tintuc/{catId}', 'PublicController@tintuc')->name('public.tintuc');
    Route::get('chitiettintuc/{id}', 'PublicController@chitiettintuc')->name('public.chitiettintuc');

    Route::get('dangtin', 'PublicController@dangtin')->name('public.dangtin');
    Route::post('taotin', 'PublicController@taotin')->name('public.taotin');

    Route::get('dangnhap', 'PublicController@dangnhap')->name('public.dangnhap');
    Route::post('dangnhap', 'PublicController@xulydangnhap')->name('public.dangnhap');

    Route::get('dangky', 'PublicController@dangky')->name('public.dangky');
    Route::post('dangky', 'PublicController@postdangky')->name('public.postdangky');

    Route::get('trangcanhan', 'PublicController@trangcanhan')->name('public.trangcanhan');
    Route::get('chitiettuvan/{idPost}', 'PublicController@chitiettuvan')->name('public.trangcanhan.chitiettuvan');
    Route::get('thaydoithongtincanhan', 'PublicController@thaydoithongtincanhan')->name('public.trangcanhan.thaydoithongtincanhan');
    Route::post('postthaydoithongtincanhan', 'PublicController@postthaydoithongtincanhan')->name('public.trangcanhan.postthaydoithongtincanhan');
    Route::get('thaydoimatkhau', 'PublicController@thaydoimatkhau')->name('public.trangcanhan.thaydoimatkhau');
    Route::post('postthaydoimatkhau', 'PublicController@postthaydoimatkhau')->name('public.trangcanhan.postthaydoimatkhau');
    Route::get('dangxuat', 'PublicController@dangxuat')->name('public.trangcanhan.dangxuat');

    Route::get('tuvan', 'PublicController@tuvan')->name('public.tuvan');
    Route::get('tuvanduan', 'PublicController@tuvanduan')->name('public.tuvanduan');
    Route::post('dangkyduan', 'PublicController@dangkyduan')->name('public.dangkyduan');
    Route::get('timkiem', 'PublicController@timkiem')->name('public.timkiem');
    Route::post('posttimkiem', 'PublicController@posttimkiem')->name('public.posttimkiem');


        //=======ajax==========

// Route::group(['prefix' => 'notification_schedules', 'as' => 'notification_schedules.'], function () {

//             Route::get('/', ['as' => 'index', 'uses' => 'NotificationScheduleController@index']);
//             Route::get('/create', ['as' => 'create', 'uses' => 'NotificationScheduleController@create']);
//             Route::post('/{notificationSchedule}/confirm', ['as' => 'confirm', 'uses' => 'NotificationScheduleController@confirmNotificationSchedule'])
//                 ->where('notificationSchedule', '[0-9]+');
//             Route::post('/confirm_create', ['as' => 'confirm_create', 'uses' => 'NotificationScheduleController@confirmCreateNotificationSchedule']);
//             Route::post('/create_draft_notification_schedule', ['as' => 'create_draft', 'uses' => 'NotificationScheduleController@createDraftNotificationSchedules']);
//             Route::post('/create_notification_schedule', ['as' => 'create_notification_schedule', 'uses' => 'NotificationScheduleController@createNotification']);
//             Route::get('/{notificationSchedule}', ['as' => 'show', 'uses' => 'NotificationScheduleController@show'])
//                 ->where('notificationSchedule', '[0-9]+');
//             Route::post('/{id}/destroy', ['as' => 'destroy', 'uses' => 'NotificationScheduleController@destroy'])
//                 ->where('id', '[0-9]+');
//             Route::get('/{notificationSchedule}/edit', ['as' => 'edit', 'uses' => 'NotificationScheduleController@edit'])
//                 ->where('notificationSchedule', '[0-9]+');
//             Route::post('/{notificationSchedule}/draft', ['as' => 'draft', 'uses' => 'NotificationScheduleController@draftNotificationSchedules'])
//                 ->where('notificationSchedule', '[0-9]+');
//             Route::post('/{notificationSchedule}/update', ['as' => 'update', 'uses' => 'NotificationScheduleController@updateNotificationSchedules'])
//                 ->where('notificationSchedule', '[0-9]+');
//         });
});