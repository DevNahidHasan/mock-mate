@extends('layouts.main')

@section('content')
<style>
    .about-hero {
        min-height: 60vh;
        padding: 8rem 1.5rem 4rem;
        background: radial-gradient(circle at top, rgba(251, 146, 60, 0.12), transparent 52%);
        font-family: "Segoe UI", system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
    }

    .about-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .about-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .about-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        padding: 0.35rem 0.9rem;
        border-radius: 999px;
        background: rgba(15, 23, 42, 0.85);
        color: #f97316;
        font-weight: 600;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        font-size: 0.85rem;
        margin-bottom: 1rem;
    }

    .about-title {
        font-size: clamp(2.5rem, 4vw, 3.5rem);
        color: #0f172a;
        margin: 1.25rem 0 1rem;
        line-height: 1.1;
    }

    .about-title span {
        color: #f97316;
    }

    .about-subtitle {
        color: #475569;
        font-size: 1.15rem;
        line-height: 1.6;
        max-width: 800px;
        margin: 0 auto;
    }

    .project-info-section {
        padding: 4rem 1.5rem;
        background: #fff;
        font-family: "Segoe UI", system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
    }

    .project-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }

    .info-card {
        background: #fff;
        border-radius: 1.25rem;
        padding: 2rem;
        border: 1px solid #f1f5f9;
        box-shadow: 0 15px 35px rgba(15, 23, 42, 0.06);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 45px rgba(15, 23, 42, 0.12);
    }

    .info-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        background: rgba(249, 115, 22, 0.12);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #f97316;
        font-weight: 700;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    .info-card h3 {
        color: #0f172a;
        font-size: 1.3rem;
        margin-bottom: 0.75rem;
        font-family: "Segoe UI", system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
    }

    .info-card p {
        color: #475569;
        line-height: 1.6;
        font-family: "Segoe UI", system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
    }

    .team-section {
        padding: 4rem 1.5rem;
        background: linear-gradient(135deg, #f8fafc, #fff);
        font-family: "Segoe UI", system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
    }

    .section-title {
        text-align: center;
        color: #0f172a;
        font-size: 2rem;
        margin-bottom: 2rem;
        font-family: "Segoe UI", system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
    }

    .section-subtitle {
        text-align: center;
        color: #64748b;
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto 3rem;
        line-height: 1.6;
        font-family: "Segoe UI", system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
    }

    .team-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }

    .team-card {
        background: #fff;
        border-radius: 1.5rem;
        padding: 2rem;
        border: 1px solid #e2e8f0;
        box-shadow: 0 15px 35px rgba(15, 23, 42, 0.08);
        text-align: center;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .team-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #fb923c, #f97316);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .team-card:hover::before {
        transform: scaleX(1);
    }

    .team-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 50px rgba(249, 115, 22, 0.15);
        border-color: rgba(249, 115, 22, 0.2);
    }

    .team-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        margin: 0 auto 1.5rem;
        background: linear-gradient(135deg, #fb923c, #f97316);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        font-weight: 700;
        color: #fff;
        border: 4px solid rgba(249, 115, 22, 0.1);
        box-shadow: 0 10px 30px rgba(249, 115, 22, 0.2);
        position: relative;
    }

    .team-avatar img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
    }

    .team-name {
        font-size: 1.4rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 0.5rem;
        font-family: "Segoe UI", system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
    }

    .team-role {
        display: inline-block;
        padding: 0.4rem 1rem;
        background: rgba(249, 115, 22, 0.1);
        color: #f97316;
        border-radius: 999px;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 1rem;
        font-family: "Segoe UI", system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
    }

    .team-bio {
        color: #64748b;
        line-height: 1.6;
        font-size: 0.95rem;
        font-family: "Segoe UI", system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
    }

    .mission-section {
        padding: 4rem 1.5rem;
        background: linear-gradient(135deg, #111827, #0f172a);
        color: #fff;
        text-align: center;
        font-family: "Segoe UI", system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
    }

    .mission-content {
        max-width: 800px;
        margin: 0 auto;
    }

    .mission-section h2 {
        font-size: 2.2rem;
        margin-bottom: 1.5rem;
        color: #fff;
        font-family: "Segoe UI", system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
    }

    .mission-section p {
        color: #cbd5f5;
        font-size: 1.1rem;
        line-height: 1.8;
        margin-bottom: 1rem;
        font-family: "Segoe UI", system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
    }
</style>

<section class="about-hero">
    <div class="about-container">
        <div class="about-header">
            <span class="about-eyebrow">About MockMate</span>
            <h1 class="about-title">Building the future of <span>interview preparation</span></h1>
            <p class="about-subtitle">
                MockMate is a comprehensive interview preparation platform that combines AI-powered practice sessions with expert-led mock interviews. We're on a mission to help candidates build confidence and excel in their career journeys.
            </p>
        </div>
    </div>
</section>

<section class="project-info-section">
    <div class="about-container">
        <h2 class="section-title">What We Built</h2>
        <div class="project-info-grid">
            <div class="info-card">
                <div class="info-icon">AI</div>
                <h3>AI-Powered Practice</h3>
                <p>Advanced AI algorithms generate role-specific interview questions and provide real-time feedback to help you improve your answers.</p>
            </div>
            <div class="info-card">
                <div class="info-icon">EX</div>
                <h3>Expert Sessions</h3>
                <p>Connect with industry professionals for personalized mock interviews and receive actionable feedback to refine your skills.</p>
            </div>
            <div class="info-card">
                <div class="info-icon">PT</div>
                <h3>Progress Tracking</h3>
                <p>Monitor your improvement with detailed analytics, session history, and performance metrics across different interview types.</p>
            </div>
            <div class="info-card">
                <div class="info-icon">MT</div>
                <h3>Modern Technology</h3>
                <p>Built with cutting-edge web technologies to deliver a seamless, responsive experience across all devices.</p>
            </div>
        </div>
    </div>
</section>

<section class="team-section">
    <div class="about-container">
        <h2 class="section-title">Meet Our Team</h2>
        <p class="section-subtitle">A passionate group of developers dedicated to revolutionizing interview preparation</p>
        
        <div class="team-grid">
            <div class="team-card">
                <div class="team-avatar">
                    <img src="{{ asset('assets/images/nahid.jpg') }}" alt="Alex Morgan">
                </div>
                <h3 class="team-name">S M NAHID HASAN</h3>
                <span class="team-role">Project Lead & Full Stack Developer</span>
                <p class="team-bio">Orchestrating the vision and leading the technical architecture. Ensures seamless integration across all platform components.</p>
            </div>

            <div class="team-card">
                <div class="team-avatar">
                    <img src="{{ asset('assets/images/tamim.jpg') }}" alt="Sarah Johnson">
                </div>
                <h3 class="team-name">Tamim Hasan</h3>
                <span class="team-role">Frontend Developer</span>
                <p class="team-bio">Crafting beautiful, intuitive user interfaces with modern design principles. Focuses on creating exceptional user experiences.</p>
            </div>

            <div class="team-card">
                <div class="team-avatar">
                    <img src="{{ asset('assets/images/nirob.jpg') }}" alt="Michael Chen">
                </div>
                <h3 class="team-name">Nahid Hasan Nirob</h3>
                <span class="team-role">Backend Developer</span>
                <p class="team-bio">Building robust APIs and server-side logic. Ensures scalability, security, and optimal performance of the platform.</p>
            </div>

            <div class="team-card">
                <div class="team-avatar">
                    <img src="{{ asset('assets/images/maruf,jpg.jpg') }}" alt="Emily Rodriguez">
                </div>
                <h3 class="team-name">Maruf Akter John</h3>
                <span class="team-role">UI/UX Designer</span>
                <p class="team-bio">Designing user flows and visual experiences that make interview preparation engaging and stress-free.</p>
            </div>

            <div class="team-card">
                <div class="team-avatar">
                    <img src="{{ asset('assets/images/shwon.png') }}" alt="David Thompson">
                </div>
                <h3 class="team-name">Shahriar Antor Shawon</h3>
                <span class="team-role">DevOps & System Architect</span>
                <p class="team-bio">Managing infrastructure, deployment pipelines, and system architecture to ensure reliability and scalability.</p>
            </div>
        </div>
    </div>
</section>

<section class="mission-section">
    <div class="about-container">
        <div class="mission-content">
            <h2>Our Mission</h2>
            <p>
                At MockMate, we believe that everyone deserves the opportunity to showcase their true potential in interviews. We've created a platform that combines the power of artificial intelligence with human expertise to provide comprehensive interview preparation.
            </p>
            <p>
                Our goal is to eliminate interview anxiety and help candidates build the confidence they need to succeed. Through continuous innovation and a user-centric approach, we're committed to making interview preparation accessible, effective, and enjoyable.
            </p>
        </div>
    </div>
</section>
@endsection
