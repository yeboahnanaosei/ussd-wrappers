<?php
declare(strict_types=1);

namespace Yeboahnanaosei\Ussd;

use Symfony\Component\HttpFoundation\Request as HttpRequest;
use Yeboahnanaosei\Ussd\Exception\BadRequestException;

interface Aggregator
{
    /**
     * Parses the request and returns an aggregator specific session.
     *
     * @param HttpRequest $request The incoming HTTP request
     * @return Request The aggregator's session object
     *@throws BadRequestException
     */
    public function parseRequest(HttpRequest $request): Request;

    /**
     * Instructs the aggregator to continue the USSD session.
     *
     * @param string $message The message displayed to the user.
     * @return mixed
     */
    public function continueSession(string $message);

    /**
     * Terminate session instructs the aggregator to terminate the USSD session.
     *
     * @param string $message The message to be displayed to the user.
     * @return mixed
     */
    public function terminateSession(string $message);
}
