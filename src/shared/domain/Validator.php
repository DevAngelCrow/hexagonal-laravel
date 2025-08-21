<?php

namespace Src\shared\domain;

use Src\shared\domain\DomainException;

/**
 * Validador de campos primitivos como values_objects, etc
 * @author Isaac <test@email.com>
 * @version 1.0
 */
class Validator
{

    protected mixed $value;

    /**
     * @var DomainException
     */
    protected  $exception;


    /**
     * Constructor
     *
     * @param mixed $value
     * @param DomainException  $exception
     */
    public function __construct(mixed $value,  $exception)
    {
        $this->value = $value;

        if (!is_subclass_of($exception, DomainException::class)) {
            throw new DomainException('Invalid exception type validator');
        }

        $this->exception = $exception;
    }

    public function required(string $message = 'Field is required'): Validator
    {
        if (empty($this->value)  || !isset($this->value)) {
            throw new $this->exception($message);
        }

        return $this;
    }

    public function email(string $message = 'Invalid email format'): Validator
    {
        if (!filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
            throw new $this->exception($message);
        }

        return $this;
    }

    public function number(string $message = 'Invalid number format'): Validator
    {
        if (!is_numeric($this->value)) {
            throw new $this->exception($message);
        }

        return $this;
    }

    public function positiveInteger(string $message = 'Invalid positive integer format'): Validator
    {
        if (!is_int($this->value) || $this->value <= 0) {
            throw new $this->exception($message);
        }

        return $this;
    }

    public function string(string $message = 'Invalid string format'): Validator
    {
        if (!is_string($this->value)) {
            throw new $this->exception($message);
        }

        return $this;
    }


    public function uuid(string $message = 'Invalid UUID format'): Validator
    {
        if (!preg_match(
            '/^[0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i',
            $this->value
        )) {
            throw new $this->exception($message);
        }

        return $this;
    }

    public function ip(string $message = 'Invalid IP address format'): Validator
    {
        if (!filter_var($this->value, FILTER_VALIDATE_IP)) {
            throw new $this->exception($message);
        }

        return $this;
    }

    public function minLength(int $length, string $message = 'Invalid string length'): Validator
    {
        if (strlen($this->value) < $length) {
            throw new $this->exception($message);
        }

        return $this;
    }

    public function maxLength(int $length, string $message = 'Invalid string length'): Validator
    {
        if (strlen($this->value) > $length) {
            throw new $this->exception($message);
        }

        return $this;
    }
}
