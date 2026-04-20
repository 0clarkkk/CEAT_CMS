<?php

declare(strict_types=1);

namespace App\View\Composers;

use Illuminate\View\View;

class NavigationComposer
{
    /**
     * Define the navigation hierarchy structure.
     * This array defines all menu items with their dropdown categories and links.
     *
     * @var array<string, array|string>
     */
    private array $navigationStructure = [
        'About' => [
            'items' => [
                ['label' => 'The College', 'url' => '/about/college'],
                ['label' => 'History', 'url' => '/about/history'],
            ],
        ],
        'Academics' => [
            'items' => [
                ['label' => 'Programs & Degrees', 'url' => '/academics/programs'],
                ['label' => 'Research Centers', 'url' => '/academics/research'],
                ['label' => 'Departments', 'url' => '/academics/departments'],
                ['label' => 'Curriculum', 'url' => '/academics/curriculum'],
            ],
        ],
        'Faculty & Staff' => [
            'items' => [
                ['label' => 'Faculty Directory', 'url' => '/faculty/directory'],
                ['label' => 'Consultation Hours', 'url' => '/faculty/consultation'],
            ],
        ],
        'Students' => [
            'items' => [
                ['label' => 'Rules & Regulations', 'url' => '/student/rules'],
                ['label' => 'Downloadables', 'url' => '/downloads'],
                ['label' => 'Student Portal', 'url' => '/student/portal'],
            ],
        ],
        'News & Events' => '/news', // Single link (no dropdown)
    ];

    /**
     * Compose the navigation data and pass it to views.
     */
    public function compose(View $view): void
    {
        $navigationItems = $this->getNavigationItems();
        $view->with('navigationItems', $navigationItems);
    }

    /**
     * Get the formatted navigation items with icons and additional metadata.
     *
     * @return array<string, mixed>
     */
    public function getNavigationItems(): array
    {
        $items = [];

        foreach ($this->navigationStructure as $key => $value) {
            if (is_string($value)) {
                // Single link without dropdown
                $items[$key] = [
                    'type' => 'single',
                    'url' => $value,
                    'label' => $key,
                    'hasDropdown' => false,
                ];
            } else {
                // Item with dropdown
                $items[$key] = [
                    'type' => 'dropdown',
                    'label' => $key,
                    'hasDropdown' => true,
                    'items' => $value['items'] ?? [],
                ];
            }
        }

        return $items;
    }

    /**
     * Get navigation structure (useful for caching or seeding database later).
     *
     * @return array<string, array|string>
     */
    public function getStructure(): array
    {
        return $this->navigationStructure;
    }
}
