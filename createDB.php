<?php 
    $servername = "localhost";
    $username = "root";
    $password = "mysql";
    $dbname = "myDB";

    $conn = mysqli_connect($servername, $username, $password);
    if ($conn->select_db($dbname) === false) {
    $sql = "create database if not exists myDB";
    $conn->query($sql);
    $conn->select_db($dbname);
    $sql = "create table if not exists project (
        id int auto_increment primary key,
        project_name varchar(45) not null   
    )";
    $conn->query($sql);
    $sql = "create table if not exists student (
        id int auto_increment primary key,
        student_name varchar(45) not null   
    )";
    $conn->query($sql);
    $sql = "create table if not exists project_student (
        project_id int,
        student_id int,
        primary key (project_id, student_id),
        foreign key (project_id) references project(id),
        foreign key (student_id) references student(id)
        )";
    $conn->query($sql);

    $sql = "insert into project (project_name) values ('JAVA'), ('PHP'), ('JavaScript')";
    $conn->query($sql);

    $sql = "insert into student (student_name) values ('Tomas'), ('Deivis'), ('Tadas'), ('Gytis'), ('Arnas'), ('Mantas')";
    $conn->query($sql);

    $sql = "insert into project_student (project_id, student_id) values (1, 1), (1, 2), (2, 3), (2, 4), (3, 5), (3, 6)";
    $conn->query($sql);
    }
?>