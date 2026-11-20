<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
 public function up():void{
  Schema::table('orders',function(Blueprint $t){
   $t->string('payment_method')->default('cash_on_delivery')->change();
   $t->string('payment_sender')->nullable();
   $t->string('payment_transaction_id')->nullable();
   $t->string('payment_status')->default('unpaid');
  });
 }
 public function down():void{
  Schema::table('orders',function(Blueprint $t){
   $t->dropColumn(['payment_sender','payment_transaction_id','payment_status']);
  });
 }
};
