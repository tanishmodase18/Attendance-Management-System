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
        <?php
            if(isset($_GET['deleteid']))
            {
                $PRN = $_GET['deleteid'];
                $result = $link->query("delete from student where PRN='$PRN'");
            }
        ?>
        <div style="padding-top:10px; padding-bottom:10px" class="panel panel-default container">
            <div class="panel-heading">
                <h1 style="text-align:center">Attendance Management System</h1>
            </div>
            <div class="panel-body">
                <a href="view.php" class="btn btn-primary">View</a>
                <a href="add.php" class="btn btn-primary pull-right">Add</a>
                <a href="takeattendance.php" class="btn btn-primary pull-right" style="margin-right:10px">Attendance</a>
                
                <form method="post">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="padding-top:20px">PRN</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $query = "select * from student";
                                $result = $link->query($query);
                                while($show = $result->fetch_assoc())
                                {
                            ?>
                            <tr>
                                <td><?php echo $show['PRN']; ?></td>
                                <td><?php echo $show['first_name']." ".$show['last_name']; ?></td>
                                <td><?php echo $show['email_id']; ?></td>
                                <td>
                                    <a href="edit.php?PRN=<?php echo $show['PRN']?>" class="btn btn-primary">Edit</a>
                                    <a href="?deleteid=<?php echo $show['PRN']  ?>" class="btn btn-primary" style="background-color:indianred;border-color:indianred">Delete</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="panel-footer"></div>
        </div>
        <div><p style="position:absolute;bottom:0;margin-left:605px">copyright by group14 @<?php echo date('Y'); ?></p></div>
    </body>
</html>