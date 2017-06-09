<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\Response;
use app\models\ProductImages;
class AjaxController extends Controller {

    function actionProductImages() {
        if (Yii::$app->request->isAjax) {
            $images = new ProductImages();
            
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $images->findAll();
        }
        
    }

}
