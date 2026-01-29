import React, { useState, useRef } from 'react';
import { Download, Gift, X, Check, Clock, Tag } from 'lucide-react';

const QRCode = ({ text, size = 120 }) => {
  const canvas = useRef(null);
  
  React.useEffect(() => {
    if (canvas.current) {
      const ctx = canvas.current.getContext('2d');
      const gridSize = 25;
      const cellSize = size / gridSize;
      
      const hash = text.split('').reduce((acc, char) => acc + char.charCodeAt(0), 0);
      
      ctx.fillStyle = '#000';
      ctx.fillRect(0, 0, size, size);
      
      ctx.fillStyle = '#fff';
      for (let y = 0; y < gridSize; y++) {
        for (let x = 0; x < gridSize; x++) {
          const shouldFill = ((x * y + hash) % 3 === 0) || 
                            (x < 3 && y < 3) || 
                            (x > gridSize - 4 && y < 3) || 
                            (x < 3 && y > gridSize - 4);
          if (shouldFill) {
            ctx.fillRect(x * cellSize, y * cellSize, cellSize, cellSize);
          }
        }
      }
    }
  }, [text, size]);
  
  return <canvas ref={canvas} width={size} height={size} className="mx-auto" />;
};

const PromoClaimSystem = () => {
  const [selectedPromo, setSelectedPromo] = useState(null);
  const [claimedPromos, setClaimedPromos] = useState([]);
  const [showVoucher, setShowVoucher] = useState(false);
  const [userName, setUserName] = useState('');
  const [userPhone, setUserPhone] = useState('');
  const voucherRef = useRef(null);

  const promos = {
    mieayam: [
      {
        id: 'MA001',
        title: '🍜 Diskon 30% Mie Ayam Special',
        description: 'Berlaku untuk pembelian Mie Ayam Special + Es Teh',
        discount: '30%',
        validUntil: '31 Februari 2026',
        minPurchase: 'Rp 30.000',
        code: 'MIEAYAM30',
        color: 'from-red-500 to-orange-500',
        bgPattern: 'bg-red-50'
      },
      {
        id: 'MA002',
        title: '🎁 Gratis Pangsit 5pcs',
        description: 'Gratis 5 pangsit goreng untuk pembelian min. Rp 50.000',
        discount: 'GRATIS',
        validUntil: '28 Februari 2026',
        minPurchase: 'Rp 50.000',
        code: 'PANGSIT5',
        color: 'from-orange-500 to-red-600',
        bgPattern: 'bg-orange-50'
      },
      {
        id: 'MA003',
        title: '💰 Cashback 20%',
        description: 'Cashback 20% maks. Rp 15.000 untuk semua menu',
        discount: '20%',
        validUntil: '15 Maret 2026',
        minPurchase: 'Rp 40.000',
        code: 'CASHBACK20',
        color: 'from-red-600 to-orange-600',
        bgPattern: 'bg-red-50'
      }
    ],
    ropang: [
      {
        id: 'RP001',
        title: '🔥 Buy 2 Get 1 Free',
        description: 'Beli 2 Ropang Original gratis 1 Ropang Original',
        discount: 'BUY 2 GET 1',
        validUntil: '29 Februari 2026',
        minPurchase: '-',
        code: 'ROPANG321',
        color: 'from-purple-500 to-indigo-500',
        bgPattern: 'bg-purple-50'
      },
      {
        id: 'RP002',
        title: '✨ Diskon 40% Paket Hemat',
        description: 'Diskon 40% untuk paket Ropang + Minuman',
        discount: '40%',
        validUntil: '20 Maret 2026',
        minPurchase: 'Rp 45.000',
        code: 'PAKET40',
        color: 'from-indigo-500 to-purple-600',
        bgPattern: 'bg-indigo-50'
      },
      {
        id: 'RP003',
        title: '🎊 Gratis Upgrade Topping',
        description: 'Gratis upgrade ke topping premium pilihan Anda',
        discount: 'GRATIS',
        validUntil: '10 Maret 2026',
        minPurchase: 'Rp 35.000',
        code: 'UPGRADE',
        color: 'from-purple-600 to-indigo-600',
        bgPattern: 'bg-purple-50'
      }
    ],
    koproll: [
      {
        id: 'KP001',
        title: '☕ Diskon 25% All Menu',
        description: 'Diskon 25% untuk semua menu kopi dan non-kopi',
        discount: '25%',
        validUntil: '25 Februari 2026',
        minPurchase: 'Rp 25.000',
        code: 'KOPI25',
        color: 'from-amber-500 to-amber-600',
        bgPattern: 'bg-amber-50'
      },
      {
        id: 'KP002',
        title: '🎁 Gratis Pastry',
        description: 'Gratis 1 pastry pilihan untuk pembelian 2 minuman',
        discount: 'GRATIS',
        validUntil: '5 Maret 2026',
        minPurchase: 'Rp 60.000',
        code: 'PASTRY',
        color: 'from-amber-600 to-amber-700',
        bgPattern: 'bg-amber-50'
      },
      {
        id: 'KP003',
        title: '💝 Paket Couple Special',
        description: '2 Kopi Susu + 2 Snack hanya Rp 55.000',
        discount: 'Rp 55K',
        validUntil: '14 Maret 2026',
        minPurchase: '-',
        code: 'COUPLE55',
        color: 'from-amber-700 to-amber-800',
        bgPattern: 'bg-amber-50'
      }
    ]
  };

  const [activeBrand, setActiveBrand] = useState('mieayam');

  const handleClaimPromo = (promo) => {
    setSelectedPromo(promo);
  };

  const handleSubmitClaim = () => {
    if (userName && userPhone && selectedPromo) {
      const voucherData = {
        ...selectedPromo,
        userName,
        userPhone,
        claimedAt: new Date().toISOString(),
        voucherNumber: `VCH-${Date.now()}`
      };
      
      setClaimedPromos([...claimedPromos, voucherData]);
      setShowVoucher(true);
    }
  };

  const downloadVoucher = () => {
    const voucher = voucherRef.current;
    if (!voucher) return;

    const voucherHTML = voucher.innerHTML;
    const blob = new Blob([`
      <!DOCTYPE html>
      <html>
      <head>
        <meta charset="UTF-8">
        <title>Voucher - ${selectedPromo.code}</title>
        <style>
          body { 
            font-family: system-ui, -apple-system, sans-serif; 
            margin: 0; 
            padding: 20px;
            background: #f5f5f5;
          }
          .voucher-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
          }
          .voucher-header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px dashed #e5e5e5;
          }
          .voucher-title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 10px;
          }
          .voucher-code {
            display: inline-block;
            background: #f0f0f0;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 2px;
            margin: 20px 0;
          }
          .voucher-details {
            margin: 20px 0;
          }
          .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
          }
          .detail-label {
            color: #666;
          }
          .detail-value {
            font-weight: 600;
          }
          .voucher-footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px dashed #e5e5e5;
            color: #666;
            font-size: 14px;
          }
          @media print {
            body { background: white; padding: 0; }
            .voucher-container { box-shadow: none; }
          }
        </style>
      </head>
      <body>
        <div class="voucher-container">
          ${voucherHTML}
        </div>
      </body>
      </html>
    `], { type: 'text/html' });

    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = `Voucher_${selectedPromo.code}_${Date.now()}.html`;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
  };

  const resetForm = () => {
    setSelectedPromo(null);
    setShowVoucher(false);
    setUserName('');
    setUserPhone('');
  };

  const brandColors = {
    mieayam: 'from-red-500 to-orange-500',
    ropang: 'from-purple-500 to-indigo-500',
    koproll: 'from-amber-500 to-amber-600'
  };

  const brandNames = {
    mieayam: 'Mie Ayamlah',
    ropang: 'Ropang Ancur',
    koproll: 'Kopi Koproll'
  };

  return (
    <div className="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12 px-4">
      <div className="max-w-7xl mx-auto">
        <div className="text-center mb-12">
          <div className="inline-flex items-center gap-2 bg-white px-6 py-3 rounded-full shadow-lg mb-6 animate-bounce">
            <Gift className="w-6 h-6 text-red-500" />
            <span className="font-bold text-gray-800">PROMO SPESIAL BULAN INI</span>
          </div>
          
          <h1 className="text-5xl font-bold text-gray-900 mb-4">
            Klaim Promo <span className="bg-gradient-to-r from-red-500 to-orange-500 bg-clip-text text-transparent">Favoritmu!</span>
          </h1>
          <p className="text-gray-600 text-lg max-w-2xl mx-auto">
            Pilih brand favorit, klaim promo eksklusif, dan dapatkan voucher yang bisa langsung kamu gunakan
          </p>
        </div>

        <div className="flex justify-center gap-4 mb-12 flex-wrap">
          {Object.keys(promos).map((brand) => (
            <button
              key={brand}
              onClick={() => setActiveBrand(brand)}
              className={`px-8 py-3 rounded-full font-semibold transition-all duration-300 transform hover:scale-105 ${
                activeBrand === brand
                  ? `bg-gradient-to-r ${brandColors[brand]} text-white shadow-lg`
                  : 'bg-white text-gray-700 hover:shadow-md'
              }`}
            >
              {brandNames[brand]}
            </button>
          ))}
        </div>

        <div className="grid md:grid-cols-3 gap-6 mb-12">
          {promos[activeBrand].map((promo) => (
            <div
              key={promo.id}
              className={`${promo.bgPattern} rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-2 border-white`}
            >
              <div className={`inline-block px-4 py-2 rounded-full bg-gradient-to-r ${promo.color} text-white font-bold text-sm mb-4`}>
                {promo.discount}
              </div>
              
              <h3 className="text-2xl font-bold text-gray-900 mb-3">
                {promo.title}
              </h3>
              
              <p className="text-gray-700 mb-4 leading-relaxed">
                {promo.description}
              </p>
              
              <div className="space-y-2 mb-6">
                <div className="flex items-center gap-2 text-sm text-gray-600">
                  <Clock className="w-4 h-4" />
                  <span>Valid: {promo.validUntil}</span>
                </div>
                <div className="flex items-center gap-2 text-sm text-gray-600">
                  <Tag className="w-4 h-4" />
                  <span>Min. Pembelian: {promo.minPurchase}</span>
                </div>
              </div>
              
              <button
                onClick={() => handleClaimPromo(promo)}
                disabled={claimedPromos.some(p => p.id === promo.id)}
                className={`w-full py-3 rounded-xl font-semibold transition-all duration-300 ${
                  claimedPromos.some(p => p.id === promo.id)
                    ? 'bg-gray-300 text-gray-500 cursor-not-allowed'
                    : `bg-gradient-to-r ${promo.color} text-white hover:shadow-lg transform hover:scale-105`
                }`}
              >
                {claimedPromos.some(p => p.id === promo.id) ? (
                  <span className="flex items-center justify-center gap-2">
                    <Check className="w-5 h-5" />
                    Sudah Diklaim
                  </span>
                ) : (
                  'Klaim Promo'
                )}
              </button>
            </div>
          ))}
        </div>

        {selectedPromo && !showVoucher && (
          <div className="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4 z-50">
            <div className="bg-white rounded-2xl p-8 max-w-md w-full shadow-2xl animate-scale-in">
              <div className="flex justify-between items-center mb-6">
                <h3 className="text-2xl font-bold text-gray-900">Klaim Promo</h3>
                <button
                  onClick={resetForm}
                  className="text-gray-400 hover:text-gray-600 transition-colors"
                >
                  <X className="w-6 h-6" />
                </button>
              </div>

              <div className={`${selectedPromo.bgPattern} rounded-xl p-4 mb-6`}>
                <div className={`inline-block px-3 py-1 rounded-full bg-gradient-to-r ${selectedPromo.color} text-white font-bold text-xs mb-2`}>
                  {selectedPromo.discount}
                </div>
                <h4 className="font-bold text-gray-900">{selectedPromo.title}</h4>
                <p className="text-sm text-gray-600 mt-1">{selectedPromo.description}</p>
              </div>

              <div className="space-y-4">
                <div>
                  <label className="block text-sm font-semibold text-gray-700 mb-2">
                    Nama Lengkap
                  </label>
                  <input
                    type="text"
                    value={userName}
                    onChange={(e) => setUserName(e.target.value)}
                    className="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all outline-none"
                    placeholder="Masukkan nama Anda"
                  />
                </div>

                <div>
                  <label className="block text-sm font-semibold text-gray-700 mb-2">
                    Nomor WhatsApp
                  </label>
                  <input
                    type="tel"
                    value={userPhone}
                    onChange={(e) => setUserPhone(e.target.value)}
                    className="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all outline-none"
                    placeholder="08xxxxxxxxxx"
                  />
                </div>

                <button
                  onClick={handleSubmitClaim}
                  disabled={!userName || !userPhone}
                  className={`w-full py-4 rounded-xl font-bold text-white transition-all duration-300 transform ${
                    userName && userPhone
                      ? `bg-gradient-to-r ${selectedPromo.color} hover:shadow-xl hover:scale-105`
                      : 'bg-gray-300 cursor-not-allowed'
                  }`}
                >
                  Dapatkan Voucher
                </button>
              </div>
            </div>
          </div>
        )}

        {showVoucher && selectedPromo && (
          <div className="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4 z-50 overflow-y-auto">
            <div className="bg-white rounded-2xl p-8 max-w-2xl w-full shadow-2xl animate-scale-in my-8">
              <div className="flex justify-between items-center mb-6">
                <h3 className="text-2xl font-bold text-gray-900">Voucher Berhasil Diklaim! 🎉</h3>
                <button
                  onClick={resetForm}
                  className="text-gray-400 hover:text-gray-600 transition-colors"
                >
                  <X className="w-6 h-6" />
                </button>
              </div>

              <div ref={voucherRef} className="bg-white border-4 border-dashed border-gray-300 rounded-2xl p-8">
                <div className="text-center mb-6 pb-6 border-b-2 border-dashed border-gray-300">
                  <div className={`inline-block px-6 py-3 rounded-full bg-gradient-to-r ${selectedPromo.color} text-white font-bold text-lg mb-4`}>
                    {selectedPromo.discount}
                  </div>
                  <h4 className="text-3xl font-bold text-gray-900 mb-2">
                    {selectedPromo.title}
                  </h4>
                  <p className="text-gray-600">{selectedPromo.description}</p>
                </div>

                <div className="mb-6">
                  <QRCode text={`${selectedPromo.code}-${userName}-${Date.now()}`} size={150} />
                </div>

                <div className="bg-gray-50 rounded-xl p-6 mb-6">
                  <div className="text-center mb-4">
                    <span className="text-sm text-gray-600 block mb-2">Kode Voucher</span>
                    <div className="bg-white px-6 py-3 rounded-lg inline-block">
                      <span className="text-2xl font-bold tracking-wider">{selectedPromo.code}</span>
                    </div>
                  </div>

                  <div className="space-y-3">
                    <div className="flex justify-between py-2 border-b border-gray-200">
                      <span className="text-gray-600">Nama</span>
                      <span className="font-semibold">{userName}</span>
                    </div>
                    <div className="flex justify-between py-2 border-b border-gray-200">
                      <span className="text-gray-600">No. HP</span>
                      <span className="font-semibold">{userPhone}</span>
                    </div>
                    <div className="flex justify-between py-2 border-b border-gray-200">
                      <span className="text-gray-600">Valid Sampai</span>
                      <span className="font-semibold">{selectedPromo.validUntil}</span>
                    </div>
                    <div className="flex justify-between py-2">
                      <span className="text-gray-600">Min. Pembelian</span>
                      <span className="font-semibold">{selectedPromo.minPurchase}</span>
                    </div>
                  </div>
                </div>

                <div className="text-center text-sm text-gray-500 pt-6 border-t-2 border-dashed border-gray-300">
                  <p className="mb-2">Tunjukkan voucher ini ke kasir untuk mendapatkan promo</p>
                  <p className="font-semibold">Voucher ID: VCH-{Date.now()}</p>
                </div>
              </div>

              <div className="flex gap-4 mt-6">
                <button
                  onClick={downloadVoucher}
                  className={`flex-1 py-4 rounded-xl font-bold text-white bg-gradient-to-r ${selectedPromo.color} hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2`}
                >
                  <Download className="w-5 h-5" />
                  Download Voucher
                </button>
                <button
                  onClick={() => window.print()}
                  className="flex-1 py-4 rounded-xl font-bold text-gray-700 bg-gray-100 hover:bg-gray-200 transition-all duration-300 transform hover:scale-105"
                >
                  Print Voucher
                </button>
              </div>
            </div>
          </div>
        )}

        {claimedPromos.length > 0 && (
          <div className="mt-12">
            <h3 className="text-2xl font-bold text-gray-900 mb-6 text-center">
              Voucher Saya ({claimedPromos.length})
            </h3>
            <div className="grid md:grid-cols-3 gap-4">
              {claimedPromos.map((promo, index) => (
                <div
                  key={index}
                  className="bg-white rounded-xl p-4 shadow-md hover:shadow-lg transition-all cursor-pointer"
                  onClick={() => {
                    setSelectedPromo(promo);
                    setUserName(promo.userName);
                    setUserPhone(promo.userPhone);
                    setShowVoucher(true);
                  }}
                >
                  <div className="flex items-center justify-between mb-2">
                    <span className="text-sm font-bold text-gray-900">{promo.code}</span>
                    <span className={`px-2 py-1 rounded text-xs font-bold bg-gradient-to-r ${promo.color} text-white`}>
                      {promo.discount}
                    </span>
                  </div>
                  <p className="text-sm text-gray-600 mb-2">{promo.title}</p>
                  <p className="text-xs text-gray-500">Valid: {promo.validUntil}</p>
                </div>
              ))}
            </div>
          </div>
        )}
      </div>

      <style>{`
        @keyframes scale-in {
          from {
            opacity: 0;
            transform: scale(0.9);
          }
          to {
            opacity: 1;
            transform: scale(1);
          }
        }
        .animate-scale-in {
          animation: scale-in 0.3s ease-out;
        }
      `}</style>
    </div>
  );
};

export default PromoClaimSystem;