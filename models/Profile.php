<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property integer $id
 * @property string $name
 * @property string $lastname
 * @property string $institution_name
 * @property string $responsability_name
 * @property string $gender
 * @property string $phone_number
 * @property string $mobile_number
 * @property integer $complete
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property integer $user_id
 * @property integer $institutiontype_id
 * @property integer $responsibilitytype_id
 * @property integer $country_id
 *
 * @property User $user
 * @property Institutiontype $institutiontype
 * @property Responsibilitytype $responsibilitytype
 * @property Country $country
 */
class Profile extends \yii\db\ActiveRecord
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
        return 'profile';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'lastname',  'institutiontype_id', 'responsibilitytype_id', 'country_id','gender'], 'required'],
            [['gender'], 'string'],
            [['complete', 'status', 'user_id', 'institutiontype_id', 'responsibilitytype_id', 'country_id'], 'integer'],
            [['created_at', 'updated_at','photo'], 'safe'],
            [['name', 'lastname'], 'string', 'max' => 100],
            [['institution_name', 'responsability_name'], 'string', 'max' => 250],
            [['phone_number', 'mobile_number'], 'string', 'max' => 15],
            ['created_at', 'default', 'value' => date('Y-m-d H:i:s')],
            ['updated_at', 'default', 'value' => date('Y-m-d H:i:s')],
            [['photo'], 'file', 'extensions'=>'jpg, gif, png'],
            [['photo'], 'required','on'=>'avatar']
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nombres',
            'lastname' => 'Apellidos',
            'institution_name' => 'Institución',
            'responsability_name' => 'Responsabilidad',
            'gender' => 'Género',
            'phone_number' => 'Teléfono fijo',
            'mobile_number' => 'Teléfono móvil',
            'complete' => 'Complete',
            'status' => 'Estado',
//            'created_at' => Yii::t('app','Created At'),
            'created_at' => 'Fecha de Creación',
            'updated_at' => 'Fecha de Actualización',
            'user_id' => 'User ID',
            'institutiontype_id' => 'Tipo de Institución',
            'responsibilitytype_id' => 'Tipos de Responsabilidad',
            'country_id' => 'País',
            'photo' => 'Fotografía',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstitutiontype()
    {
        return $this->hasOne(Institutiontype::className(), ['id' => 'institutiontype_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponsibilitytype()
    {
        return $this->hasOne(Responsibilitytype::className(), ['id' => 'responsibilitytype_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }
    //
    public function getImageUrl()
    {
        // return a default image placeholder if your source avatar is not found
        $avatar = isset($this->photo) ? $this->photo : 'profile.png';
        if ($avatar==Null)
            $avatar='profile.png';

        return Yii::$app->params['avatarFolder'] . $avatar;
    }
}
