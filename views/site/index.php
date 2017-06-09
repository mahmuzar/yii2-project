<?php
/* @var $this yii\web\View */
/* @var $model */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="container-fluid text-center">    
        <div class="row content">
            <div class="col-sm-2 sidenav">
                <?php
                $form = ActiveForm::begin(
                                [
                                    'id' => 'add-product',
                                    'options' => ['enctype' => 'multipart/form-data']
                                ]
                );
                ?>

                <?= $form->field($model, 'categoryId')->dropDownList($data, ['prompt' => 'Выберите категорию']) ?>
                <?= $form->field($model, 'categoryId')->checkboxList(['красный', 'черный', 'белый']) ?>




                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'create-category-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>


            </div>
            <div id="treto" >

            </div>
            <button id="button">тест</button>

        </div>
    </div>

</div>
