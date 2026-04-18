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
        // This is the UserPolicy at work...
        // Note to self: check UserPolicy.php for the corresponding methods.
        $this->authorize('viewAny', User::class);
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', User::class);
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', User::class);
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
    public function show(User $user)
    {
        $this->authorize('view', User::class);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $pageTitle = 'Editing User';
        $this->authorize('update', $user);
        return view('users.edit', compact('user'),
            // I'm using this property as a way to determine how a specific element is rendered in the blade template
            // This is also used in the profile method below,
            // but in that case I just hard coded the boolean value to be true.
            //
            // Since the users.edit view is being shared for Super Admins editing anyone's info, and for
            // any user editing their own info, there needs to be an 'isOwnProfile' property for both methods.
            // Since a Super Admin could access their own profile from the users index, they can basically access
            // the users.edit view from two different controller methods, so this property needs to be present but
            // must work dynamically so the page renders appropriately.
            [
                'isOwnProfile' => auth()->id() === $user->id,
                'formAction' => route("users.update", $user),
                'pageTitle' => $pageTitle,

                ]);
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
        $this->authorize('delete', $user);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }


    public function editProfile(){
        $title = 'Editing Profile';

        return view('users.edit', [
            'user' => auth()->user(),
            'isOwnProfile' => true,
            'formAction' => route('profile.update'),
            'title' => $title,
        ]);
    }

    public function updateProfile(Request $request){
        $user = auth()->user();

        $incomingFields = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($user),
            ],
            'password' => 'nullable|confirmed',
        ]);



        if (!empty($incomingFields['password'])) {
            // If the password field is filled, the password will be hashed and updated.
            $incomingFields['password'] = bcrypt($incomingFields['password']);
        } else {
            // If the password field is empty, it is dropped from the $incomingFields array and the original password is kept.
            unset($incomingFields['password']);
        }

        $user->update($incomingFields);

        return redirect()->route('home')->with('success', 'Profile updated successfully');

    }
}
