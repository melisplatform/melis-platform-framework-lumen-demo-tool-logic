<?php

return array(
    'table' => array(
        'target' => '#lumenDemoToolTable',
        'ajaxUrl' => '/melis/lumen-get-table-data',
        'dataFunction' => '',
        'ajaxCallback' => '',
        'filters' => array(
            'left' => array(
                'limit' => [
                    'view' => 'MelisPlatformFrameworkLumenDemoToolLogic::lumen-tool/tool-table-filter-limit'
                ],
            ),
            'center' => array(
                'search' => [
                    'view' => 'MelisPlatformFrameworkLumenDemoToolLogic::lumen-tool/tool-table-filter-search'
                ]
            ),
            'right' => array(

            ),
        ),
        'columns' => array(
            'alb_id' => array(
                'text' => 'ID',
                'css' => array('width' => '10%', 'padding-right' => '0'),
                'sortable' => true,
            ),
            'alb_name' => array(
                'text' => 'tr_melis_lumen_table1_heading_name',
                'css' => array('width' => '20%', 'padding-right' => '0'),
                'sortable' => true,
            ),
            'alb_date' => array(
                'text' => 'Date',
                'css' => array('width' => '30%', 'padding-right' => '0'),
                'sortable' => true,
            ),
            'alb_song_num' => array(
                'text' => 'tr_melis_lumen_table1_heading_songs',
                'css' => array('width' => '30%', 'padding-right' => '0'),
                'sortable' => true,
            ),
        ),
        'searchables' => array(),
        'actionButtons' => array(
            'edit' => [
                'view' => 'MelisPlatformFrameworkLumenDemoToolLogic::lumen-tool/tool-edit-button',
            ],
            'delete' => [
                'view' => 'MelisPlatformFrameworkLumenDemoToolLogic::lumen-tool/tool-delete-button'
            ]
        ),
    ),
);
