<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminController extends Controller
{
    public function deleteUser($id)
    {
        $admin = auth()->user();

        if ($admin->role !== 'admin') {
            abort(403);
        }

        $user = User::findOrFail($id);

        if ($user->id === $admin->id) {
            return back()->with('error', 'You cannot delete yourself.');
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }

    public function promoteUser($id)
    {
        $admin = auth()->user();

        if ($admin->role !== 'admin') {
            abort(403);
        }

        $user = User::findOrFail($id);

        $user->role = 'admin';
        $user->save();

        return back()->with('success', 'User promoted to admin.');
    }
}
