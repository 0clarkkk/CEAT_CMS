@extends('layouts.public')

@section('title', 'The College')

@section('content')

<script>
    function togglePlayPause() {
        const video = document.getElementById('videoPlayer');
        const icon = document.getElementById('playPauseIcon');
        
        if (video.paused) {
            video.play();
            icon.innerHTML = '<svg class="w-20 h-20 text-white fill-current" viewBox="0 0 24 24"><path d="M6 4h4v16H6V4zm8 0h4v16h-4V4z"/></svg>';
        } else {
            video.pause();
            icon.innerHTML = '<svg class="w-20 h-20 text-white fill-current ml-1" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>';
        }
        
        // Show the icon
        icon.parentElement.classList.remove('opacity-0', 'pointer-events-none');
        icon.parentElement.classList.add('opacity-100');
        
        // Hide after 1 second
        setTimeout(() => {
            icon.parentElement.classList.remove('opacity-100');
            icon.parentElement.classList.add('opacity-0', 'pointer-events-none');
        }, 1000);
    }
    
    // Auto-play video on page load
    window.addEventListener('load', function() {
        const video = document.getElementById('videoPlayer');
        video.play().catch(function(error) {
            console.log('Autoplay prevented:', error);
        });
    });
</script>

<style>
    .video-overlay {
        transition: opacity 0.3s ease-in-out;
    }
</style>

<div class="bg-white" style="margin-bottom: 10px; margin-top: 120px;">
    <!-- Video Hero Section -->
    <div class="w-full px-4 sm:px-6 lg:px-8">
        <!-- Video Container -->
        <div class="relative w-full max-w-4xl mx-auto overflow-hidden" id="videoContainer" onclick="togglePlayPause()" style="z-index: 1; height: 550px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15); cursor: pointer;">
            <video id="videoPlayer" class="w-full h-full object-fill" muted loop playsinline style="border-radius: 20px;">
                <source src="{{ asset('videos/ceat-vid.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            
            <!-- Play/Pause Icon Overlay -->
            <div class="video-overlay absolute inset-0 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300" style="border-radius: 20px; z-index: 10;">
                <div id="playPauseIcon" class="flex items-center justify-center">
                    <svg class="w-20 h-20 text-white fill-current" viewBox="0 0 24 24" style="filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));">
                        <path d="M8 5v14l11-7z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="pt-16 pb-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="mb-16">
            <h1 class="text-5xl font-bold text-gray-900 mb-10">The College</h1>
            <div class="h-1 w-32 bg-gradient-to-r from-maroon-600 to-yellow-400 rounded"></div>
            <p class="text-lg text-gray-600 mt-6 max-w-2xl">Pioneering Excellence in Engineering, Architecture, and Technology</p>
        </div>

        <!-- About Section -->
        <div class="mb-20">
            <div class="bg-gradient-to-br from-maroon-50 to-yellow-50 rounded-2xl p-8 sm:p-12 border border-maroon-100 shadow-sm">
                <h2 class="text-3xl font-bold text-gray-900 mb-6 flex items-center">
                    <span class="w-1 h-8 bg-gradient-to-b from-maroon-600 to-yellow-400 mr-4 rounded"></span>
                    About CEAT
                </h2>
                <div class="space-y-6 text-gray-700 leading-relaxed text-lg">
                    <x-editable-content page-slug="college-about" section-key="about-intro" default="The College of Engineering, Architecture and Technology (CEAT) of the University of Perpetual Help System DALTA is dedicated to producing competent, innovative, and socially responsible professionals in the fields of engineering, architecture, and technology." rich-text="true" />
                    <x-editable-content page-slug="college-about" section-key="about-hub" default="The college serves as a hub for academic excellence, technological advancement, and research-driven education. It equips students with the necessary knowledge, technical skills, and ethical values to address real-world challenges and contribute to national development." rich-text="true" />
                    <x-editable-content page-slug="college-about" section-key="about-character" default="Character Building is Nation Building" rich-text="true" />
                </div>
            </div>
        </div>

        <!-- Vision & Mission Grid -->
        <div class="grid md:grid-cols-2 gap-8 mb-20">
            <!-- Vision Card -->
            <div class="bg-yellow-50 rounded-2xl p-8 sm:p-10 shadow-xl border-l-4 border-l-yellow-400 border border-gray-100 hover:shadow-2xl transition-all duration-300">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Our Vision</h3>
                <div class="space-y-4 text-gray-700 leading-relaxed">
                    <x-editable-content page-slug="college-about" section-key="vision-content" default='<p>The University of Perpetual Help System DALTA envisions becoming a premier university in the Philippines, providing excellence in academics, technology, and research through strong local and international linkages.</p><p>It aims to serve as a catalyst for human development by producing globally competitive graduates grounded in Christian values and committed to nation-building.</p>' rich-text="true" />
                </div>
            </div>

            <!-- Mission Card -->
            <div class="bg-maroon-50 rounded-2xl p-8 sm:p-10 shadow-xl border-l-4 border-l-maroon-600 border border-gray-100 hover:shadow-2xl transition-all duration-300">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Our Mission</h3>
                <div class="space-y-4 text-gray-700 leading-relaxed">
                    <x-editable-content page-slug="college-about" section-key="mission-content" default='<p>The University of Perpetual Help System DALTA is committed to developing Filipino students into dynamic, well-rounded leaders who are physically, intellectually, socially, and spiritually prepared to achieve a high quality of life.</p><p>It strives to form Christ-centered, service-oriented, and research-driven individuals who contribute to society through excellence in education, innovation, and community service, embodying the identity of <span class="font-semibold text-maroon-700">"Helpers of God."</span></p>' rich-text="true" />
                </div>
            </div>
        </div>

        
        <!-- CTA Section -->
        <div class="bg-gradient-to-r from-maroon-600 to-maroon-800 rounded-2xl p-8 sm:p-12 text-center text-white">
            <h3 class="text-3xl font-bold mb-4">Explore Our Programs</h3>
            <p class="text-lg mb-8 opacity-90 max-w-2xl mx-auto">
                Discover the diverse academic and research opportunities available at CEAT
            </p>
            <a href="#" class="inline-block bg-yellow-400 text-maroon-900 font-bold py-3 px-8 rounded-lg hover:bg-yellow-300 transition-colors duration-300">
                Learn More
            </a>
        </div>
    </div>
</div>
@endsection
