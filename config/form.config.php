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
                'type' => 'text',
                'label' => 'Name',
                'tooltip' => "ToolTip dako oten",
                'attributes' => [
                    'class' => 'form-control',
                    'required' => true,
                    'name' => 'alb_name',
                ]
            ],
            [
                'type' => 'text',
                'label' => 'No of songs',
                'attributes' => [
                    'class' => 'form-control',
                    'name' => 'alb_song_num',
                ]
            ]
        ],
    ]
];