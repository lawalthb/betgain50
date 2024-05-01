<?php

namespace App\Http\Controllers;

use App\Models\RecentUsers;
use Illuminate\Http\Request;

class RecentUsersController extends Controller
{
    public function recent_users()
    {
        $recent_users = RecentUsers::with('user')->orderBy('created_at', 'asc')->take(10)->get();
        return $recent_users;
    }
}
