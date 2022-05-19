<?php

namespace app\models;

use Yii;

use function Symfony\Component\String\b;

/**
 * This is the model class for table "tom_project".
 *
 * @property int $id
 * @property string $name
 */
class TomProject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tom_project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    public function list()
    {
        return self::find()->all();
    }


    public function percentDone($id)
    {
        $query = new \yii\db\Query();
        return $query->from(['proj' => 'tom_project'])
            ->select(['avg' => 'AVG(rep.percent_done)'])
            ->innerJoin(['task' => 'tom_task'], '`proj`.`id` = `project_id`')
            ->innerJoin(['rep' => 'tom_report'], '`task`.`id` = `task_id`')
            ->where('`proj`.`id` = ' . $id)->one();
    }
}
