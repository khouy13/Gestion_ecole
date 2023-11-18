<?php
class LoginController
{
    static public function sendCode()
    {
        if (!isset($_POST['email'])) {
            Redirect::to('login');
        }
        // $email = $_POST['email'];
        $email = "mohammedbenaaouinate18@gmail.com";
        $subject = "Verification Code";
        $verificationCode = LoginController::generateRandomToken(6); // Generate a random verification code of length 6
        $message = "Dear User, \n\nYour verification code is: " . $verificationCode . "\n\nPlease enter this code to verify your account.\n\nBest regards,\nYour Website Team";
        $headers = "From: TRK@gmail.com\r\n";
        $headers .= "Reply-To: TRK@gmail.com\r\n";
        $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

        // Send the email
        if (mail($email, $subject, $message, $headers)) {
            echo "Verification code sent successfully.";
            $_SESSION['code_verification'] = $verificationCode;
        } else {
            echo "Failed to send verification code.";
        }
    }
    static public function generateRandomToken($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $token = '';

        for ($i = 0; $i < $length; $i++) {
            $randomIndex = rand(0, strlen($characters) - 1);
            $token .= $characters[$randomIndex];
        }

        return $token;
    }
}
