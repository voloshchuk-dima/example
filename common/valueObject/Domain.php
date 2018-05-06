<?php

namespace common\valueObject;

use InvalidArgumentException;

class Domain
{
    /**
     * Доменное имя
     *
     * @var string
     */
    private $domain;

    /**
     * Domain constructor.
     * @param $domain
     */
    public function __construct(string $domain)
    {
        if (!empty($domain) && !preg_match('/^((http|https):\/\/)?(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)/i', $domain)) {
            throw new InvalidArgumentException('Домен должнен быть правильной ссылкой!');
        }

        $this->domain = $domain;
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
        return $this->domain;
    }
}