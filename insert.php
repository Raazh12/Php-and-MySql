<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 500px;
            margin: auto;
        }
        .btn-primary {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="form-container">
            <h2 class="text-center mb-4">Student Registration</h2>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="fname" class="form-label">Full Name</label>
                    <input type="text" id="fname" name="fname" class="form-control" placeholder="Enter your full name" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" id="address" name="address" class="form-control" placeholder="Enter your address" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter your phone number" required>
                </div>
                <div class="mb-3">
                    <label for="regdate" class="form-label">Reg. Date</label>
                    <input 
                        type="date" 
                        id="regdate" 
                        name="regdate" 
                        class="form-control" 
                        value="<?php echo date('Y-m-d'); ?>" 
                        required>
                </div>
                <button type="submit" class="btn btn-primary" name="saveData">Save Student</button>
            </form>
        </div>
    </div>

    <?php 
       $con = new mysqli("localhost", "root", "", "ca218");
       if ($con->connect_error) {
           die("Could not connect to the server: " . $con->connect_error);
       }

       if(isset($_POST['saveData'])){
           $fn = $_POST['fname'];
           $add = $_POST['address'];
           $ph = $_POST['phone'];
           $rd = $_POST['regdate'];

           $sql = "INSERT INTO student (fullname, address, phone, regdate) 
                   VALUES ('$fn', '$add', '$ph', '$rd')";
           if($con->query($sql)) {
               echo "Data saved successfully";
               header("location: select.php");
           } else {
               echo "Error: " . $con->error;
           }
       }
    ?>
</body>
</html>