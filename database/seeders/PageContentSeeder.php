<?php

namespace Database\Seeders;

use App\Models\PageContent;
use Illuminate\Database\Seeder;

class PageContentSeeder extends Seeder
{
    public function run(): void
    {
        // College About Page - About Section
        PageContent::setContent(
            'college-about',
            'about-intro',
            '<p>The College of Engineering, Architecture and Technology (CEAT) of the University of Perpetual Help System DALTA is dedicated to producing competent, innovative, and socially responsible professionals in the fields of engineering, architecture, and technology.</p>'
        );

        PageContent::setContent(
            'college-about',
            'about-hub',
            '<p>The college serves as a hub for academic excellence, technological advancement, and research-driven education. It equips students with the necessary knowledge, technical skills, and ethical values to address real-world challenges and contribute to national development.</p>'
        );

        PageContent::setContent(
            'college-about',
            'about-character',
            '<p>Aligned with the university\'s guiding principle, <span class="font-semibold text-maroon-700">"Character Building is Nation Building,"</span> CEAT fosters holistic development by integrating academic learning with practical applications, industry exposure, and community engagement.</p>'
        );

        // College About Page - Vision
        PageContent::setContent(
            'college-about',
            'vision-content',
            '<p>The University of Perpetual Help System DALTA envisions becoming a premier university in the Philippines, providing excellence in academics, technology, and research through strong local and international linkages.</p><p>It aims to serve as a catalyst for human development by producing globally competitive graduates grounded in Christian values and committed to nation-building.</p>'
        );

        // College About Page - Mission
        PageContent::setContent(
            'college-about',
            'mission-content',
            '<p>The University of Perpetual Help System DALTA is committed to developing Filipino students into dynamic, well-rounded leaders who are physically, intellectually, socially, and spiritually prepared to achieve a high quality of life.</p><p>It strives to form Christ-centered, service-oriented, and research-driven individuals who contribute to society through excellence in education, innovation, and community service, embodying the identity of <span class="font-semibold text-maroon-700">"Helpers of God."</span></p>'
        );
    }
}
