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
                'label' => __("lumenDemo::translations.tr_melis_lumen_table1_heading_name"),
                'tooltip' => __("lumenDemo::translations.tr_melis_lumen_table1_heading_name tooltip"),
                'attributes' => [
                    'name' => 'alb_name',
                    'class' => 'form-control',
                    'required' => true,
                ]
            ],
            [
                'type' => 'text',
                'label' => __("lumenDemo::translations.tr_melis_lumen_table1_heading_songs"),
                'tooltip' => __("lumenDemo::translations.tr_melis_lumen_table1_heading_songs tooltip"),
                'attributes' => [
                    'name' => 'alb_song_num',
                    'class' => 'form-control',
                    'required' => true,
                ]
            ],
            [
                'type' => 'text',
                'hideNoData' => true,
                'tooltip' => __("lumenDemo::translations.tr_melis_lumen_table1_heading_date tooltip"),
                'label' => __("lumenDemo::translations.tr_melis_lumen_table1_heading_date"),
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