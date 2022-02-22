<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';

    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';
    $mail->setLanguage('uk', 'phpmailer/language/');
    $mail->IsHTML(true);

    $mail->setFrom('kuryshchuknazar9@gmail.com', 'Курищук Назарій');
    $mail->addAddress('nazar.kuryschuk@kpk-lp.com.ua');
    $mail->Subject = 'Привіт! Це Назар Курищук';

    $coise = "Телефон";
    if($_POST['choise'] == 'email'){
        $choise = "E-Mail"
    }

    $body = '<h1> Замовлення </h1>';

    if(trim(!empty($_POST['last_name']))){
        $body.='<p><strong>Прізвище:</strong> '.$_POST['last_name'].'</p>';
    }
    if(trim(!empty($_POST['first_name']))){
        $body.='<p><strong>Імя:</strong> '.$_POST['first_name'].'</p>';
    }
    if(trim(!empty($_POST['email']))){
        $body.='<p><strong>Email:</strong> '.$_POST['email'].'</p>';
    }
    if(trim(!empty($_POST['phone']))){
        $body.='<p><strong>Телефон:</strong> '.$_POST['phone'].'</p>';
    }
    if(trim(!empty($_POST['choise']))){
        $body.='<p><strong>Телефон або email:</strong> '.$choise.'</p>';
    }
    if(trim(!empty($_POST['message']))){
        $body.='<p><strong>Повідомлення:</strong> '.$_POST['message'].'</p>';
    }

    $mail->Body = $body;

    //Відправлю

    if (!$mail -> send()){
        $message = 'Дані відправлені!'ж
    }

    $response = ['message' => $message];

    header('Content-type: application/json');
    echo json_encode($response);
?>