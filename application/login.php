<?php

session_start();

require 'connection/functions.php';

//cek cookie
if(isset($_COOKIE['id']) && isset($_COOKIE['key'])){
  $id = $_COOKIE['id'];
  $key = $_COOKIE['key'];

  //ambil username dari id
  $result = mysqli_query($connect, "SELECT username FROM user WHERE id = $id"); 
  $row = mysqli_fetch_assoc($result);

  //cek cookie dan username
  if($key === hash('sha256', $row['username'])){
    $_SESSION['login'] = true;
  }
}

if(isset($_SESSION["login"])){
  header("Location: index.php");
  exit;
}

if(isset($_POST["login"])){
  $username = $_POST["username"];
  $password = $_POST["password"];

  //cek username dalam database
  $result = mysqli_query($connect, "SELECT * FROM user WHERE username = '$username'");
  
  if(mysqli_num_rows($result)==1){
    
    //cek pw dalam database
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row["password"])){
      //set session
      $_SESSION['login'] = true;

      //cek remember me
      if(isset($_POST['remember'])){
        //buat cookie

        setcookie('id', $row['id'], time()+3600);
        setcookie('key', hash('sha256', $row['username']), time()+3600);
      }

      header("Location: index.php");
      exit;
    }
  }

  $error = true;

}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>IAICJ | Login</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css" />
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <!--===============================================================================================-->
  </head>
  <body>

  <!-- awal form login -->
    <div class="limiter">
      <div class="container-login100">
        <div class="wrap-login100">
          <div class="login100-pic js-tilt text-center" data-tilt>
            <img src="img/1.png" width="250" alt="IMG" />
          </div>

          <form action="" method="POST" class="login100-form validate-form">
            <span class="login100-form-title mt-3"> Member Login </span>

            <!-- cek password ada/tidak atau benar/salah -->
            <?php if(isset($error)):?>
              <p style="color: red;">Username/password salah.</p>
            <?php endif; ?>

            <div class="wrap-input100 validate-input" data-validate="Username is required">
              <input class="input100" type="text" name="username" placeholder="Username" />
              <span class="focus-input100"></span>
              <span class="symbol-input100">
                <i class="fa fa-envelope" aria-hidden="true"></i>
              </span>
            </div>

            <div class="wrap-input100 validate-input" data-validate="Password is required">
              <input class="input100" type="password" name="password" placeholder="Password" />
              <span class="focus-input100"></span>
              <span class="symbol-input100">
                <i class="fa fa-lock" aria-hidden="true"></i>
              </span>
            </div>

            <div class="form-check ml-3">
              <input class="form-check-input" type="checkbox" value="" id="remember" name="remember">
              <label class="form-check-label" for="remember">Remember Me</label>
            </div>

            <div class="container-login100-form-btn">
              <button type="submit" name="login" class="login100-form-btn">Login</button>
            </a>
            </div>

            <div class="text-center p-t-136">
              <a class="txt2" href="registration.php" name="register">
                Create your Account
                <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
              </a>
            </div>
          </form>
          
        </div>
      </div>
    </div>

    <!-- akhir form login -->

    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/tilt/tilt.jquery.min.js"></script>
    <script>
      $(".js-tilt").tilt({
        scale: 1.1,
      });
    </script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>
  </body>
</html>
