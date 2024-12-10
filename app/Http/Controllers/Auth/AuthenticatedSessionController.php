<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use App\Models\identity;
use App\Models\ContactDetail;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        $siteIdentity=identity::all()->toArray();
        $contact=ContactDetail::all()->toArray();

        return view('frontend/auth/login',compact('siteIdentity','contact'));
    }

    /**
     * Handle an incoming authentication request.
     */
    // public function store(LoginRequest $request): RedirectResponse
    // {
        
    //     $request->authenticate();
    //     if(Auth::user()->status==='inactive'){
    //        Auth::guard('web')->logout();
            
    //       return redirect('login')->with('error','It seems your account status is blocked');

    //     }
    //     $request->session()->regenerate();

    //     return redirect('/dashboard');
    // }


    /**
     * Destroy an authenticated session.
     */
    public function store(Request $request): JsonResponse
    {
        // Validate the request data, including checking affiliate code
        $validator = Validator::make($request->all(), [
          
            'email' => ['required', 'string', 'email'],
            'password' => ['required','string'],
            
        ]);
        // If validation fails, return the error response
        if ($validator->fails()) {
            return response()->json(['success'=>false,'errors' => $validator->errors()], 422);
        }
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {

            return response()->json(['success'=>false,'message' =>'The provided credentials are incorrect.']);

        }

        $user = Auth::user();
        
        if ($user->status === 'inactive') {
            Auth::guard('web')->logout();
            return response()->json(['success'=>false,'message' =>'It seems your account status is blocked.'], 401);
        }

        return response()->json([
            'message' => 'Logged in successfully.',
            'success' => true,
        ]);
    }
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
