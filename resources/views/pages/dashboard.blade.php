@include('partials.header')

<style>
    .dashboard-hero {
        min-height: 90vh;
        padding: 8rem 1.5rem 4rem;
        background: #f8fafc;
        font-family: "Segoe UI", system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
    }

    .dashboard-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .dash-header {
        margin-bottom: 2rem;
    }

    .dash-title {
        font-size: 2rem;
        margin: 0 0 0.3rem;
        color: #0f172a;
    }

    .dash-sub {
        margin: 0;
        color: #64748b;
        font-size: 0.98rem;
    }

    .stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: #fff;
        border-radius: 1.25rem;
        padding: 1.4rem 1.6rem;
        box-shadow: 0 25px 60px rgba(15, 23, 42, 0.08);
        border: 1px solid #e2e8f0;
    }

    .stat-label {
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.09em;
        color: #94a3b8;
        margin-bottom: 0.35rem;
        font-weight: 600;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: #0f172a;
    }

    .table-card {
        background: #fff;
        border-radius: 1.25rem;
        box-shadow: 0 20px 50px rgba(15, 23, 42, 0.08);
        border: 1px solid #e2e8f0;
        overflow: hidden;
    }

    .table-header {
        padding: 1rem 1.4rem;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .table-header h2 {
        font-size: 1.1rem;
        margin: 0;
        color: #0f172a;
    }

    .logout-btn {
        padding: 0.45rem 1.1rem;
        border-radius: 999px;
        border: 1px solid #fee2e2;
        background: #fef2f2;
        color: #b91c1c;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
    }

    .user-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.93rem;
    }

    .user-table th,
    .user-table td {
        padding: 0.75rem 1.1rem;
        border-bottom: 1px solid #e5e7eb;
        text-align: left;
    }

    .user-table thead tr {
        background: #f9fafb;
    }

    .user-table tbody tr:nth-child(every) {
        background: #fff;
    }

    .empty-row {
        padding: 1rem 1.1rem;
        color: #94a3b8;
    }
</style>

<section class="dashboard-hero">
    <div class="dashboard-container">
        <div class="dash-header">
            <h1 class="dash-title">Dashboard</h1>
            <p class="dash-sub">
                Welcome, <strong>{{ auth()->user()->name }}</strong>. Here’s an overview of your users.
            </p>
        </div>

        {{-- Stats --}}
        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-label">Total users</div>
                <div class="stat-value">{{ $totalUsers }}</div>
            </div>
        </div>

        {{-- Users table --}}
        <div class="table-card">
            <div class="table-header">
                <h2>User list</h2>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">Log out</button>
                </form>
            </div>

            <table class="user-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Joined</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at?->format('d M Y, H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="empty-row">
                                No users yet. Sign up from the signup page to see data here.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>

@include('partials.footer')
