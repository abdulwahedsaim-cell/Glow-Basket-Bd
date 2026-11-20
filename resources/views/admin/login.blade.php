@extends('layout')
@section('title','Admin Login | Glow Basket BD')
@section('content')<section class="admin-login"><span class="eyebrow">STORE CONTROL</span><h1>Admin sign in</h1><p>শুধু অনুমোদিত স্টোর পরিচালকের জন্য।</p><form method="post" action="{{ route('admin.authenticate') }}">@csrf<label>Email<input type="email" name="email" required></label><label>Password<input type="password" name="password" required></label><button class="btn btn-dark">Sign in →</button></form></section>@endsection
