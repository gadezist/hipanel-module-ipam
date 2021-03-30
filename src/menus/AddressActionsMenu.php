<?php

namespace hipanel\modules\ipam\menus;

use hipanel\menus\AbstractDetailMenu;
use hipanel\modules\ipam\models\Prefix;
use Yii;

class AddressActionsMenu extends AbstractDetailMenu
{
    public Prefix $model;

    public function items(): array
    {
        return [
            'view' => [
                'label' => Yii::t('hipanel', 'View'),
                'icon' => 'fa-eye',
                'url' => ['@address/view', 'id' => $this->model->id],
            ],
            'update' => [
                'label' => Yii::t('hipanel', 'Update'),
                'icon' => 'fa-pencil',
                'url' => ['@address/update', 'id' => $this->model->id],
            ],
        ];
    }
}
