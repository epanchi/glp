<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "event".
 *
 * @property integer $id
 * @property string $name
 * @property string $short_description
 * @property string $general_content
 * @property string $methodology
 * @property string $addressed_to
 * @property string $included
 * @property string $requirements
 * @property string $file
 * @property string $photo
 * @property string $url
 * @property string $begin_at
 * @property string $end_at
 * @property string $city
 * @property double $cost
 * @property integer $discount
 * @property string $discount_end_at
 * @property string $discount_description
 * @property integer $year
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property integer $country_id
 * @property integer $eventtype_id
 *
 * @property Country $country
 * @property Eventtype $eventtype
 * @property Inscription[] $inscriptions
 * @property Phforum[] $phforums
 */
class Event extends \yii\db\ActiveRecord
{
    // CONTROL DE ESTADOS
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;

    public function getStatus($status)
    {
        $codes = $this->getStatusList();
        return (    isset($codes[$status])) ? $codes[$status] : '';
    }

    public function getStatusList()
    {
        return $codes = [
            self::STATUS_ACTIVE => 'ACTIVO',
            self::STATUS_INACTIVE => 'INACTIVO',
            self::STATUS_DELETED => 'ELIMINADO',
        ];

    }
    //---> ESTADOS

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'country_id', 'eventtype_id','city','short_description', 'general_content'], 'required'],
            [['short_description', 'general_content', 'methodology', 'addressed_to', 'included', 'requirements', 'file', 'photo', 'url'], 'string'],
            [['begin_at', 'end_at', 'discount_end_at', 'created_at', 'updated_at'], 'safe'],
            [['cost'], 'number'],
            [['discount', 'year', 'status', 'country_id', 'eventtype_id'], 'integer'],
            [['name', 'city'], 'string', 'max' => 250],
            [['short_description'], 'string', 'max' => 100],
            [['discount_description'], 'string', 'max' => 250],
            ['created_at', 'default', 'value' => date('Y-m-d H:i:s')],
            ['updated_at', 'default', 'value' => date('Y-m-d H:i:s')],
            [['photo'], 'file', 'extensions' => 'jpg, gif, png'],
            [['file'], 'file', 'extensions'=>'pdf, doc, ppt, xls, docx, pptx, xlsx '],
            [['photo'], 'required', 'on' => 'imagen'],
            [['file'], 'required', 'on' => 'documento']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nombre',
            'short_description' => 'Descripción Corta',
            'general_content' => 'Contenido General',
            'methodology' => 'Metodología',
            'addressed_to' => 'Dirigido a:',
            'included' => 'Que incluye',
            'requirements' => 'Requerimientos',
            'file' => 'Archivo',
            'photo' => 'Fotografía',
            'url' => 'Enlace Recurso',
            'begin_at' => 'Fecha de Inicio',
            'end_at' => 'Fecha de Fin',
            'city' => 'Ciudad',
            'cost' => 'Costo',
            'discount' => 'Descuento',
            'discount_end_at' => 'Fecha Limite de Descuento',
            'discount_description' => 'Información de descuento',
            'year' => 'Año',
            'status' => 'Estado',
            'created_at' => 'Fecha de Creación',
            'updated_at' => 'Fecha de Actualización',
            'country_id' => 'Pais',
            'eventtype_id' => 'Tipo de Evento',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventtype()
    {
        return $this->hasOne(Eventtype::className(), ['id' => 'eventtype_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInscriptions()
    {
        return $this->hasMany(Inscription::className(), ['event_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhforums()
    {
        return $this->hasMany(Phforum::className(), ['event_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventquestions()
    {
        return $this->hasMany(Eventquestion::className(), ['event_id' => 'id']);
    }

    public function getImageUrl()
    {
        // return a default image placeholder if your source avatar is not found
        $avatar = isset($this->photo) ? $this->photo : '0.jpg';
        if ($avatar == Null)
            $avatar = '0.jpg';

        return Yii::$app->params['eventFolder'] . $avatar;
    }


}
