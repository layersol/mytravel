<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasPermissions;
use App\Models\identity;
use App\Models\ContactDetail;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $siteIdentity=identity::all()->toArray();
        $contact=ContactDetail::all()->toArray();

        return view('frontend/auth/register',compact('siteIdentity','contact'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    // public function store(Request $request): RedirectResponse
    // {
    //     $request->validate([
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
    //         'password' => ['required', Rules\Password::defaults()], 
    //     ]);

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //         'status'=>'active'
    //     ]);
    //     $user->assignRole('user');
    //     event(new Registered($user));
    //     return redirect()->back()->with('success','Your account has been created. You may login now.');

    // }
    public function store(Request $request): JsonResponse
    {
        // Validate the request data, including checking termsAndPrivacy
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()], 
            'termsAndPrivacy' => ['required', 'accepted'],
        ]);
    
        // If validation fails, return the error response
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }
    
        // Create a new user
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' =>Hash::make($request->input('password')),
        ]);
        $user->assignRole('user');
        
        // For example, send a verification email or log in the user automatically
        
        return response()->json([
            'message' => 'User registered successfully.',
            'success' => true,
        ]);
    }
}
