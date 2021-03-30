<?php

namespace hipanel\modules\ipam\models;

use hipanel\base\ModelTrait;
use hipanel\modules\ipam\models\query\AddressQuery;
use hipanel\modules\ipam\models\traits\IPBlockTrait;
use Yii;
use yii\db\QueryInterface;
use yii\web\JsExpression;

class Address extends Prefix
{
    use ModelTrait, IPBlockTrait;

    public static function tableName()
    {
        return 'prefix';
    }

    /** {@inheritdoc} */
    public function rules()
    {
        return array_merge(parent::rules(), [
            'ip_validate' => [
                ['ip'], 'ip', 'subnet' => null,
                'when' => fn($model) => strpos($model->ip, '[') === false,
                'whenClient' => new JsExpression('(attribute, value) => value.indexOf("[") === -1'),
                'on' => ['create', 'update'],
            ],
        ]);
    }

    /** {@inheritdoc} */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'ip' => Yii::t('hipanel.ipam', 'Address'),
            'type' => Yii::t('hipanel.ipam', 'Status'),
        ]);
    }

    /**
     * {@inheritdoc}
     * @return QueryInterface
     */
    public static function find(array $options = []): QueryInterface
    {
        return new AddressQuery(get_called_class(), [
            'options' => $options,
        ]);
    }
}
