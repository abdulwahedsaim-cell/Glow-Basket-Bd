<?php
namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller {
 public function login(){return view('admin.login');}
 public function authenticate(Request $request){
  $data=$request->validate(['email'=>'required|email','password'=>'required|string']);
  $email=(string)env('ADMIN_EMAIL','admin@glowbasketbd.com');$password=(string)env('ADMIN_PASSWORD','');
  if($password!=='' && hash_equals(strtolower($email),strtolower($data['email'])) && hash_equals($password,$data['password'])){
   $request->session()->regenerate();$request->session()->put('is_admin',true);return redirect()->route('admin.orders');
  }
  return back()->withErrors(['email'=>'লগইন তথ্য সঠিক নয়। Check your login details.']);
 }
 public function orders(Request $request){
  $orders=Order::with('items')->latest()->paginate(20);
  $stats=['total'=>Order::count(),'pending'=>Order::where('status','pending')->count(),'sales'=>Order::where('status','!=','cancelled')->sum('total')];
  return view('admin.orders',compact('orders','stats'));
 }
 public function updateStatus(Request $request,Order $order){
  $data=$request->validate(['status'=>'required|in:pending,confirmed,shipped,delivered,cancelled']);
  $order->update(['status'=>$data['status']]);return back()->with('success','অর্ডারের অবস্থা আপডেট হয়েছে।');
 }
 public function logout(Request $request){$request->session()->forget('is_admin');$request->session()->invalidate();$request->session()->regenerateToken();return redirect()->route('admin.login');}
}
