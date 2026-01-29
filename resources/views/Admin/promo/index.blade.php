<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promo Warung Kita - Hari Ini</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #FFA726 0%, #FB8C00 50%, #F57C00 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }
        
        .container-custom {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        /* Header Section */
        .page-header {
            background: white;
            border-radius: 25px;
            padding: 40px;
            margin-bottom: 40px;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.15);
            text-align: center;
        }
        
        .store-logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #FFA726 0%, #F57C00 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 8px 20px rgba(255, 167, 38, 0.4);
        }
        
        .store-logo i {
            font-size: 40px;
            color: white;
        }
        
        .page-title {
            font-size: 36px;
            font-weight: 800;
            color: #2d3748;
            margin-bottom: 10px;
        }
        
        .page-subtitle {
            color: #718096;
            font-size: 16px;
            font-weight: 500;
        }
        
        .promo-badge {
            display: inline-block;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 8px 25px;
            border-radius: 30px;
            font-weight: 700;
            margin-top: 15px;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }
        
        /* Promo Grid */
        .promo-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }
        
        .promo-card {
            background: white;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
        }
        
        .promo-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        }
        
        .promo-image {
            position: relative;
            height: 280px;
            overflow: hidden;
        }
        
        .promo-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }
        
        .promo-card:hover .promo-image img {
            transform: scale(1.15) rotate(2deg);
        }
        
        .promo-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(0,0,0,0.7) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .promo-card:hover .promo-overlay {
            opacity: 1;
        }
        
        .discount-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            background: linear-gradient(135deg, #FF6B6B 0%, #FF5252 100%);
            color: white;
            padding: 12px 25px;
            border-radius: 50px;
            font-weight: 800;
            font-size: 20px;
            box-shadow: 0 8px 25px rgba(255, 107, 107, 0.5);
            z-index: 2;
            animation: bounce 1s infinite;
        }
        
        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-5px);
            }
        }
        
        .new-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
            color: white;
            padding: 8px 20px;
            border-radius: 25px;
            font-weight: 700;
            font-size: 13px;
            box-shadow: 0 5px 15px rgba(76, 175, 80, 0.4);
            z-index: 2;
        }
        
        .promo-content {
            padding: 30px;
        }
        
        .promo-category {
            display: inline-block;
            background: rgba(255, 167, 38, 0.1);
            color: #F57C00;
            padding: 6px 18px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 15px;
        }
        
        .promo-title {
            font-size: 24px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 12px;
            line-height: 1.3;
        }
        
        .promo-description {
            color: #718096;
            font-size: 15px;
            line-height: 1.7;
            margin-bottom: 20px;
        }
        
        .price-section {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            padding: 20px;
            background: linear-gradient(135deg, #FFF3E0 0%, #FFE0B2 100%);
            border-radius: 15px;
        }
        
        .original-price {
            font-size: 18px;
            color: #a0aec0;
            text-decoration: line-through;
            font-weight: 500;
        }
        
        .promo-price {
            font-size: 32px;
            font-weight: 800;
            color: #F57C00;
        }
        
        .save-amount {
            background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
            color: white;
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 700;
            margin-left: auto;
        }
        
        .promo-validity {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 20px;
            border-top: 2px dashed #e2e8f0;
        }
        
        .validity-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #718096;
            font-size: 14px;
            font-weight: 500;
        }
        
        .validity-item i {
            color: #FFA726;
            font-size: 16px;
        }
        
        .time-left {
            background: linear-gradient(135deg, #FF6B6B 0%, #FF5252 100%);
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            animation: pulse 2s infinite;
        }
        
        /* Footer Info */
        .footer-info {
            background: white;
            border-radius: 25px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }
        
        .footer-info h4 {
            font-size: 20px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 15px;
        }
        
        .footer-info p {
            color: #718096;
            font-size: 15px;
            line-height: 1.7;
            margin-bottom: 20px;
        }
        
        .contact-info {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #2d3748;
            font-weight: 600;
        }
        
        .contact-item i {
            color: #FFA726;
            font-size: 20px;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .promo-grid {
                grid-template-columns: 1fr;
            }
            
            .page-header {
                padding: 25px;
            }
            
            .page-title {
                font-size: 28px;
            }
            
            .promo-image {
                height: 220px;
            }
        }
    </style>
</head>
<body>
    <div class="container-custom">
        <!-- Header -->
        <div class="page-header">
            <div class="store-logo">
                <i class="fas fa-store"></i>
            </div>
            <h1 class="page-title">🎉 Promo Spesial Hari Ini 🎉</h1>
            <p class="page-subtitle">Nikmati berbagai menu favorit dengan harga istimewa!</p>
            <span class="promo-badge">
                <i class="fas fa-fire"></i> Promo Terbatas!
            </span>
        </div>

        <!-- Promo Cards Grid -->
        <div class="promo-grid">
            <!-- Promo 1: Coffee -->
            <div class="promo-card">
                <div class="promo-image">
                    <img src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=800&h=600&fit=crop" alt="Kopi Spesial">
                    <div class="promo-overlay"></div>
                    <div class="discount-badge">30% OFF</div>
                    <div class="new-badge">BARU!</div>
                </div>
                <div class="promo-content">
                    <span class="promo-category">☕ Minuman</span>
                    <h3 class="promo-title">Paket Kopi Spesial Pagi</h3>
                    <p class="promo-description">
                        Mulai hari dengan secangkir kopi premium pilihan. Tersedia berbagai varian dari Arabica hingga Robusta dengan cita rasa yang memukau.
                    </p>
                    <div class="price-section">
                        <div>
                            <div class="original-price">Rp 25.000</div>
                            <div class="promo-price">Rp 17.500</div>
                        </div>
                        <span class="save-amount">Hemat Rp 7.500</span>
                    </div>
                    <div class="promo-validity">
                        <div class="validity-item">
                            <i class="fas fa-clock"></i>
                            <span>06:00 - 10:00 WIB</span>
                        </div>
                        <span class="time-left">
                            <i class="far fa-clock"></i> Berlaku Hari Ini
                        </span>
                    </div>
                </div>
            </div>

            <!-- Promo 2: Mie Ayam -->
            <div class="promo-card">
                <div class="promo-image">
                    <img src="https://images.unsplash.com/photo-1569718212165-3a8278d5f624?w=800&h=600&fit=crop" alt="Mie Ayam">
                    <div class="promo-overlay"></div>
                    <div class="discount-badge">40% OFF</div>
                </div>
                <div class="promo-content">
                    <span class="promo-category">🍜 Makanan</span>
                    <h3 class="promo-title">Mie Ayam Spesial Jumbo</h3>
                    <p class="promo-description">
                        Mie ayam dengan topping melimpah! Ayam fillet empuk, bakso kenyal, pangsit goreng renyah, dan kuah kaldu yang gurih. Porsi jumbo bikin kenyang!
                    </p>
                    <div class="price-section">
                        <div>
                            <div class="original-price">Rp 30.000</div>
                            <div class="promo-price">Rp 18.000</div>
                        </div>
                        <span class="save-amount">Hemat Rp 12.000</span>
                    </div>
                    <div class="promo-validity">
                        <div class="validity-item">
                            <i class="fas fa-clock"></i>
                            <span>11:00 - 14:00 WIB</span>
                        </div>
                        <span class="time-left">
                            <i class="far fa-clock"></i> Berlaku Hari Ini
                        </span>
                    </div>
                </div>
            </div>

            <!-- Promo 3: Roti Panggang -->
            <div class="promo-card">
                <div class="promo-image">
                    <img src="https://images.unsplash.com/photo-1586985289688-ca3cf47d3e6e?w=800&h=600&fit=crop" alt="Roti Panggang">
                    <div class="promo-overlay"></div>
                    <div class="discount-badge">35% OFF</div>
                    <div class="new-badge">POPULER!</div>
                </div>
                <div class="promo-content">
                    <span class="promo-category">🍞 Snack</span>
                    <h3 class="promo-title">Roti Panggang Cokelat Keju</h3>
                    <p class="promo-description">
                        Roti panggang dengan olesan cokelat premium dan taburan keju melimpah. Renyah di luar, lembut di dalam. Cocok untuk teman ngopi sore!
                    </p>
                    <div class="price-section">
                        <div>
                            <div class="original-price">Rp 20.000</div>
                            <div class="promo-price">Rp 13.000</div>
                        </div>
                        <span class="save-amount">Hemat Rp 7.000</span>
                    </div>
                    <div class="promo-validity">
                        <div class="validity-item">
                            <i class="fas fa-clock"></i>
                            <span>15:00 - 18:00 WIB</span>
                        </div>
                        <span class="time-left">
                            <i class="far fa-clock"></i> Berlaku Hari Ini
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Info -->
        <div class="footer-info">
            <h4>📍 Kunjungi Warung Kami</h4>
            <p>Promo spesial ini hanya berlaku untuk pembelian langsung di warung. Buruan datang sebelum kehabisan!</p>
            <div class="contact-info">
                <div class="contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Jl. Raya Warung No. 123</span>
                </div>
                <div class="contact-item">
                    <i class="fas fa-phone"></i>
                    <span>0812-3456-7890</span>
                </div>
                <div class="contact-item">
                    <i class="fas fa-clock"></i>
                    <span>Buka 06:00 - 22:00 WIB</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>