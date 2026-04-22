@extends('layouts.faculty', [
    'title' => 'Profile History',
    'breadcrumbs' => [
        ['label' => 'Faculty Portal', 'url' => route('faculty.dashboard')],
        ['label' => 'My Profile', 'url' => route('faculty.profile.edit')],
        ['label' => 'Change Log']
    ]
])

@section('faculty_content')
@php
    use Illuminate\Support\Str;
@endphp
<div class="space-y-6 max-w-4xl">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
        <div>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight">Profile Data Logs</h1>
            <p class="text-slate-500 font-medium mt-1">Audit log of all modifications made to your credentials and settings</p>
        </div>
        <a href="{{ route('faculty.profile.edit') }}" class="px-5 py-2.5 bg-slate-900 text-white hover:bg-slate-800 rounded-xl font-bold shadow-sm transition-all text-sm flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Back to Edit Mode
        </a>
    </div>

    <!-- Timeline -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        @if($activities->isNotEmpty())
            <div class="relative py-4">
                @foreach($activities as $index => $activity)
                    <div class="px-8 py-6 relative @if(!$loop->last) border-b border-slate-100 @endif">
                        <!-- Connector Line -->
                        @if(!$loop->last)
                            <div class="absolute top-[80px] bottom-[-24px] left-[52px] w-0.5 bg-slate-100"></div>
                        @endif

                        <div class="flex items-start">
                            <!-- Timeline Dot -->
                            <div class="relative z-10 flex-shrink-0 mr-6">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center border-4 border-white shadow-sm
                                    @if($activity->event === 'created') bg-green-100 text-green-600
                                    @elseif($activity->event === 'updated') bg-blue-100 text-blue-600
                                    @elseif($activity->event === 'deleted') bg-red-100 text-red-600
                                    @else bg-slate-100 text-slate-600 @endif">
                                    @if($activity->event === 'created')
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                    @elseif($activity->event === 'updated')
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    @elseif($activity->event === 'deleted')
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    @else
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                    @endif
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="flex-1 min-w-0">
                                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-3 gap-2">
                                    <div class="flex items-center gap-3">
                                        <p class="font-bold text-slate-900 text-lg">System Modification</p>
                                        <span class="inline-flex px-2.5 py-0.5 text-[10px] font-black uppercase tracking-widest rounded border 
                                            @if($activity->event === 'created') bg-green-50 text-green-700 border-green-200
                                            @elseif($activity->event === 'updated') bg-blue-50 text-blue-700 border-blue-200
                                            @elseif($activity->event === 'deleted') bg-red-50 text-red-700 border-red-200
                                            @else bg-slate-50 text-slate-700 border-slate-200 @endif">
                                            {{ $activity->event }}
                                        </span>
                                    </div>
                                    <div class="text-right flex flex-row sm:flex-col items-center sm:items-end gap-2 sm:gap-0">
                                        <p class="text-xs font-bold text-slate-600 uppercase tracking-widest">{{ $activity->created_at->format('M d, Y') }}</p>
                                        <p class="text-[10px] font-bold text-slate-400 font-mono">{{ $activity->created_at->format('h:i:s A') }}</p>
                                    </div>
                                </div>

                                <!-- Changes Diff -->
                                @if($activity->changes && !empty($activity->changes))
                                    @if(isset($activity->changes['old']) && is_array($activity->changes['old']))
                                        <div class="bg-slate-50 rounded-xl p-5 border border-slate-100">
                                            <p class="text-[10px] font-black text-slate-400 tracking-widest uppercase mb-3 text-center sm:text-left">Modified Data Nodes</p>
                                            <div class="space-y-4">
                                                @foreach($activity->changes['old'] as $field => $oldValue)
                                                    @if(isset($activity->changes['new'][$field]))
                                                        <div>
                                                            <p class="text-xs font-bold text-slate-700 capitalize mb-2 tracking-wide">{{ str_replace('_', ' ', $field) }}</p>
                                                            <div class="flex flex-col sm:flex-row sm:items-stretch gap-2">
                                                                <div class="flex-1 bg-white border border-red-100 rounded-lg p-3 relative overflow-hidden">
                                                                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-red-400"></div>
                                                                    <p class="text-[10px] font-black text-red-400 uppercase tracking-widest mb-1.5 pl-2">Previous</p>
                                                                    <p class="text-sm text-slate-700 break-words font-mono pl-2">
                                                                        {{ is_array($oldValue) ? json_encode($oldValue) : (Str::limit($oldValue, 120)) ?: 'NULL' }}
                                                                    </p>
                                                                </div>
                                                                <div class="hidden sm:flex items-center justify-center text-slate-300">
                                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                                                </div>
                                                                <div class="flex-1 bg-white border border-green-100 rounded-lg p-3 relative overflow-hidden">
                                                                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-emerald-400"></div>
                                                                    <p class="text-[10px] font-black text-emerald-500 uppercase tracking-widest mb-1.5 pl-2">Current</p>
                                                                    <p class="text-sm text-slate-900 break-words font-mono pl-2 font-medium">
                                                                        {{ is_array($activity->changes['new'][$field]) ? json_encode($activity->changes['new'][$field]) : (Str::limit($activity->changes['new'][$field], 120)) ?: 'NULL' }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <div class="bg-slate-50 border border-slate-100 p-4 rounded-xl">
                                        <p class="text-sm text-slate-500 font-medium">Initial system bootstrapping context.</p>
                                    </div>
                                @endif
                                
                                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mt-3 flex items-center justify-end">
                                    <svg class="w-3.5 h-3.5 mr-1 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    {{ $activity->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($activities->hasPages())
                <div class="px-8 py-5 border-t border-slate-100 bg-slate-50">
                    {{ $activities->links() }}
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="px-6 py-20 text-center">
                <div class="inline-flex w-16 h-16 rounded-full bg-slate-100 items-center justify-center mb-4">
                    <svg class="h-8 w-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 tracking-tight">No Modifications Recorded</h3>
                <p class="mt-1 text-sm font-medium text-slate-500">Your profile change history log is currently empty.</p>
            </div>
        @endif
    </div>

    <!-- Summary Widgets Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 flex flex-col items-center justify-center">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Network Syncs</p>
            <p class="text-4xl font-black text-tangerine-600">{{ $activities->total() }}</p>
        </div>
        
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 flex flex-col items-center justify-center text-center">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">State Updated</p>
            @if($faculty->profile_last_updated_at)
                <p class="text-lg font-bold text-slate-900">{{ $faculty->profile_last_updated_at->format('M d, Y') }}</p>
                <p class="text-xs text-slate-500 font-medium">{{ $faculty->profile_last_updated_at->diffForHumans() }}</p>
            @else
                <p class="text-lg font-bold text-slate-400 italic">Never</p>
            @endif
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 flex flex-col items-center justify-center text-center">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Node Creation</p>
            <p class="text-lg font-bold text-slate-900">{{ $faculty->created_at->format('M d, Y') }}</p>
            <p class="text-xs text-slate-500 font-medium">{{ $faculty->created_at->diffForHumans() }}</p>
        </div>
    </div>
</div>
@endsection
