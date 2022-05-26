<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';

$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
$mail-> setLenguage('ru', 'phpmailer/lenguage/');
$mail->IsHTML(true);

//От кого письмо
$mail->setForm('info@yandex.ru', 'GoVet');
//Кому отправить
$mail->addAddress('morozova-el-s12@yandex.ru');
//Тема письма
$mail->Subject ='Привет! Это ветеринарная клиника "GoVet"';


//Вопрос
$vopros = "Да"
if($_POST['vopros']=="Yes"){
    $vopros="Нет";
}
//Тело письма
$body='<h1>Ваше письмо</h1>';

if(trim(!empty($_POST['name'])))
{
    $body.='<p><strong>Имя: </strong>'.$_POST['name'].'</p>';
}
if(trim(!empty($_POST['email'])))
{
    $body.='<p><strong>E-mail: </strong>'.$_POST['email'].'</p>';
}
if(trim(!empty($_POST['vopros'])))
{
    $body.='<p><strong>Были раньше: </strong>'.$_POST['vopros'].'</p>';
}
if(trim(!empty($_POST['specialist'])))
{
    $body.='<p><strong>Специалист: </strong>'.$_POST['specialist'].'</p>';
}
if(trim(!empty($_POST['message'])))
{
    $body.='<p><strong>Сообщение: </strong>'.$_POST['message'].'</p>';
}

$mail->Body=$body;

//Отправка
if(!$mail->send()){
    $massage ='Ошибка'
} else{
    $massage='Данные отправлены!'
}
$response = ['massage'=> $massage];
header('Content-type: application/json');
echo json_encode($response);
?>
