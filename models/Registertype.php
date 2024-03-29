<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "registertype".
 *
 * @property integer $id
 * @property string $name
 * @property string $role
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property integer $registertype_id
 *
 * @property Inscription[] $inscriptions
 * @property Registertype $registertype
 * @property Registertype[] $registertypes
 */
class Registertype extends \yii\db\ActiveRecord
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
        return 'registertype';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'registertype_id'], 'required'],
            [['role'], 'string'],
            [['status', 'registertype_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 45],
            ['created_at', 'default', 'value' => date('Y-m-d H:i:s')],
            ['updated_at', 'default', 'value' => date('Y-m-d H:i:s')]
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
            'role' => 'Rol',
            'status' => 'Estado',
            'created_at' => 'Fecha de Creación',
            'updated_at' => 'Fecha de Actualización',
            'registertype_id' => 'Tipos de Registro',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInscriptions()
    {
        return $this->hasMany(Inscription::className(), ['registertype_assigment' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegistertype()
    {
        return $this->hasOne(Registertype::className(), ['id' => 'registertype_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegistertypes()
    {
        return $this->hasMany(Registertype::className(), ['registertype_id' => 'id']);
    }
}
