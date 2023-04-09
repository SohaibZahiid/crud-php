<?php 

    include('db.php');

    $sid = $_REQUEST['sid'];
    $sql = "DELETE FROM students WHERE sid = '$sid'";


    session_start();

    if (mysqli_query($conn, $sql)) {
        $_SESSION['delete_msg'] = 'Student deleted successfully.';
    } else {
        $_SESSION['delete_msg'] = 'Could not delete the student.';
    }

    header('Location: http://localhost/projects/CRUD/index.php');

    mysqli_close($conn);

?>