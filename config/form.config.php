<?php

return [
    'form' => [
        'attributes' => [
            'class' => 'form',
            'method' => 'POST',
            'name'  => 'album_form',
        ],
        'elements' => [
            [
                'type' => 'text',
                'name' => 'alb_name',
                'label' => 'Name',
                'attributes' => [
                    'class' => 'form-control',
                    'required' => true,
                    'tooltip' => ''
                ]
            ],
            [
                'type' => 'text',
                'name' => 'alb_no_of_songs',
                'label' => 'No of songs',
                'attributes' => [
                    'class' => 'form-control',
                    'tooltip' => ''
                ]
            ]
        ],
    ]
];