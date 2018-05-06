<?php

namespace frontend\models\order\valueObject;

use InvalidArgumentException;

class FullName
{
    /**
     * ФИО
     *
     * @var string
     */
    private $fullName;

    /**
     * FullName constructor.
     * @param $fullName - ФИО
     */
    public function __construct($fullName) {
        if (empty($fullName)) {
            throw new InvalidArgumentException('ФИО не должно быть пустым');
        }

        if (!preg_match('/^[^0-9%!@#$&*()~?<>,.=+{};:]+$/ui', $fullName)) {
            throw new InvalidArgumentException('ФИО должно содержать только буквы!');
        }

        $this->fullName = $fullName;
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
        return $this->fullName;
    }
}