<?php 
include_once __DIR__ . '/../components/header.php';
include_once __DIR__ . '/../components/navigation.php';
include_once __DIR__ . '/../components/sidebar.php';
?>
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Manage Users</h1>
      <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="manageuser">Manage Users</a></li>
            <li class="breadcrumb-item active"><a href="adminmanageAdmins">Administrator Accounts</a></li>
            <li class="breadcrumb-item active"><a href="adduser">Add New Admin User</a></li>
        </ol>
      </nav>
    </div>
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Recent Records</h5>
              <!-- Table with stripped rows -->
              <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">User Code</th>
                    <th scope="col">Registered Email</th>
                    <th scope="col">Fullname</th>
                    <th scope="col">Department</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    if(isset($_GET['page_no']) && $_GET['page_no'] !== ""){
                        $page_no = $_GET['page_no'];
                    } else {
                        $page_no = 1;
                    }
                    $total_records_per_page = 4;
                    $offset = ($page_no - 1) * $total_records_per_page;
                    $count = $offset + 1;
                    $role = "Admin";
                    $search = mysqli_query($con, "SELECT COUNT(*) as total_records FROM `endusers` WHERE `role`= '$role'  ORDER BY `eu_id` DESC") or die(mysqli_errno($con));
                    $records = mysqli_fetch_array($search);
                    $total_records = $records['total_records'];
                    $total_no_of_pages = ceil($total_records / $total_records_per_page);
                    $select_data = mysqli_query($con, "SELECT * FROM `endusers` WHERE `role`= '$role'  ORDER BY `eu_id` DESC LIMIT $offset, $total_records_per_page");
                    if(mysqli_num_rows($select_data) > 0) {
                        while($row = mysqli_fetch_array($select_data)) {
                              $token = base64_encode($row['code'] . '|'.$row['code']);
                    ?>
                  <tr>
                    <td><?= $count++ ;?></td>
                    <td class="id"><?= $row['code']; ?></td>
                    <td class="email"><?= $row['email']; ?></td>
                    <td class="fullname"><?= $row['fullname']; ?></td>
                    <td class="department"><?= $row['department']; ?></td>
                    <td>
                      <?php
                        if($row['status'] == 1){
                          echo '<span class="badge bg-success fs-6"><i class="bi bi-check-circle"></i> Verified</span>';
                        }elseif($row['status'] == 2){
                          echo '<span class="badge bg-danger fs-6"><i class="bi bi-x-circle"></i> Restricted</span>';
                        }else{
                          echo '<span class="badge bg-secondary fs-6"><i class="bi bi-exclamation-circle"></i> Pending</span>';
                        }
                      ?>
                    </td>
                    <td>
                      <a href="adminviewunitUser?token=<?php echo urlencode($token); ?>" title="View"><div class="btn btn-secondary mt-1 px-1 btn-sm text-white"><i class="fa fa-eye  mx-2"></i></div></a>
                      <!-- <button type="button" class="btn btn-danger mt-1 px-1 btn-sm deleteuser" id="<?= $row['id'] ?>" title="Delete"><i class="fas fa-trash mx-2" aria-hidden="true"></i> </button> -->
                      <button type="button" 
                              class="btn btn-danger mt-1 px-1 btn-sm deleteuser" 
                              id="<?= $row['eu_id'] ?>" 
                              data-name="<?= $row['fullname'] ?>" 
                              title="Delete">
                        <i class="fas fa-trash mx-2" aria-hidden="true"></i>
                      </button>
                      <button type="button" class="btn btn-primary mt-1 px-1 btn-sm editbutton" data-toggle="modal" data-target="#verifyModal" ><i class="bi bi-pencil-square mx-2"></i> </button>
                    </td>
                  </tr>
                  <?php 
                        }
                    }
                    else {
                        echo "<tr class='text-center'><td colspan='8'>No Registered Data!</td></tr>";
                    }
                    ?>
                </tbody>
              </table>
            </div>
            </div>
                <div class="card-footer bg-bg-info-subtle d-flex align-items-center justify-content-between">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center fw-bold">
                                <li class="page-item <?php if($page_no <= 1) echo 'disabled'; ?>">
                                    <a class="page-link" href="?page_no=1">First</a>
                                </li>
                                <li class="page-item <?php if($page_no <= 1) echo 'disabled'; ?>">
                                    <a class="page-link" href="<?php if($page_no <= 1){ echo '#'; } else { echo "?page_no=".($page_no - 1); } ?>">Prev</a>
                                </li>
                                <li class="page-item <?php if($page_no >= $total_no_of_pages) echo 'disabled'; ?>">
                                    <a class="page-link" href="<?php if($page_no >= $total_no_of_pages){ echo '#'; } else { echo "?page_no=".($page_no + 1); } ?>">Next</a>
                                </li>
                                <li class="page-item <?php if($page_no >= $total_no_of_pages) echo 'disabled'; ?>">
                                    <a class="page-link" href="?page_no=<?php echo $total_no_of_pages; ?>">Last</a>
                                </li>
                            </ul>
                        </nav>
                </div>
          </div>
        </div>
      </div>
    </section>
</main>

  <!-- Modal -->
  <div class="modal fade" id="verifyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form action="action.php" method="post">
        <div class="modal-content">
          <div class="modal-header bg-secondary">
            <h5 class="modal-title text-white fw-bold" id="exampleModalLabel">Update User Access</h5>
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group px-2 mt-1">
              <label for="" class="fw-bold">User Code</label>
              <input type="text" id="id" name="id" class="form-control mt-2" readonly/>
            </div>
            <div class="form-group px-2 mt-1">
              <label for="" class="fw-bold">User Email</label>
              <input type="email" id="email" class="form-control mt-2" readonly/>
            </div>
            <div class="form-group px-2 mt-1">
              <label for="" class="fw-bold">Fullname</label>
              <input type="text" id="fullname" class="form-control mt-2" readonly/>
            </div>
            <div class="form-group px-2 mt-1">
              <label for="" class="fw-bold">Phone Number</label>
              <input type="number" name="phone" id="phone" class="form-control mt-2" readonly/>
            </div>
            <div class="form-group px-2 mt-1">
              <label for="" class="fw-bold mt-2">Status</label>
              <select name="status" id="" class="form-control">
                <option selected disabled>Please Select</option>
                <option value="1">Activate</option>
                <option value="2">Restrict</option>
              </select>
            </div>
          </div>
          <div class="modal-footer bg-secondary">
            <button type="submit" name="btnUpdateAccess" class="btn btn-light text-dark fw-bold"><i class="bi bi-upload"></i> Save changes</button>
          </div>
        </div>
      </form>
    </div>
  </div>


<?php 
include_once __DIR__ . '/../components/footer.php';
include_once __DIR__ . '/../components/footscript.php';
?>

      <script type="text/javascript">
        $(document).ready(function() {
            $('.editbutton').click(function() {
                var $row = $(this).closest('tr');
                var id = $row.find('.id').text();
                var email = $row.find('.email').text();
                var fullname = $row.find('.fullname').text();
                var phone = $row.find('.phone').text();

                $('#id').val(id);
                $('#email').val(email);
                $('#fullname').val(fullname);
                $('#phone').val(phone);

                $('#verifyModal').modal('show');
            });
        });
    </script>

    <!-- <script>
      $(document).ready(function(){
        $(document).on('click','.deleteuser',function(){
            var id = $(this).attr('id');

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
                      url: 'action.php',
                      type: 'POST',
                      data: {deleteUser:id},
                      success: function(data){
                          if (data.trim() === 'success') {
                              Swal.fire({
                                      title: 'Success',
                                      icon: 'success',
                                      text: ' Users Information Deleted Succesfully',
                                      showConfirmButton: false,
                                      timer: 2000,
                                  }).then(()=>{
                                      window.location.reload();
                                  })
                          } else {
                              Swal.fire("Error", "Failed to delete user", "error");
                          }
                      }
                  })
                }else {
                  Swal.fire("Error", "Failed to delete user", "error");
              }
            })
        })
      })
    </script> -->


    <script>
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
              url: 'action.php',
              type: 'POST',
              data: { deleteUser: id },
              success: function (data) {
                if (data.trim() === 'success') {
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
</script>