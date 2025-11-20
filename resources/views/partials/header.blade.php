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
        transition: background 0.2s ease, color 0.2s ease, box-shadow 0.2s ease;
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


</style>


<nav class="navbar">

    <div class="navbar-container">

        <div class="navbar-flex">

            <div class="nick-name">
                <a href="{{ url('/') }}">MockMate</a>
            </div>
            

            <div class="nav-btn">
                <ul>
                    <li>
                        <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">HOME</a>
                    </li>
                    <li>
                        <a href="{{ url('/ai-interview') }}" class="{{ request()->is('ai-interview') ? 'active' : '' }}">AI INTERVIEW</a>
                    </li>
                    <li>
                        <a href="{{ url('/expert-interview') }}" class="{{ request()->is('expert-interview') ? 'active' : '' }}">EXPERT INTERVIEW</a>
                    </li>
                    <li>
                        <a href="{{ url('/about') }}" class="{{ request()->is('about') ? 'active' : '' }}">ABOUT</a>
                    </li>
                </ul>
            </div>

        </div>



    </div>



    


</nav>

<hr>