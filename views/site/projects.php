<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var app\models\SignupForm $model */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\bootstrap4\Progress;
use yii\bootstrap4\Accordion;

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-projets">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    foreach ($projects as $project) { ?>
        <div class="jumbotron">
            <h2> <?= $project["name"] ?> </h2>

            <?php
            echo "percent done: " . round($project["done"]) . "%";
            echo Progress::widget([
                'percent' =>  $project["done"],
                'barOptions' => ['class' => ['bg-primary', 'progress-bar-striped']]
            ]);
            $array = [];
            foreach ($project["tasks"] as $task) {
                $reports = $reportModel->getByTask($task["id"]);
                $html = "";
                if (sizeof($reports) ==  0) {
                    $html .= "<span> No reports </span>";
                }
                foreach ($reports as $report) {
                    $html .= "<span>" . $report["name"] . "</span>";
                    $html .= "<span> Percent done: " . $report["percent_done"] . "%</span>";
                    $html .= Progress::widget([
                        'percent' =>  $report["percent_done"],
                        'barOptions' => ['class' => ['bg-primary', 'progress-bar-striped']]
                    ]);
                }

                $percentDoneTask = round($taksModel->percentDone($task["id"])["avg"]);
                if ($percentDoneTask != null) {
                    $taskDescription = " Percent done : " . $percentDoneTask . "%";
                } else {
                    $taskDescription = " No reports added";
                }

                $array[] = [
                    "label" => $task["name"] . $taskDescription,
                    "content" => $html
                ];
            }
            echo Accordion::widget([
                'items' => $array,
                'options' => ['class' => ['mt-5']]
            ]);
            ?>
        </div>
    <?php
    }
    ?>

</div>