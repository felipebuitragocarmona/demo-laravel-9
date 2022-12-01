<?php

namespace App\Http\Controllers;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller
{
    public function index(){
        return response()->json(Role::all(),200);
    }

    public function show($id){
        $the_Role=Role::find($id);
        if(is_null($the_Role)){
            return response()->json(['message'=>'Not found'],404);
        }else{
            $the_Role->users;
            $the_Role->permissions;
            return response()->json($the_Role,200);
        }
        return $the_Role;
    }
    public function store(Request $request){
        $the_Role=Role::create($request->all());
        return response($the_Role,201);
    }

    public function update(Request $request,$id){
        $the_Role=Role::find($id);
        if(is_null($the_Role)){
            return response()->json(['message'=>'Not found'],404);
        }else{
            $the_Role->update($request->all());
            return response()->json($the_Role::find($id),200);
        }
    }
    public function destroy(Request $request,$id){
        $the_Role=Role::find($id);
        if(is_null($the_Role)){
            return response()->json(['message'=>'Not found'],404);
        }else{
            $the_Role->delete();
            return response()->json(null,204);
        }
    }
    public function count($id){
        $SQLconsulta = "SELECT countRoles($id) as value";
        $consulta = DB::select($SQLconsulta, array());
        return $consulta;
    }
    public function quantitiesByRoles(){
        $SQLconsulta = "call quantity_by_role()";
        $consulta = DB::select($SQLconsulta, array());
        return $consulta;
    }
}
