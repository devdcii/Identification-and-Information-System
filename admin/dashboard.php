<?php
require_once "../config/dbcon.php";
include "../config/dashboardplugin.php";
?>
</head>
<body>

<!-- ══════════════ SIDEBAR ══════════════ -->
<div class="sidebar">
  <a href="../index.php" class="logout-icon" title="Logout">
    <i class="fas fa-sign-out-alt"></i>
  </a>
  <div class="sidebar-header">
    <img src="../image/logo.png" alt="HCC Logo" class="hcc-logo">
    <h4>Admin Dashboard</h4>
  </div>
  <nav class="sidebar-nav">
    <a href="dashboard.php" class="sidebar-link active">
      <i class="fas fa-chart-pie"></i> <span>Dashboard</span>
    </a>
    <a href="student_dashboard.php" class="sidebar-link">
      <i class="fas fa-user-graduate"></i> <span>Students</span>
    </a>
    <a href="employee_dashboard.php" class="sidebar-link">
      <i class="fas fa-user-tie"></i> <span>Employees</span>
    </a>
  </nav>
</div>

<!-- ══════════════ MAIN CONTENT ══════════════ -->
<div class="dash-main">

  <!-- Page Header -->
  <div class="dash-topbar">
    <div>
      <h2 class="dash-title"><i class="fas fa-chart-pie"></i> Dashboard</h2>
      <p class="dash-subtitle">Identification & Information Management System</p>
    </div>
    <div class="dash-datebadge" id="dateBadge"></div>
  </div>

  <!-- ── 4 Summary Cards ── -->
  <div class="cards-row">

    <div class="kcard kcard-students anim-card" style="--i:0">
      <div class="kcard-left">
        <div class="kcard-label">Total Students</div>
        <div class="kcard-value" id="totalStudents">0</div>
        <div class="kcard-sub">Enrolled records</div>
      </div>
      <div class="kcard-icon"><i class="fas fa-user-graduate"></i></div>
      <div class="kcard-wave"></div>
    </div>

    <div class="kcard kcard-employees anim-card" style="--i:1">
      <div class="kcard-left">
        <div class="kcard-label">Total Employees</div>
        <div class="kcard-value" id="totalEmployees">0</div>
        <div class="kcard-sub">Active staff</div>
      </div>
      <div class="kcard-icon"><i class="fas fa-user-tie"></i></div>
      <div class="kcard-wave"></div>
    </div>

    <div class="kcard kcard-depts anim-card" style="--i:2">
      <div class="kcard-left">
        <div class="kcard-label">Departments</div>
        <div class="kcard-value" id="totalDepts">0</div>
        <div class="kcard-sub">Academic units</div>
      </div>
      <div class="kcard-icon"><i class="fas fa-building"></i></div>
      <div class="kcard-wave"></div>
    </div>

    <div class="kcard kcard-courses anim-card" style="--i:3">
      <div class="kcard-left">
        <div class="kcard-label">Courses Offered</div>
        <div class="kcard-value" id="totalCourses">0</div>
        <div class="kcard-sub">Programs available</div>
      </div>
      <div class="kcard-icon"><i class="fas fa-book-open"></i></div>
      <div class="kcard-wave"></div>
    </div>

  </div>

  <!-- ── Middle Row: Year Level + Course Breakdown ── -->
  <div class="mid-row">

    <!-- Year Level -->
    <div class="panel anim-card" style="--i:4">
      <div class="panel-head">
        <span class="panel-title"><i class="fas fa-layer-group"></i> Year Level Breakdown</span>
        <span class="panel-chip" id="yearTotal">0 total</span>
      </div>
      <div id="yearBreakdown" class="year-stack"></div>
    </div>

    <!-- Course Breakdown -->
    <div class="panel panel-lg anim-card" style="--i:5">
      <div class="panel-head">
        <span class="panel-title"><i class="fas fa-graduation-cap"></i> Students per Course</span>
        <span class="panel-chip" id="courseChip">0 courses</span>
      </div>
      <div id="courseBreakdown" class="course-stack"></div>
    </div>

  </div>

  <!-- ── Department Row ── -->
  <div class="dept-section anim-card" style="--i:6">
    <div class="panel">
      <div class="panel-head">
        <span class="panel-title"><i class="fas fa-sitemap"></i> Employees per Department</span>
        <span class="panel-chip" id="deptChip">0 departments</span>
      </div>
      <div id="deptBreakdown" class="dept-tiles"></div>
    </div>
  </div>

</div><!-- end .dash-main -->

<!-- ══════════════ STYLES ══════════════ -->
<style>
/* ─── Base ─── */
body { background: #eef1f7; font-family: 'Segoe UI', sans-serif; margin: 0; }

/* ─── Main wrapper ─── */
.dash-main {
  margin-left: 260px;
  padding: 32px 30px 48px;
  min-height: 100vh;
}

/* ─── Top Bar ─── */
.dash-topbar {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  margin-bottom: 28px;
  gap: 12px;
  flex-wrap: wrap;
}

.dash-title {
  font-size: 20px;
  font-weight: 700;
  color: #1a3a6b;
  margin: 0 0 4px;
  display: flex;
  align-items: center;
  gap: 10px;
}
.dash-title i { color: steelblue; font-size: 18px; }
.dash-subtitle { font-size: 13px; color: #8a96ad; margin: 0; }

.dash-datebadge {
  font-size: 13px;
  color: #8a96ad;
  text-align: right;
  line-height: 1.7;
}
.dash-datebadge strong { display: block; font-size: 16px; color: steelblue; font-weight: 700; }

/* ─── 4 Summary Cards ─── */
.cards-row {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 18px;
  margin-bottom: 22px;
}

.kcard {
  border-radius: 16px;
  padding: 22px 22px 18px;
  color: white;
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 12px;
  position: relative;
  overflow: hidden;
  box-shadow: 0 4px 18px rgba(0,0,0,0.13);
  transition: transform 0.22s, box-shadow 0.22s;
  cursor: default;
}
.kcard:hover { transform: translateY(-5px); box-shadow: 0 10px 30px rgba(0,0,0,0.18); }

/* Card color variants — steelblue family */
.kcard-students  { background: linear-gradient(135deg, #2e6da4 0%, steelblue 100%); }
.kcard-employees { background: linear-gradient(135deg, #1d547e 0%, #2b7bba 100%); }
.kcard-depts     { background: linear-gradient(135deg, #2d5a91 0%, #3d7cc9 100%); }
.kcard-courses   { background: linear-gradient(135deg, #1a4f80 0%, #2d7ab5 100%); }

.kcard-left { position: relative; z-index: 2; }
.kcard-label {
  font-size: 11px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1px;
  opacity: 0.8;
  margin-bottom: 6px;
}
.kcard-value {
  font-size: 44px;
  font-weight: 800;
  line-height: 1;
  margin-bottom: 5px;
  letter-spacing: -1px;
}
.kcard-sub { font-size: 12px; opacity: 0.65; }

.kcard-icon {
  font-size: 40px;
  opacity: 0.18;
  position: relative;
  z-index: 2;
  align-self: center;
  flex-shrink: 0;
}

/* Decorative wave blob */
.kcard-wave {
  position: absolute;
  bottom: -28px; right: -28px;
  width: 110px; height: 110px;
  border-radius: 50%;
  background: rgba(255,255,255,0.1);
  pointer-events: none;
}
.kcard-wave::after {
  content: '';
  position: absolute;
  bottom: -20px; right: -20px;
  width: 80px; height: 80px;
  border-radius: 50%;
  background: rgba(255,255,255,0.07);
}

/* ─── Mid Row (Year + Course) ─── */
.mid-row {
  display: flex;
  gap: 18px;
  margin-bottom: 22px;
  flex-wrap: wrap;
}

/* ─── Panels ─── */
.panel {
  background: white;
  border-radius: 16px;
  padding: 22px 24px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.06);
  flex: 1 1 240px;
  min-width: 220px;
}
.panel-lg { flex: 2.2 1 420px; }
.dept-section .panel { width: 100%; }

.panel-head {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 18px;
  padding-bottom: 12px;
  border-bottom: 2px solid #eef1f8;
}
.panel-title {
  font-size: 13px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  color: #1a3a6b;
  display: flex;
  align-items: center;
  gap: 8px;
}
.panel-title i { color: steelblue; }

.panel-chip {
  font-size: 11px;
  font-weight: 600;
  padding: 4px 10px;
  border-radius: 20px;
  background: rgba(70,130,180,0.1);
  color: steelblue;
  border: 1px solid rgba(70,130,180,0.2);
}

/* ─── Year Stack ─── */
.year-stack { display: flex; flex-direction: column; gap: 14px; }

.year-row { display: flex; align-items: center; gap: 12px; }

.year-label {
  font-size: 13px;
  font-weight: 600;
  color: #444;
  min-width: 60px;
}

.year-track {
  flex: 1;
  background: #eef1f8;
  border-radius: 20px;
  height: 11px;
  overflow: hidden;
}
.year-fill {
  height: 100%;
  border-radius: 20px;
  background: linear-gradient(90deg, steelblue, #74b3e8);
  width: 0%;
  transition: width 1s cubic-bezier(.4,0,.2,1);
}

.year-count {
  font-size: 15px;
  font-weight: 800;
  color: steelblue;
  min-width: 32px;
  text-align: right;
}

/* ─── Course Stack ─── */
.course-stack { display: flex; flex-direction: column; gap: 9px; }

.crs-row {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 2px 0;
}

.crs-num {
  font-size: 11px;
  font-weight: 700;
  color: steelblue;
  opacity: 0.55;
  min-width: 18px;
  text-align: right;
}

.crs-name {
  font-size: 12.5px;
  color: #333;
  flex: 1;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.crs-track {
  width: 100px;
  height: 8px;
  background: #eef1f8;
  border-radius: 20px;
  overflow: hidden;
  flex-shrink: 0;
}
.crs-fill {
  height: 100%;
  border-radius: 20px;
  background: linear-gradient(90deg, steelblue, #74b3e8);
  width: 0%;
  transition: width 1s cubic-bezier(.4,0,.2,1);
}

.crs-count {
  font-size: 13px;
  font-weight: 700;
  color: #1a3a6b;
  min-width: 26px;
  text-align: right;
}

/* ─── Dept Tiles ─── */
.dept-tiles {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(190px, 1fr));
  gap: 12px;
}

.dept-tile {
  border: 1.5px solid #dde3f0;
  border-radius: 12px;
  padding: 14px 18px;
  display: flex;
  align-items: center;
  gap: 14px;
  transition: border-color 0.2s, transform 0.2s, box-shadow 0.2s;
  background: #fafbff;
}
.dept-tile:hover {
  border-color: steelblue;
  transform: translateY(-3px);
  box-shadow: 0 6px 16px rgba(70,130,180,0.12);
}

.dept-stripe {
  width: 4px;
  height: 36px;
  border-radius: 4px;
  background: steelblue;
  opacity: 0.6;
  flex-shrink: 0;
}

.dept-info { flex: 1; min-width: 0; }
.dept-name {
  font-size: 12px;
  color: #777;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  margin-bottom: 2px;
}
.dept-count {
  font-size: 22px;
  font-weight: 800;
  color: steelblue;
  line-height: 1.1;
}

/* ─── Skeleton loading ─── */
.skel {
  height: 14px;
  background: linear-gradient(90deg, #e8edf5 25%, #dde3ef 50%, #e8edf5 75%);
  background-size: 200% 100%;
  animation: shimmer 1.4s infinite;
  border-radius: 7px;
  margin-bottom: 10px;
}
@keyframes shimmer { 0%{background-position:200% 0} 100%{background-position:-200% 0} }

/* ─── Staggered fade-up ─── */
.anim-card {
  opacity: 0;
  transform: translateY(20px);
  animation: riseUp 0.45s ease forwards;
  animation-delay: calc(var(--i, 0) * 0.07s);
}
@keyframes riseUp { to { opacity:1; transform:translateY(0); } }

/* ─── Responsive ─── */
@media (max-width: 1200px) { .cards-row { grid-template-columns: repeat(2,1fr); } }
@media (max-width: 992px)  { .dash-main { margin-left:0; padding:20px 16px 40px; } }
@media (max-width: 576px)  { .cards-row { grid-template-columns: 1fr; } }
</style>

<!-- ══════════════ SCRIPT ══════════════ -->
<script>
// Live date & time badge
(function() {
  function updateBadge() {
    const d = new Date();
    const dateStr = d.toLocaleDateString('en-US', { weekday:'long', month:'long', day:'numeric', year:'numeric' });
    const timeStr = d.toLocaleTimeString('en-US', { hour:'2-digit', minute:'2-digit', second:'2-digit' });
    document.getElementById('dateBadge').innerHTML =
      `<strong>${timeStr}</strong>${dateStr}`;
  }
  updateBadge();
  setInterval(updateBadge, 1000);
})();

function countUp(id, target, delay) {
  setTimeout(() => {
    const el = document.getElementById(id);
    if (!el) return;
    let c = 0;
    const step = Math.max(1, Math.ceil(target / 50));
    const iv = setInterval(() => {
      c = Math.min(c + step, target);
      el.textContent = c;
      if (c >= target) clearInterval(iv);
    }, 22);
  }, delay || 0);
}

function loadStats() {
  // Skeletons
  ['yearBreakdown','courseBreakdown','deptBreakdown'].forEach(id => {
    document.getElementById(id).innerHTML =
      '<div class="skel"></div><div class="skel" style="width:75%"></div><div class="skel" style="width:55%"></div>';
  });

  fetch('../admin/fetch_stats.php')
    .then(r => r.json())
    .then(data => {
      const s = parseInt(data.total_students)  || 0;
      const e = parseInt(data.total_employees) || 0;
      const courses = data.per_course || {};
      const depts   = data.per_dept   || {};
      const years   = data.per_year   || {};

      // Summary cards
      countUp('totalStudents',  s, 80);
      countUp('totalEmployees', e, 160);
      countUp('totalDepts',     Object.keys(depts).length, 240);
      countUp('totalCourses',   Object.keys(courses).length, 320);

      // ── Year Level ──
      const yearKeys = ['1st Year','2nd Year','3rd Year','4th Year'];
      const yearVals = yearKeys.map(k => parseInt(years[k]) || 0);
      const yearMax  = Math.max(...yearVals, 1);
      const yearSum  = yearVals.reduce((a,b)=>a+b,0);
      document.getElementById('yearTotal').textContent = yearSum + ' total';

      document.getElementById('yearBreakdown').innerHTML = yearKeys.map((lbl, i) => `
        <div class="year-row">
          <span class="year-label">${lbl}</span>
          <div class="year-track">
            <div class="year-fill" data-pct="${Math.round(yearVals[i]/yearMax*100)}"></div>
          </div>
          <span class="year-count" data-target="${yearVals[i]}">0</span>
        </div>`).join('');

      // animate year counts
      document.querySelectorAll('.year-count').forEach(el => {
        const t = parseInt(el.dataset.target);
        let c = 0; const st = Math.max(1, Math.ceil(t/40));
        const iv = setInterval(() => { c=Math.min(c+st,t); el.textContent=c; if(c>=t)clearInterval(iv); }, 22);
      });

      // ── Course Breakdown ──
      const cEntries = Object.entries(courses);
      const maxC = Math.max(...cEntries.map(([,v])=>v), 1);
      document.getElementById('courseChip').textContent = cEntries.length + ' courses';

      document.getElementById('courseBreakdown').innerHTML = cEntries.length
        ? cEntries.map(([name,cnt],i)=>`
            <div class="crs-row">
              <span class="crs-num">${i+1}</span>
              <span class="crs-name" title="${name}">${name}</span>
              <div class="crs-track"><div class="crs-fill" data-pct="${Math.round(cnt/maxC*100)}"></div></div>
              <span class="crs-count">${cnt}</span>
            </div>`).join('')
        : '<p style="color:#aaa;font-size:13px">No course data.</p>';

      // ── Dept Tiles ──
      const dEntries = Object.entries(depts);
      document.getElementById('deptChip').textContent = dEntries.length + ' departments';

      document.getElementById('deptBreakdown').innerHTML = dEntries.length
        ? dEntries.map(([dept,cnt])=>`
            <div class="dept-tile">
              <div class="dept-stripe"></div>
              <div class="dept-info">
                <div class="dept-name" title="${dept}">${dept}</div>
                <div class="dept-count">${cnt}</div>
              </div>
            </div>`).join('')
        : '<p style="color:#aaa;font-size:13px">No department data.</p>';

      // Animate all bar fills after a tick
      setTimeout(() => {
        document.querySelectorAll('.year-fill,.crs-fill').forEach(b => {
          b.style.width = b.dataset.pct + '%';
        });
      }, 150);
    })
    .catch(() => {
      ['yearBreakdown','courseBreakdown','deptBreakdown'].forEach(id => {
        document.getElementById(id).innerHTML =
          '<p style="color:#c53030;font-size:13px">Failed to load data.</p>';
      });
    });
}

window.onload = loadStats;
</script>

</body>