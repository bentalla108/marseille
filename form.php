<?php

$db_name ='mysql:host=localhost;port=3333;dbname=contact_db;';
$user_name='root';
$user_pwd ='';

$conn =new PDO($db_name ,$user_name ,$user_pwd);

if(isset($_POST['send']))
{
    $nom = $_POST['nom'];
    $nom = filter_var($nom, FILTER_SANITIZE_STRING);

    $prenom = $_POST['prenom'];
    $prenom = filter_var($prenom, FILTER_SANITIZE_STRING);

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);

    $courses = $_POST['courses'];
    $courses = filter_var($courses, FILTER_SANITIZE_STRING);



    $commentaire = $_POST['commentaire'];
    $commentaire= filter_var($commentaire, FILTER_SANITIZE_STRING);

    $gender = $_POST['gender'];
    $gender = filter_var($gender, FILTER_SANITIZE_STRING);


    $select_contact =$conn ->prepare("SELECT * FROM `contact_form` 
    WHERE nom =? 
    AND prenom = ? 
    AND email = ?
    AND number = ?
    AND courses = ?
    AND commentaire = ? 
    AND gender = ? ") ;
    $select_contact -> execute([$nom, $prenom, $email, $number, $courses, $commentaire, $gender]);

    if($select_contact->rowCount() > 0)
    {

        $message[] ='Message déja envoyé ! ';
    }
    else{
        $insert_message = $conn -> prepare("INSERT INTO `contact_form`(nom, prenom , email, number, courses, commentaire, gender) VALUES (?,?,?,?,?,?,?)");

        $insert_message  -> execute([$nom, $prenom, $email, $number, $courses, $commentaire, $gender]);
        $message[] ='Message envoyé avec succés! ';
    };

}
?>