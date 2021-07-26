<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile()
    {
        return view('user.profile', array('user' => auth()->user()) );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function updateAvatar(Request $request)
    {
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->fit(300, 300, function ($constraint) {
                $constraint->upsize();
            })->save( public_path('/uploads/avatars/' . $filename ) );
            $user = auth()->user();
            $user->avatar = $filename;
            $user->save();
            return response()->json(['success' => true, 'avatar' => $user->avatar]);
        }
    }

    public function deleteAvatar()
    {
        $user = Auth::user();
        if ($user->avatar) {
            try {
                $user->avatar = "default.jpg";
                $user->save();
                return ['success' => true];
            }
            catch(\Exception $e) {
                // error
                return ['success' => false, 'error' => $e];
            }
        }
    }
}
