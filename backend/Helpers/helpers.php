<?php

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
            $url = "http://localhost/feapp/frontend/Authentication/resetpassword?code=" . $code;
            $mail->Body = '
            <div style="background-color: #f2f2f2; padding: 40px; font-family: Arial, sans-serif;">
            <div style="max-width: 500px; margin: auto; background-color: #ffffff; border-radius: 12px; padding: 30px; box-shadow: 0 0 10px rgba(50, 205, 50, 0.3); border: 2px solid rgba(50, 205, 50, 0.4); position: relative;">
                <div style="text-align: center;">
                <img src="cid:' . $cid . '" alt="Logo" style="height: 80px; margin-bottom: 20px;">
                <h2 style="color: #0F828C; margin: 10px 0;">Reset Your Password</h2>
                </div>
                
                <p style="text-align: center; font-size: 15px; color: #333;">Hi <strong>' . htmlspecialchars($emailTo) . '</strong>,</p>
                <p style="text-align: center; font-size: 14px; color: #444;">
                We received a request to reset your password. Please click the button below to continue.
                </p>

                <div style="text-align: center; margin: 30px 0;">
                <a href="' . $url . '" 
                    style="display: inline-block; background-color: #0F828C; color: #fff; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: bold; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                    Reset Password
                </a>
                </div>

                <p style="text-align: center; font-size: 13px; color: #666;">If you did not request this, please ignore this email or contact support.</p>
                <p style="text-align: center; font-size: 13px; color: #666;">Regards,<br><strong>BOCS_APP Team</strong></p>

                <hr style="margin-top: 20px; border: none; border-top: 1px solid #ddd;">
                <p style="text-align: center; font-size: 11px; color: #aaa;">This is an automated message. Please do not reply.</p>
            </div>
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