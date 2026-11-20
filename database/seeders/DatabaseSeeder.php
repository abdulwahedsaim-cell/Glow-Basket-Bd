<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Product;
class DatabaseSeeder extends Seeder {
 public function run():void{
  $items=[
   ['name_bn'=>'এভরিডে স্টাইল ব্যাগ','name_en'=>'Everyday Style Bag','description_bn'=>'প্রতিদিন ব্যবহারের জন্য সুন্দর ও ব্যবহারিক ব্যাগ।','description_en'=>'A versatile everyday bag with a clean, modern look.','price'=>650,'compare_price'=>790,'category'=>'Fashion','image_url'=>'https://images.unsplash.com/photo-1548036328-c9fa89d128fa?w=900','is_featured'=>true],
   ['name_bn'=>'ক্লাসিক ফ্যাশন ঘড়ি','name_en'=>'Classic Fashion Watch','description_bn'=>'সাধারণ ও আকর্ষণীয় ডিজাইনের ঘড়ি।','description_en'=>'A timeless accessory for everyday outfits.','price'=>890,'compare_price'=>1090,'category'=>'Accessories','image_url'=>'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=900','is_featured'=>true],
   ['name_bn'=>'মডার্ন সানগ্লাস','name_en'=>'Modern Sunglasses','description_bn'=>'আধুনিক স্টাইলের সানগ্লাস।','description_en'=>'Modern everyday sunglasses.','price'=>450,'compare_price'=>550,'category'=>'Accessories','image_url'=>'https://images.unsplash.com/photo-1511499767150-a48a237f0083?w=900','is_featured'=>true],
   ['name_bn'=>'মিনিমাল ব্যাকপ্যাক','name_en'=>'Minimal Backpack','description_bn'=>'দৈনন্দিন ব্যবহার ও ভ্রমণের জন্য।','description_en'=>'A practical backpack for daily use and travel.','price'=>990,'compare_price'=>1190,'category'=>'Bags','image_url'=>'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=900','is_featured'=>false]
  ];
  foreach($items as $item)Product::firstOrCreate(['name_en'=>$item['name_en']],$item);
 }
}
