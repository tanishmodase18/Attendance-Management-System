<?php include_once("connection.php"); ?>

<!DOCTYPE html>

<html>
    <head>
        <title>Attendance Management System</title>

        <link rel="stylesheet" type="text/css" href="bootstrap/bootstrap.min.css">
        <script src="bootstrap/bootstrap.min.js"></script>
        <script src="bootstrap/jquery.min.js"></script>
    </head>

    <body style="padding-top:20px">
        <div style="padding-top:10px; padding-bottom:10px" class="panel panel-default container">
            <div class="panel-heading">
                <h1 style="text-align:center">Attendance Management System</h1>
            </div>

            <div class="panel-body">
                <?php
                    if($_SERVER['REQUEST_METHOD']=='POST')
                    {
                        $first_name = $_POST['fname'];
                        $last_name = $_POST['lname'];
                        $email = $_POST['email'];
                        $PRN = $_GET['PRN'];

                        if($first_name=='' || $last_name=='' || $email=='')
                        {
                            echo "<div class='alert alert-danger'>
                                Field must not be empty!
                            </div>";
                        }
                        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
                        {
                            echo "<div class='alert alert-danger'>
                                Invalid email format!
                            </div>";
                        }
                        else
                        {
                            $query = "update student set first_name='$first_name', last_name='$last_name', email_id='$email' where PRN='$PRN'";
                            $result = $link->query($query);
                            if($result)
                            {
                                echo "<div class='alert alert-success'>
                                    Data Updated Successfully!
                                </div>";
                            }
                        }
                    }
                ?>
                <form method="post">
                    <a href="index.php" class="btn btn-primary pull-right">Back</a>
                    
                    <?php
                        $PRN = $_GET['PRN'];
                        $result = $link->query("select * from student where PRN='$PRN'");
                        $show = $result->fetch_assoc();
                        $fname1 = $show['first_name'];
                        $lname1 = $show['last_name'];
                        $email1 = $show['email_id'];
                    ?>

                    <div style="padding-top:40px" class="form-group">
                        <label for="name">First Name:</label>
                        <input type="text" name="fname" class="form-control" value="<?php echo $fname1 ?>">
                    </div>

                    <div class="form-group">
                        <label for="name">Last Name:</label>
                        <input type="text" name="lname" class="form-control" value="<?php echo $lname1 ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="name">Email Id:</label>
                        <input type="text" name="email" class="form-control" value="<?php echo $email1 ?>">
                    </div>

                    <input type="submit" class="btn btn-primary" value="Update">
                </form>
            </div>
            
            <div class="panel-footer"></div>

        </div>
        <div><p style="position:absolute;bottom:0;margin-left:605px">copyright by group14 @<?php echo date('Y'); ?></p></div>
    </body>
</html>