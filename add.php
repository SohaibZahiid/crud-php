<?php 

    $insert_msg = '';
    $name_err = $address_err = $class_err = $phone_err = '';
    $flag = true;

    if (isset($_POST['submit'])) {
        $name = $_REQUEST['name'];
        $address = $_REQUEST['address'];
        $class = $_REQUEST['class'];
        $phone = $_REQUEST['phone'];

        if (empty($name)) {
            $name_err = 'Required';
            $flag = false;
        }

        if (empty($address)) {
            $address_err = 'Required';
            $flag = false;
        }

        if (empty($class)) {
            $class_err = 'Required';
            $flag = false;
        }

        if (empty($phone)) {
            $phone_err = 'Required';
            $flag = false;
        }


        if ($flag) {
            include('db.php');

            $mysql = "INSERT INTO students (sname, saddress, sclass, sphone) values('$name', '$address', '$class', '$phone')";

            if(mysqli_query($conn, $mysql)) {
                $insert_msg = 'Student added successfuly.';
            } else {
                $insert_msg = 'Error inserting data.';
            }
        }
    }

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Add</title>
</head>

<body>
    <div class="container">

        <?php include('header.php') ?>

        <main class="content">
            <h1 class="title">Add Student</h1>

            <p class="msg" style="text-align: center;"><?php echo $insert_msg; ?></p>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="<?php echo $_POST['name'] ?? ''; ?>">
                    <span class="err_msg"><?php if(isset($name_err)) echo $name_err ?></span>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" value="<?php echo $_POST['address'] ?? ''; ?>">
                    <span class="err_msg"><?php if(isset($address_err)) echo $address_err ?></span>
                </div>
                <div class="form-group">
                    <label for="class">Class</label>
                        
                    <select name="class" >
                        <option value="">Please select your class</option>
                        <?php
                            include('db.php');

                            $sql = 'SELECT * FROM student_class';
                            $result = mysqli_query($conn, $sql) or die ('Querry Unsuccessful.');
                            
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    $cid = $row['cid'];
                                    $cname = $row['cname'];
                                    echo "<option value='$cid'>$cname</option>";
                                }
                            }

                            mysqli_close($conn);
                        ?>
                        
                    </select>
                    <span class="err_msg"><?php if(isset($class_err)) echo $class_err ?></span>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" value="<?php echo $_POST['phone'] ?? ''; ?>">
                    <span class="err_msg"><?php if(isset($phone_err)) echo $phone_err ?></span>
                </div>
                <input type="submit" name="submit" class="btn-add" value="Add">
            </div>
        </main>

    </div>

    <script src="script.js"></script>
</body>

</html>