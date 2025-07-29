<?php
require_once __DIR__ . '/../../../backend/ViewModels/SectionViewModel.php';
include_once __DIR__ . '/../../components/header.php';
include_once __DIR__ . '/../../components/navigation.php';
include_once __DIR__ . '/../../components/sidebar.php';

// Pagination setup
$vm = new SectionViewModel();
$page_no = isset($_GET['page_no']) && $_GET['page_no'] !== "" ? (int)$_GET['page_no'] : 1;
$limit = 4;
$count = ($page_no - 1) * $limit + 1;

// Get paginated data and total pages
$sectionData = $vm->getsectionPaginated($page_no, $limit);
$total_pages = $vm->getTotalPages($limit);
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Manage Section</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="ManageDepartment">Manage Department</a></li>
        <li class="breadcrumb-item"><a href="ManageCourses">Manage Courses</a></li>
        <li class="breadcrumb-item"><a href="ManageYearLevel">Manage Year Level</a></li>
        <li class="breadcrumb-item"><a href="ManageSection">Manage Section</a></li>
      </ol>
    </nav>
  </div>

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <button type="button" class="btn btn-primary float-end my-2" data-toggle="modal" data-target="#addModal">
                <i class="bi bi-plus-circle-dotted"></i> Create New
            </button>
            <h5 class="card-title">Recent Records</h5>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Section</th>
                    <th>Date Created</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php if (!empty($sectionData)): ?>
                  <?php foreach ($sectionData as $row): ?>
                    <tr>
                      <td><?= $count++; ?></td>
                      <td class="id"><?= htmlspecialchars($row['sec_code']); ?></td>
                      <td class="description"><?= htmlspecialchars($row['section_name']); ?></td>
                      <td class=""><?= htmlspecialchars($row['created_date']); ?></td>
                      <td>
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
                      </td>
                      <td>
                        <button type="button"
                                class="btn btn-danger mt-1 px-1 btn-sm deleteSection"
                                id="<?= $row['id']; ?>"
                                data-name="<?= htmlspecialchars($row['section_name']); ?>"
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

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form id="AddForm">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-secondary">
                    <h5 class="modal-title text-white" id="exampleModalLabel"><i class="bi bi-plus-circle-dotted"></i> Section Details</h5>
                </div>
                <div class="modal-body">
                        <div class="form-group">
                            <label for="">Section Name</label>
                            <input type="text" name="sectionName" id="" class="form-control" placeholder="1A" required>
                        </div>
                        <div class="form-group">
                            <label for="">Date</label>
                            <input type="date" name="dateCreated" id="" class="form-control" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="btnSaveSection" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="verifyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="updateForm">
      <div class="modal-content">
        <div class="modal-header bg-secondary">
          <h5 class="modal-title text-white fw-bold" id="exampleModalLabel"><i class="bi bi-pencil-square"></i> Update Section Status</h5>
        </div>
        <div class="modal-body">
          <div class="form-group px-2 mt-1">
            <label class="fw-bold">section Code</label>
            <input type="text" name="id" id="id" class="form-control mt-2" readonly/>
          </div>
          <div class="form-group px-2 mt-1">
            <label class="fw-bold">Section Identity</label>
            <input type="text" name="description" id="description" class="form-control mt-2" required/>
          </div>
          <div class="form-group px-2 mt-1">
            <label for="fw-bold">Status</label>
            <select name="status" id="" class="form-control" required>
                <option disabled>Please Choose</option>
                <option value="1">Activate</option>
                <option value="2">Restrict</option>
            </select>
          </div>
        </div>
        <div class="modal-footer bg-secondary">
          <button type="submit" name="btnUpdateSection" class="btn btn-light text-dark fw-bold">
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
      $('#description').val($row.find('.description').text());

      $('#verifyModal').modal('show');
    });
  });
</script>

<!-- Delete Button Logic -->
<script>
  const BASE_URL = "<?= BASE_URL ?>";
  $(document).ready(function () {
    $(document).on('click', '.deleteSection', function () {
      var id = $(this).attr('id');
      var name = $(this).data('name') || "this course";

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
              url: BASE_URL + '/api/api.sections.php',
              type: 'POST',
              data: { deleteSection: id },
              success: function (data) {
                if (data.trim() === "success") {
                  Swal.fire({
                    title: 'Success',
                    icon: 'success',
                    text: 'Year Level information deleted successfully.',
                    showConfirmButton: false,
                    timer: 2000,
                  }).then(() => {
                    window.location.reload();
                  });
                } else {
                  Swal.fire("Error", "Failed to delete Year Level", "error");
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
  formData.append("btnUpdateSection", true); 

  $.ajax({
    url: BASE_URL + '/api/api.sections.php',
    type: 'POST',
    data: formData,
    contentType: false,       
    processData: false,        
    dataType: 'json',
    success(data) {
      if (data === "updated") {
        Swal.fire({
          icon: 'success',
          title: 'Section Updated',
          text: 'Section information successfully updated!',
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


$('#AddForm').submit(function(e){
  e.preventDefault();

  var formData = new FormData(this);
  formData.append("btnSaveSection", true); 

  $.ajax({
    url: BASE_URL + '/api/api.sections.php',
    type: 'POST',
    data: formData,
    contentType: false,       
    processData: false,        
    dataType: 'json',
    success(data) {
      if (data === "added") {
        Swal.fire({
          icon: 'success',
          title: 'Section Added',
          text: 'New Section Information Successfully Added!',
          timer: 2000,
          showConfirmButton: false
        }).then(() => {
          $('#addModal').modal('hide');
          location.reload();
        });
      } else {
        Swal.fire('Error', 'Year Section Already Exist', "error");
      }
    },
    error() {
      Swal.fire('Error', 'Server error. Try again.', "error");
    }
  });
});
</script>