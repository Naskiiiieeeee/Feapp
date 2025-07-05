<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>FE-APP</title>
  <link rel="icon" href="./frontend/src/img/logo.png" type="image/icon type">
  <link rel="stylesheet" href="./frontend/src/assets/css/loading.css">
</head>
<body>
  <div class="loader-container" id="loading-screen">
    <div class="loader-box">
      <div class="spinner"></div>
      <p>Loading Faculty Evaluation System...</p>
    </div>
  </div>
    <?php include_once "frontend/Authentication/login.php"; ?>
  <script>
    window.addEventListener('load', () => {
      setTimeout(() => {
        const loader = document.getElementById('loading-screen');
        const content = document.getElementById('app-content');

        loader.classList.add('fade-out');
        setTimeout(() => {
          loader.style.display = 'none';
          content.style.display = 'block';
        }, 500); 
      }, 2000);
    });
  </script>

</body>
</html>
