@extends('Front.layouts.master')

@section('title', 'الأسئلة الشائعة')

@section('header')
    @include('Front.layouts.head')
@endsection

@section('content')
    <div style="margin-top: 50px; margin-bottom: 50px;" class="container">
        <div style="background: #f5f5f5; padding: 25px;" class="container">
            <h2 style="color: black;">{{ __('translate.FAQs') }}</h2>
            <pre style="color: black; margin-top: 15px;">{{ \App\Models\Setting::where('id', 1)->first()->faqs }}</pre>
        </div>
    </div>
@endsection