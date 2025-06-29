<?php 
    if (isset($_GET['status']) && isset($_GET['message'])) {
        $swalStatus = htmlspecialchars($_GET['status']);
        $swalMessage = htmlspecialchars($_GET['message']);
        echo "
        <script>
            window.onload = function() {
                Swal.fire({
                    icon: '$swalStatus',
                    title: '$swalMessage',
                    confirmButtonText: 'OK'
                });
            };
        </script>";
    }
?>