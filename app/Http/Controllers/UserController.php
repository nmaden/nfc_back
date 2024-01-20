<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(UserRequest $request)
    {
        $user = new User();
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('Admin Login Token')->plainTextToken;
            return response()->json(['token' => $token,'role'=>auth()->user()->id], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
    /**
     * Login
     */
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if ( auth()->attempt($data) ) {
            $token = auth()->user()->createToken('Admin Login Token')->plainTextToken;
            return response()->json(['token' => $token,'role'=>auth()->user()->id], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function show() {
        return User::where('id',auth()->user()->id)->first();
    }

    public function update(UserUpdateRequest $request) {
        $user = User::where('id',auth()->user()->id)->first();
        $user->place_work = $request->place_work;
        $user->name = $request->name;
        $user->save();
        return response()->json([
            'message' => __("messages.updated_success")
        ]);
    }

    public function index(User $user) {
        $page = empty(request('per_age')) ? 5 : (int) request('per_age');
        $user = $user::query()->with('role');
        return request('per_age')==-1? $user->paginate():$user->paginate($page);
    }
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'message' => __("messages.updated_success")
        ]);
    }
}
