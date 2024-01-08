<?php

namespace App\Http\Controllers\Customer;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\UserCreateRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index()
    {
        $user = User::find(Auth::user()->id);
        return view('pages.customer.user.user', [
            'type_menu' => '',
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\UserUpdateRequest $request
     * @param  \App\Models\User  $user
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $params = $request->safe([
            'name', 'no_hp', 'address',  'image', 'email', 'username', 'password'
        ]);
        try {
            DB::transaction(function () use ($params, $request, $user) {
                $photo = $request->file('image');
                if ($photo instanceof UploadedFile) {
                    $file_path = storage_path() . '/app/' . $user->photo;
                    if (File::exists($file_path)) {
                        unlink($file_path);
                    }
                    $filename = $photo->store('public/photos/user');
                } else {
                    $filename = $user->photo;
                };
                $password = $params['password'] == null ? $user->password : Hash::make($params['password']);
                $user = $user->update([
                    'name' => $params['name'],
                    'username' => $params['username'],
                    'email' => $params['email'],
                    'password' => $password,
                    'no_hp' => $params['no_hp'],
                    'address' =>  $request->address,
                    'photo' => $filename ?? 'avatar.jpg',
                ]);
            });
            return redirect()->route('customer.user.index')->with('success', "Data user '{$user->name}' berhasil diubah");
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
