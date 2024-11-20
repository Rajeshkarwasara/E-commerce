<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }


    public function user_list()
    {
        $data = DB::table('users')
            ->leftJoin('countries', 'users.country', '=', 'countries.id')
            ->select('users.*', 'countries.country_name')
            ->get();

        $country = country::all();
        return view("admin.users_list", compact("country", "data"));
    }

    public function user_edit($id)
    {
        $data = User::find($id);
        $country = country::all();
        return view('admin.user_edit', compact('country', 'data'));
    }


    public function add_img_edit(Request $request, string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('user_list')->with('error', 'User not found!');
        }

        if ($request->hasFile('profile')) {
            if ($user->profile && \Storage::exists('profiles/' . $user->profile)) {
                \Storage::delete('profiles/' . $user->profile);
            }

            $fileName = time() . '_' . $request->file('profile')->getClientOriginalName();
            $request->file('profile')->move(public_path('profiles'), $fileName);

            $user->update(['profile' => $fileName]);
        }

        return redirect()->route("user_list")->with('success', 'Profile image updated successfully!');
    }


    public function add_user()
    {
        $country = country::all();
        return view('admin.add_user', compact("country"));

    }

    public function add_user_data(Request $request)
    {

        $this->validate($request, [
            'fname' => 'required|min:2|max:10|string',
            'lname' => 'required|min:2|max:10|string|',
            'email' => 'required|email|',
            'password' => 'required|min:6',
            'contact' => 'numeric|nullable',
            'gender' => 'required|in:Male,Female',
            'address' => 'nullable|string|max:100',
            'country' => 'required|',
            'profile' => 'required|',
        ]);
        $requestData = $request->except(['_token', 'regist']);

        $imgName = 'lv_' . rand() . '.' . $request->profile->extension();
        $request->profile->move(public_path('profiles/'), $imgName);
        $requestData['profile'] = $imgName;

        $requestData['password'] = Hash::make($request->password);
        $requestData['role_id'] = User::USER_ROLE;
        $user = User::create($requestData);


        // dd($request->all());
        return redirect()->route('user_list')->with('success', 'User Created Successfully.');



    }

    public function user_delet(string $id){
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user_list');
    }
    
}
