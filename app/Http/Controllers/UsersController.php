<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

use App\Exports\UsersExport;
use App\Exports\UsersExportBlade;
use Maatwebsite\Excel\Facades\Excel;

class UsersController extends Controller
{
    public function index()
    {
        return response()->json(User::all(), 200);
    }
    // public function exportAllUsers(){
    //     return Excel::download(new UsersExport, 'users.xlsx');
    // }

    public function exportAllUsers(){
        return Excel::download(new UsersExportBlade, 'users.xlsx');
    }
    public function exportAllUsersPDF(){
        return (new UsersExportBlade)->download('users.pdf',\Maatwebsite\Excel\Excel::DOMPDF);
    }

    public function show($id)
    {
        $the_User = User::find($id);
        if (is_null($the_User)) {
            return response()->json(['message' => 'Not found'], 404);
        } else {
            $the_User->profile;
            $the_User->role;
            return response()->json($the_User, 200);
        }
    }
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'role_id' => 'required'
            ]);
            $data['password'] = bcrypt($request->password);
            $user = User::create($data);
            $token = $user->createToken('API Token')->accessToken;
            return response(['user' => $user, 'token' => $token]);
        } catch (Exception $e) {
            return response(['data' => "Data incomplete "],400);
        }
    }


    public function update(Request $request, $id)
    {
        $the_User = User::find($id);
        if (is_null($the_User)) {
            return response()->json(['message' => 'Not found'], 404);
        } else {
            $the_User->update($request->all());
            return response()->json($the_User::find($id), 200);
        }
    }
    public function destroy(Request $request, $id)
    {
        $the_User = User::find($id);
        if (is_null($the_User)) {
            return response()->json(['message' => 'Not found'], 404);
        } else {
            $the_User->delete();
            return response()->json(null, 204);
        }
    }
    
}
