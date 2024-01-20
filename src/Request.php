<?php
declare(strict_types=1);

namespace Yeboahnanaosei\Ussd;

interface Request
{
    /**
     * Returns the id of the session.
     *
     * @return string The unique id for the session.
     */
    public function getId(): string;

    /**
     * Indicates whether this is a new session or an ongoing session.
     *
     * @return bool
     */
    public function isNew(): bool;

    /**
     * Returns the phone number for the session.
     *
     * @return string
     */
    public function getPhoneNumber(): string;

    /**
     * Returns the user's input
     *
     * @return string
     */
    public function getUserInput(): string;
}