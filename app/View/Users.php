<?php

namespace App\View;

class Users extends Main
{
    protected function content($data = [])
    {
        $options = [
            'id' => [
                'lebel' => '#',
                'class' => 'text-center'
            ],
            'email' => [
                'lebel' => 'email',
                'class' => ''
            ],
            'name' => [
                'lebel' => 'Имя пользователя',
                'class' => ''
            ],
            'actions' => [
                'lebel' => 'Действия',
                'class' => 'text-center',
                'buttons' => [
                    'images' => [
                        'icon' => 'fa-image',
                        'route' => '/users/images'
                    ],
                    'edit' => [
                        'icon' => 'fa-pencil',
                        'route' => '/users/edit'
                    ],
                    'delete' => [
                        'icon' => 'fa-trash',
                        'route' => '/users/delete'
                    ],
                ]
            ],
        ];

        $buttons = [
            [
                'lebel' => 'Добавить',
                'route' => '/users/add'
            ]
        ];


        $this->table($data['data'], $options, $buttons);

    }
}