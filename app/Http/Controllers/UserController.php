<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function list()
    {
        $userq = User::orderBy('created_at', 'desc');
        $users = $userq->paginate(10);

        return response()->json([
            'message' => 'Success',
            'data' => $users
        ]);
    }

    public function userCreate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'location' => 'required|string',
            'age' => 'required|int'
        ]);

        $user = User::create($request->all());

        return response()->json([
            'message' => 'Success',
            'data' => $user
        ]);
    }
}
