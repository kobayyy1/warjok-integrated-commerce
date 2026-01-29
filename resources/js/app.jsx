import React from 'react';
import { createRoot } from 'react-dom/client';
import PromoClaimSystem from './components/PromoClaimSystem';
import '../css/app.css'; // 🔥 PENTING: Import CSS

const container = document.getElementById('app');

if (container) {
  createRoot(container).render(<PromoClaimSystem />);
}