<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;
/**
 * Created by PhpStorm.
 * User: nelly
 * Date: 3/9/2021
 * Time: 2:09 PM
 */
class SendEmail
{
    private $host = 'smtp.mailtrap.io';
    private $Username   = '0984032787138e';
    private $Password   = 'a0e8e2951c9f66';
    private $Port       = 587;



    public function __construct($student){

        $surname = $student['surname'];
        $newExamNumber = $student['newExamNumber'];
        $other_name = $student['other_name'];
        $contact_number = $student['contact_number'];
        $email = $student['email'];
        $date_of_birth = $student['date_of_birth'];
        $gender = $student['gender'];
        $school = $student['school'];
        $class = $student['class'];
        $residing_state = $student['residing_state'];
        $amount = $student['amount'];
        $passport = $student['passport'];

        try {
            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->Host       = $this->host;
            $mail->SMTPAuth   =true;
            $mail->Username   = $this->Username;
            $mail->Password   = $this->Password;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = $this->Port;
            $mail->SMTPDebug = 0;
            $mail->isHTML(true);

            //first email

            $mail->setFrom('info@la-vogueschools.org', 'La-Vogue Schools');
            $mail->addAddress($email, $surname . ' ' . $other_name);
            $mail->addReplyTo('info@la-vogueschools.org', 'Information');

            //Attachments
            //Convert html to pdf and set as attachment
            $filename = $this->convertHTMLtoPDF($student);
            $mail->addAttachment('../asset/exam-cards/'.$filename);         //Add attachments

            $message = 'Hi ' . $surname . ' ' . $other_name . ',<br>';
            $message .= 'You have successfully registered For the National Mathematics Competition.<br>';
            $message .= 'Your <b>Exam Number is ' . $newExamNumber . ' </b> <br>';
            $message .= 'Please find your exam card attached to this email. <br>';
            $message .= 'You are expected to print it out and come with it to the examination venue.<br>';
            $message .= 'If you have any trouble or questions, you can reach out to us via our mail <a href="mailto:info@la-vogueschools.org">info@la-vogueschools.org</a>';

            $mail->Subject = 'National Mathematics Competition';
            $mail->Body    = $message;

            $mail->send();

            $mail->clearAddresses();
            $mail->clearAllRecipients();

            // second email

            $mail->setFrom('info@la-vogueschools.org', 'La-Vogue Schools');
            $mail->addAddress('info@la-vogueschools.org', 'La-Vogue Schools');

            $mail->addEmbeddedImage(dirname(__DIR__) . '/asset/passports/' . $passport, 'passport');

            $message1 = 'A new student has registered for the National Mathematics Competition. See details below; <br>';
            $message1 .= '<b>Exam Number : ' . $newExamNumber . ' </b> <br>';
            $message1 .= '<b>Surname : ' . $surname . ' </b> <br>';
            $message1 .= '<b>Other names : ' . $other_name . ' </b> <br>';
            $message1 .= '<b>Contact number : ' . $contact_number . ' </b> <br>';
            $message1 .= '<b>Email : ' . $email . ' </b> <br>';
            $message1 .= '<b>Date of birth : ' . $date_of_birth . ' </b> <br>';
            $message1 .= '<b>Gender : ' . $gender . ' </b> <br>';
            $message1 .= '<b>School : ' . $school . ' </b> <br>';
            $message1 .= '<b>Class : ' . $class . ' </b> <br>';
            $message1 .= '<b>Residing state : ' . $residing_state . ' </b> <br>';
            $message1 .= '<b>Amount : ' . $amount . ' </b> <br>';
            $message1 .= '<b>Passport</b> : <img src="cid:passport" style="max-width:200px">  <br>';
            //Content
            $mail->Subject = 'New Registration - National Mathematics Competition';
            $mail->Body    = $message1;


            if($mail->send()) {
                http_response_code(201);
                die(json_encode(array('message' => "Successfully created resource")));
            }

        } catch (Exception $e) {
            http_response_code(409);
            error_log($mail->ErrorInfo);
            die(json_encode(array('message' => "Message could not be sent. Mailer Error: {$e->getMessage()}")));
        }



    }
    private function convertHTMLtoPDF($student){


        $options = new Options();

        $options->set('isRemoteEnabled', true);
        $options->set('defaultPaperSize ','2a0');

        $dompdf = new Dompdf($options);


        $surname = $student['surname'];
        $newExamNumber = $student['newExamNumber'];
        $other_name = $student['other_name'];
        $contact_number = $student['contact_number'];
        $email = $student['email'];
        $date_of_birth = $student['date_of_birth'];
        $gender = $student['gender'];
        $school = $student['school'];
        $class = $student['class'];
        $residing_state = $student['residing_state'];
        $amount = $student['amount'];
        $passport = $student['passport'];
        $date= date("d/m/Y");


        ob_start();
        require('../registered-students/exam-card.php');
        $html = ob_get_contents();
        ob_get_clean();
        $dompdf->loadHtml($html);



        $dompdf->render();
        $filename = $newExamNumber.'-exam-card.pdf';

        $output = $dompdf->output();
        file_put_contents('../asset/exam-cards/'.$filename, $output);
        return $filename;
    }
}