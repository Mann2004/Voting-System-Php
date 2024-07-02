<?php
    session_start();
    if(!isset($_SESSION['userdata'])) {
        header("location: ../");
    }
    
    $userdata=$_SESSION['userdata'];
    $groupsdata=$_SESSION['groupsdata'];

    if($_SESSION['userdata']['status']==0){
        $status='<b style="color:red"> Not Voted</b>';
    }
    else{
        $status='<b style="color:green">  Voted</b>';
    }
?>

<html>
<head>
    <title>Online Voting System - Dashboard</title>
    <link rel="stylesheet" href="../css/stylesheetd.css">
</head>
<body>
    <style>
            #backbtn{
               
               border-radius: 5px;
               background-color: deeppink;
               float: left;
               margin:10px;
               padding: 10px;
               border-radius: 5px;
              
              color: #fff;
             cursor: pointer;
             margin: 10px;
            }
            #mainsection {
             padding: 20px;
            }


img {
    border: 2px solid black;
    border-radius: 2px;
    padding: 10px;
    width: 100px;
    height: 80px;
    float: right;
}
#voted {
    background-color: green;
    cursor: not-allowed;
    background: 
    
}

              
 
   

            
            #logoutbtn{
                border-radius: 5px;
               background-color: deeppink;
               float: right;
               margin:10px;
               padding: 10px;
               border-radius: 5px;
              
              color: #fff;
             cursor: pointer;
             margin: 10px;
            }
            #Profile{
                background-color: skyblue;
                width: 30%;
                padding: 20px;
                float: left;
            }
            #Group{
                background-color: skyblue;
                width: 50%;
                padding: 10px;
                float: right;

            }
            #votebtn{
                padding: 5px;
               border-radius: 5px;
               background-color: deeppink;
               color: white;
            }
            #mainpannel{
                padding:10px;
            }
            #voted{
               
               border-radius: 5px;
               background-color: green;
               color:white;
               

            }
            body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    
}
    </style>

    <div id="mainsection">
        <center>
            <div id="headersection">
                <a href="../routes\homepage.html"><button id="backbtn">Back</button></a>
                <button id="logoutbtn" onclick="logout()">Logout</button>
                <h1>Online Voting System</h1>
            </div>
        </center>
        <hr>
        <div id="mainpannel">
            <div id="Profile">
                <center><img src="../uploads/<?php echo isset($userdata['photo']) ? $userdata['photo'] : 'default.jpg'; ?>" height="100" width="100"> </center><br><br>
                <b>Name:</b> <?php echo $userdata['name'] ?> <br><br>
                <b>Mobile:</b><?php echo $userdata['mno'] ?> <br><br>
                <b>Address:</b><?php echo $userdata['address'] ?> <br><br>
                <b>Status:</b><?php echo $status ?> <br><br>
            </div>
            <div id="Group">
                <?php 
                    if($_SESSION['groupsdata']){
                        for($i=0;$i<count($groupsdata);$i++) {
                ?>
                <div>
                    <img style="float:right" src="../uploads/<?php echo  $groupsdata[$i]['photo'] ?>" height="100" width="100">
                    <b>Group Name:</b> <?php echo $groupsdata[$i]['name'] ?> <br><br>
                    <b>Votes:</b><?php echo $groupsdata[$i]['votes'] ?> <br><br>
                    <form action="../api/vote.php" method="post">
                        <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes'] ?>">
                        <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id'] ?>">
                        <?php if($_SESSION['userdata']['status']==0): ?>
                            <input type="submit" name="votebtn<?php echo $i ?>" value="Vote" id="votebtn">
                        <?php else: ?>
                            <button disabled type="button" name="votebtn<?php echo $i ?>" value="Vote" id="voted">Voted</button>
                        <?php endif; ?>
                    </form>
                    <hr>
                </div>
                <?php
                        }
                    }
                    else{
                        // Handle case when groupsdata is empty
                    }
                ?>
            </div>
        </div>
    </div>

    <script>
        function logout() {
            <?php if($_SESSION['userdata']['status']==0): ?>
                alert('Please vote before logging out or go back to Homepage.');
            <?php else: ?>
                window.location.href='../routes/back.html';
            <?php endif; ?>
        }
    </script>
</body>
</html>
