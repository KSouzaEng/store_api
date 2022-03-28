<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserController extends Controller
{
    public function register(UserRequest $request){

      try{
        $input = $request->validated();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make($input['password']),
            'remember_token' => Str::random(10),
        ]);

        if(!$user){
            return response()->json(['error' => 'Não foi possível registrar os usuario'], 400);
          }else{

                return response()->json(['sucssess' =>  $user], 200);

          }

      }catch(Exception $e){
          return response()->json(['error' => $e]);
      }

    }
    public function update(UserRequest $request,$id){

        // return response()->json(['sucssess' =>  $id], 200);
        try {
            $input = $request->validated();

           $user = User::where('id',$id)->update([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make($input['password']),
            'remember_token' => Str::random(10),
           ]);

          if(!$user){
            return response()->json(['error' => 'Não foi possível atualizar os dados do usuario'], 400);
          }else{
            return response()->json(['sucssess' =>  $user], 200);
          }
        } catch (\Throwable $th) {
            return response()->json(['error' => $e]);
        }
    }
    public function destroy($id){
        try {

            $user = User::where('id','=',$id);

            $user->delete();

            if(!$user){

                 return response()->json(['error' => 'Não foi possível deletar o usuario'], 400);

            }else{
                return response()->json(['sucssess' =>  $user], 200);

            }


        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['error' => $e->errorInfo], 500);
        }
            // $rel
    }
}
