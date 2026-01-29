@extends('layouts.pages')
@section('head')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hero Video Section</title>
    <script src="https://cdn.tailwindcss.com"></script>
@endsection
@include('HeroSection.Homestyle')

<body>
@section('body')
    <div>
        @php
            $backgroundVideo = $heroVideos->where('is_background', true)->where('is_active', true)->first();
            $mainVideos = $heroVideos->where('is_background', false)->where('is_active', true)->sortBy('position')->values();
        @endphp

        <!-- Background Video Container - Only show if exists -->
        @if($backgroundVideo)
            <div class="video-bg-container">
                <video autoplay muted loop playsinline>
                    {{-- GUNAKAN asset() SAMA SEPERTI DI ADMIN --}}
                    <source src="{{ asset($backgroundVideo->video_path) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        @endif
        
        <!-- Hero Section - Only show if there are main videos -->
        @if($mainVideos->count() > 0)
            <section id="home" class="pt-20 pb-8 md:pb-12 px-4 md:px-8 relative z-10 min-h-fit flex flex-col justify-center">
                <div class="max-w-7xl mx-auto w-full hero-content">
                    <div class="text-center mb-12 md:mb-16">
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white mb-4 drop-shadow-lg animate-fade-in-up">
                            WELCOME TO WARUNG POJOK
                        </h1>
                        
                        <!-- Video Row -->
                        <div class="flex flex-col md:flex-row gap-6 md:gap-0 items-stretch justify-center">
                            @foreach($mainVideos as $index => $video)
                                <!-- Video {{ $index + 1 }} -->
                                <div class="flex-1 flex flex-col items-center">
                                    <div class="video-container w-full h-80 md:h-96 mb-4" style="aspect-ratio: 9/16; max-width: 250px;">
                                        <video autoplay muted loop playsinline>
                                            {{-- GUNAKAN asset() SAMA SEPERTI DI ADMIN --}}
                                            <source src="{{ asset($video->video_path) }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                        <div class="video-overlay">
                                            <button onclick="openModal('video{{ $video->id }}')"
                                                    class="bg-white text-purple-600 px-6 py-2 rounded-full font-bold hover:bg-gray-100 transition">
                                                VIEW
                                            </button>
                                        </div>
                                    </div>
                                    <h3 class="text-xl font-bold text-white drop-shadow-lg">{{ $video->title }}</h3>
                                    <p class="text-gray-200 text-center text-sm mt-2 drop-shadow-lg">{{ $video->description }}</p>
                                </div>
                                
                                <!-- Divider Line -->
                                @if(!$loop->last)
                                    <div class="hidden md:flex md:flex-col md:justify-center md:px-6">
                                        <div class="divider-line line-animation" 
                                             style="animation-delay: {{ 0.3 + ($index * 0.2) }}s; width: 2px; height: 100%;">
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>

            <!-- Modals for Videos -->
            @foreach($mainVideos as $video)
                <div id="video{{ $video->id }}Modal" class="modal" onclick="closeModal('video{{ $video->id }}')">
                    <div class="modal-content" onclick="event.stopPropagation()">
                        <button class="close-btn" onclick="closeModal('video{{ $video->id }}')">&times;</button>
                        <video controls autoplay style="max-width: 500px; max-height: 600px;">
                            {{-- GUNAKAN asset() SAMA SEPERTI DI ADMIN --}}
                            <source src="{{ asset($video->video_path) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
            @endforeach
        @endif

        <script>
            function openModal(videoId) {
                const modalId = videoId + 'Modal';
                const modal = document.getElementById(modalId);
                if (modal) {
                    modal.classList.add('show');
                    document.body.style.overflow = 'hidden';
                    
                    // Auto-play video saat modal dibuka
                    const video = modal.querySelector('video');
                    if (video) {
                        video.play();
                    }
                }
            }
            
            function closeModal(videoId) {
                const modalId = videoId + 'Modal';
                const modal = document.getElementById(modalId);
                if (modal) {
                    modal.classList.remove('show');
                    document.body.style.overflow = 'auto';
                    
                    // Pause video saat modal ditutup
                    const video = modal.querySelector('video');
                    if (video) {
                        video.pause();
                        video.currentTime = 0;
                    }
                }
            }

            // Close modal when ESC key is pressed
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    document.querySelectorAll('.modal.show').forEach(modal => {
                        const video = modal.querySelector('video');
                        if (video) {
                            video.pause();
                            video.currentTime = 0;
                        }
                        modal.classList.remove('show');
                        document.body.style.overflow = 'auto';
                    });
                }
            });

            // Debug: Log video paths untuk troubleshooting
            document.addEventListener('DOMContentLoaded', function() {
                console.log('=== Video Debug Info ===');
                document.querySelectorAll('video source').forEach((source, index) => {
                    console.log(`Video ${index + 1}:`, source.src);
                });
            });
        </script>

        <style>
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            .animate-fade-in-up {
                animation: fadeInUp 1s ease-out forwards;
            }

            .modal {
                display: none;
                position: fixed;
                z-index: 50;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.8);
                animation: fadeIn 0.3s ease;
            }
            
            .modal.show {
                display: flex;
                align-items: center;
                justify-content: center;
            }
            
            @keyframes fadeIn {
                from {
                    opacity: 0;
                }
                to {
                    opacity: 1;
                }
            }

            @keyframes zoomIn {
                from {
                    transform: scale(0.9);
                    opacity: 0;
                }
                to {
                    transform: scale(1);
                    opacity: 1;
                }
            }
            
            .modal-content {
                background-color: #000;
                padding: 20px;
                border-radius: 15px;
                max-width: 90vw;
                max-height: 90vh;
                position: relative;
                animation: zoomIn 0.3s ease;
            }
            
            .modal-content video {
                width: 100%;
                height: 100%;
                border-radius: 10px;
            }
            
            .close-btn {
                position: absolute;
                right: 20px;
                top: 20px;
                font-size: 28px;
                font-weight: bold;
                color: white;
                cursor: pointer;
                background: rgba(0, 0, 0, 0.5);
                border: none;
                width: 40px;
                height: 40px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: background 0.3s ease;
                z-index: 100;
            }
            
            .close-btn:hover {
                background: rgba(0, 0, 0, 0.8);
            }
        </style>
    </div>
@endsection
</body>