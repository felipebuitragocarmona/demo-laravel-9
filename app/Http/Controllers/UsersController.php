<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(){
        return response()->json(User::all(),200);
    }

    public function show($id){
        $the_User=User::find($id);
        if(is_null($the_User)){
            return response()->json(['message'=>'Not found'],404);
        }else{
            $the_User->profile;
            $the_User->role;
            return response()->json($the_User,200);
        }
        return $the_User;
    }
    public function store(Request $request){
        $the_User=User::create($request->all());
        return response($the_User,201);
    }

    public function update(Request $request,$id){
        $the_User=User::find($id);
        if(is_null($the_User)){
            return response()->json(['message'=>'Not found'],404);
        }else{
            $the_User->update($request->all());
            return response()->json($the_User::find($id),200);
        }
    }
    public function destroy(Request $request,$id){
        $the_User=User::find($id);
        if(is_null($the_User)){
            return response()->json(['message'=>'Not found'],404);
        }else{
            $the_User->delete();
            return response()->json(null,204);
        }
    }
}
