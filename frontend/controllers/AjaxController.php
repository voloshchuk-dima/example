<?php

namespace frontend\controllers;

use Yii;
use common\valueObject\Email;
use common\valueObject\Phone;
use common\valueObject\Domain;
use common\valueObject\VOLanguage;
use frontend\models\order\valueObject\FullName;
use frontend\models\order\valueObject\Contacts;
use frontend\models\order\Order;
use frontend\models\order\OrderRepository;
use frontend\models\order\OrderValidator;
use Exception;

class AjaxController extends BaseAjaxController
{
    public function actionSendOrder()
    {
        try {
            $postData = Yii::$app->request->post();

            OrderValidator::validator($postData);

            $language = new VOLanguage($postData['langId']);
            $fullName = new FullName($postData['fullName']);
            $email = new Email($postData['email']);
            $phone = new Phone($postData['phone']);
            $domain = new Domain($postData['domain']);
            $contasts = new Contacts($email, $phone, $domain);
            $order = new Order($fullName, $contasts, $language);

            OrderRepository::instance()->save($order);

            $message = Yii::t('order', 'Thank you! We will call you back!', [], Yii::$app->language);
            $code = 200;

        } catch (HttpException $exception) {
            $code = $exception->statusCode;
            $message = $exception->getMessage();
            Yii::error($exception->getMessage());
        } catch (Exception $exception) {
            $code = 400;
            $message['common_error'] = Yii::t('order', 'Something went wrong. Please try again!', [], Yii::$app->language);
            $message = json_encode($message);
            Yii::error($exception->getMessage());
        }

        return [
            'code' => $code,
            'message' => $message
        ];
    }
}