<?php

namespace common\valueObject;

use InvalidArgumentException;

class Phone
{

    /**
     * Телефон
     *
     * @var string
     */
    private $phone;

    /**
     * Phone constructor.
     * @param $phone
     */
    public function __construct($phone)
    {
        if (empty($phone)) {
            throw new InvalidArgumentException('Номер нелефона не должен быть пустым!');
        }

        if (!preg_match('/^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$/', $phone)) {
            throw new InvalidArgumentException('Не верный формат номера телефона!');
        }

        $this->phone = $phone;
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
        return $this->phone;
    }
}