<?php

namespace App\Livewire;

use Livewire\Component;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Sendmail extends Component
{
    public $email;
    public $subject;
    public $body;

    public function mount()
    {
    }

    public function sendEmail()
    {
        // Validate input
        $this->validate([
            'email' => 'required|email',
            'subject' => 'required|string',
            'body' => 'required|string',
        ]);

        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = false; // Disable verbose debug output
            $mail->isSMTP(); // Set mailer to use SMTP
            $mail->Host       = 'smtp.zoho.in'; // Specify Zoho SMTP server
            $mail->SMTPAuth   = true; // Enable SMTP authentication
            $mail->Username   = env('ZOHO_MAIL_USERNAME'); // Zoho SMTP username
            $mail->Password   = env('ZOHO_MAIL_PASSWORD'); // Zoho SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable TLS encryption
            $mail->Port       = 465; // TCP port to connect to

            $mail->setFrom(env('ZOHO_MAIL_USERNAME'), env('ZOHO_MAIL_FROM_NAME'));
            $mail->addAddress($this->email); // Use the dynamic email address

            $mail->isHTML(true);
            $mail->Subject = $this->subject;
            $mail->Body    = $this->body;
            $mail->AltBody = strip_tags($this->body); // Convert HTML to plain text

            $mail->send();

            session()->flash('message', 'Email has been sent successfully.');
        } catch (Exception $e) {
            session()->flash('error', "Email could not be sent. Mailer Error: {$mail->ErrorInfo}");
        }
    }

    public function render()
    {
        return view('livewire.sendmail');
    }
}
