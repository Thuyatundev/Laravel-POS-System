<?php

namespace App\Http\Controllers\Route;

use App\Models\User;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class RouteController extends Controller
{
    //test api
    // http://127.0.0.1:8000/api/testing (method => Get)
    public function test()
    {
        $products = Product::get();
        $users = User::get();
        $category = Category::get();
        $contact = Contact::get();

        $data = [
            'product' => [
                'test' => $products
            ],
            'users' => $users,
            'category' => $category,
            'contact' => $contact,
        ];

        return response()->json($data, 200);
    }

    // get API
    // http://127.0.0.1:8000/api/get/Category(method = GET)
    public function categoryList()
    {
        $category = Category::orderBy('id', 'desc')->get();
        return response()->json($category, 200);
    }

    // create Category API
    // http://127.0.0.1:8000/api/create/Category(method = POST)
    // body{
    // name : ''
    // }
    public function createCategory(Request $request)
    {
        $data = [
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $response = Category::create($data);
        return response()->json($response, 200);
    }

    // create Contact API 
    // http://127.0.0.1:8000/api/create/contact(method = POST)
    // body{
    // user_id : ''
    // title
    // message
    // }
    public function createContact(Request $request)
    {
        $data = $this->getContactData($request);
        Contact::create($data);
        return response()->json($data, 200);
    }


    // delete API 
    // http://127.0.0.1:8000/api/delete/category(method = POST)
    // body{
    // category_id : ''
    // }
    public function deleteCategory(Request $request)
    {
        $data = Category::where('id', $request->category_id)->first();
        if (isset($data)) {
            Category::where('id', $request->category_id)->delete();
            return response()->json(['status' => true, 'message' => 'delete success', 'DeleteData' => $data], 200);
        }
        return response()->json(['status' => false, 'message' => 'There is no id here!...'], 404);
    }

    // category Detail API
    // http://127.0.0.1:8000/api/detail/category(method = POST)
    // body{
    // category_id : ''
    // }
    public function detailCategory(Request $request)
    {
        $data = Category::where('id', $request->category_id)->first();

        if (isset($data)) {
            return response()->json(['status' => true, 'Category' => $data], 200);
        }
        return response()->json(['status' => false, 'message' => 'there is no category here'], 500);
    }

    // update category API
    // http://127.0.0.1:8000/api/update/category (method = POST)
    // body{
    // category_id : ''
    // category_name : ''
    // }
    public function updateCategory(Request $request)
    {
        $categoryId = $request->category_id;
        $dbSource = Category::where('id', $categoryId)->first();

        if (isset($dbSource)) {
            $data = $this->getCategoryData($request);
            Category::where('id', $categoryId)->update($data);
            $response = Category::where('id', $categoryId)->first();
            return response()->json(['status' => true, 'message' => 'Successfully Update...', 'category' => $response], 200);
        }
        return response()->json(['status' => false, 'message' => 'there is no category update',], 500);
    }


    // get contact data
    // pravite function 
    private function getContactData($request)
    {
        return [
            'user_id' => $request->user_id,
            'title' => $request->title,
            'message' => $request->message,
        ];
    }

    // get category data
    // pravite function 
    private function getCategoryData($request)
    {
        return [
            'name' => $request->category_name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
