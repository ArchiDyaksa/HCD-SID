@extends('layouts.admin')

@section('title', 'Data Penduduk')

@section('content')

<!-- Header Action & Search -->
<div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-8">
    <form method="GET" class="w-full sm:w-auto flex gap-2">
        <div class="relative flex-grow sm:w-80">
            <i class="ti ti-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-lg"></i>
            <input type="text" name="q" value="{{ $search ?? '' }}" placeholder="Cari nama / NIK / No. KK..."
                   class="w-full border border-slate-200 rounded-2xl pl-11 pr-4 py-2.5 text-xs focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none transition-all">
        </div>
        <button class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold px-5 py-2.5 rounded-2xl text-xs transition-colors flex items-center gap-1.5">
            <span>Cari</span>
        </button>
    </form>
    
    <a href="{{ route('admin.penduduk.create') }}" class="w-full sm:w-auto bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold px-6 py-3 rounded-2xl text-xs shadow-lg shadow-emerald-700/20 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-2">
        <i class="ti ti-user-plus text-base"></i>
        <span>Tambah Data Penduduk</span>
    </a>
</div>

<!-- Table Card -->
<div class="bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/30 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs">
            <thead class="bg-slate-50/80 text-slate-400 uppercase font-bold tracking-wider border-b border-slate-100">
                <tr>
                    <th class="px-6 py-4">NIK</th>
                    <th class="px-6 py-4">Nama Lengkap</th>
                    <th class="px-6 py-4">Jenis Kelamin</th>
                    <th class="px-6 py-4">Alamat RT/RW</th>
                    <th class="px-6 py-4">Pekerjaan</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                @forelse ($penduduks as $p)
                <tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="px-6 py-4 font-mono font-bold text-slate-800">{{ $p->nik }}</td>
                    <td class="px-6 py-4 font-bold text-slate-900">{{ $p->nama }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold {{ $p->jenis_kelamin === 'Laki-laki' ? 'bg-blue-50 text-blue-700' : 'bg-pink-50 text-pink-700' }}">
                            {{ $p->jenis_kelamin }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-slate-500">RT {{ $p->rt }}/RW {{ $p->rw }}, {{ \Illuminate\Support\Str::limit($p->alamat, 30) }}</td>
                    <td class="px-6 py-4">{{ $p->pekerjaan ?: '-' }}</td>
                    <td class="px-6 py-4 text-right whitespace-nowrap space-x-2">
                        <a href="{{ route('admin.penduduk.edit', $p) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-emerald-50 text-slate-600 hover:text-emerald-700 font-bold text-[11px] transition-colors">
                            <i class="ti ti-edit"></i> Ubah
                        </a>
                        <form action="{{ route('admin.penduduk.destroy', $p) }}" method="POST" class="inline" onsubmit="return confirm('Hapus data {{ $p->nama }}?')">
                            @csrf @method('DELETE')
                            <button class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-red-50 text-slate-600 hover:text-red-600 font-bold text-[11px] transition-colors">
                                <i class="ti ti-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-slate-400">Belum ada data penduduk yang terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">{{ $penduduks->links() }}</div>

@endsection

