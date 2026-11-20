@extends('layout')
@section('title','Order received | Glow Basket BD')
@section('content')<section class="empty-state"><div class="success-icon">✓</div><span class="eyebrow">THANK YOU FOR SHOPPING</span><h1>আপনার অর্ডার গ্রহণ করা হয়েছে!</h1><p>Order number: <strong>{{ $order->order_number }}</strong></p><p>আমরা অল্প সময়ের মধ্যে ফোনে আপনার অর্ডার নিশ্চিত করব। We will call you to confirm.</p><a class="btn btn-dark" href="{{ route('home') }}">হোমে ফিরে যান / Back to home</a></section>@endsection
