<?php
require_once "../config/dbcon.php";
include "../config/dashboardplugin.php";
?>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
  <a href="../index.php" class="logout-icon" title="Logout">
    <i class="fas fa-sign-out-alt"></i>
  </a>
  <div class="sidebar-header">
    <img src="../image/logo.png" alt="HCC Logo" class="hcc-logo">
    <h4>Admin Dashboard</h4>
  </div>
  <nav class="sidebar-nav">
    <a href="dashboard.php" class="sidebar-link">
      <i class="fas fa-chart-pie"></i> <span>Dashboard</span>
    </a>
    <a href="student_dashboard.php" class="sidebar-link active">
      <i class="fas fa-user-graduate"></i> <span>Students</span>
    </a>
    <a href="employee_dashboard.php" class="sidebar-link">
      <i class="fas fa-user-tie"></i> <span>Employees</span>
    </a>
  </nav>
</div>

<!-- Filter Bar -->
<div class="filter-bar">
  <div class="filter-group">
    <label for="filterYear" class="form-label">Year</label>
    <select id="filterYear" class="form-select form-select-sm">
      <option value="">All</option>
      <option>1st Year</option>
      <option>2nd Year</option>
      <option>3rd Year</option>
      <option>4th Year</option>
    </select>
  </div>

  <div class="filter-group flex-grow-1">
    <label for="filterCourse" class="form-label">Course</label>
    <select id="filterCourse" class="form-select form-select-sm">
      <option value="">All Courses</option>
      <option>Bachelor of Science in Accountancy</option>
      <option>Bachelor of Science in Accounting Information System</option>
      <option>Bachelor of Science in Information Technology</option>
      <option>Bachelor of Science in Computer Science</option>
      <option>Bachelor of Science in Civil Engineering</option>
      <option>Bachelor of Science in Computer Engineering</option>
      <option>Bachelor of Science in Criminology</option>
      <option>Bachelor of Science in Hospitality Management</option>
      <option>Bachelor of Science in Tourism Management</option>
      <option>Bachelor of Science in Psychology</option>
      <option>Bachelor of Science in Business Administration: Major in Financial Management</option>
      <option>Bachelor of Science in Business Administration: Major in Marketing Management</option>
      <option>Bachelor of Elementary Education</option>
      <option>Bachelor of Secondary Education: Major in Mathematics</option>
      <option>Bachelor of Secondary Education: Major in English</option>
      <option>Bachelor of Secondary Education: Major in Filipino</option>
      <option>Bachelor of Secondary Education: Major in Science</option>
      <option>Associate in Computer Technology</option>
    </select>
  </div>

  <div class="filter-group">
    <label for="sortDate" class="form-label">Sort by Date</label>
    <select id="sortDate" class="form-select form-select-sm">
      <option value="desc">Newest First</option>
      <option value="asc">Oldest First</option>
    </select>
  </div>
</div>

<!-- Table Area -->
<div id="tableArea" style="margin-left: 260px; padding: 20px 20px 0;"></div>

<!-- Pagination Bar -->
<div id="paginationBar" style="margin-left:260px; padding: 0 20px 10px; display:none;">
  <div class="pagination-wrapper">
    <div class="pagination-info" id="paginationInfo"></div>
    <div class="pagination-controls">
      <label class="per-page-label">Rows per page:</label>
      <select id="perPageSelect" class="per-page-select">
        <option value="10">10</option>
        <option value="25">25</option>
        <option value="50">50</option>
        <option value="100">100</option>
      </select>
      <div class="page-btns" id="pageBtns"></div>
    </div>
  </div>
</div>

<!-- Download Button -->
<div class="download-btn-container">
  <button class="btn btn-success btn-sm" onclick="downloadExcel()">
    <i class="fas fa-file-excel"></i> Download Student Excel
  </button>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Confirm Delete</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">Are you sure you want to delete this student record?</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger btn-sm" id="confirmDeleteBtn">Yes, Delete</button>
      </div>
    </div>
  </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Success</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center">
        <i class="fas fa-check-circle text-success" style="font-size:3rem;margin-bottom:15px;"></i>
        <p class="mb-0" id="successMessage"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success btn-sm" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<!-- Error Modal -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Error</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center">
        <i class="fas fa-exclamation-triangle text-danger" style="font-size:3rem;margin-bottom:15px;"></i>
        <p class="mb-0" id="errorMessage">An error occurred. Please try again.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit Student Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Edit Student Information</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="editStudentForm">
          <div class="row">
            <div class="col-md-6 mb-3"><label class="form-label">Last Name</label><input type="text" class="form-control" id="editLastName" required></div>
            <div class="col-md-6 mb-3"><label class="form-label">First Name</label><input type="text" class="form-control" id="editFirstName" required></div>
            <div class="col-md-4 mb-3"><label class="form-label">Middle Initial</label><input type="text" class="form-control" id="editMiddleInitial" maxlength="2"></div>
            <div class="col-md-4 mb-3"><label class="form-label">Extension</label><input type="text" class="form-control" id="editExtension" placeholder="Jr., Sr., III"></div>
            <div class="col-md-4 mb-3"><label class="form-label">Student ID</label><input type="text" class="form-control" id="editStudentId" required></div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Year</label>
              <select class="form-select" id="editYear" required>
                <option value="">Select Year</option>
                <option>1st Year</option><option>2nd Year</option><option>3rd Year</option><option>4th Year</option>
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Course</label>
              <select class="form-select" id="editCourse" required>
                <option value="">Select Course</option>
                <option>Bachelor of Science in Accountancy</option>
                <option>Bachelor of Science in Accounting Information System</option>
                <option>Bachelor of Science in Information Technology</option>
                <option>Bachelor of Science in Computer Science</option>
                <option>Bachelor of Science in Civil Engineering</option>
                <option>Bachelor of Science in Computer Engineering</option>
                <option>Bachelor of Science in Criminology</option>
                <option>Bachelor of Science in Hospitality Management</option>
                <option>Bachelor of Science in Tourism Management</option>
                <option>Bachelor of Science in Psychology</option>
                <option>Bachelor of Science in Business Administration: Major in Financial Management</option>
                <option>Bachelor of Science in Business Administration: Major in Marketing Management</option>
                <option>Bachelor of Elementary Education</option>
                <option>Bachelor of Secondary Education: Major in Mathematics</option>
                <option>Bachelor of Secondary Education: Major in English</option>
                <option>Bachelor of Secondary Education: Major in Filipino</option>
                <option>Bachelor of Secondary Education: Major in Science</option>
                <option>Associate in Computer Technology</option>
              </select>
            </div>
            <div class="col-12 mb-3"><label class="form-label">Address</label><textarea class="form-control" id="editAddress" rows="2" required></textarea></div>
            <div class="col-md-4 mb-3"><label class="form-label">Emergency Contact Name</label><input type="text" class="form-control" id="editEmergencyName" required></div>
            <div class="col-md-4 mb-3"><label class="form-label">Relation</label><input type="text" class="form-control" id="editRelation" required></div>
            <div class="col-md-4 mb-3"><label class="form-label">Contact Number</label><input type="text" class="form-control" id="editContact" required></div>
          </div>
          <input type="hidden" id="editStudentDbId">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="saveEditBtn">Save Changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Pagination Styles -->
<style>
.pagination-wrapper {
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 10px;
  background: white;
  border: 1px solid #dee2e6;
  border-top: none;
  border-radius: 0 0 8px 8px;
  padding: 10px 16px;
}
.pagination-info {
  font-size: 13px;
  color: #6c757d;
}
.pagination-controls {
  display: flex;
  align-items: center;
  gap: 10px;
  flex-wrap: wrap;
}
.per-page-label { font-size: 13px; color: #6c757d; }
.per-page-select {
  font-size: 13px;
  padding: 4px 8px;
  border: 1px solid #ced4da;
  border-radius: 6px;
  background: white;
  cursor: pointer;
  color: #333;
}
.page-btns { display: flex; gap: 4px; align-items: center; }
.page-btn {
  min-width: 32px; height: 32px;
  border: 1px solid #dee2e6;
  background: white;
  border-radius: 6px;
  font-size: 13px;
  cursor: pointer;
  display: flex; align-items: center; justify-content: center;
  color: #495057;
  transition: all 0.15s;
  padding: 0 8px;
}
.page-btn:hover { background: #f0f4ff; border-color: steelblue; color: steelblue; }
.page-btn.active { background: steelblue; border-color: steelblue; color: white; font-weight: 700; }
.page-btn:disabled { opacity: 0.4; cursor: not-allowed; }
.page-ellipsis { font-size: 13px; color: #aaa; padding: 0 4px; }
</style>

<script>
  // ── Pagination State ──
  let allRows   = [];
  let currentPage = 1;
  let perPage   = 10;

  window.onload = applyFilters;

  document.getElementById("filterYear").addEventListener("change", () => { currentPage = 1; applyFilters(); });
  document.getElementById("filterCourse").addEventListener("change", () => { currentPage = 1; applyFilters(); });
  document.getElementById("sortDate").addEventListener("change", () => { currentPage = 1; applyFilters(); });
  document.getElementById("perPageSelect").addEventListener("change", function() {
    perPage = parseInt(this.value);
    currentPage = 1;
    renderPage();
  });

  function applyFilters() {
    const year   = document.getElementById("filterYear").value;
    const course = document.getElementById("filterCourse").value;
    const sort   = document.getElementById("sortDate").value;

    fetch(`../admin/fetch_student.php?year=${encodeURIComponent(year)}&course=${encodeURIComponent(course)}&sort=${sort}`)
      .then(res => res.text())
      .then(html => {
        // Parse and store all rows from the returned table
        const parser = new DOMParser();
        const doc    = parser.parseFromString(html, 'text/html');
        const table  = doc.querySelector('table');

        if (!table) {
          document.getElementById("tableArea").innerHTML = html;
          document.getElementById("paginationBar").style.display = "none";
          return;
        }

        // Put the table shell into tableArea (without tbody rows)
        const clone = table.cloneNode(true);
        clone.querySelector('tbody').innerHTML = '';
        document.getElementById("tableArea").innerHTML =
          '<div style="overflow-x:auto;">' + clone.outerHTML + '</div>';

        // Store all rows
        allRows = Array.from(table.querySelectorAll('tbody tr'));
        currentPage = 1;
        renderPage();
      });
  }

  function renderPage() {
    const tbody = document.querySelector('#tableArea tbody');
    if (!tbody) return;

    const total      = allRows.length;
    const totalPages = Math.ceil(total / perPage);
    const start      = (currentPage - 1) * perPage;
    const end        = Math.min(start + perPage, total);
    const pageRows   = allRows.slice(start, end);

    tbody.innerHTML = '';
    pageRows.forEach(row => tbody.appendChild(row.cloneNode(true)));
    attachEventListeners();

    // Info text
    document.getElementById("paginationInfo").textContent =
      total === 0 ? 'No records found' : `Showing ${start + 1}–${end} of ${total} records`;

    // Page buttons
    renderPageButtons(totalPages);
    document.getElementById("paginationBar").style.display = total > 0 ? "block" : "none";
  }

  function renderPageButtons(totalPages) {
    const container = document.getElementById("pageBtns");
    container.innerHTML = '';

    const prev = makeBtn('‹', currentPage === 1, () => { currentPage--; renderPage(); });
    container.appendChild(prev);

    // Smart page window
    let pages = [];
    if (totalPages <= 7) {
      for (let i = 1; i <= totalPages; i++) pages.push(i);
    } else {
      pages = [1];
      if (currentPage > 3) pages.push('…');
      for (let i = Math.max(2, currentPage - 1); i <= Math.min(totalPages - 1, currentPage + 1); i++) pages.push(i);
      if (currentPage < totalPages - 2) pages.push('…');
      pages.push(totalPages);
    }

    pages.forEach(p => {
      if (p === '…') {
        const el = document.createElement('span');
        el.className = 'page-ellipsis';
        el.textContent = '…';
        container.appendChild(el);
      } else {
        const btn = makeBtn(p, false, () => { currentPage = p; renderPage(); });
        if (p === currentPage) btn.classList.add('active');
        container.appendChild(btn);
      }
    });

    const next = makeBtn('›', currentPage === totalPages || totalPages === 0, () => { currentPage++; renderPage(); });
    container.appendChild(next);
  }

  function makeBtn(label, disabled, onClick) {
    const btn = document.createElement('button');
    btn.className = 'page-btn';
    btn.textContent = label;
    btn.disabled = disabled;
    if (!disabled) btn.addEventListener('click', onClick);
    return btn;
  }

  function attachEventListeners() {
    document.querySelectorAll(".delete-btn").forEach(btn =>
      btn.addEventListener("click", () => deleteStudent(btn.getAttribute("data-id"))));
    document.querySelectorAll(".edit-btn").forEach(btn =>
      btn.addEventListener("click", () => editStudent(btn.getAttribute("data-id"))));
  }

  // ── Delete ──
  let deleteStudentId = null;
  function deleteStudent(id) {
    deleteStudentId = id;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
  }

  document.getElementById("confirmDeleteBtn").addEventListener("click", () => {
    if (!deleteStudentId) return;
    fetch(`../config/delete_student.php?id=${deleteStudentId}`)
      .then(res => res.text())
      .then(res => {
        if (res.trim() === "success") {
          bootstrap.Modal.getInstance(document.getElementById('deleteModal')).hide();
          applyFilters();
          showSuccessModal("Student deleted successfully!");
        } else {
          showErrorModal("Error deleting student: " + res);
        }
      });
  });

  // ── Edit ──
  function editStudent(id) {
    fetch(`../config/get_student.php?id=${id}`)
      .then(res => res.json())
      .then(s => {
        if (s.error) return showErrorModal("Error: " + s.error);
        document.getElementById("editStudentId").value       = s.student_id;
        document.getElementById("editFirstName").value       = s.student_fname;
        document.getElementById("editLastName").value        = s.student_surname;
        document.getElementById("editMiddleInitial").value   = s.student_mi || '';
        document.getElementById("editExtension").value       = s.student_ext || '';
        document.getElementById("editYear").value            = s.student_year;
        document.getElementById("editCourse").value          = s.student_course;
        document.getElementById("editAddress").value         = s.student_address;
        document.getElementById("editEmergencyName").value   = s.student_emergency_name;
        document.getElementById("editRelation").value        = s.student_relation;
        document.getElementById("editContact").value         = s.student_contact;
        document.getElementById("editStudentDbId").value     = s.s_id;
        new bootstrap.Modal(document.getElementById('editModal')).show();
      })
      .catch(() => showErrorModal("Error loading student data"));
  }

  document.getElementById("saveEditBtn").addEventListener("click", () => {
    const formData = new FormData();
    formData.append('s_id',                   document.getElementById("editStudentDbId").value);
    formData.append('student_id',             document.getElementById("editStudentId").value);
    formData.append('student_fname',          document.getElementById("editFirstName").value);
    formData.append('student_surname',        document.getElementById("editLastName").value);
    formData.append('student_mi',             document.getElementById("editMiddleInitial").value);
    formData.append('student_ext',            document.getElementById("editExtension").value);
    formData.append('student_year',           document.getElementById("editYear").value);
    formData.append('student_course',         document.getElementById("editCourse").value);
    formData.append('student_address',        document.getElementById("editAddress").value);
    formData.append('student_emergency_name', document.getElementById("editEmergencyName").value);
    formData.append('student_relation',       document.getElementById("editRelation").value);
    formData.append('student_contact',        document.getElementById("editContact").value);

    fetch("../config/update_student.php", { method: "POST", body: formData })
      .then(res => res.text())
      .then(res => {
        if (res.trim() === "success") {
          bootstrap.Modal.getInstance(document.getElementById('editModal')).hide();
          showSuccessModal("Student updated successfully!");
          applyFilters();
        } else {
          showErrorModal("Error updating student: " + res.trim());
        }
      });
  });

  function showSuccessModal(msg) {
    document.getElementById("successMessage").textContent = msg;
    new bootstrap.Modal(document.getElementById('successModal')).show();
  }
  function showErrorModal(msg) {
    document.getElementById("errorMessage").textContent = msg;
    new bootstrap.Modal(document.getElementById('errorModal')).show();
  }
  function downloadExcel() {
    const year   = document.getElementById("filterYear").value;
    const course = document.getElementById("filterCourse").value;
    const sort   = document.getElementById("sortDate").value;
    window.open(`../admin/export_excel_student_data.php?year=${encodeURIComponent(year)}&course=${encodeURIComponent(course)}&sort=${sort}`, "_blank");
  }
</script>

</body>