<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Application/Ports/Out/EmailSenderPort.php';
require_once __DIR__ . '/../../../Domain/Models/EmailDestinationModel.php';
require_once __DIR__ . '/../../../Domain/Exceptions/EmailSenderException.php';

final class EmailSenderService implements EmailSenderPort
{
    private string $host;
    private string $username;
    private string $password;
    private string $fromAddress;
    private string $fromName;
    private string $encryption;
    private int $port;

    public function __construct(
        string $host,
        string $username,
        string $password,
        string $fromAddress,
        string $fromName,
        string $encryption = 'tls',
        int $port = 587
    ) {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->fromAddress = $fromAddress;
        $this->fromName = $fromName;
        $this->encryption = $encryption;
        $this->port = $port;
    }

    public function send(EmailDestinationModel $destination): void
    {
        $apiKey = trim($this->password);
        $fromEmail = trim($this->fromAddress) !== '' ? trim($this->fromAddress) : 'onboarding@resend.dev';

        $payload = json_encode([
            'from' => $this->fromName . ' <' . $fromEmail . '>',
            'to' => [$destination->getDestinationEmail()],
            'subject' => $destination->getSubject(),
            'html' => $destination->getBody(),
        ]);

        $ch = curl_init('https://api.resend.com/emails');
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_TIMEOUT => 15,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $apiKey,
                'Content-Type: application/json',
            ],
            CURLOPT_POSTFIELDS => (string) $payload,
        ]);

        $response = curl_exec($ch);
        $httpCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($response === false || $httpCode < 200 || $httpCode >= 300) {
            throw new EmailSenderException(
                'No se pudo enviar el correo a ' . $destination->getDestinationEmail()
                . '. Error API (' . $httpCode . '): ' . ($curlError !== '' ? $curlError : (string) $response)
            );
        }
    }
}