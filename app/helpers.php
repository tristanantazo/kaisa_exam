<?php
use Carbon\Carbon;

function UploadImage($new_image_url){
    if (strpos(strval($new_image_url), 'base64') !== false) {
        $imageData = $new_image_url;
        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
        $filePath = public_path('assets/uploads/'.Carbon::now()->year.'/');
        if (!file_exists($filePath)) {
            mkdir($filePath, 0777, false);;
        }
        Image::make($imageData)->save($filePath.$fileName, 50);         
        $new_image_url = '/assets/uploads/'.Carbon::now()->year.'/'.$fileName;
    }
    return $new_image_url;
}