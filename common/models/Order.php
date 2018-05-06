<?php

namespace common\models;

use yii\db\ActiveRecord;

class Order extends ActiveRecord
{
    /**
     * Имя таблицы
     *
     * @return string
     */
    public static function tableName()
    {
        return '{{%orders}}';
    }
    
    /**
     * Массив валидации
     *
     * @return array
     */
    public function rules()
    {
        return [
            [['full_name', 'email', 'phone', 'created_at'], 'required'],
            [['full_name', 'email', 'lang_code', 'domain'], 'string'],
            [['email'], 'email'],
            ['full_name', 'match', 'pattern' => '/^[^0-9%!@#$&*()~?<>,.=+{};:]+$/ui'],
            ['domain', 'match', 'pattern' => '/^((http|https):\/\/)?(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)/i'],
            ['phone', 'match', 'pattern' => '/^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$/'],
            [['created_at'], 'safe'],
        ];
    }
    
    /**
     * Массив имен атрибутов
     *
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => 'Full Name',
            'domain' => 'Domain',
            'email' => 'Email',
            'phone' => 'Phone',
            'lang_code' => 'Lang',
            'created_at' => 'Order date',
        ];
    }
}