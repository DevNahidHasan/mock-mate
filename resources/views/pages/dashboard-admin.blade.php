@include('partials.header')

<style>
/* ===== MockMate Admin Dashboard ===== */
.admin-wrap {
  min-height: 85vh;
  padding: 8rem 1.5rem 4rem;
  background: radial-gradient(circle at top, rgba(251,146,60,.12), transparent 55%);
  font-family: "Segoe UI", system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
}

.admin-container {
  max-width: 1200px;
  margin: 0 auto;
}

.badge {
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

.admin-head {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  gap: 1.5rem;
  margin-bottom: 2.5rem;
}

.admin-title {
  font-size: 2.2rem;
  color: #0f172a;
  margin: .6rem 0 0;
}

.admin-sub {
  color: #475569;
  margin-top: .5rem;
  max-width: 560px;
  line-height: 1.6;
}

/* Buttons */
.btn {
  padding: .55rem 1.2rem;
  border-radius: 999px;
  font-weight: 700;
  cursor: pointer;
  border: none;
  text-decoration: none;
}

.btn-primary {
  background: linear-gradient(135deg, #fb923c, #f97316);
  color: #fff;
  box-shadow: 0 15px 35px rgba(249,115,22,.25);
}

.btn-outline {
  background: transparent;
  color: #0f172a;
  border: 1px solid #e5e7eb;
}

.btn-danger {
  background: #ef4444;
  color: #fff;
}

.btn-sm {
  padding: .3rem .7rem;
  font-size: .8rem;
}

/* Cards */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px,1fr));
  gap: 1.5rem;
}

.stat-card {
  background: #fff;
  border-radius: 1.5rem;
  padding: 1.6rem;
  box-shadow: 0 30px 90px rgba(15,23,42,.12);
  border: 1px solid #eef2ff;
}

.stat-label {
  font-size: .8rem;
  color: #94a3b8;
  text-transform: uppercase;
  letter-spacing: .08em;
  font-weight: 800;
}

.stat-value {
  margin-top: .45rem;
  font-size: 1.5rem;
  font-weight: 900;
  color: #0f172a;
}

/* Table */
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
  font-weight: 800;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

table {
  width: 100%;
  border-collapse: collapse;
  font-size: .93rem;
}

th, td {
  padding: .75rem 1.1rem;
  border-bottom: 1px solid #e5e7eb;
  text-align: left;
}

thead {
  background: #f9fafb;
}

.role-admin { color:#16a34a; font-weight:800; }
.role-user { color:#475569; font-weight:700; }

.actions {
  display: flex;
  gap: .5rem;
  flex-wrap: wrap;
}
</style>

<section class="admin-wrap">
  <div class="admin-container">

    {{-- HEADER --}}
    <div class="admin-head">
      <div>
        <span class="badge">Admin Panel</span>
        <h1 class="admin-title">Admin Dashboard</h1>
        <p class="admin-sub">
          Manage users, roles, and monitor platform activity.
        </p>
      </div>

      <div style="display:flex;gap:.8rem;flex-wrap:wrap;">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button class="btn btn-outline">Logout</button>
        </form>
      </div>
    </div>

    {{-- STATS --}}
    <div class="stats-grid">
      <div class="stat-card">
        <div class="stat-label">Total Users</div>
        <div class="stat-value">{{ $totalUsers }}</div>
      </div>

      <div class="stat-card">
        <div class="stat-label">Admins</div>
        <div class="stat-value">
          {{ $users->where('role','admin')->count() }}
        </div>
      </div>

      <div class="stat-card">
        <div class="stat-label">Normal Users</div>
        <div class="stat-value">
          {{ $users->where('role','user')->count() }}
        </div>
      </div>
    </div>

    {{-- USERS TABLE --}}
    <div class="table-card">
      <div class="table-header">
        <span>Registered Users</span>
        <span style="color:#64748b;font-size:.9rem;">
          Total: {{ $totalUsers }}
        </span>
      </div>

      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Joined</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody>
          @foreach($users as $i => $u)
            <tr>
              <td>{{ $i + 1 }}</td>
              <td>{{ $u->name }}</td>
              <td>{{ $u->email }}</td>
              <td class="{{ $u->role === 'admin' ? 'role-admin' : 'role-user' }}">
                {{ ucfirst($u->role) }}
              </td>
              <td>{{ $u->created_at->format('d M Y') }}</td>

              <td>
                <div class="actions">
                  @if ($u->role !== 'admin')
                    <form method="POST" action="{{ route('admin.user.promote', $u->id) }}">
                      @csrf
                      <button class="btn btn-primary btn-sm">Promote</button>
                    </form>
                  @endif

                  @if (auth()->id() !== $u->id)
                    <form method="POST"
                          action="{{ route('admin.user.delete', $u->id) }}"
                          onsubmit="return confirm('Delete this user?');">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                  @else
                    <span style="color:#94a3b8;font-size:.8rem;">You</span>
                  @endif
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

  </div>
</section>

@include('partials.footer')
