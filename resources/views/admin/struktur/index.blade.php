@extends('layouts.admin')

@section('title', 'Struktur Organisasi')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-navy-950 tracking-tight">Struktur Organisasi</h1>
            <p class="text-sm text-gray-500 mt-1">Susunan jabatan & pejabat yang tampil sebagai bagan di halaman Profil.</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('tentang-kami') }}#{{ \App\Models\Halaman::SLUG_STRUKTUR }}" target="_blank" rel="noopener"
               class="inline-flex items-center gap-1.5 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                Lihat bagan <x-panah arah="serong" />
            </a>
            <a href="{{ route('admin.struktur.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-emas-500 hover:bg-emas-400 text-navy-950 font-semibold text-sm rounded-lg shadow-lg shadow-emas-500/20 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                Tambah Jabatan
            </a>
        </div>
    </div>

    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
        @if(empty($daftar))
            <div class="p-10 text-center">
                <p class="text-sm font-semibold text-navy-950">Belum ada jabatan.</p>
                <p class="mt-1 text-sm text-gray-500">Mulai dari pimpinan tertinggi (Kepala Rutan), lalu tambahkan bawahannya.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full min-w-[640px] text-left text-sm text-gray-700">
                    <thead class="text-xs uppercase tracking-wider text-gray-500 border-b border-gray-200 bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3 px-4">Jabatan & pejabat</th>
                            <th scope="col" class="py-3 px-4 w-44">NIP</th>
                            <th scope="col" class="py-3 px-4 w-16 text-center">Urut</th>
                            <th scope="col" class="py-3 px-4 w-40 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($daftar as ['jabatan' => $item, 'kedalaman' => $kedalaman])
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-3 px-4">
                                    <div class="flex items-center gap-3" style="padding-left: {{ $kedalaman * 1.75 }}rem">
                                        @if($kedalaman > 0)
                                            <span class="-ml-4 h-4 w-3 shrink-0 rounded-bl border-b-2 border-l-2 border-gray-300" aria-hidden="true"></span>
                                        @endif
                                        @if($item->foto)
                                            <img src="{{ asset('storage/' . $item->foto) }}" alt="" class="h-9 w-9 shrink-0 rounded-full object-cover">
                                        @else
                                            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-navy-50 text-xs font-bold text-navy-700" aria-hidden="true">{{ $item->inisial }}</span>
                                        @endif
                                        <div class="min-w-0">
                                            <a href="{{ route('admin.struktur.edit', $item) }}" class="font-semibold text-navy-950 hover:text-emas-700 transition">{{ $item->jabatan }}</a>
                                            <p class="text-xs {{ $item->nama ? 'text-gray-600' : 'italic text-gray-400' }}">{{ $item->nama ?: 'Nama belum diisi' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 px-4 text-xs font-mono text-gray-500">{{ $item->nip ?: '—' }}</td>
                                <td class="py-3 px-4 text-center text-xs font-mono text-gray-500">{{ $item->urutan }}</td>
                                <td class="py-3 px-4 text-center">
                                    <div class="inline-flex items-center gap-1.5">
                                        <a href="{{ route('admin.struktur.create', ['atasan' => $item->id]) }}"
                                           class="p-1.5 text-gray-700 hover:text-emas-700 hover:bg-gray-100 rounded-lg transition" title="Tambah bawahan">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                                            <span class="sr-only">Tambah bawahan {{ $item->jabatan }}</span>
                                        </a>
                                        <a href="{{ route('admin.struktur.edit', $item) }}"
                                           class="p-1.5 text-gray-700 hover:text-emas-700 hover:bg-gray-100 rounded-lg transition" title="Ubah jabatan">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            <span class="sr-only">Ubah {{ $item->jabatan }}</span>
                                        </a>
                                        <form action="{{ route('admin.struktur.destroy', $item) }}" method="POST" class="inline"
                                              onsubmit="return confirm({{ \Illuminate\Support\Js::from('Hapus jabatan "' . $item->jabatan . '"? Bawahannya akan dipindahkan ke atasan jabatan ini.') }})">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 text-gray-700 hover:text-red-600 hover:bg-gray-100 rounded-lg transition" title="Hapus jabatan">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                <span class="sr-only">Hapus {{ $item->jabatan }}</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
