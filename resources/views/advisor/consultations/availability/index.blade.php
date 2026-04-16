@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Availability Slots</h1>
                    <p class="text-gray-600 dark:text-gray-400 mt-2">Manage your consultation availability</p>
                </div>
                <a href="{{ route('advisor.consultations.availability.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add Slots
                </a>
            </div>
        </div>

        <!-- Slots Table -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
            @if($slots->count() > 0)
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date & Time</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Duration</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Location</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($slots as $slot)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                {{ $slot->start_time->format('M d, Y') }}
                            </div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">
                                {{ $slot->start_time->format('h:i A') }} - {{ $slot->end_time->format('h:i A') }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">
                            {{ $slot->getFormattedDuration() }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">
                            {{ $slot->location ?? '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if($slot->status === 'available')
                                    bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-100
                                @elseif($slot->status === 'booked')
                                    bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-100
                                @else
                                    bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-100
                                @endif
                            ">
                                {{ ucfirst($slot->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                            <a href="{{ route('advisor.consultations.availability.edit', $slot->id) }}" class="text-indigo-600 hover:text-indigo-700">Edit</a>
                            @if(!$slot->isBooked())
                            <button onclick="if(confirm('Delete this slot?')) { document.getElementById('delete-form-{{ $slot->id }}').submit(); }" class="text-red-600 hover:text-red-700">Delete</button>
                            <form id="delete-form-{{ $slot->id }}" action="{{ route('advisor.consultations.availability.delete', $slot->id) }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                            @else
                            <span class="text-gray-400 cursor-not-allowed">Delete</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            @if($slots->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                {{ $slots->links() }}
            </div>
            @endif
            @else
            <div class="p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No availability slots</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Create your first availability slot to accept consultation requests.</p>
                <div class="mt-6">
                    <a href="{{ route('advisor.consultations.availability.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Create Availability Slots
                    </a>
                </div>
            </div>
            @endif
        </div>

        <!-- Info Box -->
        <div class="mt-6 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-md p-4">
            <h3 class="text-sm font-medium text-blue-800 dark:text-blue-200">Availability Management:</h3>
            <ul class="mt-2 text-sm text-blue-700 dark:text-blue-300 list-disc list-inside space-y-1">
                <li>Create slots when you're available for consultations</li>
                <li>Slots are automatically marked as "booked" when scheduled</li>
                <li>You can edit or delete available slots</li>
                <li>Booked slots cannot be deleted but can be rescheduled</li>
                <li>Set different locations for different slots if needed</li>
            </ul>
        </div>
    </div>
</div>
@endsection
