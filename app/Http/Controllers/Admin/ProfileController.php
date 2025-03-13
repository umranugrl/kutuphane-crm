<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profiles.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'name'             => 'required|string|max:255',
            'password'         => 'nullable|min:5|confirmed',
            'profile_image'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        if (! $user) {
            return redirect()->back()->withErrors(['error' => 'Kullanıcı bulunamadı.']);
        }

        // Mevcut şifrenin doğruluğunu kontrol etme
        if (! Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Mevcut şifre yanlış.']);
        }

        $user->name  = $request->name;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('profile_image')) {
            $image     = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/profile'), $imageName);
            $user->profile_image = 'images/profile/' . $imageName;
        }
        
        $user->save();
        return redirect()->route('profile.edit');
    }
}
