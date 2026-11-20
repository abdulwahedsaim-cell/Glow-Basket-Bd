<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Order extends Model {
 protected $fillable=['order_number','customer_name','phone','email','address','city','note','subtotal','delivery_fee','total','status','payment_method','payment_sender','payment_transaction_id','payment_status'];
 protected $casts=['subtotal'=>'decimal:2','delivery_fee'=>'decimal:2','total'=>'decimal:2'];
 public function items(){return $this->hasMany(OrderItem::class);}
}
