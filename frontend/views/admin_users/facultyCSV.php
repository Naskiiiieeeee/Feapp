<?php
include_once __DIR__ . '/../../components/header.php';
include_once __DIR__ . '/../../components/navigation.php';
include_once __DIR__ . '/../../components/sidebar.php';
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Import Faculty Loading Via CSV</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/frontend/views/admin_users/settings">Evaluation Scheduler</a></li>
        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/frontend/views/admin_users/facultyLoading">Faculty Loading</a></li>
        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/frontend/views/admin_users/facultyCSV">Upload Loading Via CSV</a></li>
      </ol>
    </nav>
  </div>
    <section class="section">
    <div class="row">
        <form id="AddForm" method="post" enctype="multipart/form-data">
            <div class="row mb-3">
                <label for="" class="col-md-4 col-lg-3 col-form-label">Upload File <strong>(CSV format ONLY)</strong></label>
                <div class="col-md-8 col-lg-9">
                    <input type="file" name="loadingCSV" id="" class="form-control" required>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary" name="btnSaveStudentInfos"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save Information</button>
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
    url: BASE_URL + '/api/api.loading.php',
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    dataType: 'json',
    success: function (response) {
    if (response === "added" || response.status === "added") {
        let inserted = response.inserted || 0;
        let duplicates = response.duplicates || 0;

        Swal.fire({
        icon: 'success',
        title: 'Upload Completed',
        html: `Inserted: ${inserted}<br>Duplicates Skipped: ${duplicates}`,
        timer: 3000,
        showConfirmButton: false
        }).then(() => {
        location.href = 'facultyLoading';
        });
    } else {
        Swal.fire('Warning', response.message || 'Duplicate Student Email', "error");
    }
    },
    error: function () {
      Swal.fire('Error', 'Server error. Try again.', "error");
    }
  });
});
</script>



