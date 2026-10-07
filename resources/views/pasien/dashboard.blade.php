@extends('layouts.app', ['title' => 'Dashboard Pasien'])

@section('content')
<div class="card bg-base-100 shadow">
    <div class="card-body">
        <h2 class="card-title">Selamat datang, {{ auth()->user()->nama }}</h2>
        <p>Anda login sebagai <span class="badge badge-accent">Pasien</span>.</p>
        <p>No. Rekam Medis: <span class="font-mono font-semibold">{{ auth()->user()->no_rm }}</span></p>
    </div>
</div>
@endsection
