<?php
define('BASE_URL', '/feapp');
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

<body  onload="initClock()">
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
            <div class="title">Faculty Login</div>
          <form id="loginForm">
              <div class="input-boxes">
                <div class="input-box">
                  <i class="fas fa-user"></i>
                  <input type="text" name="email" placeholder="Email" required>
                </div>
                <div class="input-box">
                  <i class="fas fa-key"></i>
                  <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="button input-box">
                  <input type="submit" value="Submit" name="btnLogin">
                </div>
                <div class="text sign-up-text">Proceed to <label for="flip">Forget Password</label></div>
                <div class="text sign-up-text">Login as <a href="<?= BASE_URL ?>/frontend/Authentication/studentLogin">Student</a></div>
              </div>
          </form>
      </div>
        <div class="signup-form">
          <div class="title">Forget Password?</div>
              <form action="action.php" method="post">
                  <div class="input-boxes">
                    <div class="input-box">
                    <i class="fas fa-envelope"></i>
                      <input type="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="button input-box">
                      <input type="submit" value="Sumbit" name="btnPreRegister" autofocus>
                    </div>
                    <div class="text sign-up-text">Proceed to <label for="flip">Log In</label></div>
                  </div>
            </form>
        </div>
    </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
  <script>
    const BASE_URL = "<?= BASE_URL ?>";

    $('#loginForm').submit(function (e) {
      e.preventDefault();

      const formData = new FormData(this);
      formData.append("btnLogin", true);

      $.ajax({
        url: BASE_URL + "/api/api.auth.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response) {
          if (response.status === "success") {
            window.location.href = BASE_URL + "/frontend/views/dashboard";
          } else {
            Swal.fire({
              icon: "error",
              title: "Login Failed",
              text: "Invalid email or password.",
            });
          }
        },
        error: function () {
          Swal.fire("Error", "Server issue. Try again.", "error");
        }
      });
    });
</script>

  <script type="text/javascript">
        function updateClock(){
            var today = new  Date();
            var dayName = today.getDay(),
                monthName = today.getMonth(),
                dateName = today.getDate(),
                yr = today.getFullYear(),
                hours = today.getHours(),
                min = today.getMinutes(),
                sec = today.getSeconds(),
                pe = "AM";

                if(hours == 0){
                    hou = 12;
                }
                if(hours > 12){
                    hours = hours - 12;
                    pe = "PM";
                }

                Number.prototype.pad = function(digits){
                    for(var num = this.toString(); num.length < digits; num = 0 + num);
                    return num;
                }

            var month = ["Jan","Feb","March","Apr","May","Jun","Jul","Aug","Sept","Oct","Nov","Dec"];
            var week = ["Sun","Mon","Tue","Wed","Thu","Fri","Sat"];
            var ids = ["dayname","months","daynum","year","hour","minutes","seconds","period"];
            var values = [week[dayName], month[monthName], dateName.pad(2), yr.pad(2), hours.pad(2), min.pad(2), sec.pad(2), pe];
            for(var i=0; i<ids.length; i++)
            document.getElementById(ids[i]).firstChild.nodeValue = values[i];

        }
        function initClock(){
            updateClock();
            window.setInterval("updateClock()", 1);
        }
        setTimeout(() => {
            const box = document.querySelector('.notification');
            if (box) {
                box.style.opacity = '0';
                setTimeout(() => box.style.display = 'none', 500);
            }
        }, 5000);
</script>

</body>
</html>

