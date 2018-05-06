<?php

namespace frontend\models\order;

use frontend\models\order\valueObject\Contacts;
use frontend\models\order\valueObject\FullName;
use common\valueObject\VOLanguage;
use common\valueObject\Email;
use common\valueObject\Phone;
use common\valueObject\Domain;
use DateTime;

class Order
{
    /**
     * Полное имя
     *
     * @var string
     */
    private $fullName;

    /**
     * Контакты
     *
     * @var Contacts
     */
    private $contacts;

    /**
     * Версия сайта
     *
     * @var Language
     */
    private $language;

    /**
     * Дата создания
     *
     * @var DateTime
     */
    private $createdAt;

    /**
     * Order constructor.
     * @param FullName $fullName
     * @param Contacts $contacts
     * @param Language $language
     */
    public function __construct(FullName $fullName, Contacts $contacts, VOLanguage $language)
    {
        $this->fullName = $fullName;
        $this->contacts = $contacts;
        $this->language = $language;
        $this->createdAt = new DateTime();
    }

    /**
     * Восстанавливает объект из данных
     *
     * @param $statement
     * @return Order
     */
    public static function from_statement($statement)
    {
        if (!is_array($statement) && !is_object($statement)) {
            throw new InvalidArgumentException('Неправильный тип данных для метода fromStatement');
        }

        if (is_array($statement)) {
            $statement = (object) $statement;
        }

        $fullName = new FullName($statement->full_name);
        $email = new Email($statement->email);
        $phone = new Phone($statement->phone);
        $domain = new Domain($statement->domain);
        $language = new Language($statement->lang_code);

        $contasts = new Contacts($email, $phone, $domain);

        $order = new Order($fullName, $contasts, $language);

        return $order;
    }

    /**
     * @return FullName
     */
    public function getFullName() : FullName
    {
        return  $this->fullName;
    }

    public function getContacts() : Contacts
    {
        return $this->contacts;
    }

    /**
     * @return Language
     */
    public function getLanguage() : VOLanguage
    {
        return $this->language;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt() : DateTime
    {
        return $this->createdAt;
    }
}