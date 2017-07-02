<?php
if(isset($_POST['email'])) {

    header('Content-Type: text/html; charset=utf-8');

    //  E-MAIL
    $email_to = "wojtasekc902@gmail.com";
    $email_subject = "Wiadomość ze strony wusp-jarocin.pl";


    function died($error) {
        // your error code can go here
        echo "Wprowadzone dane sa niepoprawne ";
        die();
    }

    // validation expected data exists
    if(!isset($_POST['name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['telephone']) ||
        !isset($_POST['title']) ||
        !isset($_POST['text'])) {
        died('Przepraszamy, wystąpił błąd z przetwarzaniem formularza.');
    }

    $name = $_POST['name']; // required
    $email = $_POST['email']; // required
    $telephone = $_POST['telephone']; // not required
    $title = $_POST['title']; // required
    $text = $_POST['text']; // required

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email)) {
    $error_message .= 'Wprowadzono niepoprawny adres e-mai.<br />';
  }
    $string_exp = "/^[A-Za-z .'-]+$/";
  if(!preg_match($string_exp,$name)) {
    $error_message .= 'Wprowadzono niepoprawne imię lub nazwisko.<br />';
  }
  if(!preg_match($string_exp,$title)) {
    $error_message .= 'Wprowadzono niepoprawny tytuł.<br />';
  }
  if(strlen($text) < 2) {
    $error_message .= 'Wprowadź wiadomość.<br />';
  }
  if(strlen($error_message) > 0) {
    died($error_message);
  }
    $email_message = "Wiadomość ze strony wusp-jarocin.pl\n\n";

    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }

    $email_message .= "Imię i Nazwisko: ".clean_string($name)."\n";
    $email_message .= "E-mail: ".clean_string($email)."\n";
    $email_message .= "Numer telefonu: ".clean_string($telephone)."\n";
    $email_message .= "Tytuł: ".clean_string($title)."\n";
    $email_message .= "<b>Treść wiadomości:</b> ".clean_string($text)."\n";


$send_mail = @mail($email_to, $email_subject, $email_message);

}
?>

Dziękujemy za wiadomość, wktótce się skontaktujemy.

<?php
die();
?>
