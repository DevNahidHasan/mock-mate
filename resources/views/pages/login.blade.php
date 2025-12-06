@include('partials.header')

<style>
    .auth-hero {
        min-height: 90vh;
        padding: 8rem 1.5rem 4rem;
        background: radial-gradient(circle at top, rgba(251, 146, 60, 0.12), transparent 52%);
        font-family: "Segoe UI", system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
    }

    .auth-container {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 2.5rem;
        align-items: center;
    }

    .auth-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        padding: 0.35rem 0.9rem;
        border-radius: 999px;
        background: rgba(15, 23, 42, 0.9);
        color: #f97316;
        font-weight: 600;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        font-size: 0.8rem;
    }

    .auth-title {
        font-size: clamp(2.2rem, 3vw, 2.8rem);
        color: #0f172a;
        margin: 1.1rem 0 0.5rem;
    }

    .auth-sub {
        color: #475569;
        font-size: 1rem;
        line-height: 1.65;
        max-width: 440px;
        margin-bottom: 1.5rem;
    }

    .auth-card {
        position: relative;
        background: #fff;
        border-radius: 1.5rem;
        padding: 2rem;
        box-shadow: 0 30px 90px rgba(15, 23, 42, 0.12);
        border: 1px solid #eef2ff;
    }

    .auth-card h2 {
        margin: 0 0 0.4rem;
        font-size: 1.4rem;
        color: #0f172a;
    }

    .auth-card-sub {
        margin: 0 0 1.3rem;
        color: #64748b;
        font-size: 0.95rem;
    }

    .auth-error {
        margin-bottom: 1rem;
        padding: 0.75rem 0.9rem;
        border-radius: 0.9rem;
        background: #fef2f2;
        color: #b91c1c;
        font-size: 0.9rem;
    }

    .auth-form-group {
        margin-bottom: 0.9rem;
    }

    .auth-form-group label {
        display: block;
        font-size: 0.85rem;
        font-weight: 600;
        color: #475569;
        margin-bottom: 0.25rem;
    }

    .auth-form-group input {
        width: 100%;
        border-radius: 0.9rem;
        border: 1px solid #e2e8f0;
        padding: 0.7rem 0.9rem;
        font-size: 0.95rem;
        background: #f8fafc;
        outline: none;
        transition: border-color 0.15s ease, box-shadow 0.15s ease, background 0.15s ease;
    }

    .auth-form-group input:focus {
        border-color: #fb923c;
        background: #fff;
        box-shadow: 0 0 0 1px rgba(249, 115, 22, 0.25), 0 18px 35px rgba(15, 23, 42, 0.1);
    }

    .auth-btn {
        width: 100%;
        border-radius: 999px;
        padding: 0.9rem 1.6rem;
        font-weight: 600;
        border: none;
        cursor: pointer;
        background: linear-gradient(135deg, #fb923c, #f97316);
        color: #fff;
        box-shadow: 0 15px 35px rgba(249, 115, 22, 0.35);
        margin-top: 0.4rem;
    }

    .auth-switch {
        margin-top: 1rem;
        font-size: 0.9rem;
        color: #64748b;
        text-align: center;
    }

    .auth-switch a {
        color: #f97316;
        text-decoration: none;
        font-weight: 600;
    }
</style>

<section class="auth-hero">
    <div class="auth-container">
        {{-- Left side --}}
        <div>
            <span class="auth-eyebrow">Welcome back</span>
            <h1 class="auth-title">Pick up where your last mock interview left off.</h1>
            <p class="auth-sub">
                Log in to access your dashboard, see your history, and continue refining
                your interview skills with focused practice.
            </p>
        </div>

        {{-- Right side form --}}
        <div>
            <div class="auth-card">
                <h2>Login</h2>
                <p class="auth-card-sub">Use the email and password you signed up with.</p>

                @if ($errors->any())
                    <div class="auth-error">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="auth-form-group">
                        <label for="email">Email address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                    </div>

                    <div class="auth-form-group">
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password" required>
                    </div>

                    <button type="submit" class="auth-btn">Login</button>

                    <p class="auth-switch">
                        Don’t have an account?
                        <a href="{{ route('signup.show') }}">Create one</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>

@include('partials.footer')
