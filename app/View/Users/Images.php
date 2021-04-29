<?php

namespace App\View\Users;

class Images extends \App\View\Main
{
    public function content($data = [])
    {
        $options = [
            'id' => [
                'lebel' => '#',
                'class' => 'text-center'
            ],
            'name' => [
                'lebel' => 'Имя изображения',
                'class' => ''
            ],
            'actions' => [
                'lebel' => 'Действия',
                'class' => 'text-center',
                'buttons' => [
                    'delete' => [
                        'icon' => 'fa-trash',
                        'route' => '/users/images/delete'
                    ],
                ]
            ],
        ];

        $buttons = [
            [
                'lebel' => 'Добавить',
                'route' => '/users/images/add?id=' . $data['id-user'],
            ]
        ];


        $this->table($data['data'], $options, $buttons);
    }
}