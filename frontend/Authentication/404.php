<?php
define('BASE_URL', '/feapp'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>404 Not Found</title>
  <link rel="icon" href="<?= BASE_URL ?>/frontend/src/img/logo.png" type="image/icon type">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="<?= BASE_URL ?>/frontend/src/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #fefefe;
      font-family: 'Segoe UI', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
      text-align: center;
      padding: 1rem;
    }

    .container-404 {
      max-width: 600px;
    }

    .warning-icon {
      font-size: 5rem;
      animation: pulse 1.5s infinite;
      color: #ff6f00;
    }

    @keyframes pulse {
      0% { transform: scale(1); opacity: 1; }
      50% { transform: scale(1.2); opacity: 0.6; }
      100% { transform: scale(1); opacity: 1; }
    }

    .heart-emoji {
      font-size: 4rem;
      animation: laugh 2s infinite;
    }

    @keyframes laugh {
      0%, 100% { transform: rotate(0deg); }
      25% { transform: rotate(-15deg); }
      75% { transform: rotate(15deg); }
    }

    .title {
      font-size: 3rem;
      font-weight: bold;
      color: #dc3545;
    }

    .message {
      font-size: 1.2rem;
      color: #555;
    }

    .btn-home {
      margin-top: 20px;
    }
  </style>
</head>
<body>

  <div class="container-404">
    <div class="warning-icon">⚠️</div>
    <div class="title">404 - Page Not Found</div>
    <p class="message">Oops! We couldn't find what you're looking for.</p>
    <div class="heart-emoji">😆❤️</div>
    <a href="<?= BASE_URL ?>/frontend/Authentication/login.php" class="btn btn-danger btn-home">Back to Login</a>
  </div>

</body>
</html>



