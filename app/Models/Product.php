<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Product extends Model {
 protected $fillable=['name_bn','name_en','description_bn','description_en','price','compare_price','image_url','category','is_featured','is_active'];
 protected $casts=['price'=>'decimal:2','compare_price'=>'decimal:2','is_featured'=>'boolean','is_active'=>'boolean'];
}
