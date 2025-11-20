@extends('layouts.main')

@section('content')
<style>
    .home-hero {
        min-height: 90vh;
        padding: 8rem 1.5rem 4rem;
        background: radial-gradient(circle at top, rgba(251, 146, 60, 0.12), transparent 52%);
        font-family: "Segoe UI", system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
    }

    .home-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .hero-content {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        align-items: center;
        gap: 2rem;
    }

    .hero-eyebrow {
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
    }

    .hero-title {
        font-size: clamp(2.5rem, 4vw, 3.5rem);
        color: #0f172a;
        margin: 1.25rem 0 1rem;
        line-height: 1.1;
    }

    .hero-title span {
        color: #f97316;
    }

    .hero-text {
        color: #475569;
        font-size: 1.15rem;
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }

    .hero-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 0.9rem;
    }

    .cta-btn {
        border-radius: 999px;
        padding: 0.95rem 1.8rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        box-shadow: 0 15px 35px rgba(249, 115, 22, 0.35);
        background: linear-gradient(135deg, #fb923c, #f97316);
        color: #fff;
    }

    .cta-btn.secondary {
        background: transparent;
        color: #0f172a;
        border: 1px solid #e2e8f0;
        box-shadow: none;
    }

    .hero-card {
        position: relative;
        background: #fff;
        border-radius: 1.5rem;
        padding: 2rem;
        box-shadow: 0 30px 90px rgba(15, 23, 42, 0.12);
        border: 1px solid #eef2ff;
    }

    .hero-card::after {
        content: "";
        position: absolute;
        inset: -2px;
        border-radius: 1.75rem;
        background: linear-gradient(135deg, rgba(251, 146, 60, 0.4), transparent);
        z-index: -1;
    }

    .hero-card h3 {
        font-size: 1.2rem;
        margin-bottom: 0.75rem;
        color: #0f172a;
    }

    .hero-json {
        background: #0f172a;
        color: #cbd5f5;
        border-radius: 1rem;
        padding: 1rem;
        font-family: "Source Code Pro", Consolas, monospace;
        font-size: 0.9rem;
        line-height: 1.5;
    }

    .trust-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 1.5rem;
        margin-top: 3rem;
    }

    .trust-card {
        background: #fff;
        border-radius: 1rem;
        padding: 1.25rem;
        border: 1px solid #e2e8f0;
        text-align: center;
    }

    .trust-card strong {
        display: block;
        font-size: 2rem;
        color: #f97316;
    }

    .section-title {
        text-align: center;
        color: #0f172a;
        font-size: 2rem;
        margin-bottom: 2rem;
    }

    .feature-section {
        padding: 4rem 1.5rem;
        background: #fff;
    }

    .feature-grid {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 1.5rem;
    }

    .feature-card {
        border-radius: 1.25rem;
        padding: 1.5rem;
        border: 1px solid #f1f5f9;
        box-shadow: 0 15px 35px rgba(15, 23, 42, 0.06);
    }

    .feature-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: rgba(249, 115, 22, 0.12);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #f97316;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .cta-section {
        padding: 4rem 1.5rem 5rem;
        background: linear-gradient(135deg, #111827, #0f172a);
        color: #fff;
        text-align: center;
    }

    .cta-section h2 {
        font-size: 2.2rem;
        margin-bottom: 1rem;
    }

    .cta-section p {
        color: #cbd5f5;
        max-width: 620px;
        margin: 0 auto 2rem;
        line-height: 1.6;
    }
</style>

<section class="home-hero">
    <div class="home-container">
        <div class="hero-content">
            <div>
                <span class="hero-eyebrow">AI + Human Interview Studio</span>
                <h1 class="hero-title">Practice smarter, <span>perform louder</span>.</h1>
                <p class="hero-text">
                    MockMate blends adaptive AI drills with peer and expert sessions so you can rehearse every scenario before the real call. Build confidence, track progress, and get actionable coaching in one calm-looking dashboard.
                </p>
                <div class="hero-actions">
                    <a href="{{ url('/ai-interview') }}" class="cta-btn">Try AI Interview</a>
                    <a href="{{ url('/expert-interview') }}" class="cta-btn secondary">Book Expert Session</a>
                </div>
            </div>
            <div class="hero-card">
                <h3>Live readiness snapshot</h3>
                <div class="hero-json">
                    {
                    <br>&nbsp;&nbsp;"role": "Frontend Engineer",
                    <br>&nbsp;&nbsp;"level": "Senior",
                    <br>&nbsp;&nbsp;"aiScore": 87,
                    <br>&nbsp;&nbsp;"sessionsBooked": 3,
                    <br>&nbsp;&nbsp;"nextAction": "Expert mock @ 6pm"
                    <br>}
                </div>
            </div>
        </div>

        <div class="trust-grid">
            <div class="trust-card">
                <strong>15K+</strong>
                candidates trained
            </div>
            <div class="trust-card">
                <strong>94%</strong>
                report higher confidence
            </div>
            <div class="trust-card">
                <strong>120</strong>
                partner interviewers
            </div>
        </div>
    </div>
</section>

<section class="feature-section">
    <h2 class="section-title">Everything you need for end-to-end prep</h2>
    <div class="feature-grid">
        <div class="feature-card">
            <div class="feature-icon">AI</div>
            <h3>Adaptive AI drills</h3>
            <p>Generate role-aware questions, auto-score by keywords, and get targeted improvement tips after every answer.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">FX</div>
            <h3>Expert live rooms</h3>
            <p>Spin up peer-to-peer video rooms with session codes, share SDPs, and rehearse with real experts as if it’s the big day.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">PB</div>
            <h3>Progress board</h3>
            <p>Track AI scores, session history, and focus areas across roles so you know exactly when you’re ready.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">LX</div>
            <h3>Human coaching</h3>
            <p>Record sessions, bookmark standout answers, and collect feedback loops from mentors to sharpen delivery.</p>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="home-container" style="text-align:center;">
        <h2>Ready to rewrite your interview story?</h2>
        <p>
            Start with AI drills, jump into expert calls, or blend both. MockMate keeps you aligned with the same modern look and feel across every page.
        </p>
        <div class="hero-actions" style="justify-content:center;">
            <a href="{{ url('/ai-interview') }}" class="cta-btn">Launch AI Practice</a>
            <a href="{{ url('/expert-interview') }}" class="cta-btn secondary" style="color:#fff;border-color:rgba(255,255,255,0.2);">Schedule Expert</a>
        </div>
    </div>
</section>
@endsection