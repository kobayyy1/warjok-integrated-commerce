<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Inter:wght@300;400;600;700;800&display=swap');

    body {
        font-family: 'Inter', sans-serif;
    }

    .font-display {
        font-family: 'Playfair Display', serif;
    }

    .hero-gradient {
        background: linear-gradient(135deg, rgba(120, 80, 50, 0.95) 0%, rgba(60, 40, 30, 0.98) 100%);
    }

    .coffee-pattern {
        background-image: url('data:image/svg+xml,<svg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"><circle cx="30" cy="30" r="1.5" fill="%23ffffff" opacity="0.1"/></svg>');
    }

    /* Enhanced Animations */
    @keyframes slide-in-left {
        from {
            opacity: 0;
            transform: translateX(-50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes fade-in {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-slide-in-left {
        animation: slide-in-left 0.8s ease-out forwards;
    }

    .animate-slide-in-left-delay {
        animation: slide-in-left 0.8s ease-out 0.2s forwards;
        opacity: 0;
    }

    .animate-slide-in-left-delay-2 {
        animation: slide-in-left 0.8s ease-out 0.4s forwards;
        opacity: 0;
    }

    .animate-fade-in {
        animation: fade-in 1s ease-out forwards;
    }

    /* Line clamp utility */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Smooth scroll */
    html {
        scroll-behavior: smooth;
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 10px;
    }

    ::-webkit-scrollbar-track {
        background: #f5f5f4;
    }

    ::-webkit-scrollbar-thumb {
        background: #d97706;
        border-radius: 5px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #b45309;
    }

    /* Shadow effects */
    .shadow-inner-strong {
        box-shadow: inset 0 0 100px rgba(0, 0, 0, 0.3);
    }

    /* Animated border shine effect */
    @keyframes border-shine {
        0% {
            opacity: 0.3;
        }
        50% {
            opacity: 1;
        }
        100% {
            opacity: 0.3;
        }
    }

    .banner-carousel {
        position: relative;
    }

    .banner-carousel::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, transparent, #f59e0b, transparent);
        animation: border-shine 3s ease-in-out infinite;
        z-index: 40;
    }
</style>