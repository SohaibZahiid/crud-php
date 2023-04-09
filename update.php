<?php

$update_msg = '';
$sid_err = $name_err = $address_err = $class_err = $phone_err = '';
$flag = true;

if (isset($_POST['updateBtn'])) {

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
        $mysql = "UPDATE students
        SET sname = '$name', saddress = '$address', sclass = '$class', sphone = '$phone'
        WHERE sid = {$_POST['sid']}";

        if (mysqli_query($conn, $mysql)) {
            $update_msg = 'Student updated successfuly.';
        } else {
            $update_msg = 'Error updating student.';
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
    <title>Update</title>
</head>

<body>
    <div class="container">

        <?php include 'header.php' ?>

        <main class="content">
            <h1 class="title">Update Student</h1>


            <p class="msg" style="text-align: center;">
                <?php echo $update_msg; ?>
            </p>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="form-group" id='input_sid'>
                    <label for="id">Id</label>
                    <input type="text" name="sid">
                    <!--  HERE WILL DISLPLAY REQUIRED MESSAGE FROM JAVASCRIPT -->
                </div>
                <input type="submit" name="showBtn" class="btn-add" value="Show">
            </form>


            <?php
            // echo 'test' . $_GET['sid'];
            if (isset($_POST['showBtn']) || !empty($_GET['update_sid'])) {
                $sid = $_POST['sid'] ?? $_GET['update_sid'];
                // !empty($_GET['update_sid']) ? $sid = $_GET['update_sid'] : '';
                if (empty($sid)) {
                    $sid_err = 'Required';
                    $flag = false;
                }


                if (isset($sid_err)) {
                    echo "<span class='err_msg' id='show_sid_err'>$sid_err</span>";
                }
                




                if ($flag) {
                    include 'db.php';
                    $sql = "SELECT * FROM students WHERE sid = $sid";
                    $result = mysqli_query($conn, $sql) or die('Querry Unsuccessful.');
                    if (mysqli_num_rows($result) > 0) {
                        while ($student = mysqli_fetch_assoc($result)) {

                            ?>

                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="hidden" name="sid" value="<?php echo $student['sid'] ?? ''; ?>">
                                    <input type="text" name="name" value="<?php echo $student['sname'] ?? ''; ?>">
                                    <span class="err_msg">
                                        <?php if (isset($name_err)) {
                                            echo $name_err;
                                        }
                                        ?>
                                    </span>
                                    
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" value="<?php echo $student['saddress'] ?? ''; ?>">
                                    <span class="err_msg">
                                        <?php if (isset($address_err)) {
                                            echo $address_err;
                                        }
                                        ?>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="class">Class</label>
                                    <select name="class">
                                        <option value="">Please select your class</option>

                                        <?php
                                        $csql = "SELECT * FROM student_class";
                                        $cresult = mysqli_query($conn, $csql) or die('Querry Unsuccessful.');
                                        if (mysqli_num_rows($cresult) > 0) {
                                            while ($class = mysqli_fetch_assoc($cresult)) {
                                                $cid = $class['cid'];
                                                $cname = $class['cname'];

                                                if ($student['sclass'] == $class['cid']) {
                                                    $select = 'selected';
                                                } else {
                                                    $select = '';
                                                }

                                                echo "<option $select value='$cid'>$cname</option>";
                                            }
                                        }
                                        ?>

                                    </select>
                                    <span class="err_msg">
                                        <?php if (isset($class_err)) {
                                            echo $class_err;
                                        }
                                        ?>
                                    </span>
                                </div>
                                <div class="form-group">

                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone" value="<?php echo $student['sphone'] ?? ''; ?>">
                                    <span class="err_msg">
                                        <?php if (isset($phone_err)) {
                                            echo $phone_err;
                                        }
                                        ?>
                                    </span>
                                </div>
                                <input type="submit" name="updateBtn" class="btn-add" value="Update">

                            </form>
                            <?php

                        }
                    } else {
                        echo '<p class="msg" style="text-align: center;">Student not found.</p>';
                    }
                }
            }
            ?>

        </main>

    </div>

</body>

<script defer src="script.js"></script>

</html>