<div 
    class="editable-content group relative"
    data-page-slug="{{ $pageSlug ?? $attributes->get('page-slug', '') }}"
    data-section-key="{{ $sectionKey ?? $attributes->get('section-key', '') }}"
>
    @auth
        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'superadmin')
            <div class="absolute top-0 right-0 opacity-0 group-hover:opacity-100 transition-opacity z-10">
                <button 
                    type="button"
                    class="inline-flex items-center gap-1 px-2 py-1 bg-maroon-600 hover:bg-maroon-700 text-white text-xs font-bold rounded transition-colors"
                    @click="openEditModal('{{ $pageSlug ?? $attributes->get('page-slug', '') }}', '{{ $sectionKey ?? $attributes->get('section-key', '') }}')"
                    title="Edit this content"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit
                </button>
            </div>
        @endif
    @endauth

    @php
        $pageSlugVal = $pageSlug ?? $attributes->get('page-slug', '');
        $sectionKeyVal = $sectionKey ?? $attributes->get('section-key', '');
        $content = \App\Models\PageContent::getContent($pageSlugVal, $sectionKeyVal, $default ?? '');
        $isRichText = filter_var($richText ?? false, FILTER_VALIDATE_BOOLEAN);
    @endphp

    @if($isRichText)
        <div class="prose prose-sm max-w-none">
            {!! $content !!}
        </div>
    @else
        <div>
            {!! nl2br(e($content)) !!}
        </div>
    @endif
</div>
