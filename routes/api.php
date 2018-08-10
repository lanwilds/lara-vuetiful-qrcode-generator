<?php

use Illuminate\Http\Request;
$QRCodeReader = new Libern\QRCodeReader\QRCodeReader();
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/


Route::post('qr-code.png', function (Request $request) {
	sleep(0.5);
	switch ($request->option) {
		case 'Text':
			QRCode::text($request->dataText)->png();
			break;
		case 'URL':
			QRCode::url($request->dataText)->png();
			break;
		default:
			abort(401);
			break;
	}
   	    
});
Route::post('decode/qr-code', function (Request $request) use ($QRCodeReader){
	$fileName = uniqid().'.'.$request->image->extension();
	$request->file('image')->move(public_path() . '/uploads/', $fileName);
	$qrcode_text = $QRCodeReader->decode(public_path().'/uploads/'.$fileName);
	return response()->json([
		'data' => $qrcode_text
	]);   
});
