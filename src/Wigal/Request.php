<?php
declare(strict_types=1);

namespace Yeboahnanaosei\Ussd\Wigal;

use Symfony\Component\HttpFoundation\Request as HttpRequest;
use Yeboahnanaosei\Ussd\Request as UssdSession;
use Yeboahnanaosei\Ussd\Exception\BadRequestException;

class Request implements UssdSession
{
    public ?string $network;

    public ?string $sessionId;

    public ?string $mode;

    public ?string $msisdn;

    public ?string $userData;

    public ?string $username;

    public ?string $trafficId;

    public ?string $other;

    /**
     * @param HttpRequest $request
     * @throws BadRequestException
     */
    public function __construct(HttpRequest $request)
    {
        $network = $request->get("network");
        if ($network === null) {
            throw new BadRequestException("missing query parameter: 'network'");
        }
        $this->network = $network;

        $mode = $request->get("mode");
        if ($mode === null) {
            throw new BadRequestException("missing query parameter: 'mode'");
        }
        $this->mode = $mode;

        $msisdn = $request->get("msisdn");
        if ($msisdn === null) {
            throw new BadRequestException("missing query parameter: 'msisdn'");
        }
        $this->msisdn = $msisdn;

        $sessionId = $request->get("sessionid");
        if ($sessionId === null) {
            throw new BadRequestException("missing query parameter: 'sessionid'");
        }
        $this->sessionId = $sessionId;


        $username = $request->get("username");
        if ($username === null) {
            throw new BadRequestException("missing query parameter: 'username'");
        }
        $this->username = $username;

        $trafficId = $request->get("trafficid");
        if ($trafficId === null) {
            throw new BadRequestException("missing query parameter: 'trafficid'");
        }
        $this->trafficId = $trafficId;

        $this->userData = $request->get("userdata", "");
        $this->other = $request->get("other", "");
        return $this;
    }

    public function getId(): string
    {
        return $this->sessionId;
    }

    public function isNew(): bool
    {
        return strtolower($this->mode) === "start";
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