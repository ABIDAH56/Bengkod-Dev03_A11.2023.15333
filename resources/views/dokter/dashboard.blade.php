@extends('layouts.app', ['title' => 'Dashboard Dokter'])

@section('content')
<div class="card bg-base-100 shadow">
    <div class="card-body">
        <h2 class="card-title">Selamat datang, {{ auth()->user()->nama }}</h2>
        <p>Anda login sebagai <span class="badge badge-secondary">Dokter</span>
            @if (auth()->user()->poli) di {{ auth()->user()->poli->nama_poli }} @endif.</p>
    </div>
</div>
@endsection
