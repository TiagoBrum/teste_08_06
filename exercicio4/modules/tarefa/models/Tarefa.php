<?php
namespace app\modules\tarefa\models;

use yii\db\ActiveRecord;

/**
 * Cliente is the model behind the cliente form.
 */
class Tarefa extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public static function tableName()
    {
        return '{{tarefas}}';
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['id', 'titulo', 'descricao', 'prioridade'], 'required'],
            [['id', 'titulo', 'descricao', 'prioridade'], 'safe', 'on' => 'search'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'titulo' => 'titulo',
            'descricao' => 'descricao',
            'prioridade' => 'prioridade',
        ];
    }

    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('title', $this->title);
        $criteria->compare('titulo', $this->titulo, true);
        $criteria->compare('descricao', $this->descricao, true);
        $criteria->compare('prioridade', $this->prioridade, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
}
