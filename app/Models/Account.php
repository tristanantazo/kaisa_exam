<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    public function photo()
    {
        return $this->hasMany(Photo::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public static function create($request) {
        try {
            $req = $request->form;
            $acct = new self;
            $acct->first_name = $req['first_name'];
            $acct->last_name = $req['last_name'];
            $acct->save();
            foreach ($req['photos'] as $key => $value) {
                if(!is_null($value)){
                    $img_url = UploadImage($value);
                    Photo::saveDirectory($img_url, $acct->id); 
                }
            }
            User::create($req, $acct->id);
            
            return response()->json($acct, 201);
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public static function updateAccount($req, $user)
    {
        try {
            $req = $req->form;
            $acct = self::find($user);
            if(is_null($acct)) {
                return response()->json(['message' => 'Account Not Found'], 404);
            }
            $acct->first_name = $req['first_name'];
            $acct->last_name = $req['last_name'];
            $acct->save();
            
            // $acct->User->updateUser($req);
            return response()->json($acct, 200);
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
