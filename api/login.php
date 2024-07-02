<?php
session_start();
include("connect.php");

$mno = $_POST['mno'];
$password = $_POST['password'];
$role = $_POST['role'];

$check = mysqli_query($connect, "SELECT * FROM user2 WHERE mno='$mno' AND password='$password' AND role='$role'" );

if(mysqli_num_rows($check)>0){
    $userdata = mysqli_fetch_array($check);
    $groups = mysqli_query($connect, "SELECT * FROM user2 WHERE role=2");
    $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);

    $_SESSION['userdata'] = $userdata;
    $_SESSION['groupsdata'] = $groupsdata;

    echo '
    <script>
        window.location = "../routes/dashboard.php";
    </script>
';
}    
else{
    echo '
            <script>
                alert("Invalid Credentials or User not found!");
                window.location = "../";
            </script>
            ';
}

?>