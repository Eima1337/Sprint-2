<?php
    $id = $_GET["id"];
    $sql = "select * from project where id = '".$id."'";
    $exec = $conn->query($sql);
    $sql = "select * from project where project_id = '".$id."'";
    $projectStudents = $conn->query($sql);
    // $projectStudents = mysqli_fetch_array($projectStudents);
    $sql = "select * from student";
    $allStudents = $conn->query($sql);
?>
<form action="" method="POST">
    <input type="text" name="name1" value="<?php echo (mysqli_fetch_assoc($exec)["project_name"]) ?>">
<?php 
    while($row = mysqli_fetch_assoc($allStudents)) {
        $sql = "select * from project_student where project_id ='".$id."' and student_id = '".$row["id"]."'";
        $exec = $conn->query($sql);
        $exist = mysqli_num_rows($exec) > 0?"checked":"";
        echo ('<input type="checkbox" '.$exist.' value="' . $row["id"] . '">' . $row["student_name"] . '</input>');
        // echo ('<input type="checkbox" value="' . $row["id"] . '">' . $row["student_name"] . '</input>');
    }
?>
    <input type="submit" value="Update">
</form>
