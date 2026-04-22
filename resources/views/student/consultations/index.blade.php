@extends('layouts.app')

@section('content')
{{-- =============================================================== --}}
{{-- HERO HEADER --}}
{{-- =============================================================== --}}
<section class="relative overflow-hidden"
    style="background: linear-gradient(135deg, #FF6B00 0%, #E55D00 40%, #1F2937 100%);">
    {{-- Subtle mesh overlay --}}
    <div class="absolute inset-0 opacity-10"
        style="background-image: url('data:image/svg+xml,%3Csvg width=%2260%22 height=%2260%22 viewBox=%220 0 60 60%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cg fill=%22none%22 fill-rule=%22evenodd%22%3E%3Cg fill=%22%23ffffff%22 fill-opacity=%220.4%22%3E%3Cpath d=%22M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z%22/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
    </div>
    {{-- Glow orbs --}}
    <div class="absolute -top-32 -right-32 w-96 h-96 rounded-full blur-3xl" style="background: rgba(255,255,255,0.08);">
    </div>
    <div class="absolute -bottom-20 -left-20 w-72 h-72 rounded-full blur-3xl" style="background: rgba(255,107,0,0.15);">
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-24">
        <div class="flex flex-col md:flex-row items-start md:items-end justify-between gap-8">
            <div>
                <span
                    class="inline-flex items-center gap-2 rounded-full px-4 py-1.5 text-xs font-bold uppercase tracking-widest"
                    style="background: rgba(255,255,255,0.1); color: #FFF; border: 1px solid rgba(255,255,255,0.25);">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z"
                            clip-rule="evenodd" />
                    </svg>
                    Student Portal
                </span>
                <h1 class="mt-5 text-4xl sm:text-5xl font-black tracking-tight leading-tight" style="color: #ffffff;">
                    My Consultations
                </h1>
                <p class="mt-3 text-base sm:text-lg max-w-xl leading-relaxed" style="color: rgba(255,255,255,0.8);">
                    View, manage, and track every consultation request in one place.
                </p>
            </div>

            <a href="{{ route('student.consultations.create') }}"
                class="group inline-flex items-center gap-3 rounded-xl px-7 py-3.5 text-sm font-bold shadow-lg transition-all duration-300 hover:-translate-y-0.5 hover:shadow-xl active:scale-95"
                style="background: #ffffff; color: #E55D00;">
                <svg class="w-5 h-5 transition-transform duration-300 group-hover:rotate-90" fill="currentColor"
                    viewBox="0 0 24 24">
                    <path
                        d="M11.25 4.5a.75.75 0 011.5 0v6.75h6.75a.75.75 0 010 1.5h-6.75v6.75a.75.75 0 01-1.5 0v-6.75H4.5a.75.75 0 010-1.5h6.75V4.5z" />
                </svg>
                New Request
            </a>
        </div>
    </div>
</section>

{{-- =============================================================== --}}
{{-- FLOATING FILTER BAR --}}
{{-- =============================================================== --}}
<div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-7" style="margin-top: 20px;">
    <div class="rounded-2xl bg-white shadow-xl ring-1 ring-black/5 p-2 flex flex-wrap items-center gap-1.5">
        @php
        $filters = [
        ['label' => 'All', 'slug' => null],
        ['label' => 'Pending', 'slug' => 'pending'],
        ['label' => 'Approved', 'slug' => 'approved'],
        ['label' => 'Scheduled', 'slug' => 'scheduled'],
        ['label' => 'Completed', 'slug' => 'completed'],
        ];
        @endphp
        @foreach($filters as $filter)
        <a href="{{ route('student.consultations.index', $filter['slug'] ? ['status' => $filter['slug']] : []) }}"
            @class([ 'rounded-xl px-5 py-2.5 text-sm font-semibold transition-all duration-200'
            , 'bg-tangerine-600 text-white shadow-md'=> $selectedStatus === $filter['slug'],
            'text-slate-500 hover:bg-slate-100 hover:text-slate-700' => $selectedStatus !== $filter['slug'],
            ])>
            {{ $filter['label'] }}
        </a>
        @endforeach
    </div>
</div>

{{-- =============================================================== --}}
{{-- CONSULTATION LIST --}}
{{-- =============================================================== --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10" style="margin-top: 20px;">
    <div class="space-y-4">
        @forelse($consultations as $consultation)
        @php
        $statusMap = [
        'pending' => ['dot' => '#f59e0b', 'bg' => '#fffbeb', 'text' => '#92400e', 'ring' => '#fde68a', 'border' =>
        '#f59e0b'],
        'approved' => ['dot' => '#0ea5e9', 'bg' => '#f0f9ff', 'text' => '#0c4a6e', 'ring' => '#bae6fd', 'border' =>
        '#0ea5e9'],
        'scheduled' => ['dot' => '#10b981', 'bg' => '#ecfdf5', 'text' => '#064e3b', 'ring' => '#a7f3d0', 'border' =>
        '#10b981'],
        'completed' => ['dot' => '#8b5cf6', 'bg' => '#f5f3ff', 'text' => '#4c1d95', 'ring' => '#c4b5fd', 'border' =>
        '#8b5cf6'],
        'rejected' => ['dot' => '#ef4444', 'bg' => '#fef2f2', 'text' => '#7f1d1d', 'ring' => '#fecaca', 'border' =>
        '#ef4444'],
        'cancelled' => ['dot' => '#94a3b8', 'bg' => '#f8fafc', 'text' => '#475569', 'ring' => '#e2e8f0', 'border' =>
        '#94a3b8'],
        ];
        $s = $statusMap[$consultation->status] ?? $statusMap['pending'];
        @endphp

        <article
            class="group bg-white rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-[2px] overflow-hidden"
            style="border-left: 5px solid {{ $s['border'] }};">
            {{-- Main clickable area --}}
            <a href="{{ route('student.consultations.show', $consultation->id) }}" class="block p-5 sm:p-6">
                {{-- Row 1: Badge + Timestamp --}}
                <div class="flex items-center justify-between mb-3">
                    <span
                        class="inline-flex items-center gap-1.5 rounded-md px-2.5 py-1 text-[11px] font-bold uppercase tracking-wider"
                        style="background: {{ $s['bg'] }}; color: {{ $s['text'] }}; box-shadow: inset 0 0 0 1px {{ $s['ring'] }};">
                        <span class="w-1.5 h-1.5 rounded-full" style="background: {{ $s['dot'] }};"></span>
                        {{ $consultation->status }}
                    </span>
                    <span class="text-xs text-slate-400 font-medium">
                        {{ $consultation->created_at->diffForHumans() }}
                    </span>
                </div>

                {{-- Row 2: Title --}}
                <h2
                    class="text-lg font-bold text-slate-900 group-hover:text-tangerine-600 transition-colors duration-200 line-clamp-1">
                    {{ $consultation->title }}
                </h2>

                {{-- Row 3: Description --}}
                @if($consultation->description)
                <p class="mt-1 text-sm text-slate-500 line-clamp-2 leading-relaxed">
                    {{ $consultation->description }}
                </p>
                @endif

                {{-- Row 4: Metadata chips --}}
                <div class="mt-4 flex flex-wrap items-center gap-4 text-sm text-slate-500">
                    {{-- Advisor --}}
                    <div class="inline-flex items-center gap-2 min-w-0">
                        <span
                            class="flex-shrink-0 w-6 h-6 rounded-full flex items-center justify-center text-[9px] font-black text-white"
                            style="background: #FF6B00;">
                            {{ strtoupper(substr($consultation->advisor->name, 0, 2)) }}
                        </span>
                        <span class="font-semibold text-slate-700 truncate">{{ $consultation->advisor->name }}</span>
                    </div>

                    <span class="hidden sm:inline text-slate-300">|</span>

                    {{-- Category --}}
                    <div class="inline-flex items-center gap-1.5 min-w-0">
                        <svg class="w-4 h-4 flex-shrink-0 text-slate-400" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M5.25 2.25a3 3 0 00-3 3v4.318a3 3 0 00.879 2.121l9.58 9.581c.92.92 2.39.92 3.298 0l4.318-4.317a2.332 2.332 0 000-3.298L10.745 4.125A3 3 0 008.623 3.25H5.25zM4.5 7.5a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="capitalize">{{ $consultation->category }}</span>
                    </div>

                    <span class="hidden sm:inline text-slate-300">|</span>

                    {{-- Date --}}
                    <div class="inline-flex items-center gap-1.5 min-w-0">
                        <svg class="w-4 h-4 flex-shrink-0 text-slate-400" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M6.75 2.25A.75.75 0 017.5 3v1.5h9V3A.75.75 0 0118 3v1.5h.75a3 3 0 013 3v10.5a3 3 0 01-3 3H5.25a3 3 0 01-3-3V7.5a3 3 0 013-3H6V3a.75.75 0 01.75-.75zm13.5 9H3.75v7.5a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5v-7.5z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>{{ optional($consultation->scheduled_at)->format('M d, Y') ?? 'TBA' }}</span>
                    </div>

                    {{-- Location --}}
                    @if($consultation->location)
                    <span class="hidden sm:inline text-slate-300">|</span>
                    <div class="inline-flex items-center gap-1.5 min-w-0">
                        <svg class="w-4 h-4 flex-shrink-0 text-slate-400" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M11.545 20.91c-.008.007-.015.015-.022.022a1.2 1.2 0 01-1.612 0c-.007-.007-.014-.015-.022-.022-1.041-1.03-3.04-3.046-4.333-4.34a8.73 8.73 0 01-1.251-1.503C3.39 13.554 3 11.83 3 10c0-4.97 4.03-9 9-9s9 4.03 9 9c0 1.83-.39 3.554-1.307 5.067a8.73 8.73 0 01-1.251 1.503c-1.293 1.294-3.292 3.31-4.333 4.34zM12 13a3 3 0 100-6 3 3 0 000 6z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="truncate">{{ $consultation->location }}</span>
                    </div>
                    @endif
                </div>

                {{-- Rejection note --}}
                @if($consultation->status === 'rejected' && $consultation->rejection_reason)
                <div class="mt-4 flex items-start gap-2.5 rounded-lg p-3"
                    style="background: #fef2f2; border: 1px solid #fecaca;">
                    <svg class="w-4 h-4 flex-shrink-0 mt-0.5" style="color: #ef4444;" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.401 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="text-xs leading-relaxed" style="color: #991b1b;">{{
                        Str::limit($consultation->rejection_reason, 150) }}</p>
                </div>
                @endif
            </a>

            {{-- Footer action bar --}}
            <div class="flex items-center justify-between border-t border-slate-100 px-5 sm:px-6 py-3"
                style="background: #f8fafc;">
                <a href="{{ route('student.consultations.show', $consultation->id) }}"
                    class="inline-flex items-center gap-1.5 text-sm font-semibold transition-colors text-tangerine-600 hover:text-tangerine-700">
                    View Details
                    <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M12.97 3.97a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 11-1.06-1.06l6.22-6.22H3a.75.75 0 010-1.5h16.19l-6.22-6.22a.75.75 0 010-1.06z"
                            clip-rule="evenodd" />
                    </svg>
                </a>

                @if($consultation->canBeCancelled())
                <div>
                    <button type="button"
                        onclick="if(confirm('Are you sure you want to cancel this consultation?')){document.getElementById('cancel-form-{{ $consultation->id }}').submit()}"
                        class="text-sm font-medium transition-colors" style="color: #ef4444;">
                        Cancel
                    </button>
                    <form id="cancel-form-{{ $consultation->id }}"
                        action="{{ route('student.consultations.cancel', $consultation->id) }}" method="POST"
                        class="hidden">
                        @csrf
                    </form>
                </div>
                @endif
            </div>
        </article>
        @empty
        {{-- ========== EMPTY STATE ========== --}}
        <div class="flex flex-col items-center justify-center py-28">
            <div class="relative">
                <div class="absolute inset-0 rounded-3xl blur-2xl" style="background: rgba(255,107,0,0.1);"></div>
                <div class="relative w-20 h-20 rounded-3xl flex items-center justify-center"
                    style="background: linear-gradient(135deg, #FFF5EB, #FFE6CC);">
                    <svg class="w-9 h-9 text-tangerine-600" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M6.75 2.25A.75.75 0 017.5 3v1.5h9V3A.75.75 0 0118 3v1.5h.75a3 3 0 013 3v10.5a3 3 0 01-3 3H5.25a3 3 0 01-3-3V7.5a3 3 0 013-3H6V3a.75.75 0 01.75-.75zm13.5 9H3.75v7.5a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5v-7.5z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
            <h2 class="mt-8 text-2xl font-bold text-slate-800">No consultations yet</h2>
            <p class="mt-3 text-sm text-slate-500 max-w-sm text-center leading-relaxed">
                You haven't made any consultation requests{{ $selectedStatus ? ' with status "' . $selectedStatus . '"'
                : '' }}. Start by requesting a new one!
            </p>
            <a href="{{ route('student.consultations.create') }}"
                class="mt-8 inline-flex items-center gap-2 rounded-xl px-7 py-3 text-sm font-bold text-white shadow-lg transition-all duration-300 hover:-translate-y-0.5 bg-tangerine-600 hover:bg-tangerine-700"
                style="padding: 10px;">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M11.25 4.5a.75.75 0 011.5 0v6.75h6.75a.75.75 0 010 1.5h-6.75v6.75a.75.75 0 01-1.5 0v-6.75H4.5a.75.75 0 010-1.5h6.75V4.5z" />
                </svg>
                Create Request
            </a>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($consultations->hasPages())
    <div class="mt-10">
        {{ $consultations->links() }}
    </div>
    @endif
</div>
@endsection