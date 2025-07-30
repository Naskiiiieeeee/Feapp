<?php
include_once __DIR__ . '/../../components/header.php';
include_once __DIR__ . '/../../components/navigation.php';
include_once __DIR__ . '/../../components/sidebar.php';
require_once __DIR__ . '/../../../backend/ViewModels/CourseViewModel.php';
require_once __DIR__ . '/../../../backend/ViewModels/LoadingViewModel.php';

$vm = new CourseViewModel();
$lvm = new LoadingViewModel();
$departmentInfo = $vm->getAllValidatedDepartment();
$sectionInfo = $lvm->getActivatedSection();
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Add New Student</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="ManageStudentView">Manage Student</a></li>
        <li class="breadcrumb-item active"><a href="AddNewStudentUser">Add New Student User</a></li>
        <li class="breadcrumb-item active"><a href="UploadViaCSV">Upload Via CSV</a></li>
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
                    <select name="section" id="" class="form-control" required>
                      <option selected disabled>Please Choose</option>
                      <?php foreach($sectionInfo as $row): ?>
                        <option value="<?= $row['section_name']; ?>"> Section: <?= $row['section_name']; ?></option>
                      <?php endforeach; ?>
                    </select>
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
              <label for="" class="col-md-4 col-lg-3 col-form-label"> Department</label>
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
              <label for="" class="col-md-4 col-lg-3 col-form-label">Course</label>
              <div class="col-md-8 col-lg-9">
                <select name="course" id="" class="form-control">
                  
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
        Swal.fire('Warning', 'Duplicate Student Email', "error");
      }
    },
    error: function () {
      Swal.fire('Error', 'Server error. Try again.', "error");
    }
  });
});

$('#departmentSelect').change(function () {
  const selectedDept = $(this).val();

  $.ajax({
    url: BASE_URL + '/api/api.course.php',
    method: 'POST',
    data: { departmentCode: selectedDept },
    dataType: 'json',
    success: function (response) {
      const courseSelect = $('select[name="course"]');
      courseSelect.empty();
      courseSelect.append('<option selected disabled>Please Choose</option>');

      if (response.length > 0) {
        response.forEach(course => {
          courseSelect.append(`<option value="${course.code}">${course.description}</option>`);
        });
      } else {
        courseSelect.append('<option disabled>No course available</option>');
      }
    },
    error: function () {
      console.error('Error fetching courses');
    }
  });
});
</script>



