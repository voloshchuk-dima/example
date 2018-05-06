<?php

namespace frontend\models\order;

use yii\web\HttpException;
use DateTime;
use common\models\Order As OrderM;

class OrderValidator
{
    /**
     * Проверяет валидность данных
     *
     * @param $postData - данные полученные из формы
     * @throws HttpException
     */
    public static function validator($postData)
    {
        $dateNow = new DateTime();
        $model = new OrderM();
        $model->full_name = $postData['fullName'];
        $model->domain = $postData['domain'];
        $model->email = $postData['email'];
        $model->phone = $postData['phone'];
        $model->lang_code = $postData['langId'];
        $model->created_at = $dateNow->format('Y-m-d H:i:s');

        if (!$model->validate()) {
            $errors['input_errors'] = $model->errors;
            $errors = json_encode($errors);
            throw new HttpException(400, $errors);
        }
    }
}