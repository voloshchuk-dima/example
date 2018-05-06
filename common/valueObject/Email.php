<?php

namespace common\valueObject;

use InvalidArgumentException;

class Email
{
    /**
     * Email
     *
     * @var string
     */
    private $email;

    /**
     * Email constructor.
     * @param $email - email
     */
    public function __construct(string $email)
    {
        if (empty($email)) {
            throw new InvalidArgumentException('Email не должен быть пустым!');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Некорректный Email!');
        }

        $this->email = $email;
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return $this->get();
    }

    /**
     * @return string
     */
    public function get() : string
    {
        return $this->email;
    }
}