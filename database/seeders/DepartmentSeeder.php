<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            [
                'code' => 'CHE',
                'name' => 'Department of Chemical Engineering',
                'slug' => 'chemical-engineering',
                'building_name' => 'Engineering Building A',
                'location' => 'CEAT Campus',
                'contact_email' => 'che@uphsd.edu.ph',
                'contact_phone' => '+63-2-7123-4567',
                'description' => 'Leading the chemical engineering education with modern research and industry partnerships.',
                'mission' => 'To provide world-class education in chemical engineering.',
                'vision' => 'To be a center of excellence in chemical engineering.',
            ],
            [
                'code' => 'CIV',
                'name' => 'Department of Civil Engineering',
                'slug' => 'civil-engineering',
                'building_name' => 'Engineering Building B',
                'location' => 'CEAT Campus',
                'contact_email' => 'civ@uphsd.edu.ph',
                'contact_phone' => '+63-2-7123-4568',
                'description' => 'Excellence in civil engineering education and infrastructure research.',
                'mission' => 'To produce civil engineers who serve the nation.',
                'vision' => 'To be recognized as a premier civil engineering institution.',
            ],
            [
                'code' => 'CS',
                'name' => 'Department of Computer Science',
                'slug' => 'computer-science',
                'building_name' => 'IT Building',
                'location' => 'CEAT Campus',
                'contact_email' => 'cs@uphsd.edu.ph',
                'contact_phone' => '+63-2-7123-4569',
                'description' => 'Pioneering computer science education and digital innovation.',
                'mission' => 'To educate computer scientists for a digital world.',
                'vision' => 'To be a leader in computer science education.',
            ],
            [
                'code' => 'ECE',
                'name' => 'Department of Electrical and Electronics Engineering',
                'slug' => 'electrical-electronics-engineering',
                'building_name' => 'Engineering Building C',
                'location' => 'CEAT Campus',
                'contact_email' => 'ece@uphsd.edu.ph',
                'contact_phone' => '+63-2-7123-4570',
                'description' => 'Advancing electrical and electronics engineering through innovation.',
                'mission' => 'To prepare electrical engineers for modern technology challenges.',
                'vision' => 'To excel in electrical and electronics engineering.',
            ],
            [
                'code' => 'GEO',
                'name' => 'Department of Geodetic Engineering',
                'slug' => 'geodetic-engineering',
                'building_name' => 'Engineering Building D',
                'location' => 'CEAT Campus',
                'contact_email' => 'geo@uphsd.edu.ph',
                'contact_phone' => '+63-2-7123-4571',
                'description' => 'Mapping the nation\'s future through geodetic science.',
                'mission' => 'To produce geodetic engineers for national development.',
                'vision' => 'To be the premier geodetic engineering school.',
            ],
            [
                'code' => 'INE',
                'name' => 'Department of Industrial Engineering',
                'slug' => 'industrial-engineering',
                'building_name' => 'Engineering Building E',
                'location' => 'CEAT Campus',
                'contact_email' => 'ine@uphsd.edu.ph',
                'contact_phone' => '+63-2-7123-4572',
                'description' => 'Optimizing processes for industry excellence.',
                'mission' => 'To educate industrial engineers for operational excellence.',
                'vision' => 'To lead in industrial engineering education.',
            ],
            [
                'code' => 'ME',
                'name' => 'Department of Mechanical Engineering',
                'slug' => 'mechanical-engineering',
                'building_name' => 'Engineering Building F',
                'location' => 'CEAT Campus',
                'contact_email' => 'me@uphsd.edu.ph',
                'contact_phone' => '+63-2-7123-4573',
                'description' => 'Building mechanical engineering excellence for tomorrow.',
                'mission' => 'To produce mechanical engineers of outstanding caliber.',
                'vision' => 'To be recognized as a leading mechanical engineering program.',
            ],
            [
                'code' => 'MME',
                'name' => 'Department of Mining, Metallurgical, and Materials Engineering',
                'slug' => 'mining-metallurgical-materials-engineering',
                'building_name' => 'Engineering Building G',
                'location' => 'CEAT Campus',
                'contact_email' => 'mme@uphsd.edu.ph',
                'contact_phone' => '+63-2-7123-4574',
                'description' => 'Advancing mining and materials science research.',
                'mission' => 'To educate engineers in mining and materials technology.',
                'vision' => 'To be a center of excellence in materials engineering.',
            ],
        ];

        foreach ($departments as $deptData) {
            Department::firstOrCreate(
                ['code' => $deptData['code']],
                $deptData
            );
        }
    }
}
