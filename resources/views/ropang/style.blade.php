<style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }

        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-pattern {
            background-color: #0f172a;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23667eea' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v6h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .bread-animation {
            animation: breadHover 3s ease-in-out infinite;
        }

        @keyframes breadHover {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(5deg);
            }
        }
    </style>
    <style>
        .history-section {
            background: linear-gradient(135deg, #fff5e6 0%, #ffe0b2 100%);
            padding: 60px 20px;
        }

        .history-section .section-title {
            text-align: center;
            margin-bottom: 50px;
        }

        .history-section .section-title h2 {
            font-size: 2.5rem;
            color: #d84315;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .history-section .section-title p {
            font-size: 1.1rem;
            color: #666;
            font-style: italic;
        }

        .history-section .timeline-wrapper {
            margin-top: 40px;
        }

        .history-section .timeline-item {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
            margin-bottom: 80px;
            animation: fadeIn 0.8s ease-in-out;
        }

        .history-section .timeline-item:nth-child(even) {
            direction: rtl;
        }

        .history-section .timeline-item:nth-child(even)>* {
            direction: ltr;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .history-section .timeline-content {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            border-left: 6px solid #d84315;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .history-section .timeline-content:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 50px rgba(216, 67, 21, 0.15);
        }

        .history-section .timeline-year {
            font-size: 2rem;
            font-weight: 700;
            color: #d84315;
            margin-bottom: 15px;
            display: inline-block;
            background: linear-gradient(135deg, #ffe0b2, #ffcc80);
            padding: 8px 16px;
            border-radius: 50px;
        }

        .history-section .timeline-title {
            font-size: 1.5rem;
            color: #333;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .history-section .timeline-description {
            font-size: 1rem;
            color: #666;
            line-height: 1.8;
        }

        .history-section .timeline-image {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease;
        }

        .history-section .timeline-image:hover {
            transform: scale(1.05);
        }

        .history-section .timeline-image img {
            width: 100%;
            height: auto;
            object-fit: contain;
            display: block;
        }

        @media (max-width: 768px) {
            .history-section .timeline-item {
                grid-template-columns: 1fr;
                gap: 30px;
                margin-bottom: 50px;
            }

            .history-section .timeline-item:nth-child(even) {
                direction: ltr;
            }

            .history-section .section-title h2 {
                font-size: 2rem;
            }

            .history-section .timeline-content {
                padding: 30px;
            }

            .history-section .timeline-image img {
                height: auto;
                object-fit: contain;
            }

            .history-section .timeline-description {
                font-size: 0.95rem;
            }
        }
    </style>