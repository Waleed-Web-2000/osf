<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'Product';
    protected $guarded = [ 'id', 'created_at', 'updated_at' ];
    
 	public function cat_info(){
        return $this->hasOne('App\Models\Category','id','category_id');
    }
    public static function getProductBySlug($slug){
        return Product::with(['cat_info'])->where('slug',$slug)->first();
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }  

}
