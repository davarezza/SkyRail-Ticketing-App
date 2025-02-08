<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('management.profile.index');
    }

    public function changeImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:10000',
        ]);
    
        $user = User::find(Auth::id());
    
        if ($request->hasFile('image')) {
            $oldImagePath = public_path('assets/img/user/' . $user->image);
            
            if (file_exists($oldImagePath) && is_file($oldImagePath)) {
                unlink($oldImagePath);
            }
    
            $imageName = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('assets/img/user/'), $imageName);
    
            $user->image = $imageName;
            $user->save();
    
            return redirect()->route('management.profile.index')->with('success', 'Profile picture updated successfully');
        }
    }
}
