<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact – MockMate</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Navbar styles (same as main) -->
    <style>
        .navbar{
            position:fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 50;
            height: 72px;
            background: rgba(255, 255, 255, 0.9);
            border-bottom: 1px solid #f1f5f9;
            box-shadow: 0 25px 60px rgba(15, 23, 42, 0.08);
            backdrop-filter: blur(18px);
            font-family: "Segoe UI", system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
        }

        .navbar-container{
            margin: 0 auto;
            padding:0 1.5rem;
            max-width: 1200px;
            height: 100%;
        }

        .navbar-flex{
            display: flex;
            justify-content: space-between;
            align-items: center;
            height:100%;
        }

        .nick-name a{
            font-size: 1.4rem;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            color:#0f172a;
            letter-spacing: 0.03em;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .nick-name a::before{
            content: "";
            width: 10px;
            height: 10px;
            border-radius: 999px;
            background: linear-gradient(135deg, #fb923c, #f97316);
            box-shadow: 0 0 15px rgba(249, 115, 22, 0.6);
        }

        .nav-btn ul{
            list-style: none;
            display: flex;
            gap: 0.75rem;
            margin: 0;
            padding: 0;
        }

        .nav-btn a{
            text-decoration: none;
            padding: 0.55rem 1.25rem;
            color: #475569;
            cursor: pointer;
            border-radius: 999px;
            font-weight: 600;
            transition: background 0.2s ease, color 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
            border: 1px solid transparent;
        }

        .nav-btn a:hover{
            color: #0f172a;
            border-color: #fcd34d;
            background: rgba(252, 211, 77, 0.15);
            box-shadow: 0 10px 28px rgba(249, 115, 22, 0.2);
        }

        .nav-btn a.active{
            background: linear-gradient(135deg, #fb923c, #f97316);
            color: #fff;
            box-shadow: 0 18px 35px rgba(249, 115, 22, 0.35);
        }

        /* Contact page styles */
        body {
            margin: 0;
            font-family: "Segoe UI", system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
            background: #f8fafc;
        }

        .contact-hero {
            min-height: 90vh;
            padding: 8rem 1.5rem 4rem;
            background: radial-gradient(circle at top, rgba(251, 146, 60, 0.12), transparent 52%);
        }

        .contact-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2rem;
            align-items: flex-start;
        }

        .contact-header-eyebrow {
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

        .contact-title {
            font-size: clamp(2.1rem, 3.2vw, 2.8rem);
            color: #0f172a;
            margin: 1.25rem 0 0.5rem;
        }

        .contact-subtext {
            color: #475569;
            font-size: 1.02rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            max-width: 480px;
        }

        .contact-card {
            background: #fff;
            border-radius: 1.5rem;
            padding: 2rem;
            box-shadow: 0 30px 90px rgba(15, 23, 42, 0.12);
            border: 1px solid #eef2ff;
        }

        .contact-card h3 {
            margin-top: 0;
            margin-bottom: 0.5rem;
            font-size: 1.25rem;
            color: #0f172a;
        }

        .contact-card p {
            margin: 0 0 1.2rem;
            color: #64748b;
            font-size: 0.98rem;
        }

        .contact-info-list {
            list-style: none;
            padding: 0;
            margin: 0 0 1.5rem;
        }

        .contact-info-list li {
            margin-bottom: 0.7rem;
            color: #0f172a;
            font-size: 0.98rem;
        }

        .contact-info-label {
            display: inline-block;
            min-width: 90px;
            color: #94a3b8;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .contact-pill-row {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .contact-pill {
            padding: 0.25rem 0.8rem;
            border-radius: 999px;
            border: 1px solid #e2e8f0;
            font-size: 0.85rem;
            color: #475569;
            background: #f8fafc;
        }

        .contact-form-card {
            background: #fff;
            border-radius: 1.5rem;
            padding: 2rem;
            box-shadow: 0 30px 90px rgba(15, 23, 42, 0.12);
            border: 1px solid #eef2ff;
        }

        .contact-form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
            margin-bottom: 1rem;
        }

        .form-label {
            font-size: 0.9rem;
            font-weight: 600;
            color: #475569;
        }

        .form-input,
        .form-textarea {
            border-radius: 0.9rem;
            border: 1px solid #e2e8f0;
            padding: 0.7rem 0.9rem;
            font-size: 0.95rem;
            outline: none;
            background: #f8fafc;
            transition: border-color 0.15s ease, box-shadow 0.15s ease, background 0.15s ease;
        }

        .form-textarea {
            min-height: 140px;
            resize: vertical;
        }

        .form-input:focus,
        .form-textarea:focus {
            border-color: #fb923c;
            background: #fff;
            box-shadow: 0 0 0 1px rgba(249, 115, 22, 0.25), 0 18px 35px rgba(15, 23, 42, 0.1);
        }

        .contact-submit-row {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 1rem;
            margin-top: 0.5rem;
        }

        .cta-btn {
            border-radius: 999px;
            padding: 0.85rem 1.7rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            box-shadow: 0 15px 35px rgba(249, 115, 22, 0.35);
            background: linear-gradient(135deg, #fb923c, #f97316);
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .small-helper {
            font-size: 0.8rem;
            color: #94a3b8;
        }

        /* Footer (same style as your main page) */
        .site-footer {
            background: #0f172a;
            color: #e2e8f0;
            padding: 3rem 1.5rem;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 2rem;
        }

        .footer-brand h3 {
            font-size: 1.4rem;
            margin-bottom: 0.5rem;
            color: #fff;
        }

        .footer-brand p {
            line-height: 1.6;
            color: #94a3b8;
            margin: 0;
        }

        .footer-links h4 {
            font-size: 1rem;
            color: #f97316;
            margin-bottom: 0.75rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .footer-links ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .footer-links a {
            display: inline-block;
            color: #cbd5f5;
            text-decoration: none;
            margin-bottom: 0.45rem;
            transition: color 0.2s ease;
        }

        .footer-links a:hover {
            color: #fff;
        }

        .footer-social {
            display: flex;
            gap: 0.6rem;
        }

        .footer-pill {
            border-radius: 999px;
            padding: 0.35rem 0.9rem;
            background: rgba(255, 255, 255, 0.08);
            color: #cbd5f5;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            border: 1px solid rgba(148, 163, 184, 0.25);
            transition: all 0.2s ease;
        }

        .footer-pill:hover {
            background: rgba(249, 115, 22, 0.25);
            border-color: rgba(249, 115, 22, 0.5);
            color: #fff;
        }

        .footer-bottom {
            text-align: center;
            margin-top: 2.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(148, 163, 184, 0.2);
            font-size: 0.95rem;
            color: #94a3b8;
        }
    </style>
</head>
<body>

<nav class="navbar">
    <div class="navbar-container">
        <div class="navbar-flex">
            <div class="nick-name">
                <a href="/">MockMate</a>
            </div>
            <div class="nav-btn">
                <ul>
                    <li>
                        <a href="/">HOME</a>
                    </li>
                    <li>
                        <a href="/ai-interview">AI INTERVIEW</a>
                    </li>
                    <li>
                        <a href="/expert-interview">EXPERT INTERVIEW</a>
                    </li>
                    <li>
                        <a href="/about">ABOUT</a>
                    </li>
                    <li>
                        <a href="/contact" class="active">CONTACT</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<section class="contact-hero">
    <div class="contact-container">
        <div class="contact-grid">
            <!-- Left side: text and info -->
            <div>
                <span class="contact-header-eyebrow">Get in touch</span>
                <h1 class="contact-title">Let’s talk about your next interview step.</h1>
                <p class="contact-subtext">
                    Have feedback about MockMate, need help with a session, or want to collaborate?
                    Drop us a message and we’ll get back within one business day.
                </p>

                <div class="contact-card">
                    <h3>Contact details</h3>
                    <p>Reach us directly or use the form. We’ll reply with specific, practical help—not canned responses.</p>

                    <ul class="contact-info-list">
                        <li>
                            <span class="contact-info-label">Email</span>
                            team@mockmate.com
                        </li>
                        <li>
                            <span class="contact-info-label">Support</span>
                            support@mockmate.com
                        </li>
                        <li>
                            <span class="contact-info-label">Hours</span>
                            Sun–Thu, 10:00 AM – 7:00 PM (GMT+6)
                        </li>
                    </ul>

                    <div class="contact-pill-row">
                        <span class="contact-pill">Account issues</span>
                        <span class="contact-pill">Interview advice</span>
                        <span class="contact-pill">Feature request</span>
                        <span class="contact-pill">Partnerships</span>
                    </div>
                </div>
            </div>

            <!-- Right side: form -->
            <div>
                <div class="contact-form-card">
                    <h3>Send us a message</h3>
                    <p style="color:#64748b;font-size:0.94rem;margin-top:0.2rem;margin-bottom:1.4rem;">
                        Tell us a bit about what you need and we’ll reply with a focused response.
                    </p>

                    <!-- You can later turn this into a real POST form -->
                    <form method="POST" action="#">
                        @csrf

                        <div class="contact-form-grid">
                            <div class="form-group">
                                <label class="form-label" for="name">Full name</label>
                                <input class="form-input" type="text" id="name" name="name" placeholder="Your name">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="email">Email</label>
                                <input class="form-input" type="email" id="email" name="email" placeholder="you@example.com">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="subject">Subject</label>
                            <input class="form-input" type="text" id="subject" name="subject" placeholder="How can we help?">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="message">Message</label>
                            <textarea class="form-textarea" id="message" name="message" placeholder="Share any context, links, or details here."></textarea>
                        </div>

                        <div class="contact-submit-row">
                            <span class="small-helper">
                                We usually respond within 24 hours.
                            </span>
                            <button type="submit" class="cta-btn">
                                Send message
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-brand">
            <h3>MockMate</h3>
            <p>Level up your interview game with AI practice, peer coaching, and live expert sessions—all in one fluid workspace.</p>
        </div>
        <div class="footer-links">
            <h4>Explore</h4>
            <ul>
                <li><a href="/ai-interview">AI Interview</a></li>
                <li><a href="/expert-interview">Expert Interview</a></li>
                <li><a href="/about">About Us</a></li>
                <li><a href="/contact">Contact</a></li>
            </ul>
        </div>
        <div class="footer-links">
            <h4>Support</h4>
            <ul>
                <li><a href="mailto:team@mockmate.com">team@mockmate.com</a></li>
                <li><a href="#">Docs &amp; Guides</a></li>
                <li><a href="#">Community</a></li>
            </ul>
        </div>
        <div>
            <h4 style="font-size:1rem;color:#f97316;margin-bottom:0.75rem;letter-spacing:0.05em;text-transform:uppercase;">Connect</h4>
            <div class="footer-social">
                <a href="#" class="footer-pill">LinkedIn</a>
                <a href="#" class="footer-pill">YouTube</a>
                <a href="#" class="footer-pill">GitHub</a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        © 2025 MockMate Labs. Crafted for ambitious interviewees.
    </div>
</footer>

</body>
</html>
