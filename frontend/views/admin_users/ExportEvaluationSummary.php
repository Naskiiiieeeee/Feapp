<?php
require_once __DIR__ . '/../../../backend/ViewModels/EvaluationSummaryViewModel.php';
require_once __DIR__ . '/../../../frontend/vendor/autoload.php';

// Use statements at the top
use Dompdf\Dompdf;
use Dompdf\Options;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Parameters
$type = $_GET['type'] ?? '';
$from = $_GET['from'] ?? '';
$to = $_GET['to'] ?? '';

// Get data from ViewModel
$vm = new EvaluationSummaryViewModel();
$data = $vm->getEvaluationSummary($from, $to);

if ($type === 'pdf') {
    // Prepare HTML
    $html = '<h3 style="text-align:center;">Faculty Evaluation Summary</h3>';
    $html .= '<table border="1" cellpadding="5" cellspacing="0" width="100%">';
    $html .= '<thead>
                <tr>
                  <th>#</th>
                  <th>Faculty Name</th>
                  <th>Email</th>
                  <th>Department</th>
                  <th>Academic</th>
                  <th>Core Values</th>
                  <th>Overall</th>
                  <th>Recommendation</th>
                  <th>Date</th>
                </tr>
              </thead><tbody>';

    foreach ($data as $i => $row) {
        $html .= '<tr>
                    <td>' . ($i + 1) . '</td>
                    <td>' . htmlspecialchars($row['faculty_name']) . '</td>
                    <td>' . htmlspecialchars($row['faculty_email']) . '</td>
                    <td>' . htmlspecialchars($row['faculty_department']) . '</td>
                    <td>' . $row['academic_rating'] . '</td>
                    <td>' . $row['core_values_rating'] . '</td>
                    <td>' . $row['overall_rating'] . '</td>
                    <td>' . htmlspecialchars($row['ai_recommendations']) . '</td>
                    <td>' . date('Y-m-d', strtotime($row['created_at'])) . '</td>
                  </tr>';
    }

    $html .= '</tbody></table>';

    // Generate PDF
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);

    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    $dompdf->stream('Evaluation_Summary_' . date('Ymd') . '.pdf', ['Attachment' => true]);
    exit;

} elseif ($type === 'excel') {
    // Generate Excel
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->fromArray([
        '#', 'Faculty Name', 'Email', 'Department',
        'Academic', 'Core Values', 'Overall',
        'Recommendation', 'Date'
    ], NULL, 'A1');

    $rowNum = 2;
    foreach ($data as $i => $row) {
        $sheet->fromArray([
            $i + 1,
            $row['faculty_name'],
            $row['faculty_email'],
            $row['faculty_department'],
            $row['academic_rating'],
            $row['core_values_rating'],
            $row['overall_rating'],
            $row['ai_recommendations'],
            date('Y-m-d', strtotime($row['created_at']))
        ], NULL, 'A' . $rowNum);
        $rowNum++;
    }

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Evaluation_Summary_' . date('Ymd') . '.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
} else {
    echo "Invalid export type.";
    exit;
}
