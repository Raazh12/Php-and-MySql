<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <?php
        $con = new mysqli("localhost", "root", "", "ca218");
        if ($con->connect_error) {
            die("Could not connect to the server: " . $con->connect_error);
        }
        if(isset($_GET['sid'])){
            $id=$_GET['sid'];
            $sqledit="select * from student where id='$id'";
            $resultUp= $con->query($sqledit);
            while ($record=$resultUp->fetch_array()){
                $fnam = $record[1];
                $add = $record[2];
                $ph = $record[3];
                $rd = $record[4];

            }
            ?>

              <form action="" method="post">
                <div class="mb-3">
                    <input type="hidden" name="updateId" value="<?php echo   $id; ?>">
                </div>
                <div class="mb-3">
                    <label for="fname" class="form-label">Full Name</label>
                    <input type="text" id="fname"  value="<?php echo $fnam;?>"   name="fname" class="form-control" placeholder="Enter your full name" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" id="address"  value="<?php echo $add;?> " name="address" class="form-control" placeholder="Enter your address" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" id="phone" value="<?php echo $ph;?>" name="phone" class="form-control" placeholder="Enter your phone number" required>
                </div>
                <div class="mb-3">
                    <label for="regdate" class="form-label">Reg. Date</label>
                    <input 
                        type="date" 
                        id="regdate" 
                        value="<?php echo $rd;?>"
                        name="regdate" 
                        class="form-control" 
                        required>
                </div>
                <button type="submit" class="btn btn-primary" name="UpDate">Save Student</button>
            </form>

            <?php
            
        }
        else{

    

        // Display Records
        $sql = "SELECT * FROM student";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            echo "<div class='table-responsive'>";
            echo "<table class='table table-striped table-hover table-bordered'>";
            echo "<thead class='table-dark'>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Full Name</th>";
            echo "<th>Address</th>";
            echo "<th>Phone</th>";
            echo "<th>Reg. Date</th>";
            echo "<th>Action</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            while ($row = $result->fetch_array()) {
                echo "<tr>";
                echo "<td>" . $row[0] . "</td>";
                echo "<td>" . $row[1] . "</td>";
                echo "<td>" . $row[2] . "</td>";
                echo "<td>" . $row[3] . "</td>";
                echo "<td>" . $row[4] . "</td>";
                echo "<td>";
                echo "<a href='select.php?did=" . $row[0] . "' class='btn btn-danger btn-sm me-2'>Delete</a>";
                echo "<a href='select.php?sid=" . $row[0] . "' class='btn btn-primary btn-sm'>Update</a>";
                echo "</td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
        }
            echo "</div>";
        }

        // Check for Delete Request
        if (isset($_GET['did'])) {
            $sid = $_GET['did'];

            // Run DELETE Query
            $deleteSQL = "DELETE FROM student WHERE id='$sid'";
            if ($con->query($deleteSQL)) {
                echo "<p class='text-success'>Data with ID $sid was deleted successfully.</p>";
                header("location: select.php");
            } 
        }
        if(isset($_POST['UpDate'])){
        $fn = $_POST['fname'];
           $add = $_POST['address'];
           $ph = $_POST['phone'];
           $rd = $_POST['regdate'];
           $sd = $_POST['updateId'];
           $sqlupdate= "update student set 
           fullname='$fn',
           address='$add',
           phone='$ph',
           regdate='$rd'

           where id='$sd'
           ";

           if($con->query($sqlupdate)){
            header("location: select.php");
           }


        }
        ?>
    </div>
    
</body>
</html>