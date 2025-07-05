<?php
include_once __DIR__ . '/../../components/header.php';
include_once __DIR__ . '/../../components/navigation.php';
include_once __DIR__ . '/../../components/sidebar.php';
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Add New Student</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="ManageStudentView">Manage Student</a></li>
        <li class="breadcrumb-item active"><a href="AddNewStudentUser">Add New Student User</a></li>
      </ol>
    </nav>
  </div>
    <section class="section">
    <div class="row">
        <form id="AddForm" method="post" enctype="multipart/form-data">
            <div class="row mb-3">
                <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Fullname</label>
                <div class="col-md-8 col-lg-9">
                    <input name="fullname" type="text" class="form-control" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Section</label>
                <div class="col-md-8 col-lg-9">
                    <input name="section" type="text" class="form-control" required>
                </div>
            </div>
            
            <div class="row mb-3">
                <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Year Level</label>
                <div class="col-md-8 col-lg-9">
                    <select name="yearLvl" class="form-control">
                        <option selected disabled>Please Choose</option>
                        <option value="1st Year">1st Year</option>
                        <option value="2nd Year">2nd Year</option>
                        <option value="3rd Year">3rd Year</option>
                        <option value="4th Year">4th Year</option>
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
                <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Student Number</label>
                <div class="col-md-8 col-lg-9">
                    <input name="studentNo" type="text" class="form-control" required>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary" name="btnSaveStudentProfile"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save User Information</button>
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
  // AJAX form submission
$('#AddForm').submit(function (e) {
  e.preventDefault();

  var formData = new FormData(this);
  formData.append("btnSaveStudentProfile", true); 

  $.ajax({
    url: BASE_URL + '/api/api.studentuser.php',
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    dataType: 'json',
    success: function (response) {
      if (response === "added") {
        Swal.fire({
          icon: 'success',
          title: 'Student Added',
          text: 'New Student user successfully added!',
          timer: 2000,
          showConfirmButton: false
        }).then(() => {
          location.href = 'ManageStudentView';
        });
      } else {
        Swal.fire('Error', 'Failed to add Student', "error");
      }
    },
    error: function () {
      Swal.fire('Error', 'Server error. Try again.', "error");
    }
  });
});
</script>



