<?php

namespace hipanel\modules\ipam\grid;

use hipanel\grid\XEditableColumn;
use hipanel\modules\ipam\menus\AddressActionsMenu;
use hiqdev\yii2\menus\grid\MenuColumn;
use Yii;
use yii\helpers\Html;

class AddressGridView extends PrefixGridView
{
    public function columns()
    {
        return array_merge(parent::columns(), [
            'ip' => [
                'format' => 'html',
                'attribute' => 'ip',
                'filterAttribute' => 'ip_like',
                'value' => static function ($address) {
                    $ip = Html::a($address->ip, ['@address/view', 'id' => $address->id], ['class' => 'text-bold']);
                    $tags = TagsColumn::renderTags($address);

                    return implode('<br>', [$ip, $tags]);
                },
            ],
            'note' => [
                'class' => XEditableColumn::class,
                'pluginOptions' => [
                    'url' => '@address/set-note',
                ],
                'filter' => true,
                'filterAttribute' => 'note_ilike',
                'popover' => Yii::t('hipanel', 'Make any notes for your convenience'),
            ],
            'actions' => [
                'class' => MenuColumn::class,
                'contentOptions' => ['style' => 'width: 1%; white-space:nowrap;'],
                'menuClass' => AddressActionsMenu::class,
            ],
        ]);
    }
}
