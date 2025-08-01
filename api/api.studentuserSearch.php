<?php
require_once __DIR__ . '/../backend/ViewModels/UserStudentViewModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'search') {
    $keyword = trim($_POST['keyword']);
    $vm = new UserStudentViewModel();
    $results = $vm->searchStudents($keyword);

    if (!empty($results)) {
        $count = 1;
        foreach ($results as $row) {
            echo '<tr>';
            echo "<td>{$count}</td>";
            echo "<td class='id'>" . htmlspecialchars($row['student_no']) . "</td>";
            echo "<td class='email'>" . htmlspecialchars($row['student_email']) . "</td>";
            echo "<td class='fullname'>" . htmlspecialchars($row['student_name']) . "</td>";
            echo "<td class='section'>" . htmlspecialchars($row['student_section']) . "</td>";
            echo "<td class='course'>" . htmlspecialchars($row['student_course']) . "</td>";
            echo "<td class='department'>" . htmlspecialchars($row['student_dep']) . "</td>";

            $status = match ($row['status']) {
                1 => '<span class="badge bg-success fs-7 rounded-5"><i class="bi bi-check-circle"></i> Verified</span>',
                2 => '<span class="badge bg-danger fs-7 rounded-5"><i class="bi bi-x-circle"></i> Restricted</span>',
                default => '<span class="badge bg-secondary fs-7 rounded-5"><i class="bi bi-exclamation-circle"></i> Pending</span>',
            };

            echo "<td>{$status}</td>";

            $evaluationAccess = match ($row['evaluationAccess']) {
                1 => '<span class="badge bg-success fs-7 rounded-5"><i class="bi bi-check-circle"></i> Active</span>',
                2 => '<span class="badge bg-danger fs-7 rounded-5"><i class="bi bi-x-circle"></i> Restricted</span>',
                default => '<span class="badge bg-secondary fs-7 rounded-5"><i class="bi bi-exclamation-circle"></i> Pending</span>',
            };

            echo "<td>{$evaluationAccess}</td>";

            //end

                          $status = $row['is_irregular'];
                          $badgeText = $status ? 'Irregular' : 'Regular';
                          $badgeClass = $status ? 'bg-danger' : 'bg-success';
                          $icon = $status ? 'exclamation-circle' : 'check-circle';

                          echo "<td>
                          <span class='badge $badgeClass fs-7 rounded-5 toggle-status' style='cursor:pointer'
                                  data-id='{$row['si_id']}' data-status='$status'>
                                  <i class='bi bi-$icon'></i> $badgeText
                                </span>
                            </td>";


            echo '<td>
                    <button type="button" class="btn btn-danger mt-1 px-1 btn-sm deleteuser" id="' . $row['si_id'] . '" data-name="' . htmlspecialchars($row['student_name']) . '">
                        <i class="fas fa-trash mx-2"></i>
                    </button>
                    <button type="button" class="btn btn-primary mt-1 px-1 btn-sm editbutton" data-toggle="modal" data-target="#verifyModal">
                        <i class="bi bi-pencil-square mx-2"></i>
                    </button>
                  </td>';
            echo '</tr>';
            $count++;
        }
    } else {
        echo '<tr class="text-center"><td colspan="9">No matching records found.</td></tr>';
    }
    exit;
}
