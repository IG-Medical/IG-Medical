<?php

Route::get('change-language/{locale}', 'ChangeLanguageController@changeLanguages')->name('change.language');


Route::prefix('uploads')->namespace('Upload')->as('upload.')->group(function () {
    Route::post('image/{dir}', 'UploadFileController@uploadImage')->name('image');
    Route::post('uploadFileOnCrop/{dir}', 'UploadFileController@uploadFileOnCrop')->name('uploadFileOnCrop');
    Route::post('file', 'UploadFileController@uploadFile')->name('file');
    Route::post('multiple-files', 'UploadFileController@multipleUploadFile')->name('multiple_file');
    Route::post('/editor', 'UploadFileController@uploadEditor')->name('editor.upload_editor');
//    Route::post('large-file', 'UploadFileController@uploadLargeFile')->name('large_file');
//    Route::post('stream-file-to-s3', 'UploadFileController@streamUploadFileToS3')->name('stream_s3');
});
Route::get('de/test',function (){
    dd(2);
});
