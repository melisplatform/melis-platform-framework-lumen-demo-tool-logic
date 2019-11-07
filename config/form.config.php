<?php

return [
    'form' => [
        'attributes' => [
            'class' => 'form',
            'method' => 'POST',
            'name'  => 'album_form',
            'id'    => "lumen_demo_tool_add_album"
        ],
        'elements' => [
            [
                'type' => 'hidden',
                'hideNoData' => true,
                'attributes' => [
                    'name' => 'alb_id',
                ]
            ],
            [
                'type' => 'text',
                'label' => 'Name',
                'tooltip' => "Name of the album",
                'attributes' => [
                    'name' => 'alb_name',
                    'class' => 'form-control',
                    'required' => true,
                ]
            ],
            [
                'type' => 'text',
                'label' => 'No of songs',
                'tooltip' => "Number of songs in the album",
                'attributes' => [
                    'name' => 'alb_song_num',
                    'class' => 'form-control',
                ]
            ],
            [
                'type' => 'text',
                'hideNoData' => true,
                'tooltip' => "Date created the album",
                'label' => 'Date added',
                'attributes' => [
                    'name' => 'alb_date',
                    'class' => 'form-control',
                    'disabled' => true
                ]
            ],
//            [
//                'type' => 'radio',
//                'label' => 'Radio Test',
//                'attributes' => [
//                    'name' => 'alb_radio',
//                    'class' => 'form-control',
//                ]
//            ],
//            [
//                'type' => 'password',
//                'label' => 'Password',
//                'attributes' => [
//                    'name' => 'alb_password',
//                    'class' => 'form-control',
//                ]
//            ],
//            [
//                'type' => 'checkbox',
//                'label' => 'Checkbox',
//                'attributes' => [
//                    'name' => 'alb_checkbox',
//                    'class' => 'form-control',
//                ]
//            ],
//            [
//                'type' => 'file',
//                'label' => 'File upload',
//                'attributes' => [
//                    'name' => 'alb_checkbox',
//                    'class' => 'form-control',
//                ]
//            ],
//            [
//                'type' => 'textarea',
//                'label' => 'Textarea',
//                'attributes' => [
//                    'name' => 'alb_textarea',
//                    'class' => 'form-control',
//                ]
//            ],
//            [
//                'type' => 'select',
//                'label' => 'Selec',
//                'options' => [
//                    '1' => 'James',
//                    '2' => 'Jacob',
//                    '3' => 'Jason',
//                    '4' => 'Johnny',
//                ],
//                'attributes' => [
//                    'name' => 'alb_select',
//                    'class' => 'form-control',
//                ]
//            ],
        ],
    ]
];