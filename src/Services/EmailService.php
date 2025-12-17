<?php

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailService
{
    private PHPMailer $mailer;
    private string $adminEmail;

    public function __construct()
    {
        $this->mailer = new PHPMailer(true);
        $this->adminEmail = $_ENV['ADMIN_EMAIL'] ?? 'emploi@corbisier.fr';
        $this->configure();
    }

    private function configure(): void
    {
        try {
            // Configuration SMTP
            $this->mailer->isSMTP();
            $this->mailer->Host = $_ENV['SMTP_HOST'] ?? 'smtp.gmail.com';
            $this->mailer->SMTPAuth = true;
            $this->mailer->Username = $_ENV['SMTP_USERNAME'] ?? '';
            $this->mailer->Password = $_ENV['SMTP_PASSWORD'] ?? '';

            // Configuration du port et du chiffrement
            $port = (int)($_ENV['SMTP_PORT'] ?? 587);
            $this->mailer->Port = $port;

            // Port 465 = SSL, Port 587 = STARTTLS
            if ($port === 465) {
                $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            } else {
                $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            }

            // Options supplémentaires pour le débogage et la compatibilité
            $this->mailer->SMTPDebug = 0; // 0 = off, 2 = debug
            $this->mailer->SMTPOptions = [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                ]
            ];

            // Configuration de l'expéditeur
            $this->mailer->setFrom($this->adminEmail, 'CV Eric Corbisier');
            $this->mailer->CharSet = 'UTF-8';
        } catch (Exception $e) {
            error_log("Email configuration error: " . $e->getMessage());
        }
    }

    /**
     * Envoyer un email de contact
     */
    public function sendContactEmail(string $name, string $email, string $message): bool
    {
        try {
            $this->mailer->clearAddresses();
            $this->mailer->clearReplyTos();

            // Destinataire
            $this->mailer->addAddress($this->adminEmail);

            // Répondre à l'expéditeur
            $this->mailer->addReplyTo($email, $name);

            // Sujet et contenu
            $this->mailer->Subject = "Nouveau message de contact - CV - {$name}";
            $this->mailer->isHTML(true);

            $htmlContent = $this->getContactEmailTemplate($name, $email, $message);
            $this->mailer->Body = $htmlContent;
            $this->mailer->AltBody = $this->getPlainTextVersion($name, $email, $message);

            return $this->mailer->send();
        } catch (Exception $e) {
            error_log("Email sending error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Template HTML pour l'email de contact
     */
    private function getContactEmailTemplate(string $name, string $email, string $message): string
    {
        return "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; padding: 20px; border-radius: 8px 8px 0 0; }
                .content { background: #f9fafb; padding: 30px; border: 1px solid #e5e7eb; border-top: none; }
                .info-row { margin-bottom: 15px; }
                .label { font-weight: bold; color: #4b5563; }
                .message-box { background: white; padding: 20px; border-left: 4px solid #3b82f6; margin-top: 20px; border-radius: 4px; }
                .footer { text-align: center; margin-top: 20px; color: #6b7280; font-size: 12px; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h2 style='margin:0;'>Nouveau message de contact</h2>
                </div>
                <div class='content'>
                    <div class='info-row'>
                        <span class='label'>De:</span> {$name}
                    </div>
                    <div class='info-row'>
                        <span class='label'>Email:</span> <a href='mailto:{$email}'>{$email}</a>
                    </div>
                    <div class='message-box'>
                        <div class='label'>Message:</div>
                        <p>" . nl2br(htmlspecialchars($message, ENT_QUOTES, 'UTF-8')) . "</p>
                    </div>
                    <div class='footer'>
                        <p>Message envoyé depuis le formulaire de contact de votre CV</p>
                        <p>" . date('d/m/Y à H:i:s') . "</p>
                    </div>
                </div>
            </div>
        </body>
        </html>
        ";
    }

    /**
     * Version texte brut de l'email
     */
    private function getPlainTextVersion(string $name, string $email, string $message): string
    {
        return "
Nouveau message de contact

De: {$name}
Email: {$email}

Message:
{$message}

---
Message envoyé depuis le formulaire de contact de votre CV
" . date('d/m/Y à H:i:s');
    }
}