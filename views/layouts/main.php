<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => 'Принцесса Сафия',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems = [
                ['label' => 'Home', 'url' => ['/site/index']],
                ['label' => 'About', 'url' => ['/site/about']],
                ['label' => 'Contact', 'url' => ['/site/contact'],],
                Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
                ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
                )
            ];
            $adminMenuItems = [
                ['label' => 'Добавить категорию', 'url' => ['/site/create-category']],
                ['label' => 'Добавить товар', 'url' => ['/site/add-product']],
                Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
                ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
                )
            ];
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => Yii::$app->user->identity === null ? ($menuItems) : (Yii::$app->user->identity->role > 10 ? ($menuItems) : ($adminMenuItems)),
            ]);
            NavBar::end();
            ?>

            <div class="container">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container-fluid">
                <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>

        <?php $this->endBody() ?>
        <script>
            var images;
            $("#button").click(function () {
                $.ajax({
                    url: '?r=ajax/product-images',
                    success: function (data) {
                        images = data;
                        ready();
                    }
                });
            });

        </script>
        <script>
            var heights = [];
            function ready() {
                
                treto.innerHTML = '';
                //alert('d');
                //var img_style
                var key = true;
                var countTr = 0;
                for (var i = 0, l = images.length; i < l; i++) {

                    if (countTr == 8) {
                        //break;
                    }
                    if (key) {
                        var tr_main = document.createElement('div');
                        tr_main.classList.add("tr_main");
                        treto.appendChild(tr_main);
                        var tr_main_style = getComputedStyle(tr_main);
                        //console.log(tr_main_style);
                        var treto_style = getComputedStyle(treto);
                        key = false;
                        var new_width = 0.0;
                        var img_style;
                        var img_marginleft_sum = 0.0;

                    }
                    //alert(key);
                    //console.log(tr_main);
//alert(key);
                    //console.log(tr_main.clientWidth);
                    //console.log(treto.clientWidth);
                    //alert(tr_width);
                    var img_div = document.createElement('div');
                    img_div.classList.add('img_div');
                    var img = document.createElement('img');
                    img.src = "/uploads/images/" + images[i].name;
                    img_div.appendChild(img);

                    //img.src = images[i];

                    tr_main.appendChild(img_div);
                    img_style = getComputedStyle(img);
                    //console.log(img_style);
                    var img_div_style = getComputedStyle(img_div);
                    var img_div_width = img_div_style.width;
                    var img_width = img_style.width;

                    var img_margin_left = img_style.marginLeft;
                    var img_div_margin_left = img_div_style.marginLeft;

                    img_div_margin_left = img_div_margin_left.substr(0, img_div_margin_left.length - 2);
                    img_div_margin_left = parseFloat(img_div_margin_left);

                    img_width = img_width.substr(0, img_width.length - 2);
                    img_width = parseFloat(img_width);

                    img_div_width = img_div_width.substr(0, img_div_width.length - 2);
                    img_div_width = parseFloat(img_div_width);
                    new_width = new_width + img_width;
                    //сумма отступов
                    img_margin_left = img_margin_left.substr(0, img_margin_left.length - 2);
                    img_margin_left = parseFloat(img_margin_left);
                    img_marginleft_sum += img_margin_left;
                    //alert(new_width);
                    //alert(img_div_width);
                    //alert(img_style.width);
                    console.log('div :' + img_div_width + " img: " + img_style.width);
                    if (new_width <= (treto.clientWidth / 2) + 100) {
                    } else {
                        //alert('d');

                        //tr_main.style.height = tr_main_style.height;

                        //tr_main_style = getComputedStyle(tr_main);

                        var tr_height = tr_main_style.height;
                        var tr_width = tr_main_style.width;
                        var tr_margin_top = tr_main_style.marginTop;
                        var tr_margin_bottom = tr_main_style.marginBottom;

                        tr_margin_top = tr_margin_top.substr(0, tr_margin_top.length - 2);
                        tr_margin_bottom = tr_margin_bottom.substr(0, tr_margin_bottom.length - 2);

                        tr_height = tr_height.substr(0, tr_height.length - 2);

                        tr_width = tr_width.substr(0, tr_width.length - 2);
                        //alert(Number(tr_height));
                        //console.log(tr_height);
                        //console.log(i);
                        tr_margin_top = parseFloat(tr_margin_top);
                        tr_margin_bottom = parseFloat(tr_margin_bottom);

                        tr_height = parseFloat(tr_height);
                        tr_width = parseFloat(tr_width);

                        var treto_widnt = treto_style.width;
                        treto_widnt = treto_widnt.substr(0, treto_widnt.length - 2);
                        treto_widnt = parseFloat(treto_widnt);
                        //tr_width = tr_width + 0.5;
                        //alert(tr_width);
                        tr_height -= 0.355;
                        console.log(treto_widnt + ' : ' + new_width);
                        //console.log(new_width);
                        //alert(img_marginleft_sum);
                        h = (tr_height * ((treto_widnt * 100.0) / new_width)) / 100.0;
                        h = (h * ((treto_widnt * 100.0) / (treto_widnt + img_marginleft_sum))) / 100.0;
                        //hh = (0.1 * ((0.1 * 100.0) / 10)) / 100.0;
                        //alert(hh);
                        //h = ((tr_height - tr_margin_bottom) * ((treto_widnt * 100.0) / new_width)) / 100.0;
                        //hh = tr_height +((tr_height * (((treto_widnt - new_width) * 100.0) / treto_widnt)) / 100.0);
                        //hhh = (tr_height * ((treto_widnt * 100.0) / tr_width)) / 100.0;
                        //hhh = (((100.0 * new_width) * tr_height) / treto_widnt) / 100;
                        //hhhh =tr_height -(hhh - tr_height)
                        //alert(hhh);
                        // alert(h);
                        //alert(tr_main_style.width);
                        //alert(tr_height);
                        //tr_height = tr_height + i;
                        //console.log(tr_height);
                        tr_main.style.height = h + 'px';
                        //alert(tr_main.style.height);
                        // break;
                        //alert(tr_main.clientWidth);
                        //console.log(i);

                        countTr++;
                        // alert('test');
                        key = true;
                        //alert(tr_main.clientWidth);
                        //alert(tr_main_style.width);
                        //alert(tr_main.clientWidth);
                        //console.log(tr_main.style.height);
                        //alert(tr_main.style.height);
                        //break;




                        //alert('d'+tr_main.style.height);
                        //

                    }

                }
            }
            //ready();
            window.onload = ready;

            window.onresize = ready;
            /*
             treto.onclick = function (e) {
             console.log(e.target);
             elem = e.target;
             if (elem.tagName == 'IMG') {
             
             image_view.appendChild(elem);
             
             //image_view.style.width = "100%";
             image_view.style.height = "500px";
             //alert('img');
             }
             };
             */
            function req() {

            }
            //window.onresize = ready;
        </script>
    </body>
</html>
<?php $this->endPage() ?>
