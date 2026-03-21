<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $incomingFields = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'password_confirmation' => 'required',
            'role' => 'required|in:super_admin,admin,client',
        ]);

        User::create($incomingFields);
        return redirect()->route('users.index')->with('success', 'User created successfully');

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
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);
        $incomingFields = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            // SINCE THIS HAS NOW TRIPPED ME UP TWICE...
            // There is a slightly different syntax here since I'm adding the rule to ignore the
            // $users email if it's unchanged...
            // The original pipe delimited syntax is in the store method above.
            // Since the Rule:: is added it changes to an array syntax.
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($user),
            ],
            'password' => 'nullable|confirmed',
            'role' => 'required|in:super_admin,admin,client',
        ]);

        if (!empty($incomingFields['password'])) {
            // If the password field is filled, the password will be hashed and updated.
            $incomingFields['password'] = bcrypt($incomingFields['password']);
        } else {
            // If the password field is empty, it is dropped from the $incomingFields array and the original password is kept.
            unset($incomingFields['password']);
        }

        $user->update($incomingFields);

        return redirect()->route('users.index')->with('success', 'User updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
