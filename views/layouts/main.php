<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use kartik\sidenav\SideNav;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link src="main.css" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>
    <div class="row">
        <div class="col-md-3 col-sm-12">
            <div class="jumbotron text-left">
                <?php

                echo Nav::widget([
                    'options' => [
                        'class' => 'nav flex-column nav-pills nav-fill ',
                    ],
                    'items' => [
                        ['label' => 'Home', 'url' => ['/site/index'], 'options' => ['class' => 'text-left']],
                        ['label' => 'Projects', 'url' => ['/site/projects'], 'options' => ['class' => 'text-left']],
                        ['label' => 'About', 'url' => ['/site/about'], 'options' => ['class' => 'text-left']],
                        Yii::$app->user->isGuest ? (['label' => 'Login', 'url' => ['/site/login'], 'options' => ['class' => 'text-left']]
                        ) : ('<li>'
                            . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline text-left'])
                            . Html::submitButton(
                                'Logout (' . Yii::$app->user->identity->username . ')',
                                ['class' => 'btn btn-link logout text-primary text-left']
                            )
                            . Html::endForm()
                            . '</li>'
                        ),
                        Yii::$app->user->isGuest ? (['label' => 'Register', 'url' => ['/site/signup'], 'options' => ['class' => 'text-left']]
                        ) : ('')
                    ],
                ]);

                ?>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <main role="main" class="flex-shrink-0">
                <div class="container">
                    <?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
                    <?= Alert::widget() ?>
                    <?= $content ?>
                </div>
            </main>
        </div>
        <div class="col-md-3 col-sm-12"></div>
    </div>

    <footer class="footer mt-auto py-3 text-muted">
        <div class="container">
            <p class="float-left">&copy; My Company <?= date('Y') ?></p>
            <p class="float-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>