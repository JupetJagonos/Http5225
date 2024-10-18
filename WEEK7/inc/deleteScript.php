<?php 
if (isset($_POST['schoolID'])) {
    $schoolID = $_POST['schoolID'];
    // $schoolName = $_POST['schoolName'];
    // $schoolType = $_POST['schoolType'];
    // $phone = $_POST['phone'];
    // $email = $_POST['email']; // Assign the value from POST
    require('../reusable/connect.php'); 

    $query = "DELETE FROM public_school_contact_list_may2024_en WHERE id = '" . mysqli_real_escape_string($connect, $schoolID) . "'";
    
    $result = mysqli_query($connect, $query);

    if ($result) {
        header("Location: ../index.php");  
        exit; 
    } else {
        echo "There was an error deleting the school: " . mysqli_error($connect); // Error handling
    }

//     mysqli_close($connect);
// } else {
   
//     header("Location: ../index.php");
//     exit; 
}
?>
