<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */

    public function __construct()
    {
        $this->middleware(['auth'])->only(['store', 'destroy']);
    }

    public function index()
    {
        $users = User::withTrashed()->paginate(10);
        return view('tables.users', [
            'users' => $users
        ]);
    }

    public function show(User $user)
    {
        return view('users.show', [
            'user' => $user
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'username' => 'required|unique:users,username|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed'
        ]);


        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return back();
    }

//    public function destroy(User $target_user)
//    {
//        $this->authorize('delete', [$target_user, auth()->user()]);
//
//        $target_user->forceDelete();
//
//        return back();
//    }
    public function unpublish(User $target_user)
    {
        $this->authorize('delete', [$target_user, auth()->user()]);

        $target_user->delete();

        return back();
    }

    public function destroy($id)
    {
        $target_user = User::withTrashed()->find($id);
        $this->authorize('delete', $target_user);

        $target_user->forceDelete();

        return back();
    }


//php artisan make:model -m -f to create a model, migration and factory

}
