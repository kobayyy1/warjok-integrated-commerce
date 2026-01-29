<style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@300;400;500;600;700&display=swap');

        * {
            font-family: 'Inter', sans-serif;
        }

        h1,
        h2,
        h3 {
            font-family: 'Playfair Display', serif;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        @keyframes pulse-glow {

            0%,
            100% {
                box-shadow: 0 0 20px rgba(255, 0, 0, 0.3);
            }

            50% {
                box-shadow: 0 0 40px rgba(255, 0, 0, 0.6);
            }
        }

        @keyframes slide-in-right {
            from {
                opacity: 0;
                transform: translateX(100px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slide-in-left {
            from {
                opacity: 0;
                transform: translateX(-100px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes shimmer {
            0% {
                background-position: -1000px 0;
            }

            100% {
                background-position: 1000px 0;
            }
        }

        @keyframes bounce-smooth {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .float {
            animation: float 3s ease-in-out infinite;
        }

        .pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite;
        }

        .slide-right {
            animation: slide-in-right 0.8s ease-out;
        }

        .slide-left {
            animation: slide-in-left 0.8s ease-out;
        }

        .shimmer-bg {
            animation: shimmer 2s infinite;
            background-size: 1000px 100%;
        }

        .bounce {
            animation: bounce-smooth 2s ease-in-out infinite;
        }

        .gradient-text {
            background: linear-gradient(135deg, #ff0000, #ff6b00);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .menu-card {
            transition: all 0.3s ease;
        }

        .menu-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 40px rgba(255, 0, 0, 0.2);
        }

        .hero-shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            max-height: 1200px;
            overflow: hidden;
            transition: max-height 0.5s ease;
        }

        .menu-grid.expanded {
            max-height: 3000px;
        }

        .btn-show-more {
            transition: all 0.3s ease;
        }

        .btn-show-more:hover {
            transform: scale(1.05);
        }

        /* Section Divider untuk memberikan jarak dan pemisah antar section */
        .section-divider {
            height: 4px;
            background: linear-gradient(90deg, #ff0000, #ff6b00, #ff0000);
            margin: 4rem 0;
            border-radius: 2px;
            box-shadow: 0 2px 10px rgba(255, 0, 0, 0.3);
        }

        /* Zoom and Pan animation for banner to simulate serving motion */
        .animate-zoom-pan {
            animation: zoomPan 8s ease-in-out infinite;
        }

        @keyframes zoomPan {
            0% {
                transform: scale(1) translateX(0);
            }

            25% {
                transform: scale(1.05) translateX(5px);
            }

            50% {
                transform: scale(1.1) translateX(0);
            }

            75% {
                transform: scale(1.05) translateX(-5px);
            }

            100% {
                transform: scale(1) translateX(0);
            }
        }

        /* Steam animation rising from the banner */
        .steam {
            position: absolute;
            width: 4px;
            height: 20px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            bottom: 10%;
            animation: rise 4s ease-in-out infinite;
            opacity: 0.7;
        }

        .steam-1 {
            left: 20%;
            animation-delay: 0s;
        }

        .steam-2 {
            left: 50%;
            animation-delay: 1s;
        }

        .steam-3 {
            left: 80%;
            animation-delay: 2s;
        }

        @keyframes rise {
            0% {
                transform: translateY(0) scale(1);
                opacity: 0.8;
            }

            50% {
                transform: translateY(-30px) scale(1.2);
                opacity: 0.5;
            }

            100% {
                transform: translateY(-60px) scale(0.8);
                opacity: 0;
            }
        }

        /* Floating food particles: noodles and chicken pieces */
        .food-particle {
            position: absolute;
            animation: floatFood 6s ease-in-out infinite;
            opacity: 0.6;
        }

        .noodle-1 {
            top: 30%;
            left: 15%;
            width: 40px;
            height: 4px;
            background: #d4af37;
            /* Yellow noodle color */
            border-radius: 2px;
            animation-delay: 0s;
        }

        .noodle-2 {
            top: 50%;
            left: 70%;
            width: 50px;
            height: 4px;
            background: #d4af37;
            border-radius: 2px;
            animation-delay: 1.5s;
        }

        .chicken-1 {
            top: 40%;
            left: 40%;
            width: 12px;
            height: 12px;
            background: #d4a574;
            /* Brown chicken color */
            border-radius: 50%;
            animation-delay: 2s;
        }

        .chicken-2 {
            top: 60%;
            left: 25%;
            width: 10px;
            height: 10px;
            background: #d4a574;
            border-radius: 50%;
            animation-delay: 3s;
        }

        @keyframes floatFood {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            25% {
                transform: translateY(-15px) rotate(5deg);
            }

            50% {
                transform: translateY(-30px) rotate(-5deg);
            }

            75% {
                transform: translateY(-15px) rotate(5deg);
            }
        }

        /* Warm glow animation for cozy food atmosphere */
        .animate-warm-glow {
            background-size: 200% 200%;
            animation: warmGlow 5s ease-in-out infinite;
        }

        @keyframes warmGlow {
            0% {
                background-position: 0% 50%;
                opacity: 0.3;
            }

            50% {
                background-position: 100% 50%;
                opacity: 0.5;
            }

            100% {
                background-position: 0% 50%;
                opacity: 0.3;
            }
        }

        /* Pulse glow (retained) */
        .pulse-glow {
            animation: pulseGlow 2s ease-in-out infinite alternate;
        }

        @keyframes pulseGlow {
            from {
                box-shadow: 0 0 20px rgba(239, 68, 68, 0.5);
            }

            to {
                box-shadow: 0 0 40px rgba(239, 68, 68, 0.8);
            }
        }

        /* Slide animations (retained) */
        .slide-left {
            animation: slideLeft 1s ease-out;
        }

        @keyframes slideLeft {
            from {
                transform: translateX(-50px);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .slide-right {
            animation: slideRight 1s ease-out;
        }

        @keyframes slideRight {
            from {
                transform: translateX(50px);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
    </style>

<style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        /* Navbar Styles */
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 1rem 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: bold;
            color: white;
            text-decoration: none;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 2rem;
        }

        .nav-menu a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: opacity 0.3s;
        }

        .nav-menu a:hover {
            opacity: 0.8;
        }

        /* Hero Section  */
        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 150px 2rem 100px;
            text-align: center;
            color: white;
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            animation: fadeInUp 1s;
        }

        .hero p {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            animation: fadeInUp 1s 0.2s both;
        }

        .cta-button {
            background: white;
            color: #667eea;
            padding: 1rem 2.5rem;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
            animation: fadeInUp 1s 0.4s both;
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        /* Product Section */
        .products-section {
            padding: 80px 2rem;
            background: #f8f9fa;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 3rem;
            color: #333;
        }

        .products-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            margin: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .product-card:hover {
            transform: translateY(-10px);
        }

        .product-image {
            width: 100%;
            height: 250px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
        }

        .product-info {
            padding: 1.5rem;
        }

        .product-name {
            font-size: 1.3rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .product-description {
            color: #666;
            margin-bottom: 1rem;
        }

        .product-price {
            font-size: 1.5rem;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 1rem;
        }

        .view-button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 25px;
            cursor: pointer;
            font-weight: bold;
            width: 100%;
            transition: opacity 0.3s;
        }

        .view-button:hover {
            opacity: 0.9;
        }

        /* Owl Carousel Custom */
        .owl-theme .owl-nav {
            margin-top: 20px;
        }

        .owl-theme .owl-nav button {
            background: #667eea !important;
            color: white !important;
            padding: 10px 20px !important;
            border-radius: 50px !important;
            margin: 0 10px !important;
        }

        .owl-theme .owl-dots .owl-dot span {
            background: #0630e8 !important;
        }

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

        /* Hamburger Menu */
        .hamburger {
            display: none;
            flex-direction: column;
            cursor: pointer;
            gap: 4px;
        }

        .hamburger span {
            width: 25px;
            height: 3px;
            background: white;
            border-radius: 2px;
            transition: all 0.3s;
        }

        @media (max-width: 768px) {
            .hero {
                padding: 120px 1rem 60px;
            }

            .hero h1 {
                font-size: 2rem;
            }

            .hero p {
                font-size: 1rem;
            }

            .cta-button {
                padding: 0.8rem 2rem;
                font-size: 1rem;
            }

            .nav-container {
                padding: 0 1rem;
            }

            .logo {
                font-size: 1.5rem;
            }

            .nav-menu {
                position: fixed;
                top: 70px;
                left: -100%;
                flex-direction: column;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                width: 100%;
                padding: 2rem;
                gap: 1.5rem;
                transition: left 0.3s;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            }

            .nav-menu.active {
                left: 0;
            }

            .hamburger {
                display: flex;
            }

            .products-section {
                padding: 60px 1rem;
            }

            .section-title {
                font-size: 1.8rem;
                margin-bottom: 2rem;
            }

            .product-card {
                margin: 10px;
            }

            .product-image {
                height: 200px;
                font-size: 3rem;
            }

            .product-info {
                padding: 1rem;
            }

            .product-name {
                font-size: 1.1rem;
            }

            .product-description {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 480px) {
            .hero h1 {
                font-size: 1.5rem;
            }

            .hero p {
                font-size: 0.9rem;
            }

            .cta-button {
                padding: 0.7rem 1.5rem;
                font-size: 0.9rem;
            }

            .logo {
                font-size: 1.3rem;
            }

            .section-title {
                font-size: 1.5rem;
            }

            .product-image {
                height: 180px;
                font-size: 2.5rem;
            }
        }
    </style>

    <!-- Additional Styles for Auth Buttons -->
<style>
    /* Auth Buttons Styling */
    .nav-auth-buttons {
        display: flex;
        align-items: center;
    }

    .btn-login,
    .btn-register {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        border-radius: 25px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
        text-decoration: none;
        white-space: nowrap;
    }

    .btn-login {
        background: transparent;
        border: 2px solid rgba(255, 255, 255, 0.8);
        color: white;
    }

    .btn-login:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 255, 255, 0.2);
    }

    .btn-register {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: 2px solid transparent;
        color: white;
    }

    .btn-register:hover {
        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }

    /* User Menu Styling */
    .nav-user-menu {
        position: relative;
    }

    .user-dropdown {
        position: relative;
    }

    .user-button {
        display: flex;
        align-items: center;
        gap: 10px;
        background: rgba(255, 255, 255, 0.1);
        border: 2px solid rgba(255, 255, 255, 0.3);
        padding: 8px 16px;
        border-radius: 25px;
        color: white;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 600;
    }

    .user-button:hover {
        background: rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.5);
    }

    .user-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 14px;
    }

    .user-name {
        max-width: 120px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .user-button i {
        font-size: 12px;
        transition: transform 0.3s ease;
    }

    .user-button.active i {
        transform: rotate(180deg);
    }

    /* Dropdown Menu */
    .user-dropdown-menu {
        position: absolute;
        top: calc(100% + 10px);
        right: 0;
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        min-width: 220px;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.3s ease;
        z-index: 1000;
    }

    .user-dropdown-menu.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .dropdown-header {
        padding: 16px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 12px 12px 0 0;
    }

    .dropdown-user-info {
        color: white;
    }

    .dropdown-user-name {
        font-weight: 700;
        font-size: 16px;
        margin-bottom: 4px;
    }

    .dropdown-user-email {
        font-size: 12px;
        opacity: 0.9;
    }

    .dropdown-divider {
        height: 1px;
        background: #e5e7eb;
        margin: 8px 0;
    }

    .dropdown-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        color: #374151;
        text-decoration: none;
        transition: all 0.2s ease;
        font-size: 14px;
        font-weight: 500;
    }

    .dropdown-item:hover {
        background: #f3f4f6;
        color: #667eea;
    }

    .dropdown-item i {
        width: 18px;
        text-align: center;
        font-size: 16px;
    }

    .dropdown-form {
        margin: 0;
    }

    .logout-item {
        width: 100%;
        border: none;
        background: none;
        cursor: pointer;
        text-align: left;
        color: #ef4444;
    }

    .logout-item:hover {
        background: #fef2f2;
        color: #dc2626;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .nav-menu.active .nav-auth-buttons {
            width: 100%;
            margin-top: 10px;
        }

        .nav-menu.active .btn-login,
        .nav-menu.active .btn-register {
            width: 100%;
            justify-content: center;
            padding: 12px 20px;
        }

        .nav-menu.active .nav-user-menu {
            width: 100%;
            margin-top: 10px;
        }

        .nav-menu.active .user-button {
            width: 100%;
            justify-content: center;
        }

        .user-dropdown-menu {
            right: 0;
            left: 0;
            margin: 0 16px;
        }
    }

    /* Ensure icons are visible */
    .btn-login i,
    .btn-register i {
        font-size: 14px;
    }
</style>

<!-- JavaScript for User Dropdown -->
<script>
    function toggleUserDropdown(event) {
        event.stopPropagation();
        const button = event.currentTarget;
        const menu = document.getElementById('userDropdownMenu');
        
        button.classList.toggle('active');
        menu.classList.toggle('show');
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const userMenu = document.querySelector('.user-dropdown-menu');
        const userButton = document.querySelector('.user-button');
        
        if (userMenu && !userMenu.contains(event.target) && !userButton.contains(event.target)) {
            userMenu.classList.remove('show');
            if (userButton) {
                userButton.classList.remove('active');
            }
        }
    });

    // Close dropdown when pressing ESC
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            const userMenu = document.querySelector('.user-dropdown-menu');
            const userButton = document.querySelector('.user-button');
            
            if (userMenu) {
                userMenu.classList.remove('show');
            }
            if (userButton) {
                userButton.classList.remove('active');
            }
        }
    });
</script>