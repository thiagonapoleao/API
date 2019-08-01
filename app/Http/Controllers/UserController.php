<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    
    public function allUser(Request $request){
        //selecionar todos os usuarios
        //equivalente a SELECT *FROM USER
        $users = User::select('name')->orderBy('name')->get();
        //transforma o dataset em um objeto json
        return response()->json($users);
    }

    public function getUser(Request $request){
        $hash = User::where('hash', $request->header('API-TOKEN'))->get();
        if( $hash->count() == 1){
          //selecionar todos os usuarios
        //equivalente a SELECT *FROM USER WHERE ID = {ID}
        $user = User::find(abs($request->id));
        return response()->json($user);
        }
        else{
            abort(403, 'Unauthorized action.');
        }      
    }

}
