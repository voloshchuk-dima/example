<?php

namespace frontend\models\order;

use yii\web\HttpException;
use common\models\Order As OrderM;

class OrderRepository
{
    /**
     * Model Order
     *
     * @var OrderM
     */
    private $model;

    /**
     * OrderRepository constructor
     */
    public function __construct()
    {
        $this->model = new OrderM();
    }

    /**
     * Создаёт новый instance текущего репозитория
     *
     * @return OrderRepository
     */
    public static function instance()
    {
        return new self();
    }

    /**
     * Сохраняет заказ
     *
     * @param Order $order
     * @throws HttpException
     */
    public function save(Order $order) : void
    {
        $this->model->full_name = $order->getFullName()->get();
        $this->model->domain = $order->getContacts()->getDomain()->get();
        $this->model->email = $order->getContacts()->getEmail()->get();
        $this->model->phone = $order->getContacts()->getPhone()->get();
        $this->model->lang_code = $order->getLanguage()->get();
        $this->model->created_at = $order->getCreatedAt()->format('Y-m-d H:i:s');

        if (!$this->model->save()) {
            $message = Yii::t('order', 'Failed to save!', [], $order->getLanguage()->get());
            throw new HttpException(500, $message);
        }
    }
}