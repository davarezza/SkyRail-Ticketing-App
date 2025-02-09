<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Penumpang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'gender' => 'required',
            'telephone' => 'nullable|numeric',
            'birth_date' => 'nullable|date',
            'address' => 'nullable',
            'email' => 'required|email',
        ]);
    
        $user = User::find(Auth::id());
        if (!$user) {
            return redirect()->route('management.profile.index')->with('error', 'User not found');
        }
    
        try {
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->save();
    
            $penumpang = Penumpang::where('user_id', $user->id)->first();
            if ($penumpang) {
                $penumpang->nama_penumpang = $request->name;
                $penumpang->username = $request->username;
                $penumpang->jenis_kelamin = $request->gender;
                $penumpang->telephone = $request->telephone;
                $penumpang->tanggal_lahir = $request->birth_date;
                $penumpang->alamat_penumpang = $request->address;
                $penumpang->save();
            }
    
            return redirect()->route('management.profile.index')->with('success', 'Profile updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('management.profile.index')->with('error', 'Failed to update profile: ' . $e->getMessage());
        }
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password',
        ]);

        $user = User::find(Auth::id());
        
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect');
        }

        if ($request->new_password !== $request->confirm_password) {
            return redirect()->back()->with('error', 'Confirmation password does not match new password');
        }

        $user->password = Hash::make($request->new_password);
        $user->plain_password = $request->new_password;
        $user->save();

        $penumpang = Penumpang::where('user_id', $user->id)->first();
            if ($penumpang) {
                $penumpang->password = $request->new_password;
                $penumpang->save();
            }

        return redirect()->route('management.profile.index')->with('success', 'Password updated successfully');
    }   
}
