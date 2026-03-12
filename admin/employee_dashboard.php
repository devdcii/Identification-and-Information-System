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
    <a href="student_dashboard.php" class="sidebar-link">
      <i class="fas fa-user-graduate"></i> <span>Students</span>
    </a>
    <a href="employee_dashboard.php" class="sidebar-link active">
      <i class="fas fa-user-tie"></i> <span>Employees</span>
    </a>
  </nav>
</div>

<!-- Filter Bar -->
<div class="filter-bar">
  <div class="filter-group">
    <label for="sortEmpDate" class="form-label">Sort by Date</label>
    <select id="sortEmpDate" class="form-select form-select-sm">
      <option value="desc">Newest First</option>
      <option value="asc">Oldest First</option>
    </select>
  </div>
</div>

<!-- Table Area -->
<div id="empTableArea" style="margin-left: 260px; padding: 20px 20px 0;"></div>

<!-- Pagination Bar -->
<div id="empPaginationBar" style="margin-left:260px; padding: 0 20px 10px; display:none;">
  <div class="pagination-wrapper">
    <div class="pagination-info" id="empPaginationInfo"></div>
    <div class="pagination-controls">
      <label class="per-page-label">Rows per page:</label>
      <select id="empPerPageSelect" class="per-page-select">
        <option value="10">10</option>
        <option value="25">25</option>
        <option value="50">50</option>
        <option value="100">100</option>
      </select>
      <div class="page-btns" id="empPageBtns"></div>
    </div>
  </div>
</div>

<!-- Download Button -->
<div class="download-btn-container">
  <button class="btn btn-success btn-sm" onclick="downloadExcel()">
    <i class="fas fa-file-excel"></i> Download Employee Excel
  </button>
</div>

<!-- Edit Employee Modal -->
<div class="modal fade" id="editEmpModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Edit Employee Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="editEmpId">
        <div class="row g-2">
          <div class="col-md-6"><label>Surname</label><input type="text" class="form-control" id="editEmpSurname"></div>
          <div class="col-md-6"><label>First Name</label><input type="text" class="form-control" id="editEmpFname"></div>
          <div class="col-md-6"><label>Middle Initial</label><input type="text" class="form-control" id="editEmpMi"></div>
          <div class="col-md-6"><label>Extension</label><input type="text" class="form-control" id="editEmpExt" placeholder="Jr., Sr., III"></div>
          <div class="col-md-6"><label>Employee ID</label><input type="text" class="form-control" id="editEmpEid"></div>
          <div class="col-md-6"><label>Position</label><input type="text" class="form-control" id="editEmpPosition"></div>
          <div class="col-md-6"><label>Department</label><input type="text" class="form-control" id="editEmpDepartment"></div>
          <div class="col-12"><label>Address</label><textarea class="form-control" id="editEmpAddress" rows="2"></textarea></div>
          <div class="col-md-6"><label>Emergency Contact Name</label><input type="text" class="form-control" id="editEmpEmergencyName"></div>
          <div class="col-md-3"><label>Relation</label><input type="text" class="form-control" id="editEmpRelation"></div>
          <div class="col-md-3"><label>Contact Number</label><input type="text" class="form-control" id="editEmpContact"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="saveEmpEditBtn">Save Changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Confirm Delete</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">Are you sure you want to delete this employee record?</div>
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
.pagination-info { font-size: 13px; color: #6c757d; }
.pagination-controls { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
.per-page-label { font-size: 13px; color: #6c757d; }
.per-page-select {
  font-size: 13px; padding: 4px 8px;
  border: 1px solid #ced4da; border-radius: 6px;
  background: white; cursor: pointer; color: #333;
}
.page-btns { display: flex; gap: 4px; align-items: center; }
.page-btn {
  min-width: 32px; height: 32px;
  border: 1px solid #dee2e6; background: white;
  border-radius: 6px; font-size: 13px; cursor: pointer;
  display: flex; align-items: center; justify-content: center;
  color: #495057; transition: all 0.15s; padding: 0 8px;
}
.page-btn:hover { background: #f0f4ff; border-color: steelblue; color: steelblue; }
.page-btn.active { background: steelblue; border-color: steelblue; color: white; font-weight: 700; }
.page-btn:disabled { opacity: 0.4; cursor: not-allowed; }
.page-ellipsis { font-size: 13px; color: #aaa; padding: 0 4px; }
</style>

<script>
  // ── Pagination State ──
  let allEmpRows   = [];
  let empPage      = 1;
  let empPerPage   = 10;
  let currentEmpId = null;

  window.onload = loadEmployeeTable;

  document.getElementById("sortEmpDate").addEventListener("change", () => { empPage = 1; loadEmployeeTable(); });
  document.getElementById("empPerPageSelect").addEventListener("change", function() {
    empPerPage = parseInt(this.value);
    empPage = 1;
    renderEmpPage();
  });

  function loadEmployeeTable() {
    const sort = document.getElementById("sortEmpDate").value;
    fetch("../admin/fetch_employee.php?sort=" + sort)
      .then(res => res.text())
      .then(html => {
        const parser = new DOMParser();
        const doc    = parser.parseFromString(html, 'text/html');
        const table  = doc.querySelector('table');

        if (!table) {
          document.getElementById("empTableArea").innerHTML = html;
          document.getElementById("empPaginationBar").style.display = "none";
          return;
        }

        const clone = table.cloneNode(true);
        clone.querySelector('tbody').innerHTML = '';
        document.getElementById("empTableArea").innerHTML =
          '<div style="overflow-x:auto;">' + clone.outerHTML + '</div>';

        allEmpRows = Array.from(table.querySelectorAll('tbody tr'));
        empPage = 1;
        renderEmpPage();
      });
  }

  function renderEmpPage() {
    const tbody = document.querySelector('#empTableArea tbody');
    if (!tbody) return;

    const total      = allEmpRows.length;
    const totalPages = Math.ceil(total / empPerPage);
    const start      = (empPage - 1) * empPerPage;
    const end        = Math.min(start + empPerPage, total);

    tbody.innerHTML = '';
    allEmpRows.slice(start, end).forEach(row => tbody.appendChild(row.cloneNode(true)));
    attachEmpEventListeners();

    document.getElementById("empPaginationInfo").textContent =
      total === 0 ? 'No records found' : `Showing ${start + 1}–${end} of ${total} records`;

    renderEmpPageButtons(totalPages);
    document.getElementById("empPaginationBar").style.display = total > 0 ? "block" : "none";
  }

  function renderEmpPageButtons(totalPages) {
    const container = document.getElementById("empPageBtns");
    container.innerHTML = '';

    container.appendChild(makeBtn('‹', empPage === 1, () => { empPage--; renderEmpPage(); }));

    let pages = [];
    if (totalPages <= 7) {
      for (let i = 1; i <= totalPages; i++) pages.push(i);
    } else {
      pages = [1];
      if (empPage > 3) pages.push('…');
      for (let i = Math.max(2, empPage - 1); i <= Math.min(totalPages - 1, empPage + 1); i++) pages.push(i);
      if (empPage < totalPages - 2) pages.push('…');
      pages.push(totalPages);
    }

    pages.forEach(p => {
      if (p === '…') {
        const el = document.createElement('span');
        el.className = 'page-ellipsis';
        el.textContent = '…';
        container.appendChild(el);
      } else {
        const btn = makeBtn(p, false, () => { empPage = p; renderEmpPage(); });
        if (p === empPage) btn.classList.add('active');
        container.appendChild(btn);
      }
    });

    container.appendChild(makeBtn('›', empPage === totalPages || totalPages === 0, () => { empPage++; renderEmpPage(); }));
  }

  function makeBtn(label, disabled, onClick) {
    const btn = document.createElement('button');
    btn.className = 'page-btn';
    btn.textContent = label;
    btn.disabled = disabled;
    if (!disabled) btn.addEventListener('click', onClick);
    return btn;
  }

  function attachEmpEventListeners() {
    document.querySelectorAll(".emp-edit-btn").forEach(btn => {
      btn.addEventListener("click", function() {
        const id = this.getAttribute("data-id");
        fetch(`../config/get_employee.php?id=${id}`)
          .then(res => res.json())
          .then(data => {
            document.getElementById("editEmpId").value           = data.e_id;
            document.getElementById("editEmpSurname").value      = data.employee_surname;
            document.getElementById("editEmpFname").value        = data.employee_fname;
            document.getElementById("editEmpMi").value           = data.employee_mi;
            document.getElementById("editEmpExt").value          = data.employee_ext;
            document.getElementById("editEmpEid").value          = data.employee_id;
            document.getElementById("editEmpPosition").value     = data.employee_position;
            document.getElementById("editEmpDepartment").value   = data.employee_department;
            document.getElementById("editEmpAddress").value      = data.employee_address;
            document.getElementById("editEmpEmergencyName").value= data.employee_emergency_name;
            document.getElementById("editEmpRelation").value     = data.employee_relation;
            document.getElementById("editEmpContact").value      = data.employee_contact;
            new bootstrap.Modal(document.getElementById("editEmpModal")).show();
          });
      });
    });

    document.querySelectorAll(".emp-delete-btn").forEach(btn => {
      btn.addEventListener("click", function() {
        currentEmpId = this.getAttribute("data-id");
        new bootstrap.Modal(document.getElementById("deleteModal")).show();
      });
    });
  }

  document.getElementById("saveEmpEditBtn").addEventListener("click", () => {
    const formData = new FormData();
    formData.append("e_id",                   document.getElementById("editEmpId").value);
    formData.append("employee_surname",        document.getElementById("editEmpSurname").value);
    formData.append("employee_fname",          document.getElementById("editEmpFname").value);
    formData.append("employee_mi",             document.getElementById("editEmpMi").value);
    formData.append("employee_ext",            document.getElementById("editEmpExt").value);
    formData.append("employee_id",             document.getElementById("editEmpEid").value);
    formData.append("employee_position",       document.getElementById("editEmpPosition").value);
    formData.append("employee_department",     document.getElementById("editEmpDepartment").value);
    formData.append("employee_address",        document.getElementById("editEmpAddress").value);
    formData.append("employee_emergency_name", document.getElementById("editEmpEmergencyName").value);
    formData.append("employee_relation",       document.getElementById("editEmpRelation").value);
    formData.append("employee_contact",        document.getElementById("editEmpContact").value);

    fetch("../config/update_employee.php", { method: "POST", body: formData })
      .then(res => res.text())
      .then(res => {
        if (res.trim() === "success") {
          bootstrap.Modal.getInstance(document.getElementById("editEmpModal")).hide();
          loadEmployeeTable();
          showSuccessModal("Employee updated successfully!");
        } else {
          alert("Update failed: " + res);
        }
      });
  });

  document.getElementById("confirmDeleteBtn").addEventListener("click", () => {
    fetch(`../config/delete_employee.php?id=${currentEmpId}`)
      .then(res => res.text())
      .then(res => {
        if (res.trim() === "success") {
          bootstrap.Modal.getInstance(document.getElementById("deleteModal")).hide();
          loadEmployeeTable();
          showSuccessModal("Employee deleted successfully!");
        } else {
          alert("Delete failed: " + res);
        }
      });
  });

  function showSuccessModal(message) {
    document.getElementById("successMessage").textContent = message;
    new bootstrap.Modal(document.getElementById("successModal")).show();
  }

  function downloadExcel() {
    const sort = document.getElementById("sortEmpDate").value;
    window.open(`../admin/export_excel_employee_data.php?sort=${encodeURIComponent(sort)}`, "_blank");
  }
</script>

</body>