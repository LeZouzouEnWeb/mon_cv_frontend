<?php

namespace App\Controllers;

use App\Services\EmailService;

class ContactController
{
    private EmailService $emailService;

    public function __construct()
    {
        $this->emailService = new EmailService();
    }

    /**
     * Traiter l'envoi d'un message de contact
     */
    public function send(): void
    {
        header('Content-Type: application/json');

        // Vérifier la méthode HTTP
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode([
                'success' => false,
                'message' => 'Méthode non autorisée'
            ]);
            exit;
        }

        try {
            // Récupérer les données JSON
            $input = json_decode(file_get_contents('php://input'), true);

            // Validation des champs
            $errors = $this->validateInput($input);
            if (!empty($errors)) {
                http_response_code(400);
                echo json_encode([
                    'success' => false,
                    'message' => 'Données invalides',
                    'errors' => $errors
                ]);
                exit;
            }

            // Nettoyer les données
            $name = $this->sanitize($input['name']);
            $email = filter_var($input['email'], FILTER_SANITIZE_EMAIL);
            $message = $this->sanitize($input['message']);

            // Envoyer l'email
            $sent = $this->emailService->sendContactEmail($name, $email, $message);

            if ($sent) {
                http_response_code(200);
                echo json_encode([
                    'success' => true,
                    'message' => 'Votre message a été envoyé avec succès. Je vous répondrai dans les plus brefs délais.'
                ]);
            } else {
                http_response_code(500);
                echo json_encode([
                    'success' => false,
                    'message' => 'Une erreur est survenue lors de l\'envoi du message. Veuillez réessayer.'
                ]);
            }
        } catch (\Exception $e) {
            error_log("Contact form error: " . $e->getMessage());
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Une erreur inattendue est survenue. Veuillez réessayer plus tard.'
            ]);
        }

        exit;
    }

    /**
     * Valider les données d'entrée
     */
    private function validateInput(?array $input): array
    {
        $errors = [];

        if (empty($input['name'])) {
            $errors['name'] = 'Le nom est requis';
        } elseif (strlen($input['name']) < 2) {
            $errors['name'] = 'Le nom doit contenir au moins 2 caractères';
        } elseif (strlen($input['name']) > 100) {
            $errors['name'] = 'Le nom ne doit pas dépasser 100 caractères';
        }

        if (empty($input['email'])) {
            $errors['email'] = 'L\'email est requis';
        } elseif (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'L\'email n\'est pas valide';
        }

        if (empty($input['message'])) {
            $errors['message'] = 'Le message est requis';
        } elseif (strlen($input['message']) < 10) {
            $errors['message'] = 'Le message doit contenir au moins 10 caractères';
        } elseif (strlen($input['message']) > 2000) {
            $errors['message'] = 'Le message ne doit pas dépasser 2000 caractères';
        }

        return $errors;
    }

    /**
     * Nettoyer les données
     */
    private function sanitize(string $data): string
    {
        return trim($data);
    }
}
