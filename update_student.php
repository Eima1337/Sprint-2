<?php
    $id = $_GET["id"];
    $sql = "select * from student where id = '".$id."'";
    $exec = $conn->query($sql);
    $sql = "select * from student where student_id = '".$id."'";
    $projectStudents = $conn->query($sql);
    $sql = "select * from project";
    $allProjects = $conn->query($sql);
?>
<form action="" method="POST">
    <input type="text" name="name1" value="<?php echo (mysqli_fetch_assoc($exec)["student_name"]) ?>">
<?php
    echo('<select name="myArr[]" multiple="multiple">');
    echo('<option type="checkbox">Remove all projects</option>');
    while($row = mysqli_fetch_assoc($allProjects)) {
        $sql = "select * from project_student where student_id ='".$id."' and project_id = '".$row["id"]."'";
        $exec = $conn->query($sql);
        $exist = mysqli_num_rows($exec) > 0?"selected":"";
        // echo ('<input type="checkbox" name="' . $row["id"] . '" '.$exist.' value="' . $row["id"] . '">' . $row["student_name"] . '</input>');
        echo ('<option type="checkbox" '.$exist.' value="' . $row["id"] . '">' . $row["project_name"] . '</option>');
    }
    echo('</select>');
?>
    <input type="submit" value="Update">
</form>