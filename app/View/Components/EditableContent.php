<?php

namespace App\View\Components;

use App\Models\PageContent;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EditableContent extends Component
{
    public function __construct(
        public string $pageSlug,
        public string $sectionKey,
        public string $default = '',
        public bool $richText = false,
    ) {}

    public function render(): View|Closure|string
    {
        $content = PageContent::getContent($this->pageSlug, $this->sectionKey, $this->default);

        return view('components.editable-content', [
            'content' => $content,
            'pageSlug' => $this->pageSlug,
            'sectionKey' => $this->sectionKey,
            'richText' => $this->richText,
        ]);
    }
}
