@include('partials.header')

<style>
    .dash-wrap { max-width:1200px; margin:120px auto; font-family:system-ui,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif; }
    .dash-title { font-size:2rem; margin:0 0 .25rem; color:#0f172a; }
    .dash-sub { color:#64748b; margin:0 0 2rem; }

    .stats-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:1.5rem; margin-bottom:2rem; }
    .stat-card { background:#fff; border-radius:1.25rem; padding:1.4rem 1.6rem; box-shadow:0 20px 60px rgba(15,23,42,.08); border:1px solid #e2e8f0; }
    .stat-label { font-size:.85rem; text-transform:uppercase; letter-spacing:.08em; color:#94a3b8; font-weight:600; }
    .stat-value { font-size:2rem; font-weight:700; color:#0f172a; margin-top:.25rem; }

    .table-card { background:#fff; border-radius:1.25rem; box-shadow:0 20px 50px rgba(15,23,42,.08); border:1px solid #e2e8f0; overflow:hidden; margin-top:1.5rem; }
    .table-header { padding:1rem 1.4rem; border-bottom:1px solid #e2e8f0; display:flex; justify-content:space-between; align-items:center; }
    .table-header h2 { font-size:1.1rem; margin:0; color:#0f172a; }

    .logout-btn { padding:.45rem 1.1rem; border-radius:999px; border:1px solid #fee2e2; background:#fef2f2; color:#b91c1c; font-size:.85rem; font-weight:600; cursor:pointer; }

    table { width:100%; border-collapse:collapse; font-size:.93rem; }
    th, td { padding:.75rem 1.1rem; border-bottom:1px solid #e5e7eb; text-align:left; }
    thead tr { background:#f9fafb; }

    .role-admin { color:#16a34a; font-weight:600; }
    .role-user { color:#475569; }
</style>

<div class="dash-wrap">
    <h1 class="dash-title">Dashboard</h1>
    <p class="dash-sub">Welcome, <strong>{{ $user->name }}</strong> 👋</p>

    {{-- Logout --}}
    <form method="POST" action="{{ route('logout') }}" style="margin-bottom:1.5rem;">
        @csrf
        <button class="logout-btn" type="submit">Logout</button>
    </form>

    {{-- USER VIEW --}}
    @if ($user->role !== 'admin')
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-label">Your Email</div>
                <div class="stat-value" style="font-size:1.1rem;">{{ $user->email }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-label">Joined</div>
                <div class="stat-value" style="font-size:1.1rem;">{{ $user->created_at->format('d M Y') }}</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Quick Actions</div>
            <div style="margin-top:.6rem;">
                <a href="{{ route('ai-interview') }}" style="color:#f97316;font-weight:600;text-decoration:none;">Start AI Interview →</a>
            </div>
        </div>
    @endif

    {{-- ADMIN VIEW --}}
    @if ($user->role === 'admin')
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-label">Total Users</div>
                <div class="stat-value">{{ $totalUsers ?? 0 }}</div>
            </div>
        </div>

        <div class="table-card">
            <div class="table-header">
                <h2>User List</h2>
            </div>

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
                    @forelse(($users ?? []) as $index => $u)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>
                            <td class="{{ $u->role === 'admin' ? 'role-admin' : 'role-user' }}">
                                {{ ucfirst($u->role) }}
                            </td>
                            <td>{{ $u->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="color:#94a3b8;padding:1rem;">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endif
</div>

@include('partials.footer')
