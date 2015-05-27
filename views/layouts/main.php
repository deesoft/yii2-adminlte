<?php

use yii\helpers\Html;
use dee\adminlte\assets\AdminlteAsset;


/* @var $this \yii\web\View */
/* @var $content string */

AdminlteAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <?php $this->beginBody() ?>
    <body class="skin-blue">
        <header class="header">
            <?php echo $this->render('heading'); ?>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <aside class="right-side">
                <section class="content-header">
                    <h1>
                        <?= Html::encode($this->title) ?>
                        <small></small>
                    </h1>
                </section>
                <section class="content">
                    <?= $content ?>
                </section>
            </aside>            
            <aside class="left-side sidebar-offcanvas">
                <?php echo $this->render('sidebar'); ?>
            </aside>
        </div>
    </div>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
