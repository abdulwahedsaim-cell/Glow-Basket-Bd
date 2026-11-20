<?php
namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class StoreController extends Controller {
 public function home(Request $request){
  $query=Product::where('is_active',true);
  if($request->filled('q')) $query->where(fn($q)=>$q->where('name_en','like','%'.$request->q.'%')->orWhere('name_bn','like','%'.$request->q.'%'));
  $products=$query->orderByDesc('is_featured')->latest()->paginate(12)->withQueryString();
  return view('home',compact('products'));
 }
 public function show(Product $product){abort_unless($product->is_active,404);return view('product',compact('product'));}
 public function addToCart(Request $request, Product $product){
  abort_unless($product->is_active,404);
  $data=$request->validate(['quantity'=>'required|integer|min:1|max:10']);
  $cart=$request->session()->get('cart',[]);
  $cart[$product->id]=min(10,($cart[$product->id]??0)+(int)$data['quantity']);
  $request->session()->put('cart',$cart);
  return redirect()->route('cart')->with('success','পণ্যটি কার্টে যোগ হয়েছে। Added to cart.');
 }
 public function cart(Request $request){
  $cart=$request->session()->get('cart',[]);$products=Product::whereIn('id',array_keys($cart))->get();
  $items=$products->map(fn($p)=>['product'=>$p,'quantity'=>$cart[$p->id],'line'=>$p->price*$cart[$p->id]]);
  $subtotal=$items->sum('line');return view('cart',compact('items','subtotal'));
 }
 public function updateCart(Request $request){
  $data=$request->validate(['quantities'=>'required|array','quantities.*'=>'required|integer|min:0|max:10']);
  $cart=$request->session()->get('cart',[]);
  foreach($data['quantities'] as $id=>$qty){if($qty===0)unset($cart[$id]);elseif(isset($cart[$id]))$cart[$id]=$qty;}
  $request->session()->put('cart',$cart);return redirect()->route('cart')->with('success','কার্ট আপডেট হয়েছে। Cart updated.');
 }
 public function checkout(Request $request){
  $cart=$request->session()->get('cart',[]);abort_if(empty($cart),404);
  $products=Product::whereIn('id',array_keys($cart))->where('is_active',true)->get();
  $items=$products->map(fn($p)=>['product'=>$p,'quantity'=>$cart[$p->id]??0,'line'=>$p->price*($cart[$p->id]??0)]);
  $subtotal=$items->sum('line');return view('checkout',compact('items','subtotal'));
 }
 public function placeOrder(Request $request){
  $data=$request->validate(['customer_name'=>'required|string|max:120','phone'=>'required|string|max:25','email'=>'nullable|email|max:150','address'=>'required|string|max:1000','city'=>'required|string|max:100','note'=>'nullable|string|max:1000','payment_method'=>'required|in:cash_on_delivery,bkash_manual,nagad_manual','payment_sender'=>'nullable|string|max:25','payment_transaction_id'=>'nullable|string|max:100']);
  $cart=$request->session()->get('cart',[]);if(empty($cart)) return redirect()->route('cart');
  $products=Product::whereIn('id',array_keys($cart))->where('is_active',true)->get();
  abort_if($products->count()!==count($cart),422,'Some cart items are no longer available.');
  $subtotal=$products->sum(fn($p)=>$p->price*$cart[$p->id]);$delivery=70;
  $order=DB::transaction(function()use($data,$products,$cart,$subtotal,$delivery){
   $order=Order::create(['order_number'=>'GB'.now()->format('ymd').strtoupper(Str::random(5)),'customer_name'=>$data['customer_name'],'phone'=>$data['phone'],'email'=>$data['email']??null,'address'=>$data['address'],'city'=>$data['city'],'note'=>$data['note']??null,'subtotal'=>$subtotal,'delivery_fee'=>$delivery,'total'=>$subtotal+$delivery,'status'=>'pending','payment_method'=>$data['payment_method'],'payment_sender'=>$data['payment_sender']??null,'payment_transaction_id'=>$data['payment_transaction_id']??null,'payment_status'=>$data['payment_method']==='cash_on_delivery'?'unpaid':'verification_pending']);
   foreach($products as $p){$qty=$cart[$p->id];$order->items()->create(['product_id'=>$p->id,'product_name'=>$p->name_en,'quantity'=>$qty,'unit_price'=>$p->price,'line_total'=>$p->price*$qty]);}
   return $order;
  });
  $request->session()->forget('cart');return view('thank-you',compact('order'));
 }
}
