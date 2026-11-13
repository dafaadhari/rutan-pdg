@extends('layouts.admin')

@section('title', 'Ubah Jabatan')

@section('content')
    @include('admin.struktur._form', [
        'aksi' => route('admin.struktur.update', $jabatan),
        'metode' => 'PUT',
        'judulForm' => 'Ubah jabatan',
        'labelSimpan' => 'Simpan perubahan',
    ])
@endsection
