<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show(){
        $user = Auth::user();
        $profile = $user->profile;

        if(!$profile){
            $profile = new Profile();
            $profile->user_id = $user->id;
            $profile->save();
        }

        return view('profile.index', compact('profile'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $profile = $user->profile;

        if (!$profile) {
            $profile = new Profile();
            $profile->user_id = $user->id;
        }

        // Validate the request data
        $validatedData = $request->validate([
            'bio' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the image validation rules as needed
        ]);

        // Save the validated data to the profile
        $profile->fill($validatedData);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete the old avatar, if exists
            if ($profile->avatar) {
                Storage::delete($profile->avatar);
            }

            // Store the new avatar
            $path = $request->file('avatar')->store('avatars', 'public');
            $profile->avatar = $path;
        }

        $profile->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }

}
