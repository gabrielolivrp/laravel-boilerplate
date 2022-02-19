<?php

namespace App\Http\Controllers\App\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserProfilePhotoController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function upload(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|max:1024'
        ]);

        $request->user()->updateProfilePhoto($request->file('photo'));

        return back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        $request->user()->deleteProfilePhoto();

        return back();
    }
}
