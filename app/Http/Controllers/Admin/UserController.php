<?php

namespace App\Http\Controllers\Admin;

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

class UserController extends Controller
{

    public function index()
    {
        $users = User::get();
        return view('pages.admin.user.user', ['type_menu' => '', 'users' => $users]);
    }

    public function create()
    {
        return view('pages.admin.user.tambah-user', ['type_menu' => '']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\UserCreateRequest  $request
     */
    public function store(UserCreateRequest $request)
    {
        $params = $request->safe([
            'name', 'no_hp', 'address', 'roles', 'image', 'password', 'email', 'username'
        ]);
        // dd($request->address);
        // DB::transaction(function () use ($params, $request) {
        $photo = $request->file('image');
        // dd($photo);
        if ($photo instanceof UploadedFile) {
            $filename = $photo->store('public/photos/user');
        }
        $user = User::create([
            'name' => $params['name'],
            'username' => $params['username'],
            'email' => $params['email'],
            'password' => Hash::make($params['password']),
            'no_hp' => $params['no_hp'],
            'address' =>  $request->address,
            'photo' => $filename ?? 'avatar.jpg',
            'roles' =>  $params['roles'],
        ]);
        // });
        return redirect()->route('admin.user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     *
     */
    public function show(User $user)
    {
        //
        // return $user;
        return view('pages.admin.user.detail-user', ['type_menu' => '', 'user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     */
    public function edit(User $user)
    {
        return view('pages.admin.user.edit-user', [
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
            'name', 'no_hp', 'address', 'roles', 'image', 'email', 'username', 'password'
        ]);
        // dd($password);
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
                    'roles' =>  $params['roles'],
                ]);
            });
            return redirect()->route('admin.user.index')->with('success', "Data user '{$user->name}' berhasil diubah");
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Summary of destroy
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        if ($user->photo !== 'avatar.jpg') {
            $file_path = storage_path() . '/app/' . $user->photo;
            if (File::exists($file_path)) {
                unlink($file_path);
            }
        }
        $user->delete();

        return redirect()->route('admin.user.index')->with('success', "Data user '{$user->name}' berhasil dihapus");
    }
}
