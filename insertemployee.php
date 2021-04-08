<?php


 if(isset($_POST['submit'])) {

    $con = mysqli_connect('localhost','root','','attendance');

    if ($con->connect_error){
        die("connection error");
    }
    else{
        echo "connected successfully";
    }

    $profileImageName = $_FILES["profileImage"]["name"];
    // For image upload
    $target_dir = "images/";
    $target_file = $target_dir . basename($profileImageName);
    // VALIDATION
    // validate image size. Size is calculated in Bytes
    // if($_FILES['profileImage']['size'] > 200000) {
    //   $msg = "Image size should not be greated than 200Kb";
    //   $msg_class = "alert-danger";
    // }
    // check if file exists
    if(file_exists($target_file)) {
      $msg = "File already exists";
      $msg_class = "alert-danger";
    }
    // Upload image only if no errors
    if (empty($error)) {
     ?>
     <script>
      console.log(<?php print_r($_FILES); ?>)
      </script>
<?php
     if ($_FILES["profileImage"]["error"] > 0)
{
echo "Return Code: " . $_FILES["profileImage"]["error"] . “<br>”;
                ?>
          <script>
            
           if(!alert("Error")){window.location = "admin.php?view_employee=view_employee";}
          </script>
          <?php
} else {
      if(copy($_FILES["profileImage"]["tmp_name"], $target_file)){
        $name =  $_POST["name"];
        $gender =  $_POST["gender"];
        $email  = $_POST['email'];
        $DOB  = $_POST["dateofbirth"];
        $Contact_No  = $_POST["contact"];
        $department  = $_POST["department"];

       $sql = "INSERT INTO `employee_details`(`name`, `gender`, `email`, `DOB`, `contact_no`, `department`, `profile_image`) VALUES ('$name','$gender','$email','$DOB','$Contact_No','$department','$profileImageName')";

        if(mysqli_query($conn, $sql)){
          ?>
          <script>
            
           if(!alert('Employee added successfully.')){window.location = "admin.php?view_employee=view_employee";}
          </script>
          <?php
        } else {
          ?>
          <script>
            // window.location = "admin.php?view_employee=view_employee";
               if(!alert("Can not add employee. Some error occured")){window.location = "admin.php?view_employee=view_employee";}
        
          </script>
        <?php
        }
    } else {
                       ?>
          <script>
            console.log(<?php print_r($_FILES); ?>)
           if(!alert("Error")){window.location = "admin.php?view_employee=view_employee";}
          </script>
          <?php
      }
    }
  }

?>
