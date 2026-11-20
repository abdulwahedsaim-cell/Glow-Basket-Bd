<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
 public function up():void{Schema::create('orders',function(Blueprint $t){$t->id();$t->string('order_number')->unique();$t->string('customer_name');$t->string('phone',25);$t->string('email')->nullable();$t->text('address');$t->string('city');$t->text('note')->nullable();$t->decimal('subtotal',10,2);$t->decimal('delivery_fee',10,2);$t->decimal('total',10,2);$t->string('status')->default('pending');$t->string('payment_method')->default('cash_on_delivery');$t->timestamps();});}
 public function down():void{Schema::dropIfExists('orders');}
};
