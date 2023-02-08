<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\ItemModel;
use App\Models\OrderModel;
use App\Models\RoleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class HomeController extends Controller
{
    public function auth_home(){
        $veggies = ItemModel::paginate(10);
        return view('authPages.home', ['veggies' => $veggies]);
    }
    public function item_detail(){
        $id = request()->id;
        $item = ItemModel::where('id', $id)->first();
        $decs = explode("\\", $item->item_desc);
        return view('authPages.detail', ['item' => $item, 'desc' => $decs]);
    }
    public function cart(){
        $user_cart = OrderModel::where('account_id', auth()->user()->id)->get();
        foreach($user_cart as $u){
            $corr_item = ItemModel::where('id', $u->item_id)->first();
            $u->item_name = $corr_item->item_name;
            $u->item_pic = $corr_item->item_pic;
            $u->price = $corr_item->price;
        }
        return view('authPages.cart', ['item' => $user_cart]);
    }
    public function profile(){
        $role = auth()->user()->role_id;
        $role = RoleModel::where('id', $role)->first()->role_name;
        return view('authPages.profile', ['user' => auth()->user(), 'role' => $role]);
    }
    public function update_profile(Request $request){
        $update = Account::where('id', auth()->user()->id)->first();
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
        $update->first_name = $validated['fname'];
        $update->last_name = $validated['lname'];
        $update->email = $validated['email'];
        if(request()->file('dp')){
            $og_filename = request()->file('dp')->getClientOriginalName();
            $update->display_picture_link = request()->file('dp')->storeAs('displayPictures', $og_filename);
        }
        $update->password = $pass;
        $update->save();
        return view('msgPages.msgcout', ['profile' => 1]);
    }
}
