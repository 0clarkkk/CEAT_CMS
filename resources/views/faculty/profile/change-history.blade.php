@extends('layouts.app')

@section('content')
@php
    use Illuminate\Support\Str;
@endphp
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Profile Change History</h1>
                    <p class="mt-2 text-gray-600">Track all updates made to your profile</p>
                </div>
                <a href="{{ route('faculty.profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Back
                </a>
            </div>
        </div>

        <!-- Info Box -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
            <div class="flex items-start">
                <svg class="h-5 w-5 text-blue-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <div>
                    <p class="text-sm font-medium text-blue-900">Activity Log</p>
                    <p class="text-sm text-blue-700 mt-1">All changes to your profile are automatically logged for security and audit purposes.</p>
                </div>
            </div>
        </div>

        <!-- Timeline -->
        <div class="bg-white rounded-lg shadow">
            @if($activities->isNotEmpty())
                <div class="relative">
                    @foreach($activities as $index => $activity)
                        <div class="px-6 py-6 @if(!$loop->last) border-b border-gray-200 @endif">
                            <div class="flex items-start">
                                <!-- Timeline Dot -->
                                <div class="flex items-center justify-center mr-6">
                                    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-100 border-2 border-blue-500">
                                        @if($activity->event === 'created')
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                        @elseif($activity->event === 'updated')
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        @elseif($activity->event === 'deleted')
                                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        @else
                                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                        @endif
                                    </div>
                                </div>

                                <!-- Content -->
                                <div class="flex-1 min-w-0">
                                    <!-- Header -->
                                    <div class="flex items-center justify-between mb-2">
                                        <div>
                                            <p class="font-semibold text-gray-900">
                                                Profile 
                                                <span class="inline-block px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded">
                                                    {{ ucfirst($activity->event) }}
                                                </span>
                                            </p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm text-gray-500">{{ $activity->created_at->format('M d, Y') }}</p>
                                            <p class="text-xs text-gray-400">{{ $activity->created_at->format('h:i A') }}</p>
                                        </div>
                                    </div>

                                    <!-- Changes -->
                                    @if($activity->changes && !empty($activity->changes))
                                        <div class="mt-3 bg-gray-50 rounded p-4">
                                            @if(isset($activity->changes['old']))
                                                <div class="mb-3">
                                                    <p class="text-xs font-medium text-gray-600 mb-1">CHANGED FIELDS:</p>
                                                    <div class="space-y-2">
                                                        @foreach($activity->changes['old'] as $field => $oldValue)
                                                            @if(isset($activity->changes['new'][$field]))
                                                                <div class="text-sm">
                                                                    <p class="font-medium text-gray-800 capitalize">{{ str_replace('_', ' ', $field) }}</p>
                                                                    <div class="flex items-center gap-2 mt-1">
                                                                        <div class="flex-1 bg-red-50 border border-red-200 rounded px-3 py-2">
                                                                            <p class="text-xs text-gray-600">Before:</p>
                                                                            <p class="text-sm text-red-700 break-words">
                                                                                {{ is_array($oldValue) ? json_encode($oldValue) : (Str::limit($oldValue, 100)) }}
                                                                            </p>
                                                                        </div>
                                                                        <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                                                        <div class="flex-1 bg-green-50 border border-green-200 rounded px-3 py-2">
                                                                            <p class="text-xs text-gray-600">After:</p>
                                                                            <p class="text-sm text-green-700 break-words">
                                                                                {{ is_array($activity->changes['new'][$field]) ? json_encode($activity->changes['new'][$field]) : (Str::limit($activity->changes['new'][$field], 100)) }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        <p class="text-sm text-gray-500">Initial profile creation</p>
                                    @endif

                                    <!-- Footer -->
                                    <div class="mt-3 flex items-center text-xs text-gray-500 space-x-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        <span>
                                            {{ $activity->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($activities->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $activities->links() }}
                    </div>
                @endif
            @else
                <!-- Empty State -->
                <div class="px-6 py-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900">No Activity</h3>
                    <p class="mt-1 text-gray-500">Profile changes will appear here.</p>
                </div>
            @endif
        </div>

        <!-- Summary Statistics -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="text-center">
                    <p class="text-gray-600 font-medium">Total Changes</p>
                    <p class="text-3xl font-bold text-blue-600 mt-2">{{ $activities->total() }}</p>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="text-center">
                    <p class="text-gray-600 font-medium">Last Updated</p>
                    @if($faculty->profile_last_updated_at)
                        <p class="text-lg font-semibold text-gray-900 mt-2">{{ $faculty->profile_last_updated_at->format('M d, Y') }}</p>
                        <p class="text-sm text-gray-500">{{ $faculty->profile_last_updated_at->diffForHumans() }}</p>
                    @else
                        <p class="text-lg font-semibold text-gray-900 mt-2">Never</p>
                    @endif
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="text-center">
                    <p class="text-gray-600 font-medium">Account Created</p>
                    <p class="text-lg font-semibold text-gray-900 mt-2">{{ $faculty->created_at->format('M d, Y') }}</p>
                    <p class="text-sm text-gray-500">{{ $faculty->created_at->diffForHumans() }}</p>
                </div>
            </div>
        </div>

        <!-- Data Privacy Notice -->
        <div class="mt-8 bg-gray-50 rounded-lg p-6 border border-gray-200">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-gray-600 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                <div>
                    <p class="font-medium text-gray-900">Data Privacy</p>
                    <p class="text-sm text-gray-600 mt-1">All changes to your profile are securely logged and retained for administrative purposes. This history is only visible to you and system administrators. For more information, please review our privacy policy.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
