<?php

namespace App\Http\Controllers;

use App\Models\ItemModel;
use App\Models\OrderModel;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function add_cart(){
        $new_ord = new OrderModel();
        $new_ord->account_id = auth()->user()->id;
        $new_ord->item_id = request()->item_id;
        $new_ord->save();
        $en = "Item sucessfully added to cart!";
        $id = "Barang berhasil dimasukkan ke keranjang!";
        if(session()->get('locale') === 'en') {
            return redirect(route('cart'))->with('buy_succ', $en);
        }
        else{
            return redirect(route('cart'))->with('buy_succ', $id);
        }
    }
    // if(session()->get('locale') === 'en'){

    // }else{

    // }
    public function del_cart(){
        $item_del = OrderModel::where('item_id', request()->del_id)->first();
        $item_del->delete();
        $en = "Item sucessfully deleted!";
        $id = "Barang berhasil dihapus!";
        if(session()->get('locale') === 'en'){
            return redirect(route('cart'))->with('del_succ', $en);
        }
        else{
            return redirect(route('cart'))->with('del_succ', $id);
        }
    }
    public function cout(){
        $cart = OrderModel::where('account_id', request()->user)->get();
        $en = "Cart is empty can't checkout!";
        $id = "Tidak ada barang di keranjang!";
        if(count($cart) == 0){
            if(session()->get('locale') === 'en'){
                return back()->with('empty_cart', $en);
            }else{
                return back()->with('empty_cart', $id);
            }
        }
        foreach($cart as $c){
            $c->delete();
        }
        return view('msgPages.msgcout', ['profile' => 0]);
    }
}
