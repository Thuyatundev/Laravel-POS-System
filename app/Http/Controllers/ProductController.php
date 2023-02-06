<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // product list
    public function createPage()
    {
        $pizzas = Product::when(request('key'), function ($query) {
            $query->where('name', 'like', '%' . request('key') . '%');
        })->orderBy('created_at', 'desc')->paginate(3);
        $pizzas->appends(request()->all());
        return view('admin.product.pizza', compact('pizzas'));
    }

    // product list
    public function createProduct()
    {
        $categories = Category::select('id', 'name')->get();
        return view('admin.product.create', compact('categories'));
    }

    // product create
    public function create(Request $request)
    {
        $this->productValidationCheck($request);

        $data = $this->requestProductInfo($request);


        $fileName = uniqid() . $request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public', $fileName);
        $data['image'] = $fileName;

        Product::create($data);
        return redirect()->route('product#createPage')->with(['productcreate'=>'Product Created Successfully...']);
    }

    // product delete
    public function delete($id)
    {
        Product::where('id',$id)->delete();
        return redirect()->route('product#createPage')->with(['deletesuccess'=>'Product Delete Successfully...']);
    }

    // Product Detail

    public function detail($id)
    {
       $pizzas = Product::where('id',$id)->first();
        return view('admin.product.detail',compact('pizzas'));
    }

    // request product info
    private function requestProductInfo($request)
    {
        return [
            'category_id' => $request->pizzaCategory,
            'name' => $request->pizzaName,
            'description' => $request->pizzaDescription,
            'price' => $request->pizzaPrice,
            'waitingtime' => $request->pizzaTime
        ];
    }

    // product validation check

    private function productValidationCheck($request)
    {
        Validator::make($request->all(), [
            'pizzaName' => 'required|min:5|unique:products,name',
            'pizzaCategory' => 'required',
            'pizzaDescription' => 'required|min:10',
            'pizzaImage' => 'required|mimes:jpg,png,jepg,webp|file',
            'pizzaPrice' => 'required',
            'pizzaTime' => 'required'
        ])->validate();
    }
}
