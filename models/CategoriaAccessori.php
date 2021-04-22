<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categoria_accessori".
 *
 * @property int $id
 * @property string $nome
 */
class CategoriaAccessori extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categoria_accessori';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['color'], 'safe'],
            [['nome', 'color'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
        ];
    }
}
