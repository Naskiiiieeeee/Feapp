<?php
require_once __DIR__ . '/../backend/ViewModels/EvaluationViewModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'search') {
    $keyword = trim($_POST['keyword']);
    $vm = new EvaluationViewModel();
    $results = $vm->searchCertificate($keyword);

    if (!empty($results)) {
        $count = 1;
        foreach ($results as $row) {
            $token = base64_encode($row['id'] . '|' . $row['id']);
            ?>
            <tr>
                <td><?= $count ?></td>
                <td class="seminarTitle"><?= htmlspecialchars($row['seminar_title']) ?></td>
                <td class="seminarName"><?= htmlspecialchars($row['seminar_name']) ?></td>
                <td class="facultyName"><?= htmlspecialchars($row['faculty_name']) ?></td>
                <td class="dateUploaded"><?= htmlspecialchars($row['uploaded_at']) ?></td>
                <td>
                    <a href="ViewUnitCertificate?token=<?= urlencode($token); ?>" title="View">
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
        echo '<tr class="text-center"><td colspan="8">No matching records found.</td></tr>';
    }
    exit;
}
?>
