<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "automezzo".
 *
 * @property int $id
 * @property string $marca
 * @property string $modello
 * @property string $targa
 * @property string $created
 * @property string $data_immatricolazione
 * @property string $data_ultimo_rinnovo_assicurazione
 * @property string $data_scadenza_assicurazione
 * @property string $data_ultima_revisione
 * @property string $data_prossima_revisione
 *
 * @property Tagliando[] $tagliandos
 */
class Automezzo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}x2
     */
    public static function tableName()
    {
        return 'automezzo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['targa', 'created'], 'required'],
            [['marca', 'modello', 'data_immatricolazione', 'data_ultimo_rinnovo_assicurazione', 'data_scadenza_assicurazione', 'data_ultima_revisione', 'data_prossima_revisione'], 'safe'],
            [['marca', 'modello', 'targa'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'marca' => 'Marca',
            'modello' => 'Modello',
            'targa' => 'Targa',
            'created' => 'Inserito',
            'data_immatricolazione' => 'Immatricolazione',
            'data_ultimo_rinnovo_assicurazione' => 'Rinnovo Assicurazione',
            'data_scadenza_assicurazione' => 'Scadenza Assicurazione',
            'data_ultima_revisione' => 'Ultima Revisione',
            'data_prossima_revisione' => 'Prossima Revisione',
        ];
    }

    /**
     * check if value is expiring
     */
    public function isExpiring($value){
        $today      = date("Y-m-d H:i:s");
        $maxRange   = date('Y-m-d H:i:s', strtotime($today . ' +10 day'));

        return ($this->$value > $today) && ($this->$value <= $maxRange) ? true : false;
    }

    /**
     * Gets query for [[Tagliandos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTagliandos()
    {
        return $this->hasMany(Tagliando::className(), ['id_automezzo' => 'id']);
    }

    public function formatDate($value, $showHour = false){
        $format = "d/m/Y";
        if($showHour)
            $format = "d/m/Y H:i:s";

        return !empty($value) ? date($format, strtotime($value)) : "";
    }

    public function convertDate($value){
        $tmp = explode("-", $value);
        return $tmp !== false ?$tmp[2]."-".$tmp[1]."-".$tmp[0] : "";
    }

}
