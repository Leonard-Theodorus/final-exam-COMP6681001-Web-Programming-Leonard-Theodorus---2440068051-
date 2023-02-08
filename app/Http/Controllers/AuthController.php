<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function login_page(){
        return view('authPages.login');
    }
    public function register_page(){
        return view('authPages.register');
    }
    public function login(){
        $email = request()->email;
        $pass = request()->pass;
        if(Auth::attempt(['email' => $email, 'password' => $pass])){
            return redirect(route('welcome'));
        }
        $en = "Login Failed! Please check again";
        $id = "Gagal masuk akun! Cek kembali kredensial Anda";
        if(session()->get('locale') === 'en'){
            return back()->with('login_error', $en);
        }
        else{
            return back()->with('login_error', $id);
        }
    }
    public function register(Request $request){
        $eng = [
            'fname.required' => "This field is required",
            'lname.required' => "This field is required",
            'email.required' => "This field is required",
            'dp.required' => "This field is required",
            'pass.required' => "This field is required",
            'repass.required' => "This field is required",
            'fname.max' => "Maximum length is 25 characters",
            'lname.max' => "Maximum length is 25 characters",
            'repass.same' => "Password must match",
            'dp.image' => "Display picture must be an image file"
        ];
        $id = [
            'fname.required' => "Bagian ini harus diisi",
            'lname.required' => "Bagian ini harus diisi",
            'email.required' => "Bagian ini harus diisi",
            'email.email' => "Email tidak valid",
            'dp.required' => "Bagian ini harus diisi",
            'pass.required' => "Bagian ini harus diisi",
            'repass.required' => "Bagian ini harus diisi",
            'fname.max' => "Maksimal Panjang nama adalah 25 karakter",
            'lname.max' => "Maksimal Panjang nama adalah 25 karakter",
            'repass.same' => "Password harus sama",
            'dp.image' => "File harus berupa gambar"
        ];
        if(session()->get('locale') === 'en'){
            $validated = $request->validate([
                'fname' => ['required', 'max:25', 'alpha_num'],
                'lname' => ['required', 'max:25', 'alpha_num'],
                'email' => ['required', 'email:dns'],
                'dp' => ['required', 'image'],
                'pass' => ['required', Password::min(8)->numbers()],
                'repass' => ['required', 'same:pass']
            ],$eng);
        }
        else{
            $validated = $request->validate([
                'fname' => ['required', 'max:25', 'alpha_num'],
                'lname' => ['required', 'max:25', 'alpha_num'],
                'email' => ['required', 'email:dns'],
                'dp' => ['required', 'image'],
                'pass' => ['required', Password::min(8)->numbers()],
                'repass' => ['required', 'same:pass']
            ],$id);
        }
        $pass = Hash::make($validated['pass']);
        $gender = request()->gender;
        $role = request()->role;
        $new = new Account();
        $new->role_id = $role;
        $new->gender_id = $gender;
        $new->first_name = $validated['fname'];
        $new->last_name = $validated['lname'];
        $new->email = $validated['email'];
        if(request()->file('dp')){
            $og_filename = request()->file('dp')->getClientOriginalName();
            $new->display_picture_link = request()->file('dp')->storeAs('displayPictures', $og_filename);
        }
        $new->password = $pass;
        $new->save();
        $en = "Register successful! Please login";
        $idn = "Berhasil membuat akun! Silahkan Masuk";
        if(session()->get('locale') === 'en'){
            return redirect(route('login'))->with('reg_succ', $en);
        }else{
            return redirect(route('login'))->with('reg_succ', $idn);
        }
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return view('guestPages.home', ['log' => 1]);
    }
}
