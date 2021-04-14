<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "operaio".
 *
 * @property int $id
 * @property string $nome
 * @property string $cognome
 * @property string $codice_fiscale
 * @property string $ruolo
 */
class Operaio extends \yii\db\ActiveRecord
{

    public $roles  = [0 => "Autista", 1 => "Amministrazione"];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'operaio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'cognome', 'codice_fiscale', 'ruolo'], 'required'],
            [['nome', 'cognome', 'ruolo'], 'string', 'max' => 255],
            [['codice_fiscale'], 'string', 'max' => 16],
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
            'cognome' => 'Cognome',
            'codice_fiscale' => 'Codice Fiscale',
            'ruolo' => 'Ruolo',
        ];
    }

    public function getRole(){
        return $this->roles[$this->ruolo];
    }
}
