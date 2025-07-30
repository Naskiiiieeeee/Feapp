<?php
require_once __DIR__ . '/../backend/ViewModels/LoadingViewModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'search') {
    $keyword = trim($_POST['keyword']);
    $vm = new LoadingViewModel();
    $results = $vm->searchLoad($keyword);

    if (!empty($results)) {
        $count = 1;
        foreach ($results as $row) {
            echo '<tr>';
            echo "<td>{$count}</td>";
            echo "<td class='id'>" . htmlspecialchars($row['fl_code']) . "</td>";
            echo "<td class='department'>" . htmlspecialchars($row['department']) . "</td>";
            echo "<td class='course'>" . htmlspecialchars($row['course']) . "</td>";
            echo "<td class='year_lvl'>" . htmlspecialchars($row['year_lvl']) . "</td>";
            echo "<td class='subjects'>" . htmlspecialchars($row['subjects']) . "</td>";
            echo "<td class='section'>" . htmlspecialchars($row['section']) . "</td>";
            echo "<td class='faculty_email'>" . htmlspecialchars($row['faculty_email']) . "</td>";

            echo '<td>
                    <button type="button" class="btn btn-danger mt-1 px-1 btn-sm deleteuser" id="' . $row['id'] . '" data-name="' . htmlspecialchars($row['faculty_email']) . '">
                        <i class="fas fa-trash mx-2"></i>
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
