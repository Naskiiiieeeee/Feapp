<?php
session_start();
require_once __DIR__ . '/../../../backend/ViewModels/EvaluationSummaryViewModel.php';

$from = $_GET['from'] ?? '';
$to = $_GET['to'] ?? '';
$type = $_GET['type'] ?? '';
$email = $_SESSION['email'];
$fullname = $_SESSION['fullname'];

if (empty($from) || empty($to) || empty($type)) {
    die("Missing required parameters.");
}

$vm = new EvaluationSummaryViewModel();
$results = $vm->getIndividualResponse($from, $to, $email);

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
                    <th>Faculty ID</th>
                    <th>Faculty Fullname</th>
                    <th>Date Submitted</th>
                    <th>Department</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($results)): ?>
                    <tr><td colspan="10" style="text-align:center;">No records found.</td></tr>
                <?php else: ?>
                    <?php foreach ($results as $i => $row): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= htmlspecialchars($row['faculty_token']) ?></td>
                            <td><?= htmlspecialchars($row['faculty_name']) ?></td>
                            <td><?= date('Y-m-d', strtotime($row['submitted_at'])) ?></td>
                            <td><?= htmlspecialchars($row['faculty_dep']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <div style="text-align: center; margin-bottom: 10px;">
            <p>__________________________________</p>
            <h5>Sign by: <strong><?= htmlspecialchars($fullname);?></strong></h5>
        </div>

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
