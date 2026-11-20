<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
 public function up():void{Schema::create('products',function(Blueprint $t){$t->id();$t->string('name_bn');$t->string('name_en');$t->text('description_bn')->nullable();$t->text('description_en')->nullable();$t->decimal('price',10,2);$t->decimal('compare_price',10,2)->nullable();$t->string('image_url')->nullable();$t->string('category')->default('General');$t->boolean('is_featured')->default(false);$t->boolean('is_active')->default(true);$t->timestamps();});}
 public function down():void{Schema::dropIfExists('products');}
};
