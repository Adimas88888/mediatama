<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Adjust the namespace based on your User model location

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Fetch all users from the database
        return view('admin.user', ['users' => $users]); // Pass $users to the view
    }
}
