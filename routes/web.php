 <?php

Route::get('/', 'HomeController@index');
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'admin','middleware'=>['auth']],function () {
    Route::get('/usercreate', 'Auth\RegisterController@showRegistrationForm')->name('usercreate');
    Route::post('/usercreate', 'Auth\RegisterController@register');
    Route::get('/changePassword','Auth\ChangePasswordController@index')->name('password.changee');
    Route::post('/changePassword','Auth\ChangePasswordController@changePassword')->name('password.updatee');
});
Route::group(['prefix'=>'departman','middleware'=>['auth']],function () { 
	Route::resource('departman','departmanController');
	Route::get('/search',['uses' => 'departmanController@search','as' => 'sdepartman']);
});
Route::group(['prefix'=>'firmatipi','middleware'=>['auth']],function () { 
	Route::resource('firmatipi','definition\firmatipiController');
	Route::get('/search',['uses' => 'definition\firmatipiController@search','as' => 'sfirmatipi']);
});
Route::group(['prefix'=>'gorevlistesi','middleware'=>['auth']],function () { 
	Route::resource('gorevlistesi','definition\gorevlistesiController');
	Route::get('/search',['uses' => 'definition\gorevlistesiController@search','as' => 'sgorevlistesi']);
});
Route::group(['prefix'=>'personel','middleware'=>['auth']],function(){
	Route::resource('personel','definition\personelController');
	Route::get('/search',['uses' => 'definition\personelController@search','as' => 'spersonel']);
	Route::get('/{list}',['uses'=>'definition\personelController@list','as'=>'listpersonel']);
});
Route::group(['prefix'=>'firma','middleware'=>['auth']],function(){
	Route::resource('firma','definition\firmaController');
	Route::get('cari/{id}','definition\firmaController@cari')->name('fcari');
	Route::get('create','definition\firmaController@js')->name('firmajs');
	Route::get('city/{id}','definition\firmaController@city')->name('city');
	// Route::get('/search',['uses' => 'definition\firmaController@search','as' => 'sfirma']);
});
Route::group(['prefix'=>'yetkili','middleware'=>['auth']],function(){
	Route::resource('yetkili','definition\yetkiliController');
	Route::get('/search',['uses' => 'definition\yetkiliController@search','as' => 'syetkili']);
});
Route::group(['prefix'=>'ambalajtur','middleware'=>['auth']],function () { 
	Route::resource('ambalajtur','definition\ambalajturController');
	Route::get('/search',['uses' => 'definition\ambalajturController@search','as' => 'sambalajtur']);
});
Route::group(['prefix'=>'paketiciozellik','middleware'=>['auth']],function () { 
	Route::resource('paketiciozellik','definition\paketiciozellikController');
	Route::get('/search',['uses' => 'definition\paketiciozellikController@search','as' => 'spaketiciozellik']);
});
Route::group(['prefix'=>'renk','middleware'=>['auth']],function () { 
	Route::resource('renk','definition\renkController');
	Route::get('/search',['uses' => 'definition\renkController@search','as' => 'srenk']);
});
Route::group(['prefix'=>'urunozellik','middleware'=>['auth']],function () { 
	Route::resource('urunozellik','definition\urunozellikController');
	Route::get('/search',['uses' => 'definition\urunozellikController@search','as' => 'surunozellik']);
});
Route::group(['prefix'=>'urunkategori','middleware'=>['auth']],function () { 
	Route::resource('urunkategori','definition\urunkategoriController');
	Route::get('/search',['uses' => 'definition\urunkategoriController@search','as' => 'surunkategori']);
});
Route::group(['prefix'=>'urunaltkategori','middleware'=>['auth']],function () { 
	Route::resource('urunaltkategori','definition\urunaltkategoriController');
	Route::get('/search',['uses' => 'definition\urunaltkategoriController@search','as' => 'surunaltkategori']);
});
Route::group(['prefix'=>'model','middleware'=>['auth']],function () { 
	Route::resource('model','definition\modelController');
	Route::get('/search',['uses' => 'definition\modelController@search','as' => 'smodel']);
});
Route::group(['prefix'=>'urun','middleware'=>['auth']],function () { 
	Route::resource('urun','definition\urunController');
	Route::get('create','definition\urunController@js')->name('urunjs');
	Route::get('/urunagaci',['uses'=>'definition\urunController@urunagaci','as'=>'urunagaci']);		
	Route::get('/{list?}',['uses'=>'definition\urunController@list','as'=>'listurun']);
	Route::get('/search',['uses' => 'definition\urunController@search','as' => 'surun']);
});
Route::group(['prefix'=>'ebat','middleware'=>['auth']],function () { 
	Route::resource('ebat','definition\ebatController');
	Route::get('/search',['uses' => 'definition\ebatController@search','as' => 'sebat']);
});
Route::group(['prefix'=>'uretim','middleware'=>['auth']],function () { 
	Route::resource('uretim','uretimController');
	Route::get('create','uretimController@js')->name('uretimjs');
	Route::get('create/{id}',['uses'=>'uretimController@create','as'=>'ucreate']);
	Route::get('topluetiket/{id}','uretimController@topluetiket')->name('topluetiket');
	Route::post('etiket','uretimController@etiket')->name('etiket');
	Route::get('delete','uretimController@delete')->name('delete');
	Route::post('etiketsilme','uretimController@etiketsilme')->name('etiketsilme');

	Route::get('uretimbot','uretimController@uretimbot')->name('uretimbot');
	Route::post('uretimbotstore','uretimController@uretimbotstore')->name('uretimbotstore');
});
Route::group(['prefix'=>'firmadetay','middleware'=>['auth']],function () { 
	Route::resource('firmadetay','definition\firmadetayController');
	Route::get('create','definition\firmadetayController@js')->name('firmadetayjs');
	// Route::get('/search',['uses' => 'definition\firmadetayController@search','as' => 'sfirmadetay']);
});
Route::group(['prefix'=>'price','middleware'=>['auth']],function () { 
	Route::resource('price','definition\priceController');
	Route::post('asd','definition\priceController@asd')->name('price');
	Route::get('/search',['uses' => 'definition\priceController@search','as' => 'sprice']);
});
Route::group(['prefix'=>'order','middleware'=>['auth']],function () { 
	Route::resource('order','orderController');
	Route::get('firmadetay/{id}','orderController@fdetay')->name('fdetay');
	Route::get('detay/{id}','orderController@detay')->name('detay');
	Route::get('create','orderController@js')->name('orderjs');
	Route::get('sevkreport/{id}','orderController@sevkreport')->name('sevkreport');

	Route::get('report','orderController@report')->name('report');
	Route::get('reportjs','orderController@reportjs')->name('reportjs');

	Route::get('urunreport','orderController@urunreport')->name('urunreport');
	Route::post('urunreportjs','orderController@urunreportjs')->name('urunreportjs');
	Route::get('urunreport2','orderController@urunreport2')->name('urunreport2');
	Route::post('urunreportjs2','orderController@urunreportjs2')->name('urunreportjs2');	


	Route::get('urunreport3','orderController@urunreport3')->name('urunreport3');
	Route::post('urunreportjs3','orderController@urunreportjs3')->name('urunreportjs3');

	Route::get('kgsevk','orderController@kgsevk')->name('kgsevk');
	Route::get('kgsevkcreate','orderController@kgsevkcreate')->name('kgsevkcreate');
	Route::post('kgsevkstore','orderController@kgsevkstore')->name('kgsevkstore');
	Route::get('kgsevkshow/{id}','orderController@kgsevkshow')->name('kgsevkshow');
	Route::get('proforma/{id}','orderController@proforma')->name('proforma');
});

Route::group(['prefix'=>'quality','middleware'=>['auth']],function () { 
	Route::resource('quality','qualityController');
    Route::get('create','qualityController@js')->name('qualityjs');
	Route::get('qualitydetail/{id}','qualityController@qualitydetail')->name('qualitydetail');
	Route::post('qualitydetailstore','qualityController@qualitydetailstore')->name('qualitydetailstore');
});

Route::group(['prefix'=>'pay','middleware'=>['auth']],function () {
    Route::resource('pay','payController');
    Route::get('create','payController@js')->name('payjs');
    Route::get('createdetail/{id}','payController@createdetail')->name('createdetail');
    Route::post('storedetail','payController@storedetail')->name('storedetail');

    // Route::get('ship/{id}','payController@ship')->name('ship');
    Route::get('hook/{id}','payController@hook')->name('hook');
});
Route::group(['prefix'=>'orderdetail','middleware'=>['auth']],function () { 
	Route::resource('orderdetail','orderdetailController');
	Route::get('/search',['uses' => 'orderdetailController@search','as' => 'sorderdetail']);
	Route::get('/{list}/{id}',['uses'=>'orderdetailController@list','as'=>'listorder']);
});
Route::group(['prefix'=>'store','middleware'=>['auth']],function () { 
	Route::resource('store','storeController');
	Route::get('bitir/{id}','storeController@bitir')->name('urunbitir');
});
Route::group(['prefix'=>'sayim','middleware'=>['auth']],function () {
	Route::resource('sayim','sayimController');
	Route::get('bitir','sayimController@bitir')->name('bitir');
});
Route::group(['prefix'=>'shipping','middleware'=>['auth']],function () { 
	Route::resource('shipping','shippingController');
	Route::get('/search',['uses' => 'shippingController@search','as' => 'sirsaliye']);

	Route::get('create','shippingController@js')->name('shippingjs');
	Route::get('create2','shippingController@kjs')->name('kjs');
	Route::get('kindex','shippingController@kindex')->name('kindex');
	Route::post('destroyqr','shippingController@destroyqr')->name('destroyqr');
	Route::post('koli','shippingController@koli')->name('koli');
	Route::post('irsaliyeno','shippingController@irsaliyeno')->name('irsaliyeno');
	Route::post('orderstatus','shippingController@orderstatus')->name('orderstatus');
	Route::post('oldorder','shippingController@oldorder')->name('oldorder');
	Route::get('sevkbitir/{id}','shippingController@sevkbitir')->name('sevkbitir');
	Route::get('ship','shippingController@ship')->name('ship');
	Route::get('shipjs','shippingController@shipjs')->name('shipjs');
	Route::get('shipfis/{id}','shippingController@shipfis')->name('shipfis');
	Route::get('fis/{id}','shippingController@fis')->name('fis');
	Route::get('shipirsaliye/{id}','shippingController@shipirsaliye')->name('shipirsaliye');
});
Route::group(['prefix'=>'bot','middleware'=>['auth']],function () {
    Route::resource('bot','botController');
    Route::get('create','botController@js')->name('botjs');
	Route::get('create2/{id}','botController@create2')->name('create2');
	Route::get('sticker/{id}','botController@sticker')->name('botsticker');
	Route::post('store2','botController@store2')->name('botdetail.store');
	Route::post('botdetaildestroy','botController@botdetaildestroy')->name('botdetaildestroy');
});
Route::group(['prefix'=>'current','middleware'=>['auth']],function(){
	Route::resource('current','currentController');
	Route::post('back','currentController@back')->name('back');
});