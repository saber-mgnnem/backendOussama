<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Notifications\NewRéunion;
use App\Notifications\UserFollowNotification;
class AuthController extends Controller
{
    public function register (Request $request){
        $validator = Validator::make($request->all(),[
            'fisrtname'=>'required|max:191',
            'lastname'=>'required|max:191',
            'email'=>'required|email|max:191|unique:users,email',
            'password'=>'required|min:8',
            'role'=>'required|max:191',
            'phone'=>'required|max:191',

          ]);



        if($validator->fails()){
             return response()->json([
                'validator_errors'=>$validator->messages(),
             ]);
        }
        else{
            $user  = new User;
            $user->fisrtname =  $request->input('fisrtname');
            $user->lastname =  $request->input('lastname');
            $user->email =  $request->input('email');
            $user->password =  Hash::make($request->input('password'));
            $user->phone =  $request->input('phone');
            $user->role =  $request->input('role');

            $user->save();

            $token =$user->createToken($user->email.'_token')->plainTextToken;

            return response()->json([
                'status'=>200,
                'auth_USER'=>$user,
                'token'=>$token,
                'message'=>'enregistré avec succès'

            ]);
        }
    }



    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email'=>'required|max:191',
            'password'=>'required',
        ]);


        if($validator->fails()){
            return response()->json([
                'validation_errors'=>$validator->message(),
            ]);
        }
        else{
            $user = User::where('email', $request->email)->first();

            if(! $user || ! Hash::check($request->password, $user->password)){
                return response()->json([
                    'status'>401,
                    'message'=>'Identifiants invalides'
                ]);
            }
            else{

                if($user->role === "Admin"){
                    $token =$user->createToken($user->email.'_AdminToken',['server:admin'])->plainTextToken;

                }
                else if($user->role === "Enseignant"){
                    $token =$user->createToken($user->email.'_EnseignantToken',['server:enseignant'])->plainTextToken;

                }
                else {
                    $token =$user->createToken($user->email.'_EtudiantToken',['server:etudiant'])->plainTextToken;

                }
                return response()->json([
                    'status'=>200,
                    'authUser'=>$user,
                    'auth_role'=>$user->role,
                    'auth_id'=>$user->id,
                    'token'=>$token,
                    'message'=>'connecté avec succès'

                ]);
            }
        }
    }


    public function logout(){
        auth()->user()->tokens()->delete();
        return response()->json([
            'status'=>200,
            'message'=>'déconnecté avec succès'
        ]);
    }

}
