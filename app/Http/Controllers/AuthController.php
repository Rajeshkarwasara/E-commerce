<?php

namespace App\Http\Controllers;

use DB;

use Illuminate\Support\str;
use App\Models\User;
use App\Models\country;
use Illuminate\Http\Request;
use App\Mail\ResetPasswordEmail;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

use Spatie\MediaLibrary\InteractsWithMedia;


class AuthController extends Controller
{
   public function register(Request $request)
   {
      $country = country::all();
      return view('register', compact("country"));
   }

   public function register_post(Request $request)
   {

      //    $request->validate([
      //       'fname' => 'required|min:2|max:10|string',
      //       'lname' => 'required|min:2|max:10|string|different:fname',
      //       'email' => 'required|email|',
      //       'password' => 'required|min:6',
      //       'contact' => 'numeric|nullable',
      //       'gender' => 'required|in:Male,Female',
      //       'address' => 'nullable|string|max:100',
      //       'country' => 'required|',
      //       'profile' => 'required|',
      //    ]);


      //    $data = [
      //       "role_id" => user::USER_ROLE,
      //       'fname' => $request->fname,
      //       'lname' => $request->lname,
      //       'email' => $request->email,
      //       'password' => Hash::make($request->password),
      //       'contact' => $request->contact,
      //       'gender' => $request->gender,
      //       'address' => $request->address,
      //       'country' => $request->country,
      //       'profile' => $request->profile,
      //    ];
      //   $file= user::create($data);

      //    if($request->hasFile('profile') && $request->file('profile')->isValid()){
      //       $file->addMediaFromRequest('profile')->toMediaCollection('profile');
      //   }



      //    dd($request->all());

      $this->validate($request, [
         'fname' => 'required|min:2|max:10|string',
         'lname' => 'required|min:2|max:10|string|different:fname',
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
      return redirect()->route('login')->with('success', 'User Created Successfully.');




   }

   public function login(Request $request)
   {
      return view('login');
   }

   public function login_post(Request $request)
   {
      $request->validate([
         'email' => 'required',
         'password' => 'required'
     ]);
     
     $userdata = $request->only('email', 'password');
     
     if(Auth::attempt($userdata)) {
         return redirect()->route('index');
         // dd($request->all());
     
     }
     else{
         return redirect()->route('login')->with('error' ,'your email and password worng');
         // dd('error');
     }
   }
   public function forgot(Request $request)
   {
      return view('forgot_password');
   }

   public function processForgotpassword(Request $request)
   {
      $Validator = Validator::make($request->all(), [
         'email' => 'required|email|exists:users,email',
     ]);
     if ($Validator->fails()) {
         return redirect()->route('forgot')->withInput()->withErrors($Validator);
     }
     $token = str::random(60);
     DB::table('password_reset_tokens')->where('email', $request->email)->delete();

     DB::table('password_reset_tokens')->insert([
         'email' => $request->email,
         'token' => $token,
         'created_at' => now()
     ]);

     $user = User::where('email', $request->email)->first();
     $formData = [
         'token' => $token,
         'user' => $user,
         'mailsubject' => 'you have requsted to reset password',
     ];

     Mail::to($request->email)->send(new ResetPasswordEmail($formData));

     return redirect()->route('forgot')->with('success', 'please chek your inbox to reset your password.');
   }

   public function reset_password($token)
   {
       $tokenexist = DB::table('password_reset_tokens')->where('token', $token)->first();
       if ($tokenexist == null) {
           return redirect()->route('forgotpassword')->with('error', 'Invalid request');
       }
       return view('reset_form', [
           'token' => $token
       ]);
   }


   public function ProcessResetPassword(Request $request)
   {
       $token = $request->token;
       $tokenexist = DB::table('password_reset_tokens')->where('token', $token)->first();
       if ($tokenexist == null) {
           return redirect()->route('forgot')->with('error', 'Invalid request');
       }

       $user=User::where('email',$tokenexist->email)->first();
       $Validator = Validator::make($request->all(), [
           'password' => 'required|min:6',
           'confirm_password' => 'required|same:password',
       ]);
       if ($Validator->fails()) {
           return redirect()->route('reset_password',$token)->withErrors($Validator);
       }


       User::where('id',$user->id)->update([
           'password'=>Hash::make($request->password)

       ]);
       return redirect()->route('login')->with('success', 'you have success fully updated your password.');
   
   }

   public function logout(){
      Auth::logout();
      return redirect()->route('login');
  }
}
