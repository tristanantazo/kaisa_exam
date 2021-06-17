<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    public static function saveDirectory($data, $account_id){
        $photo = new self;
        $photo->directory = $data;
        $photo->account_id = $account_id;
        $photo->save();
    }
}
