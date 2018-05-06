<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\MaskedInput;
?>


<?php $form = ActiveForm::begin([
    'action' => false,
    'id' => 'from-order'
]); ?>
    
<?php echo $form->field($model, 'full_name')->textInput(['placeholder'=> Yii::t('order', 'Name')])->label(false); ?>
    
<?php echo $form->field($model, 'domain')->textInput(['placeholder'=> Yii::t('order', 'www.site.com')])->label(false); ?>
    
<?php echo $form->field($model, 'email')->textInput(['placeholder'=> Yii::t('order', 'Email')])->label(false); ?>
    
<?php echo $form->field($model, 'phone')->textInput(['placeholder'=> Yii::t('order', 'Phone')])->label(false); ?>
    
<?php echo Html::submitButton(Yii::t('order', 'Send Request'), ['class' => 'btn btn-block']) ?>
    
<?php ActiveForm::end(); ?>