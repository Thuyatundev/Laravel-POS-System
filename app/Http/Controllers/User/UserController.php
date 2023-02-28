<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // user homePage
    public function homePage()
    {
        $pizza = Product::orderBy('created_at', 'desc')->get();
        $category = Category::get();
        $cartdetail = Cart::where('user_id', Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();

        return view('user.main.home', compact('pizza', 'category', 'cartdetail','history'));
    }

    // user change page

    public function changePage()
    {
        return view('user.password.change');
    }

    // user Change Pasword
    public function change(Request $request)
    {
        $this->passwordValidationCheck($request);

        $user = User::select('password')->where('id', Auth::user()->id)->first();
        $dbHashValue = $user->password;

        if (Hash::check($request->oldpassword, $dbHashValue)) {
            $data = [
                'password' => Hash::make($request->newpassword)
            ];
            User::where('id', Auth::user()->id)->update($data);
            return back()->with(['changesuccess' => 'User password Change Successfully...']);
        }

        return back()->with(['notMatch' => 'Your old Password is not match. Try again!...']);
    }

    // user account detail
    public function detail()
    {
        return view('user.info.detail');
    }

    // history 
    public function history()
    {
        $order = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(5);
        return view('user.main.history',compact('order'));
    }

    // pizza detial
    public function pizzaDetail($pizzaId)
    {
        $pizzaList = Product::where('id', $pizzaId)->first();
        $pizzaInfo = Product::get();
        return view('user.main.details', compact('pizzaList', 'pizzaInfo'));
    }

    // filter pizza 
    public function filter($category_id)
    {
        $pizza = Product::where('category_id', $category_id)->orderBy('created_at', 'desc')->get();
        $category = Category::get();
        $cartdetail = Cart::where('user_id', Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home', compact('pizza', 'category', 'cartdetail','history'));
    }

    //addCart
    public function pizzaCart()
    {
        $cartList = Cart::select('carts.*', 'products.name as pizzaName', 'products.price  as pizzaPrice', 'products.image as pizzaImage')
            ->leftJoin('products', 'products.id', 'carts.product_id')
            ->where('carts.user_id', Auth::user()->id)
            ->get();
        $totalPrice = 0;

        foreach ($cartList as $c) {
            $totalPrice += $c->pizzaPrice * $c->qty;
        }
        return view('user.cart.pizzaCart', compact('cartList', 'totalPrice'));
    }

    // user account edit
    public function accountChangePage()
    {
        return view('user.info.accountInfo');
    }

    // user account change
    public function changeAccount($id, Request $request)
    {
        // uploadimage
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        // upload image
        if ($request->hasFile('image')) {
            $dbImage = User::where('id', $id)->first();
            $dbImage = $dbImage->image;
            if ($dbImage != null) {
                Storage::delete('public/' . $dbImage);
            }
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }
        User::where('id', $id)->update($data);
        return redirect()->route('user#accountDetail')->with(['updateAccount' => 'Account Updated Successfully']);
    }


    // userdata
    private function getUserData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
            'updated_at' => Carbon::now()
        ];
    }

    // account Validation check

    private function accountValidationCheck($request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email,' . Auth::user()->id,
            'phone' => 'required',
            'gender' => 'required',
            'image' => 'mimes:png,jpg,jpeg|file',
            'address' => 'required'
        ])->validate();
    }

    // changePassword
    private function passwordValidationCheck($request)
    {
        Validator::make($request->all(), [
            'oldpassword' => 'required',
            'newpassword' => 'required|min:6|max:10',
            'confirmpassword' => 'required|min:6|max:10|same:newpassword'
        ])->validate();
    }
}
