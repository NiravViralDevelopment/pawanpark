<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contact;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard
     */
    public function index()
    {
        $stats = [
            'projects' => \App\Models\Project::count(),
            'blogs' => 24, // Will be updated when Blog CRUD is created
            'messages' => Contact::count(),
            'users' => User::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
