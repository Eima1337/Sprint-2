<?php 
    if(isset($_POST['name'])) {
        $sql = "select * from student where student_name = '".$_POST['name'] . "'";
        $result = $conn->query($sql);
        if(mysqli_num_rows($result) === 0) {
            $sql = "insert into student (student_name) values ('".$_POST['name']."')";
            $conn->query($sql); 
        }
    }
    if ($_GET['action'] == 'delete') {
        $sql = "delete from student where id = '".$_GET['id'] . "'";
        $conn->query($sql);
    }
?>
<table>
    <thead>
        <th>Id</th>
        <th>Student name</th>
        <th>Project name</th>
        <th>Actions</th>
    </thead>
    <?php 
    $sql = "select id, student_name from student";
    $result = $conn->query($sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $sql = "select * from project_student where student_id = ".$row["id"];
            $result2 = $conn->query($sql);
            $students = "";
            while ($row2 = mysqli_fetch_assoc($result2)) {
                $sql = "select project_name from project where id = ".$row2["project_id"];
                $result3 = $conn->query($sql);
                $row3 = mysqli_fetch_assoc($result3);
                $students .= $row3["project_name"] . ", ";
            }
            $students = substr_replace($students, "",-2);
        ?>
        <tr>
            <td><?php echo $row["id"]?></td>
            <td><?php echo $row["student_name"]?></td>
            <td><?php echo $students ?></td>
            <td><button><a href='./?path=student&action=delete&id=<?php echo($row["id"])?>'>Delete</a></button><button>Update</button></td>
        </tr>
            <?php }
    }
?>
</table>
<form action="" method="POST">
    <input type="text" id="name" name="name" placeholder="add project">
    <input type="submit" value="add">
</form>