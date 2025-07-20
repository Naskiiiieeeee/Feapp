<?php
session_start();
require_once __DIR__ . '/../../../backend/ViewModels/EvaluationSummaryViewModel.php';
require_once __DIR__ . '/../../../frontend/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$from = $_GET['from'] ?? '';
$to = $_GET['to'] ?? '';
$email = $_SESSION['email'];
$fullname = $_SESSION['fullname'];
$date = date('Y-m-d');
$vm = new EvaluationSummaryViewModel();
$data = $vm->getIndividualResponse($from, $to, $email);

$logoPath = __DIR__ . '/../../../frontend/src/img/clientlogo.jpg';
$logoBase64 = base64_encode(file_get_contents($logoPath));
$logo = 'data:image/png;base64,' . $logoBase64;

$html = '
    <div style="text-align: center; margin-bottom: 20px;">
        <img src="' . $logo . '" style="width: 100px;">
        <h2 style="margin: 0;">COLM Student Evaluation Form</h2>
    </div>';

$html .= '<table border="1" cellpadding="5" cellspacing="0" width="100%">
<thead>
    <tr>
        <th>#</th>
        <th>Faculty ID</th>
        <th>Faculty Fullname</th>
        <th>Date Submitted</th>
        <th>Department</th>
    </tr>
</thead><tbody>';

foreach ($data as $i => $row) {
    $html .= '<tr>
        <td>' . ($i + 1) . '</td>
        <td>' . htmlspecialchars($row['faculty_token']) . '</td>
        <td>' . htmlspecialchars($row['faculty_name']) . '</td>
        <td>' . date('Y-m-d', strtotime($row['submitted_at'])) . '</td>
        <td>' . htmlspecialchars($row['faculty_dep']) . '</td>
    </tr>';
}

$html .= '</tbody></table>';
$html .= '<br><br><br><br><br>';
$html .= '
    <div style="text-align: center; margin-bottom: 20px;">
        ____________________________________________________________
        <h4 style="margin: 0;">'. $fullname.'</h4>
        <p>Date Generated: '. $date .'</p>
    </div>';

$options = new Options();
$options->set('isHtml5ParserEnabled', true);

$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream('Evaluation_Summary_' . date('Ymd') . '.pdf', ['Attachment' => true]);
exit;
