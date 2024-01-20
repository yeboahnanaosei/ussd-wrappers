<?php
declare(strict_types=1);

namespace Yeboahnanaosei\Ussd\Wigal;

use Yeboahnanaosei\Ussd\Aggregator;
use Yeboahnanaosei\Ussd\Request as UssdRequest;
use Yeboahnanaosei\Ussd\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

class Client implements Aggregator
{

    private Request $session;

    /**
     * @param HttpRequest $request
     * @return UssdRequest
     * @throws BadRequestException
     */
    public function parseRequest(HttpRequest $request): UssdRequest
    {
        $this->session = new Request($request);
        return $this->session;
    }

    public function continueSession(string $message): void
    {
        http_response_code(200);
        echo "{$this->session->network}|MORE|{$this->session->msisdn}|{$this->session->sessionId}|$message|{$this->session->username}|{$this->session->trafficId}|{$this->session->other}";
    }

    public function terminateSession(string $message): void
    {
        http_response_code(200);
        echo "{$this->session->network}|END|{$this->session->msisdn}|{$this->session->sessionId}|$message|{$this->session->username}|{$this->session->trafficId}|{$this->session->other}";
    }
}