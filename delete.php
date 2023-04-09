<?php

$flag = true;
$sid_err = $delete_msg = '';

if (isset($_POST['deleteBtn'])) {
    $sid = $_POST['sid'];

    if (empty($sid)) {
        $sid_err = 'Required';
        $flag = false;
    }

    if ($flag) {
        include('db.php');

        $sql = "SELECT * FROM students WHERE sid = $sid";
        $result = mysqli_query($conn, $sql) or die('Query Unsuccessful.');

        if (mysqli_num_rows($result) > 0) {
            $sql = "DELETE FROM students WHERE sid = $sid";
            $result = mysqli_query($conn, $sql) or die('Query Unsuccessful.');
            $delete_msg = 'Student deleted successfully.';
        } else {
            $delete_msg = 'Could not delete the student.';
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
    <title>Delete</title>
</head>

<body>
    <div class="container">

        <?php include 'header.php' ?>

        <main class="content">
            <h1 class="title">Delete Student</h1>


            <p class="msg" style="text-align: center;">
                <?php echo $delete_msg; ?>
            </p>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="form-group">
                    <label for="id">Id</label>
                    <input type="text" name="sid">
                    <?php 
                        if (!isset($sid_err)) {
                            echo "<span class='err_msg'>$sid_err</span>";
                        }
                    ?>
                </div>
                <input type="submit" name="deleteBtn" class="btn-add" value="Delete">
            </form>

        </main>

    </div>

</body>

<script defer src="script.js"></script>

</html>