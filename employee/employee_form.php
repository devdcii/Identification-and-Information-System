<!DOCTYPE html>
<html lang="en">
<?php include "../config/pageplugin.php"; 
      session_start();

?>

<body class="form-body">

<div class="form-container">

  <!-- Header with Logos -->
  <div class="form-header">
    <div class="header-logos">
      <img src="../image/logo.png" alt="HCC Logo" class="side-logo">
      <div class="header-text">
        <h1>Holy Cross Colleges, Inc.</h1>
        <p>Sta. Lucia, Sta. Ana, Pampanga<br>Information Communication Department</p>
      </div>   
      <img src="../image/mmdlogo.png" alt="MMD Logo" class="side-logo">
    </div>
  </div>

  <!-- Employee Info Section -->
  <h2 class="section-title">Employee Information</h2>

  <form action="employee_submit_form.php" method="post" class="registration-form" id="employeeForm">

    <!-- Name Fields -->
    <div class="form-group">
      <label>Name:</label>
      <input type="text" placeholder="Surname" name="lname" required oninput="this.value = this.value.toUpperCase();">
      <input type="text" placeholder="First Name" name="fname" required oninput="capitalizeEachWord(this);">
      <input type="text" placeholder="MI." name="mi" required maxlength="2" oninput="formatMiddleInitial(this);">
      <input type="text" placeholder="Ext." name="ext" oninput="this.value = this.value.toUpperCase();">
    </div>

    <!-- Address Fields -->
    <div class="form-group">
      <label>Address:</label>
      <input type="text" placeholder="Barangay" name="barangay" oninput="capitalizeEachWord(this);">
      <input type="text" placeholder="Town/Municipality" name="town" oninput="capitalizeEachWord(this);">
      <input type="text" placeholder="Province" name="province" oninput="capitalizeEachWord(this);">
    </div>

    <!-- Employee Details -->
    <div class="form-group">
      <label>Employee ID:</label>
      <input type="text" name="employee_id" required>
    </div>

    <div class="form-group">
      <label>Department:</label>
      <input type="text" name="department" required oninput="capitalizeEachWord(this);">
    </div>

    <div class="form-group">
      <label>Position:</label>
      <input type="text" name="position" required oninput="capitalizeEachWord(this);">
    </div>

    <!-- Emergency Contact -->
    <h2 class="section-title">Emergency Contact</h2>

    <div class="form-group">
      <label>Name:</label>
      <input type="text" name="emergency_name" required oninput="capitalizeEachWord(this);">
    </div>

    <div class="form-group">
      <label>Relationship:</label>
      <input type="text" name="relation" required oninput="capitalizeEachWord(this);">
    </div>

    <div class="form-group">
      <label>Contact Number:</label>
      <input type="text" name="contact_number" required maxlength="11" pattern="\d{11}" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
    </div>

    <!-- Buttons -->
    <div class="form-actions">
      <a href="../index.php" class="btn back-btn"><i class="fas fa-arrow-left"></i> Back</a>
      <button type="submit" class="btn submit-btn"><i class="fas fa-paper-plane"></i> Submit Registration</button>
    </div>

  </form>
</div>

<!-- JS Functions -->
<script>
function capitalizeEachWord(input) {
  input.value = input.value.toLowerCase().replace(/\b\w/g, function(char) {
    return char.toUpperCase();
  });
}

function formatMiddleInitial(input) {
  let value = input.value.toUpperCase().replace(/[^A-Z]/g, '');
  input.value = value.length > 0 ? value.charAt(0) + '.' : '';
}
</script>

<?php
// ✅ Only show modal if registration was successful (no delete logic)
if (isset($_SESSION['show_success_modal'])):
?>

<!-- Registration Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded">
      <div class="modal-header bg-success text-white py-2 px-3">
        <h5 class="modal-title" id="successModalLabel">
          <i class="fas fa-check-circle me-2"></i> Registration Successful
        </h5>
      </div>
      <div class="modal-body text-center p-4">
        <p class="mb-0" style="font-size: 16px; color: #333;">The employee has been successfully registered.</p>
      </div>
      <div class="modal-footer justify-content-center border-0 pb-4">
        <button type="button" class="btn btn-success px-4" id="modalOkBtn">OKAY</button>
      </div>
    </div>
  </div>
</div>

<script>
window.onload = function () {
  const modal = new bootstrap.Modal(document.getElementById('successModal'));
  modal.show();

  document.getElementById('modalOkBtn').addEventListener('click', function () {
    modal.hide();
    window.location.href = "../employee/employee_form.php";
  });
};
</script>

<?php
unset($_SESSION['show_success_modal']);
endif;
?>

</body>
</html>
