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
                'name' => 'alb_id',
                'hideNoData' => true,
            ],
            [
                'type' => 'text',
                'name' => 'alb_name',
                'options' => [
                    'label' => __("lumenDemo::translations.tr_melis_lumen_table1_heading_name"),
                    'tooltip' => __("lumenDemo::translations.tr_melis_lumen_table1_heading_name tooltip"),
                ],
                'attributes' => [
                    'class' => 'form-control',
                    'required' => true,
                ]
            ],
            [
                'type' => 'text',
                'name' => 'alb_song_num',
                'options' => [
                    'label' => __("lumenDemo::translations.tr_melis_lumen_table1_heading_songs"),
                    'tooltip' => __("lumenDemo::translations.tr_melis_lumen_table1_heading_songs tooltip"),
                ],
                'attributes' => [
                    'class' => 'form-control',
                    'required' => true,
                ]
            ],
            [
                'type' => 'hidden',
                'name' => 'alb_date',
                'options' => [
                    'tooltip' => __("lumenDemo::translations.tr_melis_lumen_table1_heading_date tooltip"),
                    'label' => __("lumenDemo::translations.tr_melis_lumen_table1_heading_date"),
                ],
                'attributes' => [
                    'class' => "form-control album_date",
                    'disabled' => true
                ]
            ],
            // sample config for other inuputs
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