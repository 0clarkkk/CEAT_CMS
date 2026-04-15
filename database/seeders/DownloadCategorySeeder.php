<?php

namespace Database\Seeders;

use App\Models\DownloadCategory;
use App\Models\DownloadableForm;
use Illuminate\Database\Seeder;

class DownloadCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data
        DownloadableForm::truncate();
        DownloadCategory::truncate();

        // Admission Forms Category
        $admissionCategory = DownloadCategory::create([
            'name' => 'Admission Forms',
            'slug' => 'admission-forms',
            'description' => 'Forms and documents required for college admission and enrollment.',
            'icon' => 'heroicon-o-document-text',
            'order' => 1,
            'is_active' => true,
        ]);

        // Academic Forms Category
        $academicCategory = DownloadCategory::create([
            'name' => 'Academic Forms',
            'slug' => 'academic-forms',
            'description' => 'Official academic documents and forms for students.',
            'icon' => 'heroicon-o-academic-cap',
            'order' => 2,
            'is_active' => true,
        ]);

        // Financial Forms Category
        $financialCategory = DownloadCategory::create([
            'name' => 'Financial Forms',
            'slug' => 'financial-forms',
            'description' => 'Scholarship, financial aid, and payment-related forms.',
            'icon' => 'heroicon-o-banknotes',
            'order' => 3,
            'is_active' => true,
        ]);

        // Student Services Category
        $servicesCategory = DownloadCategory::create([
            'name' => 'Student Services',
            'slug' => 'student-services',
            'description' => 'Health, wellness, counseling, and other student services forms.',
            'icon' => 'heroicon-o-heart',
            'order' => 4,
            'is_active' => true,
        ]);

        // Faculty & Staff Category
        $staffCategory = DownloadCategory::create([
            'name' => 'Faculty & Staff',
            'slug' => 'faculty-staff',
            'description' => 'Forms and resources for faculty and staff members.',
            'icon' => 'heroicon-o-user-group',
            'order' => 5,
            'is_active' => true,
        ]);

        // Admission forms
        DownloadableForm::create([
            'category_id' => $admissionCategory->id,
            'title' => 'Admission Application Form',
            'description' => 'Complete application form for undergraduate admission',
            'file_path' => 'forms/admission-form.pdf',
            'file_type' => 'pdf',
            'is_active' => true,
            'order' => 1,
        ]);

        DownloadableForm::create([
            'category_id' => $admissionCategory->id,
            'title' => 'Enrollment Checklist',
            'description' => 'Step-by-step checklist for new student enrollment',
            'file_path' => 'forms/enrollment-checklist.pdf',
            'file_type' => 'pdf',
            'is_active' => true,
            'order' => 2,
        ]);

        // Academic forms
        DownloadableForm::create([
            'category_id' => $academicCategory->id,
            'title' => 'Course Change Form',
            'description' => 'Form for adding or dropping courses',
            'file_path' => 'forms/course-change.docx',
            'file_type' => 'docx',
            'is_active' => true,
            'order' => 1,
        ]);

        DownloadableForm::create([
            'category_id' => $academicCategory->id,
            'title' => 'Graduation Application',
            'description' => 'Application form for graduation',
            'file_path' => 'forms/graduation-application.pdf',
            'file_type' => 'pdf',
            'is_active' => true,
            'order' => 2,
        ]);

        // Financial forms
        DownloadableForm::create([
            'category_id' => $financialCategory->id,
            'title' => 'Scholarship Application',
            'description' => 'Application form for various scholarships',
            'file_path' => 'forms/scholarship-application.pdf',
            'file_type' => 'pdf',
            'is_active' => true,
            'order' => 1,
        ]);

        DownloadableForm::create([
            'category_id' => $financialCategory->id,
            'title' => 'Financial Aid Form',
            'description' => 'Form to apply for financial aid',
            'file_path' => 'forms/financial-aid.docx',
            'file_type' => 'docx',
            'is_active' => true,
            'order' => 2,
        ]);

        // Student services forms
        DownloadableForm::create([
            'category_id' => $servicesCategory->id,
            'title' => 'Medical Form',
            'description' => 'Health and medical information form',
            'file_path' => 'forms/medical-form.pdf',
            'file_type' => 'pdf',
            'is_active' => true,
            'order' => 1,
        ]);

        // Faculty forms
        DownloadableForm::create([
            'category_id' => $staffCategory->id,
            'title' => 'Faculty Leave Request',
            'description' => 'Form to request leave from faculty duties',
            'file_path' => 'forms/faculty-leave.pdf',
            'file_type' => 'pdf',
            'is_active' => true,
            'order' => 1,
        ]);
    }
}
