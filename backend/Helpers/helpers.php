<?php
define('BASE_URL', 'http://localhost/feapp'); 

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

require_once __DIR__ . '/../Core/BaseModel.php';

class Helpers extends BaseModel{
    
    public function ForgetPassword($emailTo)
    {
        $mail = new PHPMailer(true);
        $code = uniqid(true);

        $stmt = $this->db->prepare("INSERT INTO `resetpassword`(`code`,`username`) VALUES (:code, :username)");
        $stmt->bindParam('code', $code);
        $stmt->bindParam('username',$emailTo);
        if (!$stmt->execute()) {
            return [
                'message' => 'Database error while generating reset code.',
                'status' => 'error'
            ];
        }
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'tamuni.vents@gmail.com';
            $mail->Password   = 'mhjvrevblevchuop';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom('tamuni.vents@gmail.com', 'FEAPP');
            $mail->addAddress($emailTo);
            $mail->isHTML(true);
            $mail->Subject = 'FEAPP Password Reset';

            $imagePath = __DIR__ . '/../../frontend/src/img/clientlogo.jpg';
            $cid = 'logo'; 

            if (file_exists($imagePath)) {
                $mail->addEmbeddedImage($imagePath, $cid, 'logo.png');
            }
            $url = BASE_URL . "/frontend/Authentication/resetpassword?code=" . $code;
            $mail->Body = '
            <div style="font-family: Arial, sans-serif; padding: 20px; background-color: #0F828C; color: #fff;">
                <div style="text-align: center; margin-bottom: 20px;">
                    <img src="cid:' . $cid . '" alt="Logo" style="height: 120px;"><br>
                    <h2 style="color: #F2C078;">Reset Your Password</h2>
                </div>
                <p style="text-align: center;">Dear User, ' . htmlspecialchars($emailTo) . '</p>
                <p style="text-align: center;">We received a request to reset your password. If this was you, please click the button below to proceed.</p>

                <div style="text-align: center; margin: 30px 0;">
                    <a href="' . $url . '" style="background-color: #F2C078; padding: 10px 20px; color: #0F828C; text-decoration: none; border-radius: 5px; font-weight: bold;">
                        Reset Password
                    </a>
                </div>

                <p style="text-align: center;">If you did not request a password reset, please ignore this email or contact support.</p>
                <p style="text-align: center;">Regards,<br><strong>BOCS_APP Team</strong></p>
                <hr style="border-color: #555;">
                <small style="color: #aaa;">This is an automated message. Please do not reply.</small>
            </div>';

            $mail->send();
            return [
                'status' => 'success'
            ];
        } catch (Exception $e) {
            return [
                'message' => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}",
                'status' => 'error'
            ];
        }
    }
    public function randomStringGenerator($length = 8) {
        return bin2hex(random_bytes($length / 2));
    }

    public function emailBlocker($email, $allowedDomain) {
        if (!str_ends_with($email, $allowedDomain)) {
            echo "<script>alert('Invalid Email Domain'); window.location='index.php';</script>";
            exit;
        }
    }
    public function clean_input($data) {
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }
}

?>