<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tom_task".
 *
 * @property int $id
 * @property int $project_id
 * @property string $name
 * @property string|null $start_date
 * @property string|null $end_date
 */
class TomTask extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tom_task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'project_id', 'name'], 'required'],
            [['id', 'project_id'], 'integer'],
            [['name'], 'string'],
            [['start_date', 'end_date'], 'safe'],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_id' => 'Project ID',
            'name' => 'Name',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
        ];
    }

    public function getByProject($id)
    {
        $query = new \yii\db\Query();
        return $query->from(['task' => 'tom_task'])->where('`task`.`project_id` = ' . $id)->all();
    }

    public function percentDone($id)
    {
        $query = new \yii\db\Query();
        return $query->from(['task' => 'tom_task'])
            ->select(['avg' => 'AVG(rep.percent_done)'])
            ->innerJoin(['rep' => 'tom_report'], '`task`.`id` = `task_id`')
            ->where('`task`.`id` = ' . $id)->one();
    }
}
