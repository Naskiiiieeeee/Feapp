<?php
require_once __DIR__ . '/../../../backend/ViewModels/EvaluationSummaryViewModel.php';

$from = $_GET['from'] ?? '';
$to = $_GET['to'] ?? '';
$type = $_GET['type'] ?? '';

if (empty($from) || empty($to) || empty($type)) {
    die("Missing required parameters.");
}

$vm = new EvaluationSummaryViewModel();
$results = $vm->getEvaluationSummary($from, $to);

if ($type === 'excel') {
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=evaluation_summary_" . date('YmdHis') . ".xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    echo "<table border='1'>";
    echo "<tr>
            <th>#</th>
            <th>Faculty Name</th>
            <th>Email</th>
            <th>Department</th>
            <th>Academic</th>
            <th>Core Values</th>
            <th>Overall Evaluation</th>
            <th>Overall Rating</th>
            <th>Recommendation</th>
            <th>Date</th>
          </tr>";

    $i = 1;
    foreach ($results as $row) {
        $recommendations = explode(',', $row['ai_recommendations']);
        $recList = implode('<br>', array_map(fn($rec) => '• ' . htmlspecialchars(trim($rec)), $recommendations));

        echo "<tr>
                <td>{$i}</td>
                <td>" . htmlspecialchars($row['faculty_name']) . "</td>
                <td>" . htmlspecialchars($row['faculty_email']) . "</td>
                <td>" . htmlspecialchars($row['faculty_department']) . "</td>
                <td>{$row['academic_rating']}</td>
                <td>{$row['core_values_rating']}</td>
                <td>{$row['overall_evaluation']}</td>
                <td>{$row['overall_rating']}</td>
                <td>{$recList}</td>
                <td>" . date('Y-m-d', strtotime($row['created_at'])) . "</td>
              </tr>";
        $i++;
    }

    echo "</table>";
    exit;
}

if ($type === 'print') {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Evaluation Summary Report</title>
        <style>
            body { font-family: Arial, sans-serif; }
            table { border-collapse: collapse; width: 100%; font-size: 12px; }
            th, td { border: 1px solid #333; padding: 6px; text-align: left; }
            h2 { text-align: center; }
            @media print {
                .noprint { display: none; }
            }
        </style>
    </head>
    <body>
        
        <div style="text-align: center; margin-bottom: 10px;">
            <img src="../../src/img/clientlogo.jpg" alt="Logo" style="max-height: 80px;">
        </div>

        <h2>Evaluation Summary Report</h2>
        <p>From: <?= htmlspecialchars($from) ?> &nbsp;&nbsp; To: <?= htmlspecialchars($to) ?></p>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Faculty Name</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Academic</th>
                    <th>Core Values</th>
                    <th>Overall Evaluation</th>
                    <th>Overall Rating</th>
                    <th>Recommendation</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($results)): ?>
                    <tr><td colspan="10" style="text-align:center;">No records found.</td></tr>
                <?php else: ?>
                    <?php foreach ($results as $i => $row): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= htmlspecialchars($row['faculty_name']) ?></td>
                            <td><?= htmlspecialchars($row['faculty_email']) ?></td>
                            <td><?= htmlspecialchars($row['faculty_department']) ?></td>
                            <td><?= $row['academic_rating'] ?></td>
                            <td><?= $row['core_values_rating'] ?></td>
                            <td><?= $row['overall_evaluation'] ?></td>
                            <td><?= $row['overall_rating'] ?></td>
                            <td>
                                <ul style="padding-left: 16px; margin: 0;">
                                    <?php foreach (explode(',', $row['ai_recommendations']) as $rec): ?>
                                        <li><?= htmlspecialchars(trim($rec)) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </td>
                            <td><?= date('Y-m-d', strtotime($row['created_at'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="noprint" style="margin-top: 20px; text-align:center;">
            <button onclick="window.print()">🖨️ Print / Save as PDF</button>
            <button onclick="window.location.href='printReports.php'" class="btn btn-secondary">
                ❌ Back
            </button>
        </div>

        <script>
            window.addEventListener('load', function() {
                setTimeout(() => window.print(), 500);
            });
        </script>
    </body>
    </html>
    <?php
    exit;
}

echo "Invalid export type.";
