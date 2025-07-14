<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Enums\UserType;

trait HandlesUserUpdate
{
    public function handleUpdate(User $user, Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $folder = $user->type->value == UserType::ADMIN->value ? 'admins' : 'clients';
            $file->move(public_path("uploads/{$folder}"), $fileName);

            if ($user->image && file_exists(public_path("uploads/{$folder}/" . $user->image))) {
                unlink(public_path("uploads/{$folder}/" . $user->image));
            }

            $user->image = $fileName;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->has('status')) {
            $user->status = $request->status;
        }

        $user->save();
    }
}
