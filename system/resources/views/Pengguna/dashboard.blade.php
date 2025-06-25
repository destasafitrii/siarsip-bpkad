@extends('template.admin')

@section('content')
<div class="page-content">
    <div class="container">
        <h3>Selamat datang, {{ Auth::user()->name }}</h3>
        <p>Gunakan menu di atas untuk mencari arsip.</p>
        <p>Ini debug teks. Kalau ini muncul, berarti layout berfungsi.</p>
    </div>
@endsection
