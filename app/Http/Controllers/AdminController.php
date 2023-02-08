<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function maintanance(){
        $accounts = Account::all();
        return view('adminPages.main', ['acc' => $accounts]);
    }
    public function update_role(){
        $id = request()->id;
        $acc = Account::where('id', $id)->first();
        $name = $acc->first_name . " " . $acc->last_name;
        $role = $acc->role_id;
        return view('adminPages.role', ['name' => $name, 'role' => $role, 'id' => $id]);
    }
    public function change_role(){
        $update = Account::where('id', request()->id)->first();
        $new_role = request()->role;
        $update->role_id = $new_role;
        $update->save();
        $en = "Role sucessfully updated!";
        $id = "Peran akun berhasil di-perbaharui!";
        if(session()->get('locale') === 'en'){
            return redirect(route('maintanance'))->with('role_succ', $en);
        }else{
            return redirect(route('maintanance'))->with('role_succ', $id);
        }
    }
    public function del_acc(){
        $acc = Account::where('id', request()->id);
        $acc->delete();
        $en = "Account sucessfully deleted!";
        $id = "Akun berhasil dihapus!";
        if(session()->get('locale') === 'en'){
            return redirect(route('maintanance'))->with('del_succ', $en);
        }else{
            return redirect(route('maintanance'))->with('del_succ', $id);
        }
    }
}
