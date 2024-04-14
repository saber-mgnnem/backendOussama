<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attribution;
use App\Models\InscriptionEnseignant;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function getEnseignantParEleve($identifiant){
        $role = "Eleves";
        $fils = User::where("role",$role)->where("identifiant_user",$identifiant)->first();
        $Attribution = Attribution::where('student_id',$fils->id)->first();
        $inscrireEnseignant = InscriptionEnseignant::with([
            'enseignant' => function ($query) {
                $query->select('id', 'name',);
            }
        ])->where('classe_id',$Attribution->classe_id)->get();
        return response()->json([
         'status'=>200,
         'enseignant'=>$inscrireEnseignant


        ]);
    }
    public function index(){
        $enseignant= User::where('role','Enseignant')->get();
        $etudiant= User::where('role','Etudiant')->get();
        $admin= User::where('role','Admin')->get();

        return response()->json([
         'status'=>200,
         'enseignant'=>$enseignant,
         'etudiant'=>$etudiant,
         'admin'=>$admin,


        ]);
    }
    public function getuser($id){
        $user =  User::find($id);

        return response()->json([
         'status'=>200,
         'user'=>$user,

        ]);
    }


    public function  destroy($id){
        $user =  User::find($id);
        if($user){
            $user->delete();
            return response()->json([
                'status'=>200,
                'message'=>'user supprimé avec succès'
            ]);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>' Aucun user trouvé'
            ]);
        }


    }

    public function update (Request $request , $id ){
        $validator = Validator::make($request->all(),[
            'name' => 'string|required',
            'email' => 'string|required',
            'phone' => 'string|required',


          ]);
          if($validator->fails()){
            return response()->json([
               'validator_errors'=>$validator->messages(),
            ]);
       }

       else{
        $user =  user::find($id);
        if(  $user ){
            $user->name = $request->input('name');
            $user->phone = $request->input('phone');
            $user->email = $request->input('email');
            $user->city = $request->input('city');
            $user->address = $request->input('address');
            $user->country = $request->input('country');

            if ($request->hasFile('file')){
                $path = $user->image;
                if(File::exists($path)){
                    File::delete($path);
                }
                $file = $request->file('file');
                $extension = $file->getClientOriginalExtension();
                $fileName = time().'.'.$extension;
                $file->move('uploads/profile/',$fileName);
                $user->image =$fileName;
             }

            $user->update();
            return response()->json([
                'status'=>200,
                'message'=>'Profile Modifier  avec succès'

            ]);

        }
        else {
            return response()->json([
                'status'=>404,
                'message'=>"utilisateur n'exciste pas"

            ]);        }

    } }
}
