<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Category;
use File;

class ProductController extends Controller
{
    public function index()
    {
    	$searchTerm = request()->get('s');
        $books = Product::orWhere('name', 'LIKE', "%$searchTerm%")->latest()->paginate(5);
        return view('admin/product/index')->with(compact('books'));
    }

    public function create()
    {
        $categories = Category::get();
        return view('admin/product/create')->with(compact('categories'));
    }

    public function store(request $request)
    {
        $this->validate(request(),[
        'name' => 'required|max:100',
        'price' => 'required|max:100',
        ]);
        
        $filename = null;
        if (request()->hasFile('image')) {
            $file = request()->File('image');
            $filename = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/product/', $filename);
        }

        Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'SKU' => $request->SKU,
            'options' => $request->options,
            'tags' => $request->tags,
            'stock' => $request->stock,
            'size' => $request->size,
            'rating' => 'rating',
            'description' => $request->description,
            'short_description' => $request->short_description,
            'image' => $filename,
            'images' => 'No Images Found',
            'downloaded' => $request->Integer(''),
            'recommended' => $request->recommended,
            'condition' => $request->condition,
            'status' => 'DEACTIVE',
        ]);
        toastr()->timeOut(10000)->closeButton()->addSuccess('Product Created Succesfully');
        return redirect()->to('/admin/product/');
    }

    public function edit($id)
    {
    	$book = Product::findorFail($id);
    	$categories = Category::get();
        return view('admin/product/edit')->with(compact('book', 'categories'));
    }

    public function update($id, request $request)
    {
        $book = Product::findorFail($id);
        $currentImage = $book->image;
        $this->validate(request(),[
        'name' => 'required|max:100',
        'price' => 'required|max:100',
        ]);
         $filename = null;
        if (request()->hasFile('image')) {
            $file = request()->File('image');
            $filename = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/product/', $filename);
        }

        $book->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'SKU' => $request->SKU,
            'options' => $request->options,
            'tags' => $request->tags,
            'stock' => $request->stock,
            'size' => $request->size,
            'rating' => 'rating',
            'description' => $request->description,
            'short_description' => $request->short_description,
            'image' => ($filename) ? $filename : $currentImage,
            'images' => 'No Images Found',
            'downloaded' => $request->Integer(''),
            'recommended' => $request->recommended,
            'condition' => $request->condition,
            'status' => 'DEACTIVE',
        ]);
        if ($filename) {
            File::delete('./uploads/product/' . $currentImage);
        }
        toastr()->timeOut(10000)->closeButton()->addSuccess('Product Updated Succesfully');
        return redirect()->to('/admin/product/');
    }

    public function destroy($id)
    {
        $book = Product::findorFail($id);
        $currentImage = $book->product_img;
        $book->delete();
        File::delete('./uploads/product/' . $currentImage);
        toastr()->timeOut(10000)->closeButton()->addSuccess('Product Deleted Succesfully');
        return redirect()->back();
    }
    public function status($id)
    {
        $book = Product::findorFail($id);
        $newStatus = ($book->status == 'DEACTIVE') ? 'ACTIVE' : 'DEACTIVE';
        $book->update(['status' => $newStatus]);
        toastr()->timeOut(10000)->closeButton()->addSuccess('Prdouct Status Changed Succesfully');
        return redirect()->back();
    }
}


