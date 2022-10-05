<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class UsersController extends Controller
{
    public function index()
    {
        return response()->json(User::all(), 200);
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
        // echo "entradno";
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role_id'=>'required'
        ]);
        $data['password'] = bcrypt($request->password);
        $user = User::create($data);
        $token = $user->createToken('API Token')->accessToken;
        return response([ 'user' => $user, 'token' => $token]);
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
