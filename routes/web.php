<?php

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


Route::get('/','Frontend\MainController@index');
//Route::get('/{slug}','Frontend\MainController@process');
//sidebar
Route::get('/thong-tin-truong-hoc/{slug}.html','Frontend\MainController@processInfoAllSchool');

// Route::get('/{cat_slug}/{post_slug}-{id}.html', 'Frontend\MainController@processCat')
//     ->where('slug', '[a-zA-Z0-9-_]+')
//     ->where('id', '[0-9]+')
//     ->name('products.show');

Route::get('/{parent_slug}/{childrent_slug}.html', 'Frontend\MainController@process')
    ->where('parent_slug', '[a-zA-Z0-9-_]+')
    ->where('childrent_slug', '[a-zA-Z0-9-_]+');

//Route::get('/tin-tuc-moi-nhat/{slug}','Frontend\MainController@process');
Route::get('/tin-tuc-moi-nhat/{slug}-{id}.html', 'Frontend\MainController@processNews')
    ->where('slug', '[a-zA-Z0-9-_]+') // Bắt buộc phải là chuỗi a-z hoặc A-Z hoặc 0-9 hoặc - hoặc _
    ->where('id', '[0-9]+') // Bắt buộc phải là số 0-9
    ->name('products.show'); // Định danh cho route.

Route::resource('post', 'PostController');
Route::get('about','Frontend\PostController@index');
Route::get('/backend/admin', [ 'as' => 'login', 'uses' => 'Auth\LoginController@getLogin']);

//login ngoài giao diện front end
Route::get('login', [ 'as' => 'login', 'uses' => 'Auth\LoginController@']);
Route::post('login', [ 'as' => 'login', 'uses' => 'Auth\LoginController@postLoginHome']);
Route::get('logout_home', [ 'as' => 'login', 'uses' => 'Auth\LogoutController@getLogoutHome']);

Route::get('register', 'Auth\RegisterController@getRegisterHome');
Route::post('register', 'Auth\RegisterController@postRegisterHome');

Route::get('/{static_page}.html','Frontend\PageController@layouts');

Route::group(['prefix' => 'admin'], function () {
		// Đăng ký thành viên
	Route::get('register', 'Auth\RegisterController@getRegister');
	Route::post('register', 'Auth\RegisterController@postRegister');
	
	// Đăng nhập và xử lý đăng nhập
	Route::get('login', [ 'as' => 'login', 'uses' => 'Auth\LoginController@getLogin']);
	Route::post('login', [ 'as' => 'login', 'uses' => 'Auth\LoginController@postLogin']);
	
	// Đăng xuất
	Route::get('logout', [ 'as' => 'logout', 'uses' => 'Auth\LogoutController@getLogout']);

	Route::get('/', 'Backend\DashboardController@dashboard');
	Route::get('/dashboard', 'Backend\DashboardController@dashboard');
	Route::get('/danh-muc', 'Backend\CategoryController@index');
	Route::get('/danh-muc/them-moi', 'Backend\CategoryController@create');
	Route::post('/danh-muc/luu-thong-tin', 'Backend\CategoryController@store');
	Route::get('/danh-muc/cap-nhat/{id}', 'Backend\CategoryController@edit');
	Route::post('/danh-muc/luu-cap-nhat/{id}', 'Backend\CategoryController@update');
	Route::get('/danh-muc/xoa/{id}', 'Backend\CategoryController@destroy');

	Route::get('/bai-viet', 'Backend\PostController@index');
	Route::get('/bai-viet/them-moi', 'Backend\PostController@create');
	Route::post('/bai-viet/luu-thong-tin', 'Backend\PostController@store');
	Route::get('/bai-viet/cap-nhat/{id}', 'Backend\PostController@edit');
	Route::post('/bai-viet/luu-cap-nhat/{id}', 'Backend\PostController@update');
	Route::get('/bai-viet/xoa/{id}', 'Backend\PostController@destroy');

	Route::get('/video', 'Backend\VideoController@index');
	Route::post('/video/luu-cap-nhat/{id}', 'Backend\VideoController@update');

	Route::get('lien-ket', 'Backend\LinkController@index');
	Route::get('/lien-ket/them-moi', 'Backend\LinkController@create');
	Route::post('/lien-ket/luu-thong-tin', 'Backend\LinkController@store');
	Route::get('/lien-ket/cap-nhat/{id}', 'Backend\LinkController@edit');
	Route::post('/lien-ket/luu-cap-nhat/{id}', 'Backend\LinkController@update');
	Route::get('/lien-ket/xoa/{id}', 'Backend\LinkController@destroy');
	

	Route::get('chat', 'Backend\ChatController@chat');

	Route::post('ckeditor/image_upload', 'CKEditorController@upload')->name('upload');
});


Route::group(['prefix' => 'api'], function () {
	Route::post('send-data-chat', 'Chat\ApiController@sendDataChat');
});
Route::group(['prefix' => 'cart'], function () {
	Route::get('update-cart', 'Frontend\CartController@updateCart'); // update cart khi click button "Thêm giỏ hàng" ngoài trang chủ
	Route::get('info-cart', 'Frontend\CartController@infoCart');
	Route::post('update-table-cart', 'Frontend\CartController@updateTableCart'); // update cart khi click button "Cập nhật giỏ hàng" ở trong cart.html
	
});

Route::group(['prefix' => 'order'], function () {
	Route::post('save-order', 'Frontend\OrderController@saveOrder');

});

