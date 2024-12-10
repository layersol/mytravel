<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        
        return view('backend/profile-update', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
        
        public function update(ProfileUpdateRequest $request): RedirectResponse
       {
            $user = $request->user();
            $old_image=$user->image;

            $user->fill($request->validated());

            if ($user->isDirty('email')) {
                $user->email_verified_at = null;
            }

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $fileName = time() . '.' . $image->getClientOriginalExtension();
                Storage::putFileAs('public/images/users', $image, $fileName);

                // delete old image if exists
                if ($old_image) {
                    Storage::delete('public/images/users/' . $old_image);
                }

                $user->image = $fileName;
            }
              
              $user->save();

             return redirect()->back()->with('success','Profile-updated');
        }


    
}
