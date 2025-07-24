<?php
include_once __DIR__ . '/../../components/header.php';
include_once __DIR__ . '/../../components/navigation.php';
include_once __DIR__ . '/../../components/sidebar.php';
require_once __DIR__ . '/../../../backend/ViewModels/CourseViewModel.php';

$vm = new CourseViewModel();
$departmentInfo = $vm->getAllValidatedDepartment();
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Add New Faculty</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="ManageFacultyView">Manage Faculty</a></li>
        <li class="breadcrumb-item active"><a href="AddNewFacultyUser">Add New Faculty User</a></li>
      </ol>
    </nav>
  </div>
    <section class="section">
    <div class="row">
        <form id="AddForm" method="post" enctype="multipart/form-data">
            <div class="row mb-3">
                <img id="img" style="max-width: 150px; border-radius: 15px;">
            </div>
            <div class="row mb-3">
                <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Profile Picture</label>
                <div class="col-md-8 col-lg-9">
                    <input type="file" name="photo" class="form-control mt-2" onchange="img.src = window.URL.createObjectURL(this.files[0])" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Fullname</label>
                <div class="col-md-8 col-lg-9">
                    <input name="fullname" type="text" class="form-control" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Department</label>
                <div class="col-md-8 col-lg-9">
                  <select name="department" id="departmentSelect" class="form-control" required>
                    <option selected disabled>Please Choose</option>
                      <?php foreach($departmentInfo as $row): ?>
                        <option value="<?= $row['description']; ?>"><?= $row['description']; ?></option>
                      <?php endforeach; ?>
                  </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="Address" class="col-md-4 col-lg-3 col-form-label">Email</label>
                <div class="col-md-8 col-lg-9">
                    <input name="email" type="email" class="form-control" required>
                </div>
            </div>
            
            <div class="row mb-3">
                <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Password</label>
                <div class="col-md-8 col-lg-9">
                    <input name="password" type="text" class="form-control" required>
                    <small id="strength" class="text-muted ms-2 fw-bold"></small>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary" name="btnSaveNewFaculty"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save User Information</button>
            </div>
        </form>
    </div>
    </section>
</main>


<?php
include_once __DIR__ . '/../../components/footer.php';
include_once __DIR__ . '/../../components/footscript.php';
?>

<script>
  const BASE_URL = "<?= BASE_URL ?>";

  document.querySelector('input[name="password"]').addEventListener('input', function () {
    const strengthMsg = document.getElementById('strength');
    const val = this.value;

    if (val.length < 6) {
      strengthMsg.textContent = "Too short (min 6 characters)";
      strengthMsg.style.color = "red";
    } else if (!/[A-Z]/.test(val) || !/[0-9]/.test(val) || !/[!@#\$%\^&\*]/.test(val)) {
      strengthMsg.textContent = "Weak (add uppercase, number, symbol)";
      strengthMsg.style.color = "orange";
    } else {
      strengthMsg.textContent = "Strong password!";
      strengthMsg.style.color = "green";
    }
  });

  // AJAX form submission
$('#AddForm').submit(function (e) {
  e.preventDefault();

  var formData = new FormData(this);
  formData.append("btnSaveNewFaculty", true); 

  $.ajax({
    url: BASE_URL + '/api/api.facultyuser.php',
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    dataType: 'json',
    success: function (response) {
      if (response === "added") {
        Swal.fire({
          icon: 'success',
          title: 'Faculty Added',
          text: 'New Faculty user successfully added!',
          timer: 2000,
          showConfirmButton: false
        }).then(() => {
          location.href = 'ManageFacultyView';
        });
      } else {
        Swal.fire('Warning', 'Duplicate Faculty Email', 'error');
      }
    },
    error: function () {
      Swal.fire('Error', 'Server error. Try again.', 'error');
    }
  });
});
</script>



