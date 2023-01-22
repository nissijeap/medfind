<link rel="stylesheet" href="assets/css/popup_style.css"> 
           <style>
.footer1 {
  position: fixed;
  bottom: 0;
  width: 100%;
  color: #5c4ac7;
  text-align: center;
}
</style>
   
   <?php
   
include('./constant/layout/head.php');
include('./constant/connect.php');
session_start();

if(isset($_SESSION['userId'])) {
 //header('location:'.$store_url.'login.php');   
}

$errors = array();

if($_POST) {    

  $email = $_POST['email'];
  $password = $_POST['password'];

  if(empty($email) || empty($password)) {
    if($email == "") {
      $errors[] = "Email is required";
    } 

    if($password == "") {
      $errors[] = "Password is required";
    }
  } else {
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $connect->query($sql);

    if($result->num_rows == 1) {
      // exists
      $mainSql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
      $mainResult = $connect->query($mainSql);

      if($mainResult->num_rows == 1) {
        $value = $mainResult->fetch_assoc();
        $user_id = $value['id'];

        $_SESSION['userId'] = $user_id;
?>

<div class="popup popup--icon -success js_success-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Success 
    </h1>
    <p>Login Successfully</p>
    <p>
     
     <?php echo "<script>setTimeout(\"location.href = 'dashboard.php';\",1500);</script>"; ?>
    </p>
  </div>
</div>
     <?php  }  
      else{
        ?>


<div class="popup popup--icon -error js_error-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Error 
    </h1>
    <p>Incorrect Email/Password Combination</p>
    <p>
      <a href="login.php"><button class="button button--error" data-for="js_error-popup">Close</button></a>
    </p>
  </div>
</div>
       
      <?php } // /else
    } else { ?> 
        <div class="popup popup--icon -error js_error-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Error 
    </h1>
    <p>Email does not Exists</p>
    <p>
      <a href="login.php"><button class="button button--error" data-for="js_error-popup">Close</button></a>
    </p>
  </div>
</div>  
         
    <?php } // /else
  } // /else not empty email // password
  
} // /if $_POST

?>
    
    <div id="main-wrapper">
        <div class="unix-login">

            <div class="container-fluid" style="background-image: url('assets/uploadImage/Logo/banner_login.jpg');
 background-color: #ffffff;background-size:cover">
                <div class="row ">
                    <div class="col-md-4">
                        <div class="login-content ">
                            <div class="login-form">
                                <center><img src="./assets/uploadImage/Logo/headermedfind.png" style="width: 400px; margin-left:50px; margin-bottom: 20px"></center><br>
                                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" id="loginForm" class="row">

                                    <div class="f-w-900" style="margin-left: 210px; margin-bottom: 35px; color: #116530; font-size: 25px;">LOG IN</label></div>

                                    <div class="form-group col-md-12">
                                        <label lass="col-sm-3 control-label" style="margin-left:50px;">Email</label>
                                        <input type="text" name="email" id="email" class="form-control" placeholder="Email" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="Invalid email address"required="" style="margin-left:50px;">
                                    </div>

                                    <div class="form-group col-md-12" style="margin-left:50px;">
                                        <label>Password</label>
                                        <input type="password" pattern="[a-z]{1,15}" id="password" name="password" class="form-control" placeholder="Password" required="">
                                    </div>

                                   <div class="col-md-12"> 
                                       <button style="background-color: #116530; border-radius: 50px; margin-left:50px;" type="submit" name="login" class=" f-w-600 text-white btn  btn-flat m-b-30 m-t-30">Log In</button>
                                   </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><center>
 
            
            </footer> </center>
    </div>
    
    <script src="./assets/js/lib/jquery/jquery.min.js"></script>
    <script src="./assets/js/lib/bootstrap/js/popper.min.js"></script>
    <script src="./assets/js/jquery.slimscroll.js"></script>
    <script src="./assets/js/sidebarmenu.js"></script>
    <script src="./assets/js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="./assets/js/custom.min.js"></script>
</body>

</html>
