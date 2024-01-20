<?php
declare(strict_types=1);

namespace Yeboahnanaosei\Ussd\Nalo;

use Yeboahnanaosei\Ussd\Aggregator;
use Yeboahnanaosei\Ussd\Nalo\Request as NaloSession;
use Yeboahnanaosei\Ussd\Request as UssdSession;
use Symfony\Component\HttpFoundation\Request;

class Client implements Aggregator
{

    private Request $session;
    public function parseRequest(Request $request): UssdSession
    {
        $session = new NaloSession($request);
        $this->session = $session;
        return $session;
    }

    public function continueSession(string $message)
    {
        http_response_code(200);
        header("Content-Type: application/json");
        echo json_encode([
            'USERID' => $this->session->userId,
            'MSISDN' => $this->session->phoneNumber(),
            'MSG' => $message,
            'MSGTYPE' => true,
        ]);
    }

    public function terminateSession(string $message)
    {
        http_response_code(200);
        header("Content-Type: application/json");
        echo json_encode([
            'USERID' => $this->session->userId,
            'MSISDN' => $this->session->phoneNumber(),
            'MSG' => $message,
            'MSGTYPE' => false,
        ]);
    }
}