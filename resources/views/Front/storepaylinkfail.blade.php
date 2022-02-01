@extends('Front.layouts.master')

@section('title', 'فشل العملية')

@section('header')
    @include('Front.layouts.head')
@endsection

@section('content')
    <div style="margin-top: 50px; margin-bottom: 50px;" class="container">
        <div style="background: #f5f5f5; padding: 25px;" class="container">
            <h2 style="color: black;">فشلت العملية</h2>
            <p style="color: black; margin-top: 15px;">
                عذراً رابط الدفع غير فعال
            </p>
        </div>
    </div>
@endsection