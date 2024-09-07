<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use File;

class CategoryController extends Controller
{
    public function index()
    {
    	$searchTerm = request()->get('s'); 
        $categories = Category::orWhere('title', 'LIKE', "%$searchTerm%")->latest()->paginate(5);
        return view('admin/category/index')->with(compact('categories'));
    }

    public function create()
    {
    	return view('admin/category/create');
    }

    public function store(Request $request)
    {
    	$this->validate(request(),[
        'title' => 'required|max:100',
        ]);

    	$filename = null;
        if (request()->hasFile('category_img')) {
            $file = request()->File('category_img');
            $filename = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/category/', $filename);
        }

        Category::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'category_img' => $filename,
            'status' => 'DEACTIVE',
        ]);
        toastr()->timeOut(10000)->closeButton()->addSuccess('Category Created Succesfully');
        return redirect()->to('/admin/category');
    }

    public function edit($id)
    {
    	$category = Category::findorFail($id);
        return view('admin/category/edit')->with(compact('category'));
    }

    public function update($id, Request $request)
    {
    	$category = Category::findorFail($id);
    	$currentImage = $category->category_img;
        $this->validate(request(),[
        'title' => 'required|max:100',
        ]);

        $filename = null;
        if (request()->hasFile('category_img')) {
            $file = request()->File('category_img');
            $filename = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/category/', $filename);
        }

        $category->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'category_img' => ($filename) ? $filename : $currentImage,
            'status' => 'DEACTIVE',
        ]);

        if ($filename) {
            File::delete('./uploads/category/' . $currentImage);
        }

        toastr()->timeOut(10000)->closeButton()->addSuccess('Category Updated Succesfully');
        return redirect()->to('/admin/category');
    }

    public function destroy($id)
    {
    	$category = Category::findorFail($id);
    	$currentImage = $category->category_img;
        $category->delete();
        File::delete('./uploads/category/' . $currentImage);
        toastr()->timeOut(10000)->closeButton()->addSuccess('Category Deleted Succesfully');
        return redirect()->back();
    }
    public function status($id)
    {
        $category = Category::findorFail($id);
        $newStatus = ($category->status == 'DEACTIVE') ? 'ACTIVE' : 'DEACTIVE';
        $category->update(['status' => $newStatus]);
        toastr()->timeOut(10000)->closeButton()->addSuccess('Category Status Changed Succesfully');
        return redirect()->back();
    }
}
