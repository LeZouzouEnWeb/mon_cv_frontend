<?php

namespace App\Services;

class TurnstileService
{
    private string $secretKey;
    private const VERIFY_URL = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';

    public function __construct()
    {
        $this->secretKey = $_ENV['TURNSTILE_SECRET_KEY'] ?? '';
    }

    /**
     * Vérifier le token Turnstile
     */
    public function verify(string $token, ?string $remoteIp = null): bool
    {
        if (empty($this->secretKey)) {
            error_log('Turnstile secret key is not configured');
            return false;
        }

        if (empty($token)) {
            return false;
        }

        $data = [
            'secret' => $this->secretKey,
            'response' => $token,
        ];

        if ($remoteIp) {
            $data['remoteip'] = $remoteIp;
        }

        try {
            $ch = curl_init(self::VERIFY_URL);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode !== 200) {
                error_log("Turnstile API returned HTTP $httpCode");
                return false;
            }

            $result = json_decode($response, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                error_log('Failed to decode Turnstile response: ' . json_last_error_msg());
                return false;
            }

            // Log les erreurs Turnstile si présentes
            if (!empty($result['error-codes'])) {
                error_log('Turnstile errors: ' . implode(', ', $result['error-codes']));
            }

            return $result['success'] ?? false;
        } catch (\Exception $e) {
            error_log('Turnstile verification error: ' . $e->getMessage());
            return false;
        }
    }
}
