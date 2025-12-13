@include('partials.header')


<style>
/* ========== SHARED DASHBOARD STYLES (MockMate Theme) ========== */
.dash-hero {
  min-height: 85vh;
  padding: 8rem 1.5rem 4rem;
  background: radial-gradient(circle at top, rgba(251,146,60,.12), transparent 55%);
  font-family: "Segoe UI", system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
}

.dash-container {
  max-width: 1200px;
  margin: 0 auto;
}

.dash-head {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  gap: 1.5rem;
  margin-bottom: 2.5rem;
}

.dash-title {
  font-size: 2.2rem;
  color: #0f172a;
  margin: .5rem 0 0;
}

.dash-sub {
  color: #475569;
  margin-top: .5rem;
  line-height: 1.6;
  max-width: 520px;
}

.pill {
  display: inline-block;
  padding: .35rem .9rem;
  border-radius: 999px;
  background: rgba(15,23,42,.9);
  color: #f97316;
  font-size: .8rem;
  font-weight: 700;
  letter-spacing: .08em;
  text-transform: uppercase;
}

/* Buttons (match home) */
.cta-btn {
  padding: .65rem 1.4rem;
  border-radius: 999px;
  background: linear-gradient(135deg, #fb923c, #f97316);
  color: #fff;
  border: none;
  font-weight: 700;
  cursor: pointer;
  text-decoration: none;
}

.cta-btn.secondary {
  background: transparent;
  color: #0f172a;
  border: 1px solid #e5e7eb;
}

/* Cards */
.cards-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px,1fr));
  gap: 1.5rem;
}

.mm-card {
  background: #fff;
  border-radius: 1.5rem;
  padding: 1.6rem;
  box-shadow: 0 30px 90px rgba(15,23,42,.12);
  border: 1px solid #eef2ff;
}

.mm-label {
  font-size: .8rem;
  color: #94a3b8;
  text-transform: uppercase;
  letter-spacing: .08em;
  font-weight: 700;
}

.mm-value {
  margin-top: .4rem;
  font-size: 1.2rem;
  font-weight: 800;
  color: #0f172a;
}

/* Actions */
.action-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px,1fr));
  gap: 1.5rem;
  margin-top: 2rem;
}

.action-card {
  background: #fff;
  border-radius: 1.4rem;
  padding: 1.6rem;
  border: 1px solid #f1f5f9;
  box-shadow: 0 15px 35px rgba(15,23,42,.08);
  text-decoration: none;
  color: inherit;
}

.action-icon {
  width: 46px;
  height: 46px;
  border-radius: 14px;
  background: rgba(249,115,22,.12);
  display: flex;
  align-items: center;
  justify-content: center;
  color: #f97316;
  font-weight: 800;
  margin-bottom: .9rem;
}

/* Admin table */
.table-card {
  margin-top: 2.5rem;
  background: #fff;
  border-radius: 1.5rem;
  overflow: hidden;
  border: 1px solid #e5e7eb;
  box-shadow: 0 20px 50px rgba(15,23,42,.1);
}

.table-header {
  padding: 1rem 1.4rem;
  border-bottom: 1px solid #e5e7eb;
  font-weight: 700;
}

table {
  width: 100%;
  border-collapse: collapse;
}

th, td {
  padding: .75rem 1.2rem;
  border-bottom: 1px solid #e5e7eb;
  text-align: left;
}

thead {
  background: #f9fafb;
}

.role-admin { color:#16a34a; font-weight:700; }
.role-user { color:#475569; }
</style>

<section class="dash-hero">
  <div class="dash-container">

    {{-- DASHBOARD HEADER --}}
    <div class="dash-head">
      <div>
        <span class="pill">Dashboard</span>
        <h1 class="dash-title">
          Welcome,
          <span style="color:#f97316;">{{ $user->name }}</span>
        </h1>
        <p class="dash-sub">
          Manage your account and continue your interview preparation.
        </p>
      </div>

      <div style="display:flex;gap:.8rem;flex-wrap:wrap;">
        <a href="{{ route('ai-interview') }}" class="cta-btn">AI Interview</a>
        <a href="{{ route('expert-interview') }}" class="cta-btn secondary">Expert</a>

        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button class="cta-btn secondary">Logout</button>
        </form>
      </div>
    </div>

    {{-- ================= USER DASHBOARD ================= --}}
    @if ($user->role !== 'admin')

      <div class="cards-grid">
        <div class="mm-card">
          <div class="mm-label">Email</div>
          <div class="mm-value" style="font-size:1rem;">{{ $user->email }}</div>
        </div>

        <div class="mm-card">
          <div class="mm-label">Joined</div>
          <div class="mm-value">{{ $user->created_at->format('d M Y') }}</div>
        </div>

        <div class="mm-card">
          <div class="mm-label">Account Type</div>
          <div class="mm-value">{{ ucfirst($user->role) }}</div>
        </div>
      </div>

      <div class="action-grid">
        <a class="action-card" href="{{ route('ai-interview') }}">
          <div class="action-icon">AI</div>
          <h3>Start AI Interview</h3>
          <p>Practice with intelligent mock interviews.</p>
        </a>

        <a class="action-card" href="{{ route('expert-interview') }}">
          <div class="action-icon">EX</div>
          <h3>Expert Session</h3>
          <p>Book a live mock interview with experts.</p>
        </a>

        <a class="action-card" href="{{ route('contact') }}">
          <div class="action-icon">?</div>
          <h3>Support</h3>
          <p>Contact MockMate support anytime.</p>
        </a>
      </div>

    @endif

    {{-- ================= ADMIN DASHBOARD ================= --}}
    @if ($user->role === 'admin')

      <div class="cards-grid">
        <div class="mm-card">
          <div class="mm-label">Total Users</div>
          <div class="mm-value">{{ $totalUsers ?? 0 }}</div>
        </div>
      </div>

      <div class="table-card">
        <div class="table-header">Registered Users</div>

        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Joined</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users ?? [] as $i => $u)
              <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $u->name }}</td>
                <td>{{ $u->email }}</td>
                <td class="{{ $u->role === 'admin' ? 'role-admin' : 'role-user' }}">
                  {{ ucfirst($u->role) }}
                </td>
                <td>{{ $u->created_at->format('d M Y') }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    @endif

  </div>
</section>

@include('partials.footer')



