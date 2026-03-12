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

  <!-- Section Title -->
  <h2 class="section-title">Student Information</h2>

  <form action="../student/student_submit_form.php" method="post" class="registration-form" id="studentForm">

    <!-- Name -->
    <div class="form-group">
      <label>Name:</label>
      <input type="text" placeholder="Surname" name="lname" required oninput="this.value = this.value.toUpperCase();">
      <input type="text" placeholder="First Name" name="fname" required oninput="capitalizeEachWord(this);">
      <input type="text" placeholder="MI." name="mi" required maxlength="2" 
  oninput="formatMiddleInitial(this);">
      <input type="text" placeholder="Ext." name="ext" oninput="this.value = this.value.toUpperCase();">
    </div>

    <!-- Address -->
    <div class="form-group">
      <label>Address:</label>
      <input type="text" placeholder="Barangay" name="barangay" oninput="capitalizeEachWord(this);">
      <input type="text" placeholder="Town/Municipality" name="town" oninput="capitalizeEachWord(this);">
      <input type="text" placeholder="Province" name="province" oninput="capitalizeEachWord(this);">
    </div>

    <!-- Student ID -->
    <div class="form-group">
      <label>Student ID:</label>
      <input type="text" name="student_id" required>
    </div>

    <!-- Year (Radio buttons with larger circles and tight label) -->
    <div class="form-group">
      <label>Year:</label>
      <div class="radio-group">
        <label><input type="radio" name="year" value="1st Year" required> 1st Year</label>
        <label><input type="radio" name="year" value="2nd Year"> 2nd Year</label>
        <label><input type="radio" name="year" value="3rd Year"> 3rd Year</label>
        <label><input type="radio" name="year" value="4th Year"> 4th Year</label>
      </div>
    </div>

    <!-- Course -->
    <div class="form-group">
      <label>Course:</label>
      <select name="course" required>
        <option value="">-- Select Course --</option>
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
      <a href="../index.php" class="btn back-btn">
        <i class="fas fa-arrow-left"></i> Back
      </a>

    <button type="submit" class="btn submit-btn">
        <i class="fas fa-paper-plane"></i> Submit Registration
      </button>
    </div>

  </form>
</div>

<!-- Capitalize Script -->
<script>
function capitalizeEachWord(input) {
  input.value = input.value
    .toLowerCase()
    .replace(/\b\w/g, function(char) {
      return char.toUpperCase();
    });
}

function formatMiddleInitial(input) {
  let value = input.value.toUpperCase().replace(/[^A-Z]/g, '');
  if (value.length === 1) {
    input.value = value + '.';
  } else if (value.length > 1) {
    input.value = value.charAt(0) + '.';
  }
}
</script>

<?php if (isset($_SESSION['show_success_modal'])): ?>
<!-- Bootstrap Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded">
      <div class="modal-header bg-success text-white py-2 px-3">
        <h5 class="modal-title" id="successModalLabel">
          <i class="fas fa-check-circle me-2"></i>Registration Successful
        </h5>
      </div>
      <div class="modal-body text-center p-4">
        <p class="mb-0" style="font-size: 16px; color: #333;">The student has been successfully registered.</p>
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
      window.location.href = "../student/student_form.php";
    });
  };

</script>
<?php unset($_SESSION['show_success_modal']); ?>
<?php endif; ?>


</body>
</html>