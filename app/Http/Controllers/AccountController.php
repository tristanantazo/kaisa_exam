<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Account;

class AccountController extends Controller
{
    /**
        * Display a listing of the resource.
        *
        * @return Response
        */
        public function getAll()
        {
            return Account::with('user', 'photo')->get();
        }
    
        /**
            * Store a newly created Account.
            *
            * @return Response
            */
        public function store(Request $request)
        {
            $validated = Validator::make($request->all(), [
                'form.first_name' => 'required|max:50',
                'form.last_name' => 'required|max:50',
                'form.email' => 'required|max:50',
                'form.password' => 'required|max:6',
            ]);
            if($validated->fails()){
                return $validated->errors();
            }else{
                /* 
                    this will store the new account
                    inside the new account it will create the user data
                 */
                $return = Account::create($request);
                return $return;
            }
        }
    
        /**
            * Display the specified data.
            *
            * @param  int  $id
            * @return Response
            */
        public function show($id)
        {
            $acct = Account::with('user', 'photo')->find($id);
            if(is_null($acct)){
                return response()->json(['message' => 'Data Not Found'], 404);
            }else{
                return response()->json($acct, 200);
            }
        }
    
        /**
            * Update the specified data.
            *
            * @param  int  $id
            * @return Response
            */
        public function update(Request $request, $user)
        {
            $validated = Validator::make($request->all(), [
                'form.first_name' => 'required|max:50',
                'form.last_name' => 'required|max:50',
            ]);
            if($validated->fails()){
                return $validated->errors();
            }else{
                $return = Account::updateAccount($request, $user);
                return $return;
            }
        }
    
        /**
            * Remove the specified data from storage.
            *
            * @param  int  $id
            * @return Response
            */
        public function destroy($id)
        {
            $data = Account::find($id);
            if(is_null($data)) {
                return response()->json(['message' => 'Data Not Found'], 404);
            }
            $data->delete();
            return response()->json(['message' => 'Data Deleted'], 204);
        }
}
