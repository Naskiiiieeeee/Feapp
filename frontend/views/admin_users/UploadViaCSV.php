<?php
include_once __DIR__ . '/../../components/header.php';
include_once __DIR__ . '/../../components/navigation.php';
include_once __DIR__ . '/../../components/sidebar.php';
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Import Student Information</h1>
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
                <label for="" class="col-md-4 col-lg-3 col-form-label">Upload CSV File</label>
                <div class="col-md-8 col-lg-9">
                    <input type="file" name="studentCSV" id="" class="form-control" required>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary" name="btnSaveStudentInfos"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save User Information</button>
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
  formData.append("btnSaveStudentInfos", true); 

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
          text: 'Student Informations successfully added!',
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
</script>



