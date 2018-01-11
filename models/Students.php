<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "students".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property int $sex
 * @property string $group
 * @property string $email
 * @property int $points
 * @property int $birth_year
 * @property int $is_local
 */
class Students extends \yii\db\ActiveRecord
{
    public $search;

    const CITIZEN_LOCAL = "Local citizen";
    const CITIZEN_ALIEN = "Citizen of another city";

    const SEX_MALE   = 'Male';
    const SEX_FEMALE = 'Female';

    const ERROR_MAX_STRING = 'Field "{attribute}" could contain not more {max} symbols';
    const ERROR_MIN_NUMBER = 'Field "{attribute}" couldn\'t be less than {min}';
    const ERROR_MAX_NUMBER = 'Field "{attribute}" couldn\'t be more than {max}';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'students';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'sex', 'group', 'email', 'points', 'birth_year', 'is_local'],
                'required', 'message' => 'Field "{attribute}" is required'
            ],
            [['first_name', 'last_name', 'email'], 'string', 'max' => 100,
                'tooLong' => self::ERROR_MAX_STRING
            ],
            [['first_name', 'last_name'], 'match',
                'pattern' => '/^[a-zA-Zа-яА-Я]+$/',
                'message' => 'The field "{attribute}" can contain only one word without space'
            ],
            [['group'], 'match',
                'pattern' => '/^[a-zA-Zа-яА-Я0-9]+$/',
                'message' => 'The field "{attribute}" can contain only letters and numbers without space'
            ],
            [['email'], 'match',
                'pattern' =>
                    '/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))'.
                    '@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/',
                'message' => 'You wrote invalid email'
            ],
            [['group'], 'string', 'max' => 5, 'tooLong' => self::ERROR_MAX_STRING],
            [['points'], 'number', 'min' => 0, 'max' => 200,
                'tooSmall' => self::ERROR_MIN_NUMBER, 'tooBig' => self::ERROR_MAX_NUMBER,
            ],
            ['birth_year', 'number', 'min' => 1920, 'max' => 2010,
                'tooSmall' => self::ERROR_MIN_NUMBER, 'tooBig' => self::ERROR_MAX_NUMBER,
            ],
            [['email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'         => 'ID',
            'first_name' => 'First Name',
            'last_name'  => 'Last Name',
            'sex'        => 'Sex',
            'group'      => 'Group',
            'email'      => 'Email',
            'points'     => 'Count of points',
            'birth_year' => 'Birth Year',
            'is_local'   => 'Citizen',
        ];
    }

    public function getSexTypes() {
        return [self::SEX_MALE, self::SEX_FEMALE];
    }

    public function getCitizenTypes() {
        return [self::CITIZEN_LOCAL, self::CITIZEN_ALIEN];
    }
}
