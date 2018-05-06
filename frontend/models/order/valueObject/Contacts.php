<?php

namespace frontend\models\order\valueObject;

use common\valueObject\Domain;
use common\valueObject\Email;
use common\valueObject\Phone;

class Contacts {
    /**
     * @var Email
     */
    private $email;

    /**
     * @var Phone
     */
    private $phone;

    /**
     * @var Domain
     */
    private $domain;

    /**
     * Contacts constructor.
     * @param Email $email
     * @param Phone $phone
     * @param Domain $domain
     */
    public function __construct(Email $email, Phone $phone, Domain $domain) {
        $this->email = $email;
        $this->phone = $phone;
        $this->domain = $domain;
    }

    /**
     * @return Email
     */
    public function getEmail() : Email
    {
        return $this->email;
    }

    /**
     * @return Phone
     */
    public function getPhone() : Phone
    {
        return $this->phone;
    }

    /**
     * @return Domain
     */
    public function getDomain() : Domain
    {
        return $this->domain;
    }
}