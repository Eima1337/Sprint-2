<?php
    $id = $_GET["id"];
    $sql = "select * from project where id = '".$id."'";
    $exec = $conn->query($sql);
    $sql = "select * from project where project_id = '".$id."'";
    $projectStudents = $conn->query($sql);
    $sql = "select * from student";
    $allStudents = $conn->query($sql);
?>
<form action="" method="POST">
    <input type="text" name="name1" value="<?php echo (mysqli_fetch_assoc($exec)["project_name"]) ?>">
<?php
    echo('<select name="myArr[]" multiple="multiple">');
    echo('<option type="checkbox">Remove all students</option>');
    while($row = mysqli_fetch_assoc($allStudents)) {
        $sql = "select * from project_student where project_id ='".$id."' and student_id = '".$row["id"]."'";
        $exec = $conn->query($sql);
        $exist = mysqli_num_rows($exec) > 0?"selected":"";
        // echo ('<input type="checkbox" name="' . $row["id"] . '" '.$exist.' value="' . $row["id"] . '">' . $row["student_name"] . '</input>');
        echo ('<option type="checkbox" '.$exist.' value="' . $row["id"] . '">' . $row["student_name"] . '</option>');
    }
    echo('</select>');
?>
    <input type="submit" value="Update">
</form>
