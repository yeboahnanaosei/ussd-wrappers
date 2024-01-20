<?php
declare(strict_types=1);

namespace Yeboahnanaosei\Ussd\Nalo;


use Yeboahnanaosei\Ussd\Request as UssdRequest;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

class Request implements UssdRequest
{
    private bool $msgType;

    public string $userId;

    private string $sessionId;

    private string $msisdn;

    private string $userData;

    public function __construct(HttpRequest $request)
    {
        $payload = $request->toArray();
        $this->sessionId = $payload["SESSIONID"];
        $this->userId = $payload["USERID"];
        $this->msgType = (bool)$payload["MSGTYPE"];
        $this->msisdn = $payload["MSISDN"];
        $this->userData = $payload["USERDATA"];
    }

    public function getId(): string
    {
        return $this->sessionId;
    }

    public function isNew(): bool
    {
        return $this->msgType;
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