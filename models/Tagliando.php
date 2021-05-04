<?php

namespace app\models;

use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "tagliando".
 *
 * @property int $id
 * @property int $id_automezzo
 * @property string $created
 * @property string $updated
 * @property string $note
 * @property string $allegati
 *
 * @property Automezzo $automezzo
 */
class Tagliando extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tagliando';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_automezzo', 'created'], 'required'],
            [['id_automezzo'], 'integer'],
            [['note', 'allegati', 'updated', 'costo', 'costo_con_iva'], 'safe'],
            [['note'], 'string'],
            [['allegati'], 'file', 'extensions' => ['jpg', 'png', 'jpeg', 'pdf'], 'skipOnEmpty' => true, 'maxSize' => 1024 * 1024 * 5, 'tooBig' => 'File troppo grande (Max 5MB)'],
            [['id_automezzo'], 'exist', 'skipOnError' => true, 'targetClass' => Automezzo::className(), 'targetAttribute' => ['id_automezzo' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_automezzo' => 'Automezzo',
            'created' => 'Data',
            'updated' => 'Ultima modifica',
            'note' => 'Note',
            'allegati' => 'Allegati',
            'costo' => "Costo Iva escl.",
            'costo_con_iva' => "Costo Iva incl.",
        ];
    }

    /**
     * Gets query for [[Automezzo]].
     * @return \yii\db\ActiveQuery
     */
    public function getAutomezzo()
    {
        return $this->hasOne(Automezzo::className(), ['id' => 'id_automezzo']);
    }

    public function formatDate($value, $showHour = false){
        $format = "d/m/Y";
        if($showHour)
        $format = "d/m/Y H:i:s";

        return !empty($value) ? date($format, strtotime($value)) : "";
    }

    public function getDateHour($value){
        $format = "H:i";

        return !empty($value) ? date($format, strtotime($value)) : "";
    }

    public function getAttachmentUrl($attribute) {
        $files = json_decode($this->$attribute);
        $out = [];
        if(!empty($files)){
            foreach($files as $key => $value){
                $out[$key] = Url::base() ."/".$value;
            }
        }
        return $out;
    }

    public function formatValue($value){
        return number_format($value, 2, ",", "."). " €";
    }

    public function convertDate($value){
        $tmp = explode("-", $value);
        return $tmp !== false ?$tmp[2]."-".$tmp[1]."-".$tmp[0] : "";
    }
}