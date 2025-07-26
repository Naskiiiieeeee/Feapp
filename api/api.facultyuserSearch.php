<?php
require_once __DIR__ . '/../backend/ViewModels/UserFacultyViewModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'search') {
    $keyword = trim($_POST['keyword']);
    $vm = new UserFacultyViewModel();
    $results = $vm->searchFaculty($keyword);

    if (!empty($results)) {
        $count = 1;
        foreach ($results as $row) {
            $token = base64_encode($row['code'] . '|' . $row['code']);
            echo '<tr>';
            echo "<td>{$count}</td>";
            echo "<td class='id'>" . htmlspecialchars($row['code']) . "</td>";
            echo "<td class='email'>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td class='fullname'>" . htmlspecialchars($row['fullname']) . "</td>";
            echo "<td class='department'>" . htmlspecialchars($row['department']) . "</td>";

            $status = match ($row['status']) {
                1 => '<span class="badge bg-success fs-7 rounded-5"><i class="bi bi-check-circle"></i> Verified</span>',
                2 => '<span class="badge bg-danger fs-7 rounded-5"><i class="bi bi-x-circle"></i> Restricted</span>',
                default => '<span class="badge bg-secondary fs-7 rounded-5"><i class="bi bi-exclamation-circle"></i> Pending</span>',
            };

            echo "<td>{$status}</td>";

            echo '<td>
                    <a href="ViewUnitFaculty?token=' . urlencode($token) . '" title="View">
                        <div class="btn btn-secondary mt-1 px-1 btn-sm text-white"><i class="fa fa-eye mx-2"></i></div>
                    </a>
                    <button type="button" class="btn btn-danger mt-1 px-1 btn-sm deleteuser" id="' . $row['eu_id'] . '" data-name="' . htmlspecialchars($row['fullname']) . '">
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
