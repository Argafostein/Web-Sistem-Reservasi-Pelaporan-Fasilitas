@extends('layouts.app')

@section('content')

<div style="padding: 40px;">
    <h1>Dashboard Petugas</h1>

    <p>
        Selamat datang, {{ auth()->user()->name }}.
    </p>

    <p>
        Halaman ini hanya dapat diakses oleh petugas.
    </p>
</div>

@endsection