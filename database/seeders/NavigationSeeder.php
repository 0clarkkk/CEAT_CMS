<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\NavigationItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NavigationSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing navigation items
        NavigationItem::query()->delete();

        // Define the navigation structure
        $navigationStructure = [
            [
                'label' => 'About',
                'url' => null,
                'icon' => 'information-circle',
                'sort_order' => 1,
                'children' => [
                    [
                        'label' => 'The College',
                        'url' => '/about/college',
                        'icon' => 'building-library',
                        'sort_order' => 1,
                    ],
                    [
                        'label' => 'History',
                        'url' => '/about/history',
                        'icon' => 'book-open',
                        'sort_order' => 2,
                    ],
                    [
                        'label' => 'Mission & Vision',
                        'url' => '/about/mission',
                        'icon' => 'star',
                        'sort_order' => 3,
                    ],
                ],
            ],
            [
                'label' => 'Academics',
                'url' => null,
                'icon' => 'academic-cap',
                'sort_order' => 2,
                'children' => [
                    [
                        'label' => 'Programs & Degrees',
                        'url' => '/academics/programs',
                        'icon' => 'rectangle-stack',
                        'sort_order' => 1,
                    ],
                    [
                        'label' => 'Departments',
                        'url' => '/academics/departments',
                        'icon' => 'squares-2x2',
                        'sort_order' => 2,
                    ],
                    [
                        'label' => 'Curriculum',
                        'url' => '/academics/curriculum',
                        'icon' => 'list-bullet',
                        'sort_order' => 3,
                    ],
                ],
            ],
            [
                'label' => 'Faculty & Staff',
                'url' => null,
                'icon' => 'users',
                'sort_order' => 3,
                'children' => [
                    [
                        'label' => 'Faculty Directory',
                        'url' => '/faculty/directory',
                        'icon' => 'user-group',
                        'sort_order' => 1,
                    ],
                    [
                        'label' => 'Departments',
                        'url' => '/faculty/departments',
                        'icon' => 'chart-bar',
                        'sort_order' => 2,
                    ],
                    [
                        'label' => 'Consultation Hours',
                        'url' => '/faculty/consultation',
                        'icon' => 'calendar',
                        'sort_order' => 3,
                    ],
                ],
            ],
            [
                'label' => 'Students',
                'url' => null,
                'icon' => 'document-text',
                'sort_order' => 4,
                'children' => [
                    [
                        'label' => 'Rules & Regulations',
                        'url' => '/student/rules',
                        'icon' => 'clipboard-document-list',
                        'sort_order' => 1,
                    ],
                    [
                        'label' => 'Downloadables',
                        'url' => '/downloads',
                        'icon' => 'arrow-down-tray',
                        'sort_order' => 2,
                    ],
                    [
                        'label' => 'Student Portal',
                        'url' => '/student/portal',
                        'icon' => 'globe-alt',
                        'sort_order' => 3,
                    ],
                ],
            ],
            [
                'label' => 'News',
                'url' => '/news',
                'icon' => 'newspaper',
                'sort_order' => 5,
                'children' => [],
            ],
        ];

        // Create navigation items with their children
        foreach ($navigationStructure as $item) {
            $children = $item['children'] ?? [];
            unset($item['children']);

            $parentItem = NavigationItem::create($item);

            // Create child items
            foreach ($children as $childData) {
                NavigationItem::create([
                    ...$childData,
                    'parent_id' => $parentItem->id,
                ]);
            }
        }

        $this->command->info('Navigation items seeded successfully!');
    }
}
