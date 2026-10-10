<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        return view('admin.users.index', ['users' => User::latest()->paginate(15)]);
    }

    public function store(StoreUserRequest $request){
        User::create([
            ...$request->validated(),
            'password' => Hash::make($request->password),
            'status'   => 'approved', 
        ]);
        return redirect()->route('admin.users.index');
    }

    public function pending(){
        return view('admin.users.pending', [
            'users' => User::where('status', 'pending')->latest()->get(),
        ]);
    }

    public function approve(User $user){
        $user->update(['status' => 'approved']);
        return back()->with('status', "Akun {$user->name} disetujui.");
    }

    public function reject(User $user){
        $user->update(['status' => 'rejected']);
        return back()->with('status', "Akun {$user->name} ditolak.");
    }
}
