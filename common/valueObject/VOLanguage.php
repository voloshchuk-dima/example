<?php

namespace common\valueObject;

use common\models\LanguageModel;

/**
 * Value Object для языка
 *
 * @package common\models
 */
class VOLanguage
{
    /**
     * Версия сайта
     *
     * @var string
     */
    private $language;

    /**
     * Language constructor.
     * @param string $language - Версия сайта
     */
    public function __construct(string $language)
    {
        if (empty($language)) {
            throw new InvalidArgumentException('Empty language');
        }
        
        $languageModel = LanguageModel::find()->where(['language_id' => $language, 'status' => LanguageModel::STATUS_ACTIVE])->one();
        if (empty($languageModel)) {
            throw new InvalidArgumentException('No such language');
        }
        
        $this->language = $language;
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
        return $this->language;
    }
}