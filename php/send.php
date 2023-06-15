<?php
error_reporting(0);

function myMail($mailTo, $subject, $message) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://send.api.mailtrap.io/api/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{"from":{"email":"info@serzhkonsierzh.com","name":"Sergey Bogodelov"},"to":[{"email":"'.$mailTo.'"}],"subject":"'.$subject.'","text":"'.$message.'"}',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer <your api token>',
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    if ($response === false) {
        return false;
    }

    curl_close($curl);
    return true;
}

if(
    isset($_SERVER['HTTP_X_REQUESTED_WITH']) 
    && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) 
    && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest' 
    && !empty($_POST['name'])) {
        $message = 'Имя: ' . $_POST['name'] . ' ';
        $message .= 'email: ' . $_POST['email'] . ' ';
        if(!empty($_POST['text'])) {
            $message .= 'Текст: ' . $_POST['text'] . ' ';
        }
        $mailTo = "bogodelovsergey@gmail.com"; // Ваш e-mail
        $subject = "Письмо с сайта"; // Тема сообщения
        
        if(myMail($mailTo, $subject, $message)) {
            echo "Спасибо, ".$_POST['name'].", мы свяжемся с вами в самое ближайшее время!"; 
        } else {
            http_response_code(500);
            die();
}
}
?>