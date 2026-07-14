@props(['status'])

@php
    $styles = [
        'pending'      => 'bg-amber-50 text-amber-700 border-amber-200 ring-amber-100',
        'dikonfirmasi' => 'bg-blue-50 text-blue-700 border-blue-200 ring-blue-100',
        'dikerjakan'   => 'bg-orange-50 text-orange-700 border-orange-200 ring-orange-100',
        'selesai'      => 'bg-emerald-50 text-emerald-700 border-emerald-200 ring-emerald-100',
        'dibatalkan'   => 'bg-red-50 text-red-700 border-red-200 ring-red-100',
    ];
    $dots = [
        'pending'      => 'bg-amber-400',
        'dikonfirmasi' => 'bg-blue-500',
        'dikerjakan'   => 'bg-orange-500 animate-pulse',
        'selesai'      => 'bg-emerald-500',
        'dibatalkan'   => 'bg-red-400',
    ];
    $labels = [
        'pending'      => 'Menunggu',
        'dikonfirmasi' => 'Dikonfirmasi',
        'dikerjakan'   => 'Dikerjakan',
        'selesai'      => 'Selesai',
        'dibatalkan'   => 'Dibatalkan',
    ];
@endphp

<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium border
    {{ $styles[$status] ?? 'bg-slate-50 text-slate-700 border-slate-200' }}
    transition-all hover:ring-2 hover:ring-offset-1 {{ isset($styles[$status]) ? 'ring-'.(explode(' ', $styles[$status])[2] ?? '') : '' }}"
    title="{{ $labels[$status] ?? $status }}">
    <span class="w-1.5 h-1.5 rounded-full flex-shrink-0 {{ $dots[$status] ?? 'bg-slate-400' }}"></span>
    {{ $labels[$status] ?? $status }}
</span>
