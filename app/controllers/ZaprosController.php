<?php

namespace app\controllers;

require_once VENDOR . 'phpmailer/phpmailer/src/PHPMailer.php';
require_once VENDOR . 'phpmailer/phpmailer/src/SMTP.php';
require_once VENDOR . 'phpmailer/phpmailer/src/Exception.php';


use ishop\App;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class ZaprosController extends AppController
{

    public function indexAction(){

        $title = 'Запрос на уточнение цены';

        if($_POST){
            $name = h(trim($_POST['name']));
            $phone = h(trim($_POST['phone']));
            $email = h(trim($_POST['email']));
            $dopparam = h(trim($_POST['dopparam']));
            if ($_POST['param']){
                $param = explode(';', $_POST['param']);
                $from = trim($param[0]);
                $to = trim($param[1]);
                $massa = trim($param[2]);
                $volume = trim($param[3]);
                $price = trim($param[4]);
                $tk = trim($param[5]);
                $email_to = trim($param[6]);
            }else{
                $from = trim(h($_POST['from']));
                $to = trim(h($_POST['to']));
                $massa = trim(h($_POST['massa']));
                $volume = trim(h($_POST['volume']));
            }

            try {
                $mailer = new Phpmailer();

                $mailer->IsHTML(true);
                $mailer->SMTPDebug = 0;
                $mailer->CharSet = "utf-8";

                $mailer->IsSMTP();
                $mailer->Host = App::$app->getProperty('smtp_host');
                $mailer->Port = App::$app->getProperty('smtp_port');

                $mailer->SMTPSecure = App::$app->getProperty('smtp_protocol');

                $mailer->SMTPAuth = true;
                $mailer->Username = App::$app->getProperty('smtp_login');
                $mailer->Password = App::$app->getProperty('smtp_password');

                // Create a message
                ob_start();
                require APP . '/views/Zapros/zapros.php';
                $body = ob_get_clean();

                $mailer->AddAddress($email_to);
                //$mailer->AddAddress(App::$app->getProperty('admin'));

                $mailer->From = App::$app->getProperty('smtp_login');
                $mailer->FromName = 'Cargo-price.com';
                $mailer->Sender = App::$app->getProperty('smtp_login');;
                $mailer->Subject = 'Новый запрос: ' . $from . ' - ' . $to . ' / ' . $massa . 'кг. / ' . $volume . 'куб.м.';
                $mailer->Body = $body;

                if ($mailer->Send()){
                    $mailer->Subject = 'Поступил запрос перевозки для компании ' . $tk . ' (' . $email_to . ')';
                    $mailer->clearAllRecipients();
                    $mailer->AddAddress(App::$app->getProperty('admin'));
                    $mailer->Send();
                    $_SESSION['success'] = 'Ваш запрос на уточнение стоимости перевозки успешно отправлен! Менеджер обязательно связжеться с Вами.';
                    redirect();
                }else{
                    $_SESSION['errors'] = 'Ваш запрос не был отправлен, попробуйте еще раз!';
                    redirect('/zapros');
                }

            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mailer->ErrorInfo}";
            }
        }

        $this->setMeta('', '', '');
        $this->set(compact('title', 'res'));
    }

}