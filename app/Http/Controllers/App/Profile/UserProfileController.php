<?php

namespace App\Http\Controllers\App\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserProfileController extends Controller
{
    /**
     * Display a user profile view.
     *
     * @return \Illuminate\Contracts\Support\Renderable|string
     */
    public function index()
    {
        return view('app.profile.show');
    }
}
