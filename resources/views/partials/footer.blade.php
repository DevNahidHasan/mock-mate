<style>
    .site-footer {
        background: #0f172a;
        color: #e2e8f0;
        padding: 3rem 1.5rem;
        font-family: "Segoe UI", system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
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

<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-brand">
            <h3>MockMate</h3>
            <p>Level up your interview game with AI practice, peer coaching, and live expert sessions—all in one fluid workspace.</p>
        </div>
        <div class="footer-links">
            <h4>Explore</h4>
            <ul>
                <li><a href="{{ url('/ai-interview') }}">AI Interview</a></li>
                <li><a href="{{ url('/expert-interview') }}">Expert Interview</a></li>
                <li><a href="{{ url('/about') }}">About Us</a></li>
            </ul>
        </div>
        <div class="footer-links">
            <h4>Support</h4>
            <ul>
                <li><a href="mailto:team@mockmate.com">team@mockmate.com</a></li>
                <li><a href="#">Docs & Guides</a></li>
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
        © {{ date('Y') }} MockMate Labs. Crafted for ambitious interviewees.
    </div>
</footer>