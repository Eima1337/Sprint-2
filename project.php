<?php
    if(isset($_POST['name'])) {
        $sql = "select * from project where project_name = '".$_POST['name'] . "'";
        $result = $conn->query($sql);
        if(mysqli_num_rows($result) === 0) {
            $sql = "insert into project (project_name) values ('".$_POST['name']."')";
            $conn->query($sql); 
        }
    }
    if ($_GET['action'] == 'delete') {
        $sql = "delete from project where id = '".$_GET['id'] . "'";
        $conn->query($sql);
    }
    if ($_GET['action'] == 'update') {
        if(isset($_POST['name1'])) {
            $sql = "update project set project_name ='".$_POST['name1']."' where id =" .$_GET['id'];
            $conn->query($sql);
            $values = $_POST['myArr'];
            $flagToRemoveAllStudents = false;
            foreach ($values as $value) {
                if($value == "Remove all students") {
                    $flagToRemoveAllStudents = true;
                    break;
                } 
                $sql = "select * from project_student where project_id=" . $_GET['id'] . " and student_id=" . $value;
                $result = $conn->query($sql);
                if (mysqli_num_rows($result) === 0) {
                    $sql = "insert into project_student (project_id, student_id) values (".$_GET['id'] . ", " . $value.")";
                    $conn->query($sql);
                }
            }
            $sql = "select * from project_student where project_id=" . $_GET['id'];
            $result = $conn->query($sql);
            while($row = mysqli_fetch_assoc($result)) {
                if(!in_array($row['student_id'],$values) || $flagToRemoveAllStudents) {
                    $sql = "delete from project_student where student_id = ".$row['student_id'] . " and project_id = " . $_GET['id'];
                    $conn->query($sql);
                }
            }
        }    
    }
?>
<table>
    <thead>
        <th>Id</th>
        <th>Project name</th>
        <th>Student name</th>
        <th>Actions</th>
    </thead>
<?php 
    $sql = "select id, project_name from project";
    $result = $conn->query($sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $sql = "select * from project_student where project_id = ".$row["id"];
            $result2 = $conn->query($sql);
            $students = "";
            while ($row2 = mysqli_fetch_assoc($result2)) {
                $sql = "select student_name from student where id = ".$row2["student_id"];
                $result3 = $conn->query($sql);
                $row3 = mysqli_fetch_assoc($result3);
                $students .= $row3["student_name"] . ", ";
            }
            $students = substr_replace($students, "",-2);
        ?>
        <tr>
            <td><?php echo $row["id"]?></td>
            <td><?php echo $row["project_name"]?></td>
            <td><?php echo $students ?></td>
            <td><button><a href='./?path=project&action=delete&id=<?php echo($row["id"])?>'>Delete</a></button><button><a href="./?path=project&action=update&id=<?php echo($row["id"])?>">Update</a></button></td>
        </tr>
            <?php }
    }
?>
</table>
<form action="" method="POST">
    <input type="text" id="name" name="name" placeholder="add project">
    <input type="submit" value="add">
</form>
<?php 
    if ($_GET['action'] == 'update' && !isset($_POST['name1'])) {
        include("update_project.php");
    }
?>
