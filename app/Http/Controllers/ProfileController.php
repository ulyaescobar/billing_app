<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function showForm()
    {
        // Ambil profil pengguna terkait
        $profile = Profile::where('user_id', Auth::user()->id)->first();

        return view('profile.index', compact('profile'));
    }

    public function saveProfile(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email|max:255',
            'bio' => 'nullable|string',
            'address' => 'nullable|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Simpan data profil ke dalam database
        $user = Auth::user();
        $profile = $user->profile ?: new Profile();
        $profile->user_id = $user->id;
        $profile->bio = $request->input('bio');
        $profile->address = $request->input('address');

        if ($request->hasFile('avatar')) {
            // Jika ada file avatar yang diunggah, simpan ke dalam storage
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $profile->avatar = $avatarPath;
        }

        $profile->save();

        return redirect()->route('profile.show')->with('success', 'Profile has been updated successfully!');
    }
}