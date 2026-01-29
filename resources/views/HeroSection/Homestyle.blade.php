 <style>
     @keyframes slideInRight {
         from {
             width: 0;
         }

         to {
             width: 100%;
         }
     }

     .line-animation {
         animation: slideInRight 2s ease-in-out forwards;
     }

     .video-bg-container {
         position: fixed;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         z-index: -1;
         overflow: hidden;
     }

     .video-bg-container video {
         width: 100%;
         height: 100%;
         object-fit: cover;
         filter: blur(8px) brightness(0.4);
     }

     .video-container {
         position: relative;
         overflow: hidden;
         border-radius: 15px;
         box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
     }

     .video-container video {
         width: 100%;
         height: 100%;
         object-fit: cover;
     }

     .video-overlay {
         position: absolute;
         inset: 0;
         background: rgba(0, 0, 0, 0.3);
         display: flex;
         align-items: center;
         justify-content: center;
         opacity: 0;
         transition: opacity 0.3s ease;
     }

     .video-container:hover .video-overlay {
         opacity: 1;
     }

     .divider-line {
         height: 2px;
         background: linear-gradient(90deg, transparent, #667eea, transparent);
         width: 100%;
         display: none;
     }

     @media (min-width: 768px) {
         .divider-line {
             display: block;
         }
     }

     .hero-content {
         position: relative;
         z-index: 10;
     }
 </style>
