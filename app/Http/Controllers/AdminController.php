<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        $user = auth()->user();

        return view('admin-dashboard', [
            'username' => $user->username,
            'isAdmin' => $user->isAdmin
        ]);
    }
}
