<?php

namespace App\Http\Controllers;
use App\Models\User;

use App\Models\country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function user_profile(Request $request)
    {
        $data = DB::table('users')
            ->leftJoin('countries', 'users.country', '=', 'countries.id')
            ->where('users.id', '=', Auth::id())
            ->select('users.*', 'countries.country_name')
            ->first();

        $country = country::all();
        return view("user_profile", compact("country", "data"));
    }


    public function image_update(Request $request)
    {
        if ($request->hasFile('profile') && $request->file('profile')->isValid()) {
            $imgName = 'lv_' . rand() . '.' . $request->file('profile')->extension();
            $request->file('profile')->move(public_path('profiles'), $imgName);
            DB::table('users')
                ->where('id', Auth::id())
                ->update(['profile' => $imgName]);

            return redirect()->route('user_profile')->with('success', 'Profile image updated successfully.');
        } else {
            return redirect()->route('user_profile')->with('error', 'No profile image uploaded or invalid file.');
        }
    }


    public function user_detail_update(Request $request)
    {

        // dd($request->all());
        try {
            $request->validate([
                'fname' => 'required|min:2|max:10|string',
                'lname' => 'required|min:2|max:10|string|',
                'email' => 'required|email|',
                'contact' => 'numeric|nullable',
                'gender' => 'required|in:Male,Female',
                'address' => 'nullable|string|max:100',
                'country' => 'required|',
            ]);
            $requestData = $request->except(['_token', '_method', 'update']);
            $user = User::find(auth()->user()->id);
            $user->update($requestData);

            return redirect()->route('user_profile')->with('Account_Details', 'Account_Detailss updated successfully.');
        } catch (\Exception $e) {
            dd($e);
        }






    }

}
