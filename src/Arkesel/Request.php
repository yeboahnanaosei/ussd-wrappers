<?php
declare(strict_types=1);

namespace Yeboahnanaosei\Ussd\Arkesel;


use Yeboahnanaosei\Ussd\Request as UssdSession;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

class Request implements UssdSession
{
    private bool $newSession;
    public string $userId;

    public string $sessionId;
    private string $msisdn;
    private string $userData;
    public string $network;

    public function __construct(HttpRequest $request)
    {
        $payload = $request->toArray();
        $this->sessionId = trim($payload["sessionID"]);
        $this->userId = trim($payload["userID"]);
        $this->newSession = (bool)$payload["newSession"];
        $this->msisdn = trim($payload["msisdn"]);
        $this->userData = trim($payload["userData"]);
        $this->network = trim($payload["network"]);
    }

    public function getId(): string
    {
        return $this->sessionId;
    }

    public function isNew(): bool
    {
        return $this->newSession;
    }

    public function getPhoneNumber(): string
    {
        return $this->msisdn;
    }

    public function getUserInput(): string
    {
        return $this->userData;
    }
}