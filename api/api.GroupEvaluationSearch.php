<?php
require_once __DIR__ . '/../backend/ViewModels/EvaluationViewModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'search') {
    $keyword = trim($_POST['keyword']);
    $vm = new EvaluationViewModel();
    $results = $vm->searchByGroupEvaluation($keyword);

    if (!empty($results)) {
        $count = 1;
        foreach ($results as $row) {
            $token = base64_encode($row['faculty_token'] . '|' . $row['faculty_token']);
            ?>
            <tr>
                <td><?= $count ?></td>
                <td class="facultyID"><?= htmlspecialchars($row['faculty_token']) ?></td>
                <td class="fullname"><?= htmlspecialchars($row['faculty_name']) ?></td>
                <td class="department"><?= htmlspecialchars($row['faculty_dep']) ?></td>
                <td>
                    <a href="ViewUnitEval?token=<?= urlencode($token); ?>" title="View">
                        <div class="btn btn-secondary mt-1 px-1 btn-sm text-white">
                            <i class="fa fa-eye mx-2"></i>
                        </div>
                    </a>
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
