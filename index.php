<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>CRUD</title>
</head>
<body>
    <div class="container">

        <?php include('header.php') ?>
        
        <main class="content">
            <h1 class="title">All Records</h1>
            <p class="msg" style="text-align: center;"><?php session_start(); if(isset($_SESSION['delete_msg'])) 
            echo $_SESSION['delete_msg']; $_SESSION['delete_msg'] = ''; ?></p>
            <?php 
                include('db.php');

                $sql = 'SELECT * FROM students JOIN student_class ON students.sclass = student_class.cid';
                $result = mysqli_query($conn, $sql) or die ('Querry Unsuccessful.');
                
                if(mysqli_num_rows($result) > 0) {     
                
            ?>

            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Class</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php 
                        while($row = mysqli_fetch_assoc($result)) {    
                    ?>

                    <tr>
                        <td><?php echo $row['sid']; ?></td>
                        <td><?php echo $row['sname']; ?></td>
                        <td><?php echo $row['saddress']; ?></td>
                        <td><?php echo $row['cname']; ?></td>
                        <td><?php echo $row['sphone']; ?></td>
                        <td class="btn-container">
                            <a href="update.php?update_sid=<?php echo $row['sid']; ?>" class="btn btn-edit">Edit</a>
                            <a href="delete_data.php?sid=<?php echo $row['sid']; ?>" class="btn btn-delete">Delete</a>
                        </td>
                    </tr>

                    <?php 
                        };
                    ?>

                </tbody>
            </table>

            <?php 
                } else {
                    echo '<p style="text-align: center;">0 records found.</p>';
                }

                mysqli_close($conn);
            ?>

        </main>

    </div>
</body>
</html>
<script src="script.js"></script>