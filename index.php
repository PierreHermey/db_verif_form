<?php
require "connexion.php";    

if(!empty($_POST)) {
    $errors = [];
    $name = htmlspecialchars($_POST['name']);
    $firstname = htmlspecialchars($_POST['firstname']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);
    $statut = htmlspecialchars($_POST['statut']);


    if(empty($name)){
        $errors['name'] = "Vous n'avez pas renseigné votre nom";
    }

    if(empty($firstname)){
        $errors['firstname'] = "Vous n'avez pas renseigné votre prénom";
    }

    if(empty($subject)){
        $errors['subject'] = "Vous n'avez pas renseigné le sujet de votre mail";
    }

    if(empty($message)){
        $errors['message'] = "Vous n'avez pas renseigné votre message";
    }

    if(!isset($_POST['gender'])){
        $errors['gender'] = "Vous n'avez pas renseigné votre civilité";
    }
    else {
    $gender = htmlspecialchars($_POST['gender']);
    }

    if($statut == "-1"){
        $errors['statut'] = "Vous n'avez pas renseigné votre statut";
    }

    if(!isset($_POST['sports'])){
        $errors['sports'] = "Vous n'avez pas renseigné votre civilité";
    } else {

    }


    if(empty($errors)) {
        //si le formulaire est validé
        $to = 'pierre.h@codeur.online';
        $headers ='From: <site@local.dev>'."\n";
        $headers .='Content-Type: text/html; charset="utf-8"'."\n";
        
       /*  $msg .= 'Nom: '.$name;
        $msg .= ' Prénom: '.$firstname;
        $msg .= ' Message: '.$message; */

        $insert = $bdd->prepare("INSERT INTO form VALUE ('$gender','$name','$firstname','$statut','$subject','$message')");
        $insert->execute();

        echo '<p>Votre message a été envoyé avec succès</p>';
        /* if(mail( 'pierre.h@codeur.online', $subject, $msg, $headers))
        {
            echo '<script language="javascript">
            alert("Le message a été envoyé");
            </script>'; 
        } else {
            echo '<script language="javascript">
            alert("Le message n\'a pas pu être envoyé");
            </script>';
        }	
             */
    }
    else{
        echo '<p>Votre message n \'a pas pu être envoyé </p>';
    }
}




?><!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Aladin" rel="stylesheet"> 
    <title>Document</title>
</head>
<body>

    <form method="POST" action="index.php">
    <h1>Formulaire de contact</h1>
    <p><?php if(isset($errors['gender'])) echo $errors['gender'];?></p>
        <fieldset class="radio">
            <label for="gender">Madame</label>
            <input type="radio" name="gender" id="gender" value="Madame"/>

            <label for="gender">Monsieur</label>
            <input type="radio" id="gender" name="gender" value="Monsieur"/>
        </fieldset>

        <fieldset>
            <label for="input_name">Nom</label>
            <p><?php if(isset($errors['name'])) echo $errors['name'];?></p>
            <input type="text" name="name" id="input_name" placeholder="Nom">

            <label for="input_firstname">Prénom</label>
            <p><?php if(isset($errors['firstname'])) echo $errors['firstname'];?></p>
            <input type="text" id="input_firstname" name="firstname" placeholder="Prénom">
        </fieldset>

        <fieldset>
        <p><?php if(isset($errors['statut'])) echo $errors['statut'];?></p>
            <label for="statut">Vous êtes un :</label>
            <select name="statut">
                <option selected value="-1"></option>
                <option value="Particulier">Particulier</option>
                <option value="Professionnel">Professionnel</option>
            </select> 
        </fieldset>
        
        <p><?php if(isset($errors['sports'])) echo $errors['sports'];?></p>
        <p class="sports">Faites vous du sport ?</p>
        <fieldset class="checkbox">
        
            <label for="sports">Basketball</label>
            <input type="checkbox" name="sports" id="sports" value="Basketball"/>

            <label for="sports">Football</label>
            <input type="checkbox" id="sports" name="sports" value="Football"/>

            <label for="sports">Handball</label>
            <input type="checkbox" id="sports" name="sports" value="Handball"/>
        </fieldset>

        <fieldset>
            <label for="input_subject">Sujet</label>    
            <p><?php if(isset($errors['subject'])) echo $errors['subject'];?></p>
            <input type="text" name="subject" if="input_subject" placeholder="Sujet">
        </fieldset>

        <fieldset>
            <label for="input_message">Message</label>
            <p><?php if(isset($errors['message'])) echo $errors['message'];?></p>
            <textarea id="input_message" name="message" placeholder="Votre message"></textarea>
            <button type="submit">Envoyer</button>
        </fieldset>
    </form>
</body>
</html>