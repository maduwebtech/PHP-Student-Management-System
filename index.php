<!-- Developed by Muddsar Qayyum
YouTube Channel: Madu Web Tech
Website: https://maduwebtech.com -->
<?php include "config.php";
session_start();
if (isset($_SESSION['user_data'])) {
  header("location:main.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="COMSATS">
    <meta name="author" content="Muddsar Qayyum">
    <title>COMSATS</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  </head>
  <body class="bg-primary">
    <div class="container my-5">
      <div class="row px-2">
    <div class="col-xl-5 col-md-4 m-auto p-5 bg-white mt-5 shadow">
      <?php
       if (isset($_SESSION['error'])) {
        $error=$_SESSION['error'];
        echo "<p class='bg-danger p-2 text-white text-center'>".$error."</p>";
        unset($_SESSION['error']);
       }
       ?>
      <form action="" method="POST">
        <p class="text-center">COMSATS! Login your account.</p>
      <div class="mb-3">
        <input type="email" name="user_email" placeholder="Email" class="form-control" required>
      </div>
      <div class="mb-3">
        <input type="password" name="user_pass" placeholder="Password" class="form-control" required>
      </div>
      <div class="mb-3">
        <input type="submit" name="login_btn"class="btn btn-primary" value="Login">
      </div>
      </form>
    </div>
  </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
<?php
if (isset($_POST['login_btn'])) {
  $email=mysqli_real_escape_string($config,$_POST['user_email']);
  $pass=mysqli_real_escape_string($config,sha1($_POST['user_pass']));
  $sql="SELECT * FROM admin_tbl WHERE user_email='{$email}' AND user_pass='{$pass}'";
  $query=mysqli_query($config,$sql);
  $data=mysqli_num_rows($query);
  if ($data) {
    $result=mysqli_fetch_assoc($query);
    $user_data=array($result['user_id'],$result['user_name'],$result['role']);
    $_SESSION['user_data']=$user_data;
    header("location:main.php");
  }
  else
  { 
    $_SESSION['error']="Invalid email/password";
    header("location:index.php");
  }
}
?>