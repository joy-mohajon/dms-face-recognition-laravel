<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::where('id', '!=', Auth::id())->orderBy('id', 'DESC')->paginate(10);

        return view('pages.user.index', compact('users'))
        ->with('i', ($request->input('page', 1) - 1) * 10);
        /*
            ->with('i', ($request->input('page', 1) - 1) * 10): This sets a variable $i in the view, which represents the index of the first item on the current page. It calculates the index based on the current page number ($request->input('page', 1)) and offsets the index by 10 (assuming there are 10 users per page). This is useful for displaying sequential numbers in the view, often used in conjunction with pagination.
        */
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::latest()->get();
        return view('pages.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:80',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4|confirmed',
            'password_confirmation' => 'required',
            'role' => 'required',
        ]);
// return $request->toArray();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => hash::make($request->password),
            ]);

            $user->assignRole($request->role);

            session()->flash('success', 'User created successfully');
            return redirect()->route('users.index');
        }catch(\Exception $e){
            return redirect()->route('users.index')->with('error', 'Something went wrong!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::latest()->get();
        $data = $user->roles()->pluck('id')->toArray();
        return  view('pages.user.edit', compact(['user', 'roles', 'data']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // return $request->toArray();
        $request->validate([
            'name' => 'required',
            'email' => "required|email|unique:users,email,$user->id",
            'password' => 'nullable|sometimes|min:6|confirmed',
            'role' => 'required',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $user->syncRoles($request->role);

        if($request->has('password')){
            $user->update(['password' => Hash::make('password')]);
        }

        session()->flash('success', 'User updated successfully');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        // session()->flash('success', 'Rule Successfully Deleted');
        return response()->json(['success' => true, 'status'=> 'User has been deleted.']);
    }
}
