@extends('layouts.admin')

@section('title', 'Tambah Jabatan')

@section('content')
    @include('admin.struktur._form', [
        'aksi' => route('admin.struktur.store'),
        'metode' => 'POST',
        'judulForm' => 'Tambah jabatan',
        'labelSimpan' => 'Simpan jabatan',
    ])
@endsection
