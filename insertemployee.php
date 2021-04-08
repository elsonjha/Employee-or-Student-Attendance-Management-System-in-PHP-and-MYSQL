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
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/images/";
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
echo "Return Code: " . $_FILES["profileImage"]["error"] . "";
                ?>
          <script>
            console.log(<?php $_FILES["profileImage"]["error"]; ?>)
           if(!alert("Error" + <?php $_FILES["profileImage"]["error"]; ?>)){window.location = "admin.php?view_employee=view_employee";}
          </script>
          <?php
} else {
      if(move_uploaded_file($_FILES["profileImage"]["tmp_name"], $target_file)){
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
                   printf("Errormessage: %s\n", mysqli_error($conn));
          ?>
          <script>
           console.log(<?php mysqli_error($conn)?>)
            // window.location = "admin.php?view_employee=view_employee";
               if(!alert("Can not add employee. Some error occured")){window.location = "admin.php?view_employee=view_employee";}
        
          </script>
        <?php
        }
    } else {
                       ?>
          <script>
            console.log(<?php print_r($_FILES); 
    print_r($target_file);
?>)
           if(!alert("Error 2")){window.location = "admin.php?view_employee=view_employee";}
          </script>
          <?php
      }
    }
  }
 }
?>
