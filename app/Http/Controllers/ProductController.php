<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // product list
    public function createPage()
    {
        $pizzas = Product::select('products.*', 'categories.name as category_name')->when(request('key'), function ($query) {
                $query->where('products.name', 'like', '%' . request('key') . '%');
            })->leftJoin('categories', 'products.category_id', 'categories.id')
            ->orderBy('created_at', 'desc')->paginate(4);
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
        $this->productValidationCheck($request, 'create');

        $data = $this->requestProductInfo($request);


        $fileName = uniqid() . $request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public', $fileName);
        $data['image'] = $fileName;

        Product::create($data);
        return redirect()->route('product#createPage')->with(['productcreate' => 'Product Created Successfully...']);
    }

    // product update
    public function update(Request $request)
    {
        $this->productValidationCheck($request, 'update');
        $data = $this->requestProductInfo($request);


        if ($request->hasFile('pizzaImage')) {
            $oldImageName = Product::where('id', $request->pizzaId)->first();
            $oldImageName = $oldImageName->image;

            if ($oldImageName != null) {
                Storage::delete('public/' . $oldImageName);
            }

            $fileName = uniqid() . $request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }

        Product::where('id', $request->pizzaId)->update($data);
        return  redirect()->route('product#createPage')->with(['Productupdate' => 'Product Updated Successfully...']);
    }


    // product delete
    public function delete($id)
    {
        Product::where('id', $id)->delete();
        return redirect()->route('product#createPage')->with(['deletesuccess' => 'Product Delete Successfully...']);
    }

    // Product Detail

    public function detail($id)
    {
        $pizzas = Product::select('products.*', 'categories.name as category_name')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->where('products.id', $id)->first();
        return view('admin.product.detail', compact('pizzas'));
    }

    public function edit($id)
    {
        $pizzas =  Product::where('id', $id)->first();
        $categories = Category::get();
        return view('admin.product.edit', compact('pizzas', 'categories'));
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

    private function productValidationCheck($request, $action)
    {
        $validationRule = [
            'pizzaName' => 'required|min:5|unique:products,name,' . $request->pizzaId,
            'pizzaCategory' => 'required',
            'pizzaDescription' => 'required|min:10',
            'pizzaPrice' => 'required',
            'pizzaTime' => 'required'
        ];
        $validationRule['pizzaImage'] = $action == 'create' ? 'required|mimes:jpg,png,jepg,webp|file' : "mimes:jpg,png,jepg,webp|file";
        Validator::make($request->all(), $validationRule)->validate();
    }
}
