<?php
require_once __DIR__ . '/../../../backend/ViewModels/LoadingViewModel.php';
include_once __DIR__ . '/../../components/header.php';
include_once __DIR__ . '/../../components/navigation.php';
include_once __DIR__ . '/../../components/sidebar.php';

$lvm = new LoadingViewModel();

$page_no = isset($_GET['page_no']) && $_GET['page_no'] !== "" ? (int)$_GET['page_no'] : 1;
$limit = 10;
$count = ($page_no - 1) * $limit + 1;

$loadingdata = $lvm->getLoadPaginated($page_no, $limit);
$total_pages = $lvm->getTotalPages($limit);

$departmentInfo = $lvm->getAllValidatedDepartment();
$facultyInfo = $lvm->getActivatedFaculty();
$sectionInfo = $lvm->getActivatedSection();
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Faculty Loading</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/frontend/views/admin_users/settings">Evaluation Scheduler</a></li>
        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/frontend/views/admin_users/facultyLoading">Faculty Loading</a></li>
      </ol>
    </nav>
  </div>

<section class="section profile">
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-body pt-3">
          <ul class="nav nav-tabs nav-tabs-bordered">
            <li class="nav-item">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">History</button>
            </li>
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Add New Faculty Load</button>
            </li>
          </ul>
          <div class="tab-content pt-2">
            <div class="tab-pane fade show active profile-overview" id="profile-overview">
              <div class="row">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Recent Records</h5>
                    <div class="table-responsive">
                      <div class="mb-3">
                        <input type="text" class="form-control" id="searchBox" placeholder="🔍 Search by Department/Course/facultyEmail/Section/Subject">
                      </div>    
                      <table class="table">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th>Department</th>
                            <th>Course</th>
                            <th>Year Lvl</th>
                            <th>Subject Code</th>
                            <th>Section</th>
                            <th>Faculty</th>
                            <!-- <th>Status</th> -->
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($loadingdata)): ?>
                          <?php foreach ($loadingdata as $row): ?>
                            <tr>
                              <td><?= $count++; ?></td>
                              <td class="id"><?= htmlspecialchars($row['fl_code']); ?></td>
                              <td class="department"><?= htmlspecialchars($row['department']); ?></td>
                              <td class="course"><?= htmlspecialchars($row['course']); ?></td>
                              <td class="year_lvl"><?= htmlspecialchars($row['year_lvl']); ?></td>
                              <td class="subjects"><?= htmlspecialchars($row['subjects']); ?></td>
                              <td class="section"><?= htmlspecialchars($row['section']); ?></td>
                              <td class="faculty_email"><?= htmlspecialchars($row['faculty_email']); ?></td>
                              <!-- <td>
                                <?php
                                  switch ($row['status']) {
                                    case 1:
                                      echo '<span class="badge bg-success fs-7 rounded-5"><i class="bi bi-check-circle"></i> Activated</span>';
                                      break;
                                    case 2:
                                      echo '<span class="badge bg-danger fs-7 rounded-5"><i class="bi bi-x-circle"></i> Restricted</span>';
                                      break;
                                    default:
                                      echo '<span class="badge bg-secondary fs-7 rounded-5"><i class="bi bi-exclamation-circle"></i> Pending</span>';
                                      break;
                                  }
                                ?>
                              </td> -->
                              <td>
                                <button type="button"
                                        class="btn btn-danger mt-1 px-1 btn-sm deleteLoad"
                                        id="<?= $row['id']; ?>"
                                        data-name="<?= htmlspecialchars($row['faculty_email']); ?>"
                                        title="Delete">
                                  <i class="fas fa-trash mx-2" aria-hidden="true"></i>
                                </button>
                                <!-- <button type="button"
                                        class="btn btn-primary mt-1 px-1 btn-sm editbutton"
                                        data-toggle="modal"
                                        data-target="#verifyModal">
                                  <i class="bi bi-pencil-square mx-2"></i>
                                </button> -->
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        <?php else: ?>
                          <tr class="text-center"><td colspan="8">No Registered Data!</td></tr>
                        <?php endif; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <div class="card-footer bg-bg-info-subtle d-flex align-items-center justify-content-between">
                    <nav aria-label="Page navigation">
                      <ul class="pagination justify-content-center fw-bold">
                        <li class="page-item <?= ($page_no <= 1) ? 'disabled' : ''; ?>">
                          <a class="page-link" href="?page_no=1">First</a>
                        </li>
                        <li class="page-item <?= ($page_no <= 1) ? 'disabled' : ''; ?>">
                          <a class="page-link" href="<?= ($page_no <= 1) ? '#' : '?page_no=' . ($page_no - 1); ?>">Prev</a>
                        </li>
                        <li class="page-item <?= ($page_no >= $total_pages) ? 'disabled' : ''; ?>">
                          <a class="page-link" href="<?= ($page_no >= $total_pages) ? '#' : '?page_no=' . ($page_no + 1); ?>">Next</a>
                        </li>
                        <li class="page-item <?= ($page_no >= $total_pages) ? 'disabled' : ''; ?>">
                          <a class="page-link" href="?page_no=<?= $total_pages; ?>">Last</a>
                        </li>
                      </ul>
                    </nav>
                  </div>

                </div>
              </div>

            </div>

            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
              <form id="AddForm">
                <div class="row mb-3">
                  <label for="fullName" class="col-md-4 col-lg-3 col-form-label"><i class="bi bi-building-add"></i> Department</label>
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
                  <label for="about" class="col-md-4 col-lg-3 col-form-label"><i class="bi bi-journal-bookmark"></i> Course</label>
                  <div class="col-md-8 col-lg-9">
                    <select name="course" id="" class="form-control">
                  
                    </select>
                  </div>
                </div>
                
                <div class="row mb-3">
                  <label for="about" class="col-md-4 col-lg-3 col-form-label"><i class="bi bi-calendar2-check-fill"></i> Year Level</label>
                  <div class="col-md-8 col-lg-9">
                    <select name="yearLvl" id="" class="form-control">
                  
                    </select>
                  </div>
                </div>
                                
                <div class="row mb-3">
                  <label for="about" class="col-md-4 col-lg-3 col-form-label"><i class="bi bi-bookmarks"></i> Subject</label>
                  <div class="col-md-8 col-lg-9">
                    <select name="subjects" id="" class="form-control">
                  
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="fullName" class="col-md-4 col-lg-3 col-form-label"><i class="bi bi-person-badge"></i> Section</label>
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
                  <label for="fullName" class="col-md-4 col-lg-3 col-form-label"><i class="bi bi-person-badge"></i> Faculty Name</label>
                  <div class="col-md-8 col-lg-9">
                    <select name="faculty" id="" class="form-control" required>
                      <option selected disabled>Please Choose</option>
                      <?php foreach($facultyInfo as $row): ?>
                        <option value="<?= $row['email']; ?>"><?= $row['fullname']; ?> | <?= $row['department']; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="fullName" class="col-md-4 col-lg-3 col-form-label"><i class="bi bi-journal-bookmark-fill"></i> Semester</label>
                  <div class="col-md-8 col-lg-9">
                    <select name="semester" id="" class="form-control">
                        <option value="1st Semester">1st Semester</option>
                        <option value="2nd Semester">2nd Semester</option>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="fullName" class="col-md-4 col-lg-3 col-form-label"><i class="bi bi-calendar2-check"></i> School Year</label>
                  <div class="col-md-8 col-lg-9">
                    <select name="sy" id="" class="form-control">
                        <option value="2024-2025">2024-2025</option>
                        <option value="2023-2024">2023-2024</option>
                    </select>
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary" name="btnSaveLoad">Save Changes</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="card-footer bg-primary-subtle">

        </div>
      </div>
    </div>
  </div>
</section>
</main>


<?php
include_once __DIR__ . '/../../components/footer.php';
include_once __DIR__ . '/../../components/footscript.php';
?>

<script>
  $(document).ready(function () {
    $('.editbutton').click(function () {
      var $row = $(this).closest('tr');
      $('#id').val($row.find('.id').text());
      $('#department').val($row.find('.department').text());
      $('#startDate').val($row.find('.startDate').text());
      $('#endDate').val($row.find('.endDate').text());

      $('#verifyModal').modal('show');
    });
  });
</script>


<script>
  const BASE_URL = "<?= BASE_URL ?>";

$(document).ready(function () {
    $(document).on('click', '.deleteLoad', function () {
      var id = $(this).attr('id');
      var name = $(this).data('name') || "this user";

      const msg = new SpeechSynthesisUtterance(`Are you sure you want to delete ${name}?`);
      msg.lang = 'en-US';
      msg.pitch = 1;
      msg.rate = 1;
      speechSynthesis.speak(msg);

      setTimeout(() => {
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: BASE_URL + '/api/api.loading.php',
              type: 'POST',
              data: { deleteload: id },
              success: function (data) {
                if (data.trim() === "success") {
                  Swal.fire({
                    title: 'Success',
                    icon: 'success',
                    text: 'Faculty Load deleted successfully.',
                    showConfirmButton: false,
                    timer: 2000,
                  }).then(() => {
                    window.location.reload();
                  });
                } else {
                  Swal.fire("Error", "Failed to delete Faculty Load", "error");
                }
              }
            });
          } else {
            Swal.fire("Cancelled", "Delete operation cancelled", "info");
          }
        });
      }, 500);
    });
  });


  // AJAX form submission
$('#AddForm').submit(function (e) {
  e.preventDefault();

  var formData = new FormData(this);
  formData.append("btnSaveLoad", true); 

  $.ajax({
    url: BASE_URL + '/api/api.loading.php',
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    dataType: 'json',
    success: function (response) {
      if (response === "added") {
        Swal.fire({
          icon: 'success',
          title: 'Loading Created',
          text: 'New Faculty Loading Successfully Added!',
          timer: 2000,
          showConfirmButton: false
        }).then(() => {
          location.href = 'facultyLoading';
        });
      } else {
        Swal.fire('Error', 'Duplicate Loading', 'error');
      }
    },
    error: function () {
      Swal.fire('Error', 'Server error. Try again.', 'error');
    }
  });
});

// update function

$('#updateForm').submit(function(e){
  e.preventDefault();

  var formData = new FormData(this);
  formData.append("btnUpdateAccess", true); 

  $.ajax({
    url: BASE_URL + '/api/api.evaluationsched.php',
    type: 'POST',
    data: formData,
    contentType: false,       
    processData: false,        
    dataType: 'json',
    success(data) {
      if (data === "updated") {
        Swal.fire({
          icon: 'success',
          title: 'Schedule Updated',
          text: 'Evaluation Schedule successfully updated!',
          timer: 2000,
          showConfirmButton: false
        }).then(() => {
          $('#verifyModal').modal('hide');
          location.reload();
        });
      } else {
        Swal.fire('Error', 'Failed to update', "error");
      }
    },
    error() {
      Swal.fire('Error', 'Server error. Try again.', "error");
    }
  });
});

$('#departmentSelect').change(function () {
  const selectedDept = $(this).val();

  $.ajax({
    url: BASE_URL + '/api/api.loading.php',
    method: 'POST',
    data: { departmentCode: selectedDept },
    dataType: 'json',
success: function (response) {
  // Courses
  const courseSelect = $('select[name="course"]');
  courseSelect.empty().append('<option selected disabled>Please Choose</option>');
  response.courses.forEach(c => {
    courseSelect.append(`<option value="${c.subj_course}">${c.subj_course}</option>`);
  });

  // Year Levels
  const yearSelect = $('select[name="yearLvl"]');
  yearSelect.empty().append('<option selected disabled>Please Choose</option>');
  if (Array.isArray(response.yearLvls)) {
    response.yearLvls.forEach(y => {
      yearSelect.append(`<option value="${y.subj_yearLvl}">${y.subj_yearLvl}</option>`);
    });
  }

  // Subjects
  const subjSelect = $('select[name="subjects"]');
  subjSelect.empty().append('<option selected disabled>Please Choose</option>');
  if (Array.isArray(response.subjects)) {
    response.subjects.forEach(s => {
      subjSelect.append(`<option value="${s.subj_code}">${s.subj_des}</option>`);
    });
  }
},
    error: function () {
      console.error('Error fetching courses');
    }
  });
});

$(document).ready(function () {
  $('#searchBox').on('keyup', function () {
    let query = $(this).val();

    $.ajax({
      url: "<?= BASE_URL ?>/api/api.loadSearch.php",
      type: "POST",
      data: {
        action: "search",
        keyword: query
      },
      success: function (response) {
        $('tbody').html(response); // bale ito yung way para mapalitan yung mga content ng table via search
      }
    });
  });
});


</script>