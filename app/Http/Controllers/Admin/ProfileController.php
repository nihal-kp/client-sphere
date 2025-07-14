<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;
use App\Traits\HandlesUserUpdate;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    use HandlesUserUpdate;

    public function edit()
    {
        return view('admin.profile.edit');
    }

    public function update(UpdateUserRequest $request)
    {
        $user = Auth::user();
        $this->handleUpdate($user, $request);

        return redirect()->back()->with('success', 'Profile updated successfully');
    }
}
