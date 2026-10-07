@extends('layouts.app', ['title' => 'Dashboard Admin'])

@section('content')
<div class="card bg-base-100 shadow">
    <div class="card-body">
        <h2 class="card-title">Selamat datang, {{ auth()->user()->nama }}</h2>
        <p>Anda login sebagai <span class="badge badge-primary">Admin</span>.</p>
    </div>
</div>
@endsection
