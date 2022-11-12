<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function index()
    {
        return response()->json(Profile::all(), 200);
    }

    public function show($id)
    {
        $the_Profile = Profile::find($id);
        if (is_null($the_Profile)) {
            return response()->json(['message' => 'Not found'], 404);
        } else {
            return response()->json($the_Profile, 200);
        }
        return $the_Profile;
    }
    public function store(Request $request)
    {
        $url_image = $request->file('avatar')->store('public');
        error_log('url_image>' . $url_image);
        $the_Profile = Profile::where('user_id', '=', $request->user_id)->first();
        if (is_null($the_Profile)) {
            $the_Profile = Profile::create($request->all());
            return response($the_Profile, 201);
        } else {
            return response()->json(['message' => 'El usuario ya tiene un perfil'], 400);
        }
    }

    public function update(Request $request, $id)
    {
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename = $id."-".time() . '.' . $extension;
        $url=$file->move('avatars', $filename);
        
        $the_Profile = Profile::where('id', '=', $id)
            ->where('user_id', '=', $request->user_id)
            ->first();
        if (is_null($the_Profile)) {
            return response()->json(['message' => 'Not found'], 404);
        } else {
            $the_Profile->update($request->all());
            return response()->json($the_Profile::find($id), 200);
        }
    }
    public function destroy(Request $request, $id)
    {
        $the_Profile = Profile::find($id);
        if (is_null($the_Profile)) {
            return response()->json(['message' => 'Not found'], 404);
        } else {
            $the_Profile->delete();
            return response()->json(null, 204);
        }
    }
}
