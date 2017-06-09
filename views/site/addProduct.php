<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model yii\models\CreatePostForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Добавление новой категории';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (Yii::$app->session->hasFlash('postFormSabmited')) { ?>
        <div class="alert alert-success">
            Тема создана    
        </div>
    <?php } else { ?>
        <div class="row">
            <div class="col-lg-5">

                <?php
                $form = ActiveForm::begin(
                                [
                                    'id' => 'add-product',
                                    'options' => ['enctype' => 'multipart/form-data']
                                ]
                );
                ?>

                <?= $form->field($model, 'categoryId')->dropDownList($data, ['prompt' => 'Выберите категорию']) ?>
                <?= $form->field($model, 'name')->textInput() ?>
                <?= $form->field($model, 'description')->textarea() ?>
                <?= $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']); ?>


                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'create-category-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    <?php } ?>
</div>