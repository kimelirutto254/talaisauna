<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talai Herbal Sauna | Traditional Finnish Sauna in Kenya - Nairobi & Kapsabet</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Experience authentic Finnish sauna therapy at Talai Herbal Sauna. Traditional wood-fired saunas in Nairobi and Kapsabet. Only KES 300 per session. Book now for deep detoxification, stress relief, and wellness.">
    <meta name="keywords" content="sauna Kenya, Finnish sauna Nairobi, herbal sauna Kapsabet, sauna therapy, wellness Kenya, detox sauna, traditional sauna, steam room Nairobi, spa Kenya, heat therapy">
    <meta name="author" content="Talai Herbal Sauna">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://talaisauna.co.ke">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://talaisauna.co.ke">
    <meta property="og:title" content="Talai Herbal Sauna | Traditional Finnish Sauna in Kenya">
    <meta property="og:description" content="Experience authentic Finnish sauna therapy in Nairobi and Kapsabet. Traditional wood-fired saunas from KES 300 per session.">
    <meta property="og:image" content="https://talaisauna.co.ke/logo.png">
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://talaisauna.co.ke">
    <meta property="twitter:title" content="Talai Herbal Sauna | Traditional Finnish Sauna in Kenya">
    <meta property="twitter:description" content="Experience authentic Finnish sauna therapy in Nairobi and Kapsabet. Traditional wood-fired saunas from KES 300 per session.">
    <meta property="twitter:image" content="https://talaisauna.co.ke/logo.png">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo e(asset('logo.png')); ?>">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary: #ff8c42;
            --primary-dark: #e67935;
            --secondary: #d4552f;
            --dark: #1a1410;
            --warm-dark: #2d1f1a;
            --bg-gradient: linear-gradient(135deg, #1a1410 0%, #2d1f1a 100%);
            --text-light: #fef9f5;
            --text-muted: rgba(254, 249, 245, 0.65);
            --bg-light: #fef9f5;
            --text-dark: #1a1410;
            --text-muted-dark: rgba(26, 20, 16, 0.65);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: var(--dark);
            color: var(--text-light);
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* Animated Background */
        .heat-overlay {
            position: fixed;
            inset: 0;
            background: 
                radial-gradient(circle at 20% 80%, rgba(255, 100, 50, 0.12) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(212, 85, 47, 0.08) 0%, transparent 50%);
            z-index: -1;
            animation: heatPulse 8s ease-in-out infinite;
        }

        @keyframes heatPulse {
            0%, 100% { opacity: 0.6; }
            50% { opacity: 1; }
        }

        /* Navbar */
        .navbar {
            background: transparent;
            padding: 1.5rem 0;
            transition: all 0.3s;
            border-bottom: 1px solid transparent;
        }

        .navbar.scrolled {
            background: rgba(26, 20, 16, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 140, 66, 0.15);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 1.3rem;
            color: var(--primary) !important;
            letter-spacing: 3px;
            text-decoration: none;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .navbar-brand img {
            height: 45px;
            width: 45px;
            object-fit: contain;
            filter: drop-shadow(0 2px 8px rgba(255, 140, 66, 0.3));
        }

        .nav-link {
            color: var(--text-light) !important;
            font-weight: 400;
            font-size: 0.9rem;
            padding: 0.5rem 1.2rem !important;
            position: relative;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: var(--primary) !important;
        }

        .btn-book {
            background: var(--primary);
            color: var(--dark);
            padding: 0.7rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.3s;
            border: none;
        }

        .btn-book:hover {
            background: #fff;
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(255, 140, 66, 0.4);
        }

        /* Hero */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url('https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=2070') center/cover;
            filter: brightness(0.35) contrast(1.1);
            z-index: -1;
        }

        .hero-content h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(3rem, 10vw, 7rem);
            font-weight: 700;
            line-height: 0.95;
            margin-bottom: 2rem;
            background: linear-gradient(135deg, #fff 0%, #ffcba4 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-content p {
            font-size: 1.3rem;
            font-weight: 300;
            color: var(--text-muted);
            max-width: 600px;
            margin-bottom: 3rem;
        }

        .btn-primary-custom {
            background: var(--primary);
            color: var(--dark);
            padding: 1rem 3rem;
            border-radius: 50px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
            border: none;
            transition: all 0.3s;
        }

        .btn-primary-custom:hover {
            background: #fff;
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(255, 140, 66, 0.5);
        }

        .btn-outline-custom {
            background: transparent;
            color: var(--text-light);
            padding: 1rem 3rem;
            border-radius: 50px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
            border: 2px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s;
        }

        .btn-outline-custom:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        /* Section */
        section {
            padding: 120px 0;
            position: relative;
        }

        .section-light {
            background: var(--bg-light);
            color: var(--text-dark);
        }

        .section-light .section-title {
            color: var(--text-dark);
        }

        .section-light .section-desc {
            color: var(--text-muted-dark);
        }

        .section-light .benefit-card {
            background: rgba(255, 140, 66, 0.05);
            border-color: rgba(255, 140, 66, 0.2);
        }

        .section-light .benefit-card h3 {
            color: var(--text-dark);
        }

        .section-light .benefit-card p {
            color: var(--text-muted-dark);
        }

        .section-light .location-card {
            background: #fff;
            border-color: rgba(255, 140, 66, 0.2);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .section-light .location-card h3 {
            color: var(--text-dark);
        }

        .section-light .info-row {
            border-bottom: 1px solid rgba(0,0,0,0.05);
            color: var(--text-muted-dark);
        }

        .section-header {
            text-align: center;
            margin-bottom: 5rem;
        }

        .section-label {
            color: var(--primary);
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 1rem;
            display: block;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .section-desc {
            font-size: 1.2rem;
            color: var(--text-muted);
            max-width: 700px;
            margin: 0 auto;
        }

        /* Benefits */
        .benefit-card {
            background: rgba(255, 140, 66, 0.03);
            border: 1px solid rgba(255, 140, 66, 0.1);
            border-radius: 24px;
            padding: 3rem 2rem;
            transition: all 0.4s;
            height: 100%;
        }

        .benefit-card:hover {
            background: rgba(255, 140, 66, 0.08);
            border-color: var(--primary);
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(255, 140, 66, 0.15);
        }

        .benefit-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: var(--dark);
            margin-bottom: 2rem;
        }

        .benefit-card h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            margin-bottom: 1rem;
        }

        .benefit-card p {
            color: var(--text-muted);
            font-size: 1rem;
            line-height: 1.7;
        }

        /* Experience Section */
        .experience-visual {
            position: relative;
            height: 600px;
            border-radius: 30px;
            overflow: hidden;
        }

        .experience-visual img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.7s;
        }

        .experience-visual:hover img {
            transform: scale(1.05);
        }

        .stat-item {
            text-align: center;
            padding: 2rem;
        }

        .stat-number {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            font-weight: 700;
            color: var(--primary);
            display: block;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 0.95rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* Pricing */
        .pricing-card {
            background: rgba(255, 140, 66, 0.04);
            border: 1px solid rgba(255, 140, 66, 0.15);
            border-radius: 30px;
            padding: 3.5rem 2.5rem;
            transition: all 0.4s;
            position: relative;
            overflow: hidden;
        }

        .pricing-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            opacity: 0;
            transition: opacity 0.4s;
        }

        .pricing-card:hover::before {
            opacity: 1;
        }

        .pricing-card:hover {
            background: rgba(255, 140, 66, 0.08);
            border-color: var(--primary);
            transform: translateY(-10px);
        }

        .pricing-card.featured {
            background: linear-gradient(135deg, rgba(255, 140, 66, 0.1), rgba(212, 85, 47, 0.05));
            border: 2px solid var(--primary);
            transform: scale(1.05);
        }

        .pricing-badge {
            background: var(--primary);
            color: var(--dark);
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            display: inline-block;
            margin-bottom: 2rem;
        }

        .price {
            font-family: 'Playfair Display', serif;
            font-size: 4rem;
            font-weight: 700;
            color: var(--text-light);
            margin: 2rem 0;
        }

        .price span {
            font-size: 1.5rem;
            color: var(--text-muted);
        }

        .pricing-features {
            list-style: none;
            padding: 0;
            margin: 2rem 0 3rem;
        }

        .pricing-features li {
            padding: 0.8rem 0;
            color: var(--text-muted);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .pricing-features li i {
            color: var(--primary);
            margin-right: 1rem;
        }

        /* Locations */
        .location-card {
            background: linear-gradient(135deg, rgba(255, 140, 66, 0.1), rgba(212, 85, 47, 0.05));
            border: 1px solid rgba(255, 140, 66, 0.2);
            border-radius: 30px;
            padding: 3rem;
            position: relative;
            overflow: hidden;
            transition: all 0.4s;
        }

        .location-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 140, 66, 0.15) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.4s;
        }

        .location-card:hover::before {
            opacity: 1;
        }

        .location-card:hover {
            border-color: var(--primary);
            transform: translateY(-5px);
        }

        .location-icon {
            width: 80px;
            height: 80px;
            background: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
        }

        .location-icon i {
            font-size: 2.5rem;
            color: var(--dark);
        }

        .location-card h3 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .location-info {
            margin: 2rem 0;
        }

        .info-row {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .info-row i {
            color: var(--primary);
            font-size: 1.3rem;
        }

        /* Footer */
        footer {
            background: rgba(26, 20, 16, 0.8);
            border-top: 1px solid rgba(255, 140, 66, 0.1);
            padding: 5rem 0 2rem;
        }

        .footer-logo {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 1.5rem;
            display: block;
        }

        footer h5 {
            color: var(--text-light);
            font-weight: 600;
        }

        footer a {
            transition: color 0.3s;
        }

        footer a:hover {
            color: var(--primary) !important;
        }

        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            background: rgba(255, 140, 66, 0.1);
            border-radius: 50%;
            color: var(--text-light);
            font-size: 1.3rem;
            transition: all 0.3s;
        }

        .social-links a:hover {
            background: var(--primary);
            color: var(--dark);
            transform: translateY(-3px);
        }

        /* Animations */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* WhatsApp Floating Button */
        .whatsapp-float {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: #25D366;
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
            z-index: 1000;
            transition: all 0.3s;
            text-decoration: none;
        }

        .whatsapp-float:hover {
            background: #20BA5A;
            transform: scale(1.1);
            box-shadow: 0 6px 30px rgba(37, 211, 102, 0.6);
        }
    </style>
</head>
<body>
    <div class="heat-overlay"></div>

    <nav class="navbar navbar-expand-lg fixed-top" id="navbar">
        <div class="container">
            <a class="navbar-brand" href="#">
                <span>Talai Herbal Sauna</span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <i class="bi bi-list fs-2 text-white"></i>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item"><a class="nav-link" href="#benefits">Benefits</a></li>
                    <li class="nav-item"><a class="nav-link" href="#experience">Experience</a></li>
                    <li class="nav-item"><a class="nav-link" href="#pricing">Pricing</a></li>
                    <li class="nav-item"><a class="nav-link" href="#locations">Locations</a></li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-book" href="https://wa.me/254720700006?text=Hello%2C%20I%20would%20like%20to%20book%20a%20sauna%20session" target="_blank">Book Now</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero">
        <div class="container">
            <div class="hero-content fade-in">
                <h1>Heat.<br>Heal.<br>Repeat.</h1>
                <p>Experience the transformative power of traditional sauna therapy. Detoxify your body, calm your mind, and elevate your wellness journey.</p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="https://wa.me/254720700006?text=Hello%2C%20I%20would%20like%20to%20book%20a%20sauna%20session" target="_blank" class="btn btn-primary-custom">Start Your Journey</a>
                    <a href="#experience" class="btn btn-outline-custom">Learn More</a>
                </div>
            </div>
        </div>
    </section>

    <section id="benefits" class="section-light">
        <div class="container">
            <div class="section-header fade-in">
                <span class="section-label">Why Sauna</span>
                <h2 class="section-title">Transform Your Health</h2>
                <p class="section-desc">Traditional heat therapy offers profound benefits backed by science and centuries of practice.</p>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="benefit-card fade-in">
                        <div class="benefit-icon">
                            <i class="bi bi-droplet-fill"></i>
                        </div>
                        <h3>Deep Detoxification</h3>
                        <p>Intensive sweating eliminates toxins and heavy metals from your body, leaving you refreshed and purified.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="benefit-card fade-in">
                        <div class="benefit-icon">
                            <i class="bi bi-heart-pulse-fill"></i>
                        </div>
                        <h3>Cardiovascular Health</h3>
                        <p>Regular sauna use improves circulation, reduces blood pressure, and strengthens your heart.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="benefit-card fade-in">
                        <div class="benefit-icon">
                            <i class="bi bi-lightning-charge-fill"></i>
                        </div>
                        <h3>Faster Recovery</h3>
                        <p>Heat therapy accelerates muscle recovery, reduces inflammation, and eases post-workout soreness.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="benefit-card fade-in">
                        <div class="benefit-icon">
                            <i class="bi bi-brain"></i>
                        </div>
                        <h3>Mental Clarity</h3>
                        <p>Experience reduced stress, improved mood, and enhanced mental focus through heat-induced relaxation.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="benefit-card fade-in">
                        <div class="benefit-icon">
                            <i class="bi bi-moon-stars-fill"></i>
                        </div>
                        <h3>Better Sleep</h3>
                        <p>Evening sauna sessions promote deeper, more restorative sleep by regulating body temperature.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="benefit-card fade-in">
                        <div class="benefit-icon">
                            <i class="bi bi-stars"></i>
                        </div>
                        <h3>Radiant Skin</h3>
                        <p>Heat opens pores, increases collagen production, and gives you a healthy, natural glow.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="experience" style="background: linear-gradient(180deg, transparent, rgba(45, 31, 26, 0.3));">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="experience-visual fade-in">
                        <img src="https://images.unsplash.com/photo-1521017432531-fbd92d768814?q=80&w=2070" alt="Sauna Interior">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="fade-in">
                        <span class="section-label">The Ritual</span>
                        <h2 class="section-title">Authentic Finnish Sauna</h2>
                        <p class="mb-4" style="font-size: 1.1rem; color: var(--text-light);">Step into temperatures of 80-90°C, where time slows down and healing begins. Our traditional wood-fired saunas create the perfect environment for deep relaxation and physical renewal.</p>
                        
                        <div class="mb-4">
                            <div class="d-flex align-items-start gap-3 mb-3">
                                <i class="bi bi-fire text-primary fs-2"></i>
                                <div>
                                    <h5 class="mb-1">Traditional Heat</h5>
                                    <p class="mb-0" style="color: var(--text-light);">Authentic wood-burning stoves for optimal heat distribution</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start gap-3 mb-3">
                                <i class="bi bi-tree text-primary fs-2"></i>
                                <div>
                                    <h5 class="mb-1">Natural Materials</h5>
                                    <p class="mb-0" style="color: var(--text-light);">Cedar and pine wood for aromatherapy benefits</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start gap-3">
                                <i class="bi bi-cup-hot text-primary fs-2"></i>
                                <div>
                                    <h5 class="mb-1">Complete Relaxation</h5>
                                    <p class="mb-0" style="color: var(--text-light);">Quiet zones with herbal teas and cooling stations</p>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-6">
                                <div class="stat-item">
                                    <span class="stat-number">90°C</span>
                                    <span class="stat-label">Peak Heat</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stat-item">
                                    <span class="stat-number">100%</span>
                                    <span class="stat-label">Natural</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="pricing">
        <div class="container">
            <div class="section-header fade-in">
                <span class="section-label">Simple Pricing</span>
                <h2 class="section-title">Choose Your Path</h2>
                <p class="section-desc" style="color: var(--text-light);">Flexible options for every wellness journey</p>
            </div>

            <div class="row g-4 justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="pricing-card featured fade-in">
                        <span class="pricing-badge">Simple Pricing</span>
                        <h4 class="text-uppercase text-white mb-3" style="font-size: 0.85rem; letter-spacing: 2px;">Sauna Session</h4>
                        <div class="price">KES 300</div>
                        <p class="mb-4" style="color: var(--text-light);">Experience authentic heat therapy at an accessible price.</p>
                        
                        <ul class="pricing-features">
                            <li><i class="bi bi-check-circle-fill"></i> Unlimited sauna time</li>
                            <li><i class="bi bi-check-circle-fill"></i> Towel & locker provided</li>
                            <li><i class="bi bi-check-circle-fill"></i> Herbal tea included</li>
                            <li><i class="bi bi-check-circle-fill"></i> Shower facilities</li>
                            <li><i class="bi bi-check-circle-fill"></i> Relaxation lounge access</li>
                        </ul>
                        
                        <a href="https://wa.me/254720700006?text=Hello%2C%20I%20would%20like%20to%20book%20a%20sauna%20session" target="_blank" class="btn btn-primary-custom w-100">Book Your Session</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="locations" class="section-light">
        <div class="container">
            <div class="section-header fade-in">
                <span class="section-label">Our Saunas</span>
                <h2 class="section-title">Visit Us</h2>
                <p class="section-desc">Two premium locations serving Kenya's wellness community</p>
            </div>

            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="location-card fade-in">
                        <div class="location-icon">
                            <i class="bi bi-building"></i>
                        </div>
                        <h3>Nairobi</h3>
                        <p class="mb-4">Urban sanctuary in the heart of Kenya's capital. Experience authentic Finnish sauna culture just minutes from downtown.</p>
                        
                        <div class="location-info">
                            <div class="info-row">
                                <i class="bi bi-clock"></i>
                                <span>Monday - Sunday: 06:00 - 22:00</span>
                            </div>
                            <div class="info-row">
                                <i class="bi bi-thermometer-sun"></i>
                                <span>Traditional Wood-Fired Sauna</span>
                            </div>
                            <div class="info-row">
                                <i class="bi bi-people"></i>
                                <span>Individual & Group Sessions</span>
                            </div>
                        </div>
                        
                        <a href="https://www.google.com/maps/search/Nairobi+CBD" target="_blank" class="btn btn-primary-custom mt-4">Get Directions</a>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="location-card fade-in">
                        <div class="location-icon">
                            <i class="bi bi-tree"></i>
                        </div>
                        <h3>Kapsabet</h3>
                        <p class="mb-4">Highland retreat nestled among tea plantations. Breathe fresh mountain air while you heal in therapeutic heat.</p>
                        
                        <div class="location-info">
                            <div class="info-row">
                                <i class="bi bi-clock"></i>
                                <span>Monday - Sunday: 07:00 - 21:00</span>
                            </div>
                            <div class="info-row">
                                <i class="bi bi-thermometer-sun"></i>
                                <span>Herbal Steam & Traditional Heat</span>
                            </div>
                            <div class="info-row">
                                <i class="bi bi-flower3"></i>
                                <span>Natural Mountain Setting</span>
                            </div>
                        </div>
                        
                        <a href="https://www.google.com/maps/search/Kapsabet" target="_blank" class="btn btn-primary-custom mt-4">Get Directions</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <img src="<?php echo e(asset('logo.png')); ?>" alt="Talai Herbal Sauna Logo" style="height: 60px; width: 60px;">
                        <span class="footer-logo">TALAI HERBAL SAUNA</span>
                    </div>
                    <p class="mb-4" style="color: var(--text-light);">Traditional heat therapy for modern wellness. Experience the transformative power of authentic Finnish sauna culture in the heart of Kenya.</p>
                    <div class="social-links d-flex gap-3">
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="mb-3">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#benefits" class="text-decoration-none" style="color: rgba(254, 249, 245, 0.7);">Benefits</a></li>
                        <li class="mb-2"><a href="#experience" class="text-decoration-none" style="color: rgba(254, 249, 245, 0.7);">Experience</a></li>
                        <li class="mb-2"><a href="#pricing" class="text-decoration-none" style="color: rgba(254, 249, 245, 0.7);">Pricing</a></li>
                        <li class="mb-2"><a href="#locations" class="text-decoration-none" style="color: rgba(254, 249, 245, 0.7);">Locations</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="mb-3">Contact</h5>
                    <ul class="list-unstyled" style="color: rgba(254, 249, 245, 0.7);">
                        <li class="mb-2"><i class="bi bi-envelope me-2"></i>hello@talaisauna.co.ke</li>
                        <li class="mb-2"><i class="bi bi-phone me-2"></i>+254 720 700 006</li>
                        <li class="mb-2"><i class="bi bi-clock me-2"></i>Daily: 6AM - 10PM</li>
                    </ul>
                </div>
            </div>
            <hr class="my-4 opacity-10">
            <div class="text-center">
                <p class="mb-0" style="color: var(--text-light);">&copy; 2026 Talai Herbal Sauna. All rights reserved.</p>
                <small><a href="<?php echo e(route('login')); ?>" class="text-decoration-none opacity-50" style="color: var(--text-light);">Staff Portal</a></small>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });

        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Intersection Observer for fade-in animations
        document.addEventListener('DOMContentLoaded', () => {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            document.querySelectorAll('.fade-in').forEach(el => observer.observe(el));
        });
    </script>

    <!-- Structured Data / Schema.org -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "HealthAndBeautyBusiness",
        "name": "Talai Herbal Sauna",
        "description": "Traditional Finnish sauna therapy in Kenya. Authentic wood-fired saunas for detoxification, relaxation, and wellness.",
        "url": "https://talaisauna.co.ke",
        "telephone": "+254720700006",
        "email": "hello@talaisauna.co.ke",
        "priceRange": "KES 300 - KES 4,500",
        "address": [
            {
                "@type": "PostalAddress",
                "addressLocality": "Nairobi",
                "addressCountry": "KE"
            },
            {
                "@type": "PostalAddress",
                "addressLocality": "Kapsabet",
                "addressCountry": "KE"
            }
        ],
        "openingHours": "Mo-Su 06:00-22:00",
        "sameAs": [
            "https://facebook.com/talaisauna",
            "https://instagram.com/talaisauna"
        ],
        "hasOfferCatalog": {
            "@type": "OfferCatalog",
            "name": "Sauna Services",
            "itemListElement": [
                {
                    "@type": "Offer",
                    "itemOffered": {
                        "@type": "Service",
                        "name": "Single Sauna Session",
                        "description": "Unlimited sauna time with towel service and herbal tea"
                    },
                    "price": "300",
                    "priceCurrency": "KES"
                },
                {
                    "@type": "Offer",
                    "itemOffered": {
                        "@type": "Service",
                        "name": "Monthly Unlimited Membership",
                        "description": "Unlimited daily sessions with priority booking"
                    },
                    "price": "4500",
                    "priceCurrency": "KES"
                }
            ]
        }
    }
    </script>

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/254720700006?text=Hello%2C%20I%20would%20like%20to%20book%20a%20sauna%20session" target="_blank" class="whatsapp-float" title="Chat on WhatsApp" aria-label="Contact us on WhatsApp">
        <i class="bi bi-whatsapp"></i>
    </a>
</body>
</html><?php /**PATH /Users/dismas/Desktop/businessmanager/resources/views/welcome.blade.php ENDPATH**/ ?>