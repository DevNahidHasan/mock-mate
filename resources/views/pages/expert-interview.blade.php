
@include('partials.header')

<style>
/* ===== Expert Interview Page ===== */
.expert-hero {
  min-height: 85vh;
  padding: 8rem 1.5rem 4rem;
  background: radial-gradient(circle at top, rgba(251,146,60,.12), transparent 55%);
  font-family: "Segoe UI", system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
}

.expert-container {
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

.page-title {
  font-size: 2.3rem;
  color: #0f172a;
  margin: .6rem 0 0;
}

.page-sub {
  color: #475569;
  margin-top: .6rem;
  max-width: 620px;
  line-height: 1.7;
}

/* Expert grid */
.expert-grid {
  margin-top: 3rem;
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px,1fr));
  gap: 1.8rem;
}

.expert-card {
  background: #fff;
  border-radius: 1.6rem;
  padding: 1.8rem;
  border: 1px solid #eef2ff;
  box-shadow: 0 30px 80px rgba(15,23,42,.12);
  text-align: center;
}

.expert-avatar {
  width: 88px;
  height: 88px;
  border-radius: 50%;
  background: linear-gradient(135deg, #fb923c, #f97316);
  color: #fff;
  font-size: 1.8rem;
  font-weight: 900;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 1rem;
}

.expert-name {
  font-size: 1.2rem;
  font-weight: 800;
  color: #0f172a;
}

.expert-role {
  color: #f97316;
  font-weight: 700;
  font-size: .9rem;
  margin-top: .2rem;
}

.expert-desc {
  margin-top: .7rem;
  color: #475569;
  font-size: .95rem;
  line-height: 1.6;
}

/* Button */
.btn {
  margin-top: 1.3rem;
  padding: .6rem 1.3rem;
  border-radius: 999px;
  font-weight: 700;
  cursor: pointer;
  border: none;
  text-decoration: none;
  display: inline-block;
}

.btn-primary {
  background: linear-gradient(135deg, #fb923c, #f97316);
  color: #fff;
  box-shadow: 0 15px 35px rgba(249,115,22,.25);
}

.note {
  margin-top: 3rem;
  background: #fff;
  border-radius: 1.5rem;
  padding: 1.4rem;
  border: 1px solid #e5e7eb;
  color: #475569;
  box-shadow: 0 12px 30px rgba(15,23,42,.06);
}
</style>

<section class="expert-hero">
  <div class="expert-container">

    <span class="badge">Expert Interview</span>
    <h1 class="page-title">Practice with Industry Experts</h1>
    <p class="page-sub">
      Book a one-on-one mock interview with experienced professionals and receive
      real, human feedback to boost your confidence and job readiness.
    </p>

    {{-- Expert Cards --}}
    <div class="expert-grid">

      <div class="expert-card">
        <div class="expert-avatar">L</div>
        <div class="expert-name">Laravel Expert</div>
        <div class="expert-role">Backend & API</div>
        <p class="expert-desc">
          Deep dive into Laravel concepts, MVC, Eloquent, APIs, and best practices.
        </p>
        <button class="btn btn-primary">Request Interview</button>
      </div>

      <div class="expert-card">
        <div class="expert-avatar">F</div>
        <div class="expert-name">Frontend Expert</div>
        <div class="expert-role">HTML • CSS • JS</div>
        <p class="expert-desc">
          Improve UI logic, performance, accessibility, and frontend interview skills.
        </p>
        <button class="btn btn-primary">Request Interview</button>
      </div>

      <div class="expert-card">
        <div class="expert-avatar">H</div>
        <div class="expert-name">HR Expert</div>
        <div class="expert-role">Behavioral & Soft Skills</div>
        <p class="expert-desc">
          Prepare for HR questions, communication, confidence, and cultural fit.
        </p>
        <button class="btn btn-primary">Request Interview</button>
      </div>

Shawon Friend, [12/14/2025 2:35 AM]
<div class="expert-card">
        <div class="expert-avatar">S</div>
        <div class="expert-name">System Design Expert</div>
        <div class="expert-role">Architecture</div>
        <p class="expert-desc">
          Learn scalable system design, real-world scenarios, and problem solving.
        </p>
        <button class="btn btn-primary">Request Interview</button>
      </div>

    </div>

    {{-- Info note --}}
    <div class="note">
      <strong>Note:</strong>
      Expert interviews are reviewed by the admin and scheduled manually.
      This feature simulates real-world professional interview preparation.
    </div>

  </div>
</section>

@include('partials.footer')
