<?php
define('BASE_URL', '/feapp');
require_once __DIR__ . '/../../backend/ViewModels/UserPasswordViewModel.php';
$vm = new UserPasswordViewModel();

if (!isset($_GET["code"])) {
    exit("Page in the link does not exist!");
}
$codes = $_GET["code"];
$userData = null;

$userData = $vm->getUserCredentials($codes);

foreach($userData as $row){
    $username = $row['username'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>FE-APP</title>
  <link rel="icon" href="<?= BASE_URL ?>/frontend/src/img/logo.png" type="image/icon type">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>/frontend/src/assets/css/login.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body onload="initClock(); generateCaptcha();">
  <div class="container">
    <input type="checkbox" id="flip">
    <div class="cover">
      <div class="front">
        <img class="frontImg" src="<?= BASE_URL ?>/frontend/src/img/logo.png" alt="">
        <div class="text">
          <span class="text-1">Every new friend is a <br> new adventure</span>
          <span class="text-2">Let's get connected</span>
        </div>
      </div>
      <div class="back">
        <img class="backImg" src="<?= BASE_URL ?>/frontend/src/img/logo.png" alt="">
        <div class="text">
          <span class="text-3">Complete miles of journey <br> with one step</span>
          <span class="text-4">Let's get started</span>
        </div>
      </div>
    </div>
    <div class="forms">
      <div class="form-content">
        <div class="login-form">
          <div class="datetime">
            <div class="date">
              <span id="dayname"> DAY </span>,
              <span id="months"> Month </span>,
              <span id="daynum"> 00 </span>,
              <span id="year"> Year </span>
            </div>
            <div class="time">
              <span id="hour"> 00 </span>:
              <span id="minutes"> 00 </span>:
              <span id="seconds"> 00 </span>:
              <span id="period"> AM </span>
            </div>
          </div>
          <div class="title">Reset Password</div>
          <form id="resetPasswordForm">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-key"></i>
                <input type="password" name="password" id="password" placeholder="Password" title="At least 8 characters, including numbers and symbols" required>
                <input type="hidden" name="code" value="<?= $codes ?? '' ?>">
                <input type="hidden" name="email" value="<?= $username ?? '' ?>">
              </div>
              <div class="input-box">
                <i class="fas fa-key"></i>
                <input type="password" name="Confirmpassword" id="confirmPassword" placeholder="Confirm Password" required>
              </div>
              <div class="input-box" style="display: flex; align-items: center; gap: 10px;">
                <input type="checkbox" id="showPassword" style="width: 16px; height: 16px;">
                <label for="showPassword">Show Password</label>
              </div>
              <div class="input-box">
                <span id="passwordMatchMsg" style="font-size: 13px;"></span>
              </div>
              <div class="input-box">
                <i class="fas fa-question-circle"></i>
                <input type="text" name="captcha" id="captcha" placeholder="" required>
              </div>
              <div class="button input-box">
                <input type="submit" value="Submit" name="btnUpdatePassword" id="submitBtn" disabled>
              </div>
              <a href="index"><div class="text sign-up-text">Back to Login</div></a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    const BASE_URL = "<?= BASE_URL ?>";

    let num1, num2, correctAnswer;

    function generateCaptcha() {
        num1 = Math.floor(Math.random() * 10) + 1;
        num2 = Math.floor(Math.random() * 10) + 1;
        correctAnswer = num1 + num2;
        document.getElementById("captcha").placeholder = `What is ${num1} + ${num2}?`;
    }

    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirmPassword");
    const passwordMatchMsg = document.getElementById("passwordMatchMsg");
    const submitBtn = document.getElementById("submitBtn");
    const captcha = document.getElementById("captcha");

    function validateForm() {
    const pwd = password.value.trim();
    const cpwd = confirmPassword.value.trim();
    const cap = parseInt(captcha.value.trim());

    // Regex: at least 8 chars, one number, one special character hihihi.
    const strongPassword = /^(?=.*[0-9])(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/;

    if (!strongPassword.test(pwd)) {
        passwordMatchMsg.textContent = "Password must be at least 8 characters long and include numbers & symbols.";
        passwordMatchMsg.style.color = "orange";
        submitBtn.disabled = true;
        return;
    }

    if (pwd && cpwd && pwd === cpwd) {
        if (cap === correctAnswer) {
        submitBtn.disabled = false;
        passwordMatchMsg.textContent = "Passwords match!";
        passwordMatchMsg.style.color = "green";
        } else {
        submitBtn.disabled = true;
        passwordMatchMsg.textContent = "Correct the captcha to proceed.";
        passwordMatchMsg.style.color = "orange";
        }
    } else if (pwd && cpwd && pwd !== cpwd) {
        submitBtn.disabled = true;
        passwordMatchMsg.textContent = "Passwords do not match!";
        passwordMatchMsg.style.color = "red";
    } else {
        submitBtn.disabled = true;
        passwordMatchMsg.textContent = "";
    }
    }
  password.addEventListener("input", validateForm);
  confirmPassword.addEventListener("input", validateForm);
  captcha.addEventListener("input", validateForm);

  document.getElementById("showPassword").addEventListener("change", function () {
    const type = this.checked ? "text" : "password";
    password.type = type;
    confirmPassword.type = type;
  });

  $('#resetPasswordForm').submit(function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    formData.append("btnUpdatePassword", true); 
    $.ajax({
      url: BASE_URL + '/api/api.userforgetpassword.php',
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      dataType: 'json',
      success: function (response) {
        if (response.status === "success") {
          Swal.fire({
            icon: 'success',
            title: 'Request Password',
            text: 'Link has been sent to your email. Kindly Check it!',
            timer: 2000,
            showConfirmButton: false
          });
        } else {
          Swal.fire('Error', 'Failed to process email notification!', "error");
        }
      },
      error: function () {
        Swal.fire('Error', 'Server error. Try again.', 'error');
      }
    });
  });

  function updateClock() {
    var today = new Date();
    var dayName = today.getDay(),
        monthName = today.getMonth(),
        dateName = today.getDate(),
        yr = today.getFullYear(),
        hours = today.getHours(),
        min = today.getMinutes(),
        sec = today.getSeconds(),
        pe = "AM";

    if (hours == 0) hours = 12;
    if (hours > 12) {
        hours -= 12;
        pe = "PM";
    }

    Number.prototype.pad = function (digits) {
        var num = this.toString();
        while (num.length < digits) num = "0" + num;
        return num;
    }

    var month = ["Jan", "Feb", "March", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"];
    var week = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
    var ids = ["dayname", "months", "daynum", "year", "hour", "minutes", "seconds", "period"];
    var values = [week[dayName], month[monthName], dateName.pad(2), yr.pad(2), hours.pad(2), min.pad(2), sec.pad(2), pe];
    for (var i = 0; i < ids.length; i++)
        document.getElementById(ids[i]).firstChild.nodeValue = values[i];
  }

  function initClock() {
    updateClock();
    setInterval(updateClock, 1000);
  }
</script>

</body>
</html>