<?php
require_once __DIR__ . '/../backend/ViewModels/EvaluationViewModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'search') {
    $keyword = trim($_POST['keyword']);
    $vm = new EvaluationViewModel();
    $results = $vm->searchFacultyEvaluation($keyword);

    if (!empty($results)) {
        $count = 1;
        foreach ($results as $row) {
            $token = base64_encode($row['faculty_id'] . '|' . $row['faculty_id']);
            ?>
            <tr>
                <td><?= $count ?></td>
                <td class="facultyID"><?= htmlspecialchars($row['faculty_id']) ?></td>
                <td class="facultyName"><?= htmlspecialchars($row['faculty_name']) ?></td>
                <td class="facultyDep"><?= htmlspecialchars($row['faculty_department']) ?></td>
                <td class="dateCreate"><?= htmlspecialchars($row['created_at']) ?></td>
                <td>
                    <a href="ViewEvaluationUnitHistory?token=<?= urlencode($token); ?>" title="View">
                        <div class="btn btn-secondary mt-1 px-1 btn-sm text-white">
                            <i class="fa fa-eye mx-2"></i>
                        </div>
                    </a>
                    <button type="button"
                            class="btn btn-danger mt-1 px-1 btn-sm deleteuser"
                            id="<?= htmlspecialchars($row['id']) ?>"
                            data-name="<?= htmlspecialchars($row['faculty_name']) ?>"
                            title="Delete">
                        <i class="fas fa-trash mx-2" aria-hidden="true"></i>
                    </button>
                </td>
            </tr>
            <?php
            $count++;
        }
    } else {
        echo '<tr class="text-center"><td colspan="9">No matching records found.</td></tr>';
    }
    exit;
}
?>
