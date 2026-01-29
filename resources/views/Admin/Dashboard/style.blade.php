<style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }
        
        .stat-card {
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .menu-item {
            position: relative;
            overflow: hidden;
        }
        
        .menu-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background: linear-gradient(180deg, #3b82f6, #8b5cf6);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }
        
        .menu-item:hover::before,
        .menu-item.active::before {
            transform: scaleY(1);
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .gradient-blue {
            background: linear-gradient(135deg, #667eea 0%, #3b82f6 100%);
        }
        
        .gradient-green {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }
        
        .gradient-purple {
            background: linear-gradient(135deg, #a855f7 0%, #7c3aed 100%);
        }
        
        .gradient-orange {
            background: linear-gradient(135deg, #f59e0b 0%, #ea580c 100%);
        }
        
        .gradient-pink {
            background: linear-gradient(135deg, #ec4899 0%, #db2777 100%);
        }
    </style>