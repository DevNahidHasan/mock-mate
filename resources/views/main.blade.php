@extends('layouts.app')

@section('title', 'MockMate – Smart Mock Interview Platform')

@section('content')

<!-- ================= HERO SECTION ================= -->
<section id="hero" class="hero-section">
    <div class="container">
        <div class="hero-content">
            <h1>MockMate</h1>
            <h2>Smart, Expert-Led Mock Interviews</h2>
            <p>
                Prepare for real-world job interviews with industry experts,
                structured evaluations, and AI-powered insights.
            </p>
            <div class="hero-actions">
                <a href="/register" class="btn-primary">Get Started</a>
                <a href="/interviews" class="btn-secondary">Book Mock Interview</a>
            </div>
        </div>
    </div>
</section>

<!-- ================= WHY WE ARE BEST ================= -->
<section id="why-best" class="section">
    <div class="container">
        <h2 class="section-title">Why MockMate Is Different</h2>

        <div class="grid-3">
            <div class="card">
                <h3>Industry Experts</h3>
                <p>
                    Get interviewed by real professionals with hands-on industry experience,
                    not automated bots or static systems.
                </p>
            </div>

            <div class="card">
                <h3>Skill-Specific Practice</h3>
                <p>
                    Choose your preferred domain and receive interviews tailored
                    exactly to your job role.
                </p>
            </div>

            <div class="card">
                <h3>AI-Powered Feedback</h3>
                <p>
                    Advanced AI analyzes interview transcripts and summarizes
                    expert feedback into clear reports.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ================= ABOUT SECTION ================= -->
<section id="about" class="section-light">
    <div class="container">
        <h2 class="section-title">About MockMate</h2>
        <p>
            MockMate is a smart mock interview platform designed to help job seekers
            gain confidence and readiness for real-world interviews.
        </p>
        <p>
            Unlike traditional platforms that rely on static question banks,
            MockMate focuses on interactive, expert-led interviews with structured
            evaluation and continuous performance tracking.
        </p>
    </div>
</section>

<!-- ================= FEATURES ================= -->
<section id="features" class="section">
    <div class="container">
        <h2 class="section-title">Core Features</h2>

        <ul class="feature-list">
            <li>✔ Live mock interviews using WebRTC</li>
            <li>✔ Slot-based interview booking</li>
            <li>✔ Skill-based leaderboards</li>
            <li>✔ Interview history & performance tracking</li>
            <li>✔ AI-generated questions and feedback summaries</li>
        </ul>
    </div>
</section>

<!-- ================= PRICING ================= -->
<section id="pricing" class="section-light">
    <div class="container">
        <h2 class="section-title">Pricing Plans</h2>

        <div class="grid-3">
            <div class="pricing-card">
                <h3>Free</h3>
                <p class="price">$0</p>
                <ul>
                    <li>Basic interview access</li>
                    <li>Limited feedback</li>
                    <li>No expert interviews</li>
                </ul>
            </div>

            <div class="pricing-card featured">
                <h3>Pro</h3>
                <p class="price">$29</p>
                <ul>
                    <li>Expert-led interviews</li>
                    <li>AI feedback summaries</li>
                    <li>Performance tracking</li>
                </ul>
            </div>

            <div class="pricing-card">
                <h3>Enterprise</h3>
                <p class="price">Custom</p>
                <ul>
                    <li>Bulk interviews</li>
                    <li>Dedicated experts</li>
                    <li>Advanced analytics</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- ================= FAQ ================= -->
<section id="faq" class="section">
    <div class="container">
        <h2 class="section-title">Frequently Asked Questions</h2>

        <div class="faq-item">
            <h4>Who conducts the interviews?</h4>
            <p>Interviews are conducted by verified industry professionals.</p>
        </div>

        <div class="faq-item">
            <h4>Is this platform beginner-friendly?</h4>
            <p>Yes. MockMate supports beginners to advanced professionals.</p>
        </div>

        <div class="faq-item">
            <h4>Is AI replacing human interviewers?</h4>
            <p>No. AI enhances feedback, but interviews are expert-led.</p>
        </div>
    </div>
</section>

<!-- ================= CONTACT ================= -->
<section id="contact" class="section-light">
    <div class="container">
        <h2 class="section-title">Contact Us</h2>

        <form method="POST" action="/contact">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Message</label>
                <textarea name="message" rows="4"></textarea>
            </div>

            <button type="submit" class="btn-primary">Send Message</button>
        </form>
    </div>
</section>

<!-- ================= FOOTER ================= -->
<footer class="footer">
    <div class="container">
        <p>© {{ date('Y') }} MockMate. All rights reserved.</p>
        <p>
            Built with Laravel, WebRTC, and AI-powered insights.
        </p>
    </div>
</footer>

@endsection
