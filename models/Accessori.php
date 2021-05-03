<?php

namespace app\models;

use Yii;
use app\models\CategoriaAccessori;

/**
 * This is the model class for table "accessori".
 *
 * @property int $id
 * @property int $id_operaio
 * @property string $oggetto
 * @property string $taglia
 * @property int $quantita
 * @property string $created
 */
class Accessori extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'accessori';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['oggetto', 'id_operaio', 'created'], 'required'],
            [['id_operaio', 'oggetto'], 'integer'],
            [['taglia', 'quantita', 'created', 'costo_totale'], 'safe'],
            [['taglia'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_operaio' => 'Operaio',
            'oggetto' => 'Oggetto',
            'created' => "Data di consegna"
        ];
    }


    public function getOperaio(){
        $operaio = Operaio::findOne(["id" => $this->id_operaio]);

        return !empty($operaio) ? $operaio->nome." ".$operaio->cognome : "";
    }

    public function getCategoriaAccessori(){
        $categoria = CategoriaAccessori::findOne(["id" => $this->oggetto]);

        return !empty($categoria) ? $categoria->nome : "";
    }

    public function getCategoriaColor(){
        $categoria = CategoriaAccessori::findOne(["id" => $this->oggetto]);

        return !empty($categoria) ? $categoria->color : "";
    }

    public function getCategoriaColorHex(){
        $categoria = CategoriaAccessori::findOne(["id" => $this->oggetto]);

        return !empty($categoria) ? $categoria->color_hex : "";
    }

    public function getCategorieAccessori(){
        $categorie = CategoriaAccessori::find()->all();
        $out = [];

        foreach($categorie as $categoria){
            $out[$categoria->id] = $categoria->nome;
        }

        return $out;
    }

    public function convertDate($value){
        $tmp = explode("-", $value);
        return $tmp !== false ?$tmp[2]."-".$tmp[1]."-".$tmp[0] : "";
    }

    public function formatDate($value, $showHour = false){
        $format = "d/m/Y";
        if($showHour)
            $format = "d/m/Y H:i:s";

        return !empty($value) ? date($format, strtotime($value)) : "";
    }

    public function formatValue($value){
        return number_format($value, 2, ",", "."). " €";
    }
}
