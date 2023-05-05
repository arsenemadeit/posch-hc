<?php
if(isset($_POST['email'])) {
     
    $email_to = "arsenembanou26@gmail.com";
    $email_subject = "Formulaire de contact";
     
    function died($error) {
        echo "Désolé, il y a des erreurs dans le formulaire. ";
        echo "Les erreurs sont ci-dessous.<br /><br />";
        echo $error."<br /><br />";
        echo "Veuillez revenir en arrière et corriger ces erreurs.<br /><br />";
        die();
    }
     
    if(!isset($_POST['name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['subject']) ||
        !isset($_POST['message'])) {
        died('Désolé, il y a des erreurs dans le formulaire.');       
    }
     
    $name = $_POST['name'];
    $email_from = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
     
    $error_message = "";
     
    if(!filter_var($email_from, FILTER_VALIDATE_EMAIL)) {
        $error_message .= 'L\'adresse email entrée ne semble pas être valide.<br />';
    }
     
    $email_message = "Détails du formulaire de contact ci-dessous :\n\n";
     
    function clean_string($string) {
        $bad = array("content-type","bcc:","to:","cc:","href");
        return str_replace($bad,"",$string);
    }
     
    $email_message .= "Nom: ".clean_string($name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Sujet: ".clean_string($subject)."\n";
    $email_message .= "Message: ".clean_string($message)."\n";
     
     
//Création de l'en-tête du mail
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- page de confirmation -->

Merci d'avoir pris contact avec nous. Nous vous répondrons dans les plus brefs délais.
 
<?php
}
?>