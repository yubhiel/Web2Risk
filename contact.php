<?php

$destinataire = "contact@web2risk.com";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // on récupère les données du formulaire
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // on vérifie que les champs ne sont pas vides
    if ($nom == "" || $email == "" || $message == "") {
        header("Location: index.html?envoi=erreur#contact");
        exit();
    }

    // on vérifie si l'email est valide
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: index.html?envoi=erreur#contact");
        exit();
    }

    // on prépare le message
    $sujet = "Nouveau message de " . $nom;
    
    $contenu = "Nom : " . $nom . "\n";
    $contenu .= "Email : " . $email . "\n\n";
    $contenu .= "Message :\n" . $message;
    $headers = "From: noreply@web2risk.com" . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";

    if (mail($destinataire, $sujet, $contenu, $headers)) {
        header("Location: index.html?envoi=ok#contact");
    } else {
        header("Location: index.html?envoi=erreur#contact");
    }
    
    exit();
}

?>