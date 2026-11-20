<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prima - Full-Stack Developer</title>
    
    <!-- Google Fonts & Font Awesome -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- AOS Animation CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-color: #00d4aa;
            --bg-dark: #0a0e17;
            --bg-card: #111827;
            --text-primary: #ffffff;
            --text-secondary: #9ca3af;
            --border-color: #1f2937;
        }

        /* Mencegah scroll saat preloader aktif */
        body.no-scroll {
            overflow: hidden;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-dark);
            color: var(--text-primary);
            line-height: 1.6;
            overflow-x: hidden;
            position: relative;
            background-image: 
                radial-gradient(circle at 1px 1px, rgba(255, 255, 255, 0.04) 1px, transparent 0);
            background-size: 40px 40px;
        }

        /* ========================================= */
        /* PRELOADER / SPLASH SCREEN (BARU) */
        /* ========================================= */
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: var(--bg-dark);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: opacity 0.8s ease, visibility 0.8s ease;
        }

        #preloader.loaded {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }

        .preloader-content {
            text-align: center;
        }

        .preloader-name {
            font-size: 48px;
            font-weight: 800;
            color: var(--text-primary);
            opacity: 0;
            transform: translateY(30px);
            animation: slideUpFade 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
            animation-delay: 0.3s;
        }

        .preloader-name .highlight {
            color: var(--primary-color);
        }

        .preloader-role {
            font-size: 16px;
            font-weight: 500;
            color: var(--text-secondary);
            letter-spacing: 4px;
            text-transform: uppercase;
            margin-top: 10px;
            opacity: 0;
            transform: translateY(20px);
            animation: slideUpFade 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
            animation-delay: 0.6s;
        }

        .preloader-line {
            width: 0;
            height: 3px;
            background: var(--primary-color);
            margin: 25px auto 0;
            border-radius: 2px;
            animation: expandLine 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
            animation-delay: 0.9s;
            box-shadow: 0 0 15px rgba(0, 212, 170, 0.5);
        }

        @keyframes slideUpFade {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes expandLine {
            to {
                width: 80px;
            }
        }

        /* Animasi Background Glow Orbs */
        body::before,
        body::after {
            content: '';
            position: fixed;
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.35;
            z-index: -1;
            animation: floatBlob 12s infinite alternate ease-in-out;
        }

        body::before {
            width: 800px;
            height: 800px;
            background: var(--primary-color);
            top: -15%;
            left: -15%;
        }

        body::after {
            width: 700px;
            height: 700px;
            background: #0088cc;
            bottom: -15%;
            right: -15%;
            animation-delay: -5s;
        }

        @keyframes floatBlob {
            0% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(80px, -100px) scale(1.15); }
            66% { transform: translate(-60px, 80px) scale(0.9); }
            100% { transform: translate(0, 0) scale(1); }
        }

        /* Hero Section */
        .hero {
            margin-top: 100px;
            padding: 60px;
            max-width: 1400px;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-content {
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 80px;
            align-items: center;
        }

        /* Profile Card */
        .profile-card {
            background: var(--bg-card);
            border: 2px solid var(--primary-color);
            border-radius: 24px;
            padding: 50px 40px;
            text-align: center;
            position: relative;
            max-width: 480px;
            width: 100%;
            margin: 0 auto;
        }

        .profile-image {
            width: 240px;
            height: 240px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 30px;
            border: 4px solid var(--primary-color);
            box-shadow: 0 0 40px rgba(0, 212, 170, 0.4);
        }

        .profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-name {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .profile-title {
            color: var(--text-secondary);
            font-size: 16px;
            margin-bottom: 25px;
        }

        .profile-info {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 30px;
            text-align: left;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
            color: var(--text-secondary);
        }

        .info-item i {
            color: var(--primary-color);
            width: 18px;
            flex-shrink: 0;
        }

        .info-item a {
            color: var(--text-secondary);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .info-item a:hover {
            color: var(--primary-color);
        }

        .download-cv {
            display: inline-block;
            padding: 14px 35px;
            background: transparent;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            border-radius: 8px;
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .download-cv:hover {
            background: var(--primary-color);
            color: var(--bg-dark);
        }

        .download-cv i {
            margin-right: 8px;
        }

        /* Hero Text */
        .hero-text {
            padding-left: 40px;
        }

        .hero-badge {
            display: inline-block;
            padding: 8px 20px;
            background: rgba(0, 212, 170, 0.1);
            border: 1px solid var(--primary-color);
            border-radius: 20px;
            color: var(--primary-color);
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .hero-title {
            font-size: 64px;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 20px;
        }

        .hero-title .highlight {
            color: var(--primary-color);
        }

        .hero-subtitle {
            font-size: 18px;
            color: var(--text-secondary);
            margin-bottom: 30px;
            max-width: 600px;
        }

        .hero-description {
            font-size: 15px;
            color: var(--text-secondary);
            line-height: 1.8;
            margin-bottom: 30px;
            max-width: 550px;
        }

        .cta-button {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 15px 35px;
            background: var(--primary-color);
            color: var(--bg-dark);
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 212, 170, 0.3);
        }

        /* Stats Section */
        .stats {
            display: flex;
            flex-direction: row;
            justify-content: center;
            gap: 20px;
            margin: 60px auto 0;
            width: fit-content;
            grid-column: 1 / -1;
        }

        .stat-item {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 20px 25px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            min-width: 150px;
            max-width: 180px;
            transition: all 0.3s ease;
        }

        .stat-item:hover {
            border-color: var(--primary-color);
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 212, 170, 0.1);
        }

        .stat-number {
            font-size: 36px;
            font-weight: 800;
            color: var(--primary-color);
            margin-bottom: 5px;
            line-height: 1;
        }

        .stat-label {
            font-size: 14px;
            color: var(--text-secondary);
            line-height: 1.4;
        }

        /* Scroll Indicator */
        .scroll-indicator {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            margin: 80px auto;
            max-width: 1400px;
            padding: 0 60px;
            color: var(--text-secondary);
        }

        .mouse {
            width: 26px;
            height: 42px;
            border: 2px solid var(--text-secondary);
            border-radius: 20px;
            position: relative;
            display: flex;
            justify-content: center;
            padding-top: 8px;
        }

        .wheel {
            width: 4px;
            height: 8px;
            background: var(--primary-color);
            border-radius: 2px;
            animation: scrollWheel 1.5s infinite ease-in-out;
        }

        @keyframes scrollWheel {
            0% { transform: translateY(0); opacity: 1; }
            100% { transform: translateY(16px); opacity: 0; }
        }

        .scroll-text {
            font-size: 12px;
            color: var(--text-secondary);
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        /* Section Common Styles */
        section {
            padding: 80px 60px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .section-header {
            margin-bottom: 50px;
            text-align: center;
        }

        .section-badge {
            display: inline-block;
            padding: 8px 20px;
            border: 2px solid var(--primary-color);
            border-radius: 8px;
            color: var(--primary-color);
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .section-text {
            font-size: 16px;
            color: var(--text-secondary);
            line-height: 1.8;
            max-width: 700px;
            margin: 0 auto;
        }

        /* About Section */
        .about-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .about-text {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 40px;
            text-align: center;
        }

        .about-text h3 {
            font-size: 28px;
            margin-bottom: 20px;
            color: var(--primary-color);
            text-align: center;
        }

        .about-text p {
            color: var(--text-secondary);
            line-height: 1.8;
            margin-bottom: 15px;
            text-align: center;
        }

        .about-image {
            border-radius: 16px;
            overflow: hidden;
        }

        .about-image img {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }

        /* Skills Section - Improved */
       /* Skills Section - Clean Version */
        .skills {
            background: linear-gradient(180deg, transparent 0%, rgba(0, 212, 170, 0.03) 50%, transparent 100%);
            padding: 80px 60px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .skills-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .skills-code {
            font-size: 80px;
            color: var(--primary-color);
            margin-bottom: 20px;
            opacity: 0.3;
        }

        /* Level Legend - Pojok Kanan Atas Section */
        .skills-legend {
            display: flex;
            justify-content: flex-end; /* Pojok kanan di desktop */
            align-items: center;
            gap: 16px;
            margin-bottom: 35px;
            flex-wrap: wrap;
            max-width: 100%;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: var(--text-secondary);
            font-weight: 500;
            white-space: nowrap;
        }

        .legend-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            flex-shrink: 0;
        }

        /* Grid Skills */
        .skills-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 400px));
            justify-content: center;
            gap: 30px;
            max-width: 1000px;
            margin: 0 auto;
        }

        .skill-category {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 30px;
            transition: all 0.3s ease;
            max-width: 400px;
            margin: 0 auto;
            width: 100%;
            position: relative;
        }

        .skill-category:hover {
            border-color: var(--primary-color);
            transform: translateY(-4px);
            box-shadow: 0 10px 30px rgba(0, 212, 170, 0.12);
        }

        /* Header Kategori */
        .skill-category-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 20px;
            padding-bottom: 14px;
            border-bottom: 1px solid var(--border-color);
        }

        .category-title-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
        }

        .skill-category-header i {
            font-size: 22px;
            color: var(--primary-color);
            flex-shrink: 0;
        }

        .skill-category-header h3 {
            font-size: 19px;
            font-weight: 700;
            color: var(--text-primary);
            margin: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Label Tingkat Keahlian di Pojok Kanan Atas Card */
        .skill-card-badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.25);
        }

        /* Skill Tags */
        .skill-tags {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .skill-tag-wrapper {
            position: relative;
            width: 100%;
        }

        .skill-tag {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            background: rgba(0, 212, 170, 0.08);
            border: 1px solid var(--level-color, var(--primary-color));
            border-left: 4px solid var(--level-color, var(--primary-color));
            border-radius: 8px;
            font-size: 14px;
            color: var(--text-primary);
            transition: all 0.3s ease;
        }

        .skill-tag:hover {
            background: rgba(0, 212, 170, 0.16);
            transform: translateX(4px);
            box-shadow: 0 5px 15px rgba(0, 212, 170, 0.15);
        }

        .skill-tag-name {
            font-weight: 500;
            color: var(--text-primary);
        }

        .skill-tag-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 11px;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 6px;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .badge-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        /* Responsive Skills */
        @media (max-width: 768px) {
            .skills {
                padding: 60px 20px;
            }
            
            .skills-legend {
                justify-content: center; /* Rata tengah di mobile */
                gap: 10px 16px;
                margin-bottom: 25px;
                padding: 0 10px;
            }
            
            .skills-grid {
                grid-template-columns: 1fr;
                gap: 20px;
                max-width: 100%;
            }
            
            .skill-category {
                max-width: 380px;
                padding: 24px 20px;
            }
            
            .legend-item {
                font-size: 12px;
            }
        }

        @media (max-width: 480px) {
            .skills-legend {
                gap: 8px 12px;
                padding: 0 5px;
            }
            
            .legend-item {
                font-size: 11px;
                gap: 5px;
            }
            
            .legend-dot {
                width: 8px;
                height: 8px;
            }
            
            .skill-category {
                padding: 16px 14px;
            }

            .skill-category-header h3 {
                font-size: 17px;
            }

            .skill-card-badge {
                font-size: 10px;
                padding: 3px 9px;
            }
            
            .skill-tag {
                padding: 10px 12px;
                font-size: 13px;
            }

            .skill-tag-badge {
                font-size: 10px;
                padding: 2px 6px;
            }
        }
        
        /* Portfolio Section */
        .portfolio-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 40px;
        }

        .portfolio-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .portfolio-card:hover {
            border-color: var(--primary-color);
            transform: translateY(-8px);
            box-shadow: 0 10px 30px rgba(0, 212, 170, 0.1);
        }

        .portfolio-image {
            position: relative;
            overflow: hidden;
            height: 250px;
        }

        .portfolio-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .portfolio-card:hover .portfolio-image img {
            transform: scale(1.05);
        }

        .portfolio-info {
            padding: 25px;
        }

        .portfolio-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 12px;
            color: var(--text-primary);
        }

        .portfolio-desc {
            font-size: 14px;
            color: var(--text-secondary);
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .portfolio-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--primary-color);
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: gap 0.3s ease;
        }

        .portfolio-link:hover {
            gap: 12px;
        }

        /* ========================================= */
        /* FILTER BUTTONS */
        /* ========================================= */
        .filter-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 12px 28px;
            background: transparent;
            border: 2px solid var(--border-color);
            color: var(--text-secondary);
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Inter', sans-serif;
        }

        .filter-btn:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
            transform: translateY(-2px);
        }

        .filter-btn.active {
            background: var(--primary-color);
            border-color: var(--primary-color);
            color: var(--bg-dark);
        }

        /* ========================================= */
        /* ANIMASI FILTER DARI KIRI & KANAN */
        /* ========================================= */
        @keyframes fadeInFromLeft {
            from {
                opacity: 0;
                transform: translateX(-80px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateX(0) scale(1);
            }
        }

        @keyframes fadeInFromRight {
            from {
                opacity: 0;
                transform: translateX(80px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateX(0) scale(1);
            }
        }

        .portfolio-card.fade-out {
            opacity: 0;
            transform: scale(0.8);
        }

        .portfolio-card.hide {
            display: none;
        }

        .portfolio-card.fade-in-left {
            animation: fadeInFromLeft 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
        }

        .portfolio-card.fade-in-right {
            animation: fadeInFromRight 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
        }

        /* Contact Section */
        .contact-content {
            text-align: center;
            max-width: 700px;
            margin: 0 auto;
        }

        .contact-title {
            font-size: 42px;
            margin-bottom: 15px;
        }

        .contact-subtitle {
            color: var(--text-secondary);
            font-size: 16px;
            margin-bottom: 50px;
        }

        .contact-button {
            display: inline-block;
            padding: 18px 40px;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            margin-bottom: 50px;
        }

        .contact-button:hover {
            background: var(--primary-color);
            color: var(--bg-dark);
        }

        .contact-form {
            max-width: 600px;
            margin: 0 auto;
            display: grid;
            gap: 20px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 18px 24px;
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            color: var(--text-primary);
            font-family: 'Inter', sans-serif;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .form-group textarea {
            min-height: 150px;
            resize: vertical;
        }

        .submit-btn {
            padding: 18px 40px;
            background: var(--primary-color);
            color: var(--bg-dark);
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            justify-content: center;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 212, 170, 0.3);
        }

        /* Footer */
        footer {
            background: var(--bg-card);
            border-top: 1px solid var(--border-color);
            padding: 40px 60px;
            text-align: center;
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
        }

        .footer-social {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 25px;
        }

        .footer-social a {
            width: 45px;
            height: 45px;
            border: 1px solid var(--border-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            font-size: 18px;
            transition: all 0.3s ease;
        }

        .footer-social a:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
            transform: translateY(-3px);
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-bottom: 20px;
        }

        .footer-links a {
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: var(--primary-color);
        }

        .footer-text {
            color: var(--text-secondary);
            font-size: 14px;
        }

        .footer-text a {
            color: var(--primary-color);
            text-decoration: none;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .hero-content {
                grid-template-columns: 1fr;
                gap: 60px;
            }

            .hero-text {
                padding-left: 0;
                text-align: center;
            }

            .hero-title {
                font-size: 48px;
            }

            .about-content {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .hero {
                margin-top: 75px;
                padding: 40px 20px;
            }

            .hero-content {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .hero-text {
                padding-left: 0;
                text-align: center;
            }

            .hero-subtitle,
            .hero-description {
                text-align: center;
                margin-left: auto;
                margin-right: auto;
                max-width: 95%;
            }

            .hero-title {
                font-size: 32px;
                word-break: break-word;
            }

            .profile-card {
                max-width: 360px;
                padding: 35px 20px;
                margin: 0 auto;
            }

            .profile-image {
                width: 160px;
                height: 160px;
            }

            .profile-name {
                font-size: 24px;
            }

            .preloader-name {
                font-size: 32px;
            }

            .about-content {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .about-text {
                padding: 25px 20px;
            }

            .about-text h3 {
                font-size: 22px;
            }

            .about-image img {
                height: 250px;
            }

            .stats {
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: center;
                width: 100%;
                max-width: 100%;
                margin: 30px auto 0;
                gap: 12px;
            }

            .stat-item {
                flex: 1 1 120px;
                min-width: 100px;
                padding: 16px 12px;
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .stat-number {
                font-size: 28px;
                margin-bottom: 4px;
            }

            .stat-label {
                font-size: 12px;
                text-align: center;
            }

            section {
                padding: 50px 20px;
            }

            .section-title {
                font-size: 28px;
            }

            .skills-code {
                font-size: 50px;
            }

            .portfolio-grid {
                grid-template-columns: 1fr;
                gap: 24px;
            }

            .portfolio-image {
                height: 220px;
            }

            .filter-buttons {
                gap: 10px;
                margin-bottom: 30px;
            }

            .filter-btn {
                padding: 10px 18px;
                font-size: 13px;
            }

            .contact-title {
                font-size: 28px;
            }

            .contact-subtitle {
                font-size: 14px;
                margin-bottom: 30px;
            }

            .contact-button {
                padding: 14px 28px;
                font-size: 14px;
                margin-bottom: 35px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .form-group input,
            .form-group textarea {
                padding: 14px 18px;
                font-size: 14px;
            }

            .submit-btn {
                padding: 14px 28px;
                font-size: 15px;
                width: 100%;
            }

            .footer-content {
                padding: 0 15px;
            }

            .scroll-indicator {
                padding: 0 20px;
                margin-top: 20px;
            }
        }

        @media (max-width: 480px) {
            .hero {
                padding: 30px 15px;
                margin-top: 65px;
            }

            .hero-title {
                font-size: 24px;
                line-height: 1.25;
            }

            .hero-subtitle {
                font-size: 14px;
            }

            .hero-description {
                font-size: 13px;
            }

            .profile-card {
                max-width: 100%;
                padding: 25px 15px;
            }

            .profile-image {
                width: 130px;
                height: 130px;
            }

            .profile-name {
                font-size: 20px;
            }

            .profile-title {
                font-size: 13px;
            }

            .stats {
                gap: 8px;
            }

            .stat-item {
                flex: 1 1 85px;
                min-width: 80px;
                padding: 12px 6px;
            }

            .stat-number {
                font-size: 22px;
            }

            .stat-label {
                font-size: 10px;
                line-height: 1.2;
            }

            section {
                padding: 40px 15px;
            }

            .section-title {
                font-size: 22px;
            }

            .section-text {
                font-size: 13px;
            }

            .about-text {
                padding: 20px 15px;
            }

            .about-text h3 {
                font-size: 18px;
            }

            .about-text p {
                font-size: 13px;
                line-height: 1.6;
            }

            .about-image img {
                height: 190px;
            }

            .filter-buttons {
                gap: 6px;
            }

            .filter-btn {
                padding: 8px 12px;
                font-size: 12px;
            }

            .portfolio-image {
                height: 180px;
            }

            .portfolio-info {
                padding: 18px 15px;
            }

            .portfolio-title {
                font-size: 17px;
            }

            .portfolio-desc {
                font-size: 13px;
            }

            .contact-title {
                font-size: 22px;
            }

            .form-group input,
            .form-group textarea {
                padding: 12px 14px;
                font-size: 13px;
            }

            .preloader-name {
                font-size: 26px;
            }

            .preloader-role {
                font-size: 13px;
            }

            .footer-social a {
                width: 38px;
                height: 38px;
                font-size: 15px;
            }

            .footer-text {
                font-size: 12px;
            }
        }
    </style>
</head>
<!-- ... (HEAD DAN CSS TETAP SAMA PERSIS SEPERTI KODE KAMU) ... -->

<body class="no-scroll">
    <div id="preloader">
        <div class="preloader-content">
            <h1 class="preloader-name">{{ $user?->name ?? 'Prima' }}</h1>
            <p class="preloader-role">{{ $homepage->role ?? 'Informatics Engineering Student' }}</p>
            <div class="preloader-line"></div>
        </div>
    </div>

    @include('partials.navbar')

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-content">
            <div class="profile-card" data-aos="fade-right" data-aos-duration="1000">
                <div class="profile-image">
                    @if($user && $user->foto_profil)
                        <img src="{{ asset('storage/' . $user->foto_profil) }}?v={{ time() }}" alt="{{ $user->name ?? 'Prima' }}">
                    @else
                        <img src="{{ asset('images/profile.jpg') }}" alt="Prima">
                    @endif
                </div>
                <h2 class="profile-name">{{ $user->name ?? 'Prima' }}</h2>
                <p class="profile-title">{{ $homepage->role ?? 'Full-Stack Developer' }}</p>
                
                <div class="profile-info">
                    <div class="info-item"><i class="fas fa-map-marker-alt"></i><span>{{ $user->alamat ?? 'Jakarta, Indonesia' }}</span></div>
                    <div class="info-item"><i class="fas fa-circle-check"></i><span>{{ $user->status ?? 'Available for Work' }}</span></div>
                    <div class="info-item"><i class="fas fa-envelope"></i><span>{{ $user->email ?? 'prima@email.com' }}</span></div>
                    @php
                        $gh = $contact->link_github ?? ($user->link_github ?? '');
                        if ($gh && !\Illuminate\Support\Str::startsWith($gh, ['http://', 'https://'])) {
                            $gh = 'https://' . $gh;
                        }
                        $ghName = $gh ? str_replace(['https://github.com/', 'http://github.com/', 'https://', 'http://'], '', $gh) : 'GitHub';
                    @endphp
                    @if($gh)
                    <div class="info-item"><i class="fab fa-github"></i><a href="{{ $gh }}" target="_blank">{{ $ghName }}</a></div>
                    @endif
                </div>

                @if($user && $user->cv)
                <a href="{{ asset('storage/' . $user->cv) }}" class="download-cv" target="_blank" download>
                    <i class="fas fa-download"></i> Download CV
                </a>
                @endif
            </div>

            <div class="hero-text" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                <div class="hero-badge">&lt;/&gt; Developer</div>
                <h1 class="hero-title">
                    @if($homepage && $homepage->judul_deskripsi)
                        {!! nl2br(e($homepage->judul_deskripsi)) !!}
                    @else
                        Hey<br>I'm <span class="highlight">{{ $user->name ?? 'Prima' }}</span>,<br>{{ $homepage->role ?? 'Full-Stack Developer' }}
                    @endif
                </h1>
                <p class="hero-subtitle">{{ $homepage->catatan_utama ?? 'I help business grow by crafting amazing web experiences.' }}</p>
                <p class="hero-description">{{ $homepage->deskripsi ?? 'Saya adalah developer yang passionate dalam menciptakan solusi digital yang inovatif dan fungsional.' }}</p>
                <a href="#contact" class="cta-button">Let's Talk <i class="fas fa-arrow-right"></i></a>
            </div>

            <div class="stats" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                <div class="stat-item"><span class="stat-number">{{ $stats['projects'] ?? 0 }}</span><span class="stat-label">Projek<br>Dikerjakan</span></div>
                <div class="stat-item"><span class="stat-number">{{ $stats['organizations'] ?? 0 }}</span><span class="stat-label">Pengalaman<br>Kegiatan</span></div>
                <div class="stat-item"><span class="stat-number">{{ $stats['certificates'] ?? 0 }}</span><span class="stat-label">Sertifikasi</span></div>
            </div>
        </div>
    </section>

    <!-- Scroll Indicator -->
    <div class="scroll-indicator" data-aos="fade-up" data-aos-delay="600">
        <span class="scroll-text">Scroll Down</span>
        <div class="mouse"><div class="wheel"></div></div>
    </div>

    <!-- About Section -->
    <section id="about">
        <div class="section-header" data-aos="fade-down">
            <div class="section-badge">About Me</div>
            <h2 class="section-title">{{ $about->judul ?? 'Hello!' }}</h2>
            <p class="section-text">{{ $about->deskripsi ?? 'My name is Prima and I specialize in web development...' }}</p>
        </div>

        <div class="about-content">
            <div class="about-text" data-aos="fade-right" data-aos-duration="800">
                <h3>{{ $about->judul_detail ?? 'Hello!' }}</h3>
                <p>{!! nl2br(e($about->deskripsi_detail ?? 'When I\'m not coding, I am writing blogs, reading...')) !!}</p>
            </div>
            <div class="about-image" data-aos="fade-left" data-aos-duration="800" data-aos-delay="200">
                @if($about && $about->aboutme_gambar)
                    <img src="{{ asset('storage/' . $about->aboutme_gambar) }}" alt="About Me">
                @else
                    <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=800&h=600&fit=crop" alt="Working">
                @endif
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section class="skills" id="skills">
        <div class="skills-header" data-aos="zoom-in" data-aos-duration="800">
            <div class="skills-code">&lt;/&gt;</div>
            <div class="section-badge">Skills</div>
            <h2 class="section-title">I am striving to never stop learning and improving</h2>
        </div>

        <!-- Level Legend (Pojok Kanan Atas Section) -->
        <div class="skills-legend" data-aos="fade-down" data-aos-delay="200">
            <div class="legend-item">
                <span class="legend-dot" style="background: #10b981;"></span>
                <span>Beginner</span>
            </div>
            <div class="legend-item">
                <span class="legend-dot" style="background: #00d4aa;"></span>
                <span>Intermediate</span>
            </div>
            <div class="legend-item">
                <span class="legend-dot" style="background: #059669;"></span>
                <span>Advanced</span>
            </div>
            <div class="legend-item">
                <span class="legend-dot" style="background: #047857;"></span>
                <span>Expert</span>
            </div>
        </div>

        <div class="skills-grid">
            @if($skills->count() > 0)
                @php 
                    $groupedSkills = $skills->groupBy('skill_judul'); 
                @endphp
                
                @foreach($groupedSkills as $category => $items)
                @php
                    $levelMap = [
                        'beginner'     => ['name' => 'Beginner', 'color' => '#10b981'],
                        'intermediate' => ['name' => 'Intermediate', 'color' => '#00d4aa'],
                        'advanced'     => ['name' => 'Advanced', 'color' => '#059669'],
                        'expert'       => ['name' => 'Expert', 'color' => '#047857']
                    ];
                    $firstSkill = $items->first();
                    $cardLevelKey = $firstSkill->level ?: 'intermediate';
                    $cardLevel = $levelMap[$cardLevelKey] ?? ['name' => ucfirst($cardLevelKey), 'color' => '#00d4aa'];
                @endphp
                <div class="skill-category" data-aos="fade-right" data-aos-delay="{{ $loop->index * 100 }}">
                    
                    <!-- Icon dan Judul Kategori + Label Tingkat Keahlian di Pojok Kanan Atas Card -->
                    <div class="skill-category-header">
                        @php
                            $skillIcon = $firstSkill->emoji ?? 'fa-code';
                            if (!\Illuminate\Support\Str::startsWith($skillIcon, 'fa-')) {
                                $skillIcon = 'fa-code';
                            }
                        @endphp
                        <div class="category-title-wrap">
                            <i class="fas {{ $skillIcon }}"></i>
                            <h3>{{ $category }}</h3>
                        </div>
                        <span class="skill-card-badge" style="background: {{ $cardLevel['color'] }}; color: #0a0e17;">
                            {{ $cardLevel['name'] }}
                        </span>
                    </div>
                    
                    <div class="skill-tags">
                        @foreach($items as $skill)
                            @php
                                $sLevelKey = $skill->level ?: 'intermediate';
                                $sLevel = $levelMap[$sLevelKey] ?? ['name' => ucfirst($sLevelKey), 'color' => '#00d4aa'];
                                $levelColor = $sLevel['color'];
                            @endphp
                            
                            <div class="skill-tag-wrapper" style="--level-color: {{ $levelColor }};">
                                <div class="skill-tag">
                                    <span class="skill-tag-name">{{ $skill->judul_perskill }}</span>
                                    @if($items->count() > 1)
                                    <span class="skill-tag-badge" style="background: rgba(0, 212, 170, 0.12); color: {{ $levelColor }}; border: 1px solid {{ $levelColor }};">
                                        <span class="badge-dot" style="background: {{ $levelColor }};"></span>
                                        {{ $sLevel['name'] }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            @else
                <div class="card" style="grid-column: 1 / -1; text-align: center; padding: 50px;">
                    <i class="fas fa-code" style="font-size: 48px; color: var(--text-secondary); margin-bottom: 20px; opacity: 0.3;"></i>
                    <p style="color: var(--text-secondary); font-size: 16px;">Belum ada data skills. Silakan tambahkan di Admin Dashboard.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portfolio">
        <div class="section-header" data-aos="fade-down" data-aos-duration="800">
            <div class="section-badge">Portfolio</div>
            <h2 class="section-title">Projek Terbaru yang Saya Kerjakan</h2>
            <p class="section-text">Berikut adalah beberapa proyek pilihan yang mencerminkan keahlian dan dedikasi saya.</p>
        </div>

        <div class="filter-buttons" data-aos="fade-up" data-aos-delay="200">
            <button class="filter-btn active" data-filter="all">Semua</button>
            <button class="filter-btn" data-filter="project">Projek</button>
            <button class="filter-btn" data-filter="organization">Organisasi</button>
            <button class="filter-btn" data-filter="certificate">Sertifikat</button>
        </div>

        <div class="portfolio-grid">
            @forelse($portfolios as $item)
            <div class="portfolio-card" data-category="{{ $item->kategori }}" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="portfolio-image">
                    <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}">
                </div>
                <div class="portfolio-info">
                    <h3 class="portfolio-title">{{ $item->judul }}</h3>
                    <p class="portfolio-desc">{{ $item->deskripsi_singkat }}</p>
                    <a href="javascript:void(0)" 
                        class="portfolio-link open-modal-btn" 
                        data-judul="{{ $item->judul }}"
                        data-detail-judul="{{ $item->judul_isi ?? 'Detail Project' }}"
                        data-detail-deskripsi="{{ $item->deskripsi_isi ?? 'Tidak ada deskripsi detail.' }}">
                        Lihat Detail <i class="fas fa-arrow-right"></i>
                        </a>
                </div>
            </div>
            @empty
            <div class="card" style="grid-column: 1 / -1; text-align: center; padding: 50px;">
                <p style="color: var(--text-secondary);">Belum ada data portfolio. Silakan tambahkan di Admin Dashboard.</p>
            </div>
            @endforelse
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact">
        <div class="contact-content" data-aos="fade-up" data-aos-duration="800">
            <div class="section-badge" style="display: inline-block;">Contact</div>
            <h2 class="contact-title">{{ $contact->judul ?? 'I\'m currently available for freelance work' }}</h2>
            <p class="contact-subtitle">{{ $contact->deskripsi_singkat ?? 'Send me a message and let\'s create something amazing together' }}</p>
            
            <a href="mailto:{{ $user->email ?? 'prima@email.com' }}" class="contact-button">Send Me A Message</a>

            @if(session('success'))
                <div style="background: rgba(0, 212, 170, 0.1); border: 1px solid var(--primary-color); color: var(--primary-color); padding: 15px; border-radius: 8px; margin-bottom: 20px; text-align: center;">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div style="background: rgba(239, 68, 68, 0.12); border: 1px solid #ef4444; color: #fca5a5; padding: 15px; border-radius: 8px; margin-bottom: 20px; text-align: left;">
                    <div style="display: flex; align-items: center; gap: 8px; font-weight: 600; color: #ef4444; margin-bottom: 5px;">
                        <i class="fas fa-exclamation-triangle"></i> Gagal Mengirim Pesan:
                    </div>
                    <ul style="margin: 0; padding-left: 20px; font-size: 13px;">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="contact-form" action="{{ route('contact.send') }}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group" data-aos="fade-right" data-aos-delay="100">
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Your name *" required>
                    </div>
                    <div class="form-group" data-aos="fade-left" data-aos-delay="200">
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Your real email *" required>
                    </div>
                </div>
                <div class="form-group" data-aos="fade-up" data-aos-delay="300">
                    <textarea name="message" placeholder="Your message *" required>{{ old('message') }}</textarea>
                </div>
                <button type="submit" class="submit-btn" data-aos="zoom-in" data-aos-delay="400">
                    Send Message <i class="fas fa-paper-plane"></i>
                </button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content" data-aos="fade-down" data-aos-duration="800">
            <div class="footer-social">
                @php
                    $fGithub = $contact->link_github ?? ($user->link_github ?? '');
                    if ($fGithub && !\Illuminate\Support\Str::startsWith($fGithub, ['http://', 'https://'])) {
                        $fGithub = 'https://' . $fGithub;
                    }

                    $fLinkedin = $contact->link_linkedin ?? '';
                    if ($fLinkedin && !\Illuminate\Support\Str::startsWith($fLinkedin, ['http://', 'https://'])) {
                        $fLinkedin = 'https://' . $fLinkedin;
                    }

                    $fInstagram = $contact->link_instagram ?? '';
                    if ($fInstagram && !\Illuminate\Support\Str::startsWith($fInstagram, ['http://', 'https://'])) {
                        $fInstagram = 'https://' . $fInstagram;
                    }
                @endphp
                @if($fGithub)
                    <a href="{{ $fGithub }}" target="_blank" title="GitHub"><i class="fab fa-github"></i></a>
                @endif
                @if($fLinkedin)
                    <a href="{{ $fLinkedin }}" target="_blank" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                @endif
                @if($fInstagram)
                    <a href="{{ $fInstagram }}" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
                @endif
            </div>
            <p class="footer-text">© {{ date('Y') }} {{ $user->name ?? 'Prima' }}. All rights reserved.<br>Design by <a href="#">{{ $user->name ?? 'Prima' }}</a></p>
        </div>
    </footer>

    <!-- Modal Detail Portofolio -->
    <div id="portfolioModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.85); z-index: 9999; justify-content: center; align-items: center; backdrop-filter: blur(5px);">
        <div style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 16px; width: 90%; max-width: 600px; padding: 30px; position: relative; box-shadow: 0 20px 50px rgba(0,0,0,0.5);">
            <button onclick="closeModal()" style="position: absolute; top: 15px; right: 15px; background: none; border: none; color: var(--text-secondary); font-size: 24px; cursor: pointer; transition: 0.3s;">&times;</button>
            
            <h3 id="modalJudul" style="font-size: 24px; font-weight: 700; color: var(--primary-color); margin-bottom: 10px;"></h3>
            <h4 id="modalDetailJudul" style="font-size: 18px; font-weight: 600; color: var(--text-primary); margin-bottom: 15px;"></h4>
            <p id="modalDetailDeskripsi" style="color: var(--text-secondary); line-height: 1.8; font-size: 15px;"></p>
            
            <button onclick="closeModal()" style="margin-top: 25px; padding: 10px 25px; background: var(--bg-dark); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 8px; cursor: pointer; font-weight: 600; transition: 0.3s;">Tutup</button>
        </div>
    </div>

    <!-- AOS Animation JS & Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // PRELOADER LOGIC
        window.addEventListener('load', () => {
            const preloader = document.getElementById('preloader');
            const body = document.body;
            setTimeout(() => {
                preloader.classList.add('loaded');
                body.classList.remove('no-scroll');
                setTimeout(() => { AOS.refreshHard(); }, 800);
            }, 2500); 
        });

        AOS.init({ duration: 800, easing: 'ease-out-cubic', once: false, mirror: true, offset: 100 });

        // FILTER PORTFOLIO
        const filterButtons = document.querySelectorAll('.filter-btn');
        const portfolioCards = document.querySelectorAll('.portfolio-card');
        let previousFilterIndex = 0;

        filterButtons.forEach((button, currentIndex) => {
            button.addEventListener('click', () => {
                filterButtons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');
                const filterValue = button.getAttribute('data-filter');
                const direction = currentIndex > previousFilterIndex ? 'right' : 'left';
                const animationClass = direction === 'right' ? 'fade-in-right' : 'fade-in-left';
                previousFilterIndex = currentIndex;

                portfolioCards.forEach(card => {
                    card.classList.add('fade-out');
                    card.classList.remove('fade-in-left', 'fade-in-right');
                });

                setTimeout(() => {
                    let delay = 0;
                    portfolioCards.forEach(card => {
                        card.classList.remove('fade-out', 'fade-in-left', 'fade-in-right');
                        if (filterValue === 'all' || card.getAttribute('data-category') === filterValue) {
                            card.classList.remove('hide');
                            setTimeout(() => { card.classList.add(animationClass); }, delay);
                            delay += 80;
                        } else {
                            card.classList.add('hide');
                        }
                    });
                }, 400);
            });
        });

        // SMOOTH SCROLL
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    setTimeout(() => { AOS.refreshHard(); }, 600);
                }
            });
        });

        // ACTIVE NAV LINK
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.nav-links a');
        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                if (window.scrollY >= section.offsetTop - 200) current = section.getAttribute('id');
            });
            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === `/#${current}` || link.getAttribute('href') === `#${current}`) {
                    link.classList.add('active');
                }
            });
        });

        // Fungsi Modal Portofolio
        const modal = document.getElementById('portfolioModal');
        const modalJudul = document.getElementById('modalJudul');
        const modalDetailJudul = document.getElementById('modalDetailJudul');
        const modalDetailDeskripsi = document.getElementById('modalDetailDeskripsi');

        document.querySelectorAll('.open-modal-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                modalJudul.textContent = this.getAttribute('data-judul');
                modalDetailJudul.textContent = this.getAttribute('data-detail-judul');
                modalDetailDeskripsi.textContent = this.getAttribute('data-detail-deskripsi');
                modal.style.display = 'flex';
                document.body.style.overflow = 'hidden'; // Mencegah scroll background
            });
        });

        function closeModal() {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto'; // Mengembalikan scroll
        }

        // Tutup modal jika klik di luar area konten
        modal.addEventListener('click', function(e) {
            if (e.target === modal) closeModal();
        });
    </script>
</body>
</html>