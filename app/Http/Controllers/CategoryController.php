<?php

namespace App\Http\Controllers;



use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //category list
    public function list()
    {
        $categories = Category::when(request('key'), function ($query) {
            $query->where('name', 'like', '%' . request('key') . '%');
        })->orderBy('id', 'desc')
            ->paginate(5);
            $categories->appends(request()->all());
        return view('admin.category.list', compact('categories'));
    }

    //category createpage
    public function createPage()
    {
        return view('admin.category.create');
    }

    //create category
    public function create(Request $request)
    {
        $this->categoryValidatorCheck($request);
        $data = $this->requestCategoryData($request);
        Category::create($data);
        return redirect()->route('category#list')->with(['createSuccess' => 'Category Created Successfully']);
    }

    // delete category

    public function delete($id)
    {
        Category::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'Category Deleted Successfully']);
    }

    // edit category

    public function edit($id)
    {
        $category = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('category'));
    }

    // update category

    public function update(Request $request)
    {
        $this->categoryValidatorCheck($request);
        $data = $this->requestCategoryData($request);
        Category::where('id',$request->categoryId)->update($data);
        return redirect()->route('category#list')->with(['updateSuccess'=> 'Category Updated Successfully']);
    }

    //change password
    // public function changepassword(){
    //     return view('admin.change');
    // }

    // category Validation check
    private function categoryValidatorCheck($request)
    {
        Validator::make($request->all(), [
            'categoryName' => 'required|unique:categories,name,'.$request->categoryId
        ])->validate();
    }

    //category Data

    private function requestCategoryData($request)
    {
        return [
            'name' => $request->categoryName
        ];
    }
}
