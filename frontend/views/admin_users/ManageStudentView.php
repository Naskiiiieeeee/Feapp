<?php
require_once __DIR__ . '/../../../backend/ViewModels/UserStudentViewModel.php';
include_once __DIR__ . '/../../components/header.php';
include_once __DIR__ . '/../../components/navigation.php';
include_once __DIR__ . '/../../components/sidebar.php';

// Pagination setup
$vm = new UserStudentViewModel();
$page_no = isset($_GET['page_no']) && $_GET['page_no'] !== "" ? (int)$_GET['page_no'] : 1;
$limit = 10;
$count = ($page_no - 1) * $limit + 1;

// Get paginated data and total pages
$studentData = $vm->getStudentPaginated($page_no, $limit);
$total_pages = $vm->getTotalPages($limit);
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Manage Student Information</h1>
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
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Recent Records</h5>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Student No.</th>
                    <th>Registered Email</th>
                    <th>Fullname</th>
                    <th>Section</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php if (!empty($studentData)): ?>
                  <?php foreach ($studentData as $row): ?>
                    <tr>
                      <td><?= $count++; ?></td>
                      <td class="id"><?= htmlspecialchars($row['student_no']); ?></td>
                      <td class="email"><?= htmlspecialchars($row['student_email']); ?></td>
                      <td class="fullname"><?= htmlspecialchars($row['student_name']); ?></td>
                      <td class="department"><?= htmlspecialchars($row['student_section']); ?></td>
                      <td>
                        <?php
                          switch ($row['status']) {
                            case 1:
                              echo '<span class="badge bg-success fs-6"><i class="bi bi-check-circle"></i> Verified</span>';
                              break;
                            case 2:
                              echo '<span class="badge bg-danger fs-6"><i class="bi bi-x-circle"></i> Restricted</span>';
                              break;
                            default:
                              echo '<span class="badge bg-secondary fs-6"><i class="bi bi-exclamation-circle"></i> Pending</span>';
                              break;
                          }
                        ?>
                      </td>
                      <td>
                        <button type="button"
                                class="btn btn-danger mt-1 px-1 btn-sm deleteuser"
                                id="<?= $row['si_id']; ?>"
                                data-name="<?= htmlspecialchars($row['student_name']); ?>"
                                title="Delete">
                          <i class="fas fa-trash mx-2" aria-hidden="true"></i>
                        </button>
                        <button type="button"
                                class="btn btn-primary mt-1 px-1 btn-sm editbutton"
                                data-toggle="modal"
                                data-target="#verifyModal">
                          <i class="bi bi-pencil-square mx-2"></i>
                        </button>
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
  </section>
</main>

<!-- Edit Modal -->
<div class="modal fade" id="verifyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="updateForm" method="post">
      <div class="modal-content">
        <div class="modal-header bg-secondary">
          <h5 class="modal-title text-white fw-bold" id="exampleModalLabel">Update User Access</h5>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="id">
          <div class="form-group px-2 mt-1">
            <label class="fw-bold">User Email</label>
            <input type="email" id="email" class="form-control mt-2" readonly/>
          </div>
          <div class="form-group px-2 mt-1">
            <label class="fw-bold">Fullname</label>
            <input type="text" id="fullname" class="form-control mt-2" readonly/>
          </div>
          <div class="form-group px-2 mt-1">
            <label class="fw-bold">Section</label>
            <input type="text" name="department" id="department" class="form-control mt-2" readonly/>
          </div>
          <div class="form-group px-2 mt-1">
            <label class="fw-bold mt-2">Status</label>
            <select name="status" class="form-control">
              <option selected disabled>Please Select</option>
              <option value="1">Activate</option>
              <option value="2">Restrict</option>
            </select>
          </div>
        </div>
        <div class="modal-footer bg-secondary">
          <button type="submit" name="btnUpdateAccess" class="btn btn-light text-dark fw-bold">
            <i class="bi bi-upload"></i> Save changes
          </button>
        </div>
      </div>
    </form>
  </div>
</div>

<?php
include_once __DIR__ . '/../../components/footer.php';
include_once __DIR__ . '/../../components/footscript.php';
?>

<!-- Edit Button Logic -->
<script>
  $(document).ready(function () {
    $('.editbutton').click(function () {
      var $row = $(this).closest('tr');
      $('#id').val($row.find('.id').text());
      $('#email').val($row.find('.email').text());
      $('#fullname').val($row.find('.fullname').text());
      $('#department').val($row.find('.department').text());

      $('#verifyModal').modal('show');
    });
  });
</script>

<!-- Delete Button Logic -->
<script>
  const BASE_URL = "<?= BASE_URL ?>";
  $(document).ready(function () {
    $(document).on('click', '.deleteuser', function () {
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
              url: BASE_URL + '/api/api.studentuser.php',
              type: 'POST',
              data: { deleteUser: id },
              success: function (data) {
                if (data.trim() === "success") {
                  Swal.fire({
                    title: 'Success',
                    icon: 'success',
                    text: 'User information deleted successfully.',
                    showConfirmButton: false,
                    timer: 2000,
                  }).then(() => {
                    window.location.reload();
                  });
                } else {
                  Swal.fire("Error", "Failed to delete user", "error");
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

$('#updateForm').submit(function(e){
  e.preventDefault();

  var formData = new FormData(this);
  formData.append("btnUpdateAccess", true); 

  $.ajax({
    url: BASE_URL + '/api/api.studentuser.php',
    type: 'POST',
    data: formData,
    contentType: false,       
    processData: false,        
    dataType: 'json',
    success(data) {
      if (data === "updated") {
        Swal.fire({
          icon: 'success',
          title: 'Student Updated',
          text: 'Student information successfully updated!',
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

</script>