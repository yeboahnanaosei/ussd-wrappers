<?php
declare(strict_types=1);

namespace Yeboahnanaosei\Ussd\Arkesel;

use Yeboahnanaosei\Ussd\Aggregator;
use Yeboahnanaosei\Ussd\Arkesel\Request as ArkeselSession;
use Yeboahnanaosei\Ussd\Request;
use Symfony\Component\HttpFoundation\Request;

class Client implements Aggregator
{
    private ArkeselSession $session;

    public function parseRequest(Request $request): Request
    {
        $session = new ArkeselSession($request);
        $this->session = $session;
        return $this->session;
    }

    public function continueSession(string $message)
    {
        http_response_code(200);
        header("Content-Type: application/json");
        echo json_encode([
            'sessionID' => $this->session->sessionId,
            'userID' => $this->session->userId,
            'msisdn' => $this->session->getPhoneNumber(),
            'message' => $message,
            'continueSession' => true,
        ]);
    }

    public function terminateSession(string $message)
    {
        http_response_code(200);
        header("Content-Type: application/json");
        echo json_encode([
            'sessionID' => $this->session->sessionId,
            'userID' => $this->session->userId,
            'msisdn' => $this->session->getPhoneNumber(),
            'message' => $message,
            'continueSession' => false,
        ]);
    }
}