<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'Category';
    protected $guarded = [ 'id', 'created_at', 'updated_at' ];
    public static function getProductByCat($slug){
        // dd($slug);
        return Category::with('products')->where('slug',$slug)->first();
        // return Product::where('cat_id',$id)->where('child_cat_id',null)->paginate(10);
    }
    public function products()
    {
        return $this->hasMany('App\Models\Product','category_id')->where('status','ACTIVE');
    }
    public function productss()
    {
        return $this->hasMany(Product::class, 'category_id');
    } 
}
