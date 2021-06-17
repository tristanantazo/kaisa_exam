<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function create($req, $acct_id)
    {
        $user = new self;
        $user->name = $req['first_name'] . ' ' . $req['last_name'];
        $user->email = $req['email'];
        $user->password = $req['password'];
        $user->account_id = $acct_id;
        $user->save();
    }

    public function updateUser($req)
    {
        $user = self::where('account_id', $this->account_id)->first();
        $user->name = $req['first_name'] . ' ' . $req['last_name'];
        $user->email = $req['email'];
        $user->password = $req['password'];
        $user->save();
    }
}
