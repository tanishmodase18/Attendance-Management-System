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
                <a href="index.php" class="btn btn-primary pull-right">Back</a>
                
                <form method="post">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="padding-top:20px">PRN</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Attendance</th>
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
                                    Present <input required type="radio" name="attendance[<?php echo $show['PRN']?>]" value="Present" checked>
                                    Absent <input required type="radio" name="attendance[<?php echo $show['PRN']?>]" value="Absent">
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>

                        <?php
                            if($_SERVER['REQUEST_METHOD']=='POST')
                            {
                                $attend = $_POST['attendance'];
                                $date = date('d-m-Y');
                                $query = "select distinct date from attendance";
                                $result = $link->query($query);
                                $b = false;
                                if($result->num_rows>0)
                                {
                                    while($check = $result->fetch_assoc())
                                    {
                                        if($date==$check['date'])
                                        {
                                            $b = true;
                                            echo "<div class='alert alert-danger'>
                                                Attendance Already Taken!
                                            </div>";
                                        }
                                    }
                                }
                                if(!$b)
                                {
                                    foreach($attend as $key=>$value)
                                    {
                                        if($value=="Present")
                                        {
                                            $query="insert into attendance(PRN,value,date) values($key, 'Present', '$date')";
                                            $insertResult = $link->query($query);
                                        }
                                        else
                                        {
                                            $query="insert into attendance(PRN,value,date) values($key, 'Absent', '$date')";
                                            $insertResult = $link->query($query);
                                        }
                                    }

                                    if($insertResult)
                                    {
                                        echo "<div class='alert alert-success'>
                                            Attendance Taken Successfully!
                                        </div>";
                                    }
                                }                            
                            }
                        ?>
                    </table>
                    <input type="submit" value="Take Attendance" class="btn btn-primary">
                </form>
            </div>
            <div class="panel-footer"></div>

        </div>
        <div><p style="position:absolute;bottom:0;margin-left:605px">copyright by group14 @<?php echo date('Y'); ?></p></div>
    </body>
</html>