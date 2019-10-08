<?php

return array(
    'table' => array(
        'target' => '#lumenDemoToolTable',
        'ajaxUrl' => '/melis/lumen-get-table-data',
        'dataFunction' => '',
        'ajaxCallback' => '',
        'filters' => array(
            'left' => array(
                # limit
                'album_limit_filter' => 'l'
//                'news-list-news-filter-site' => array(
//                    'module' => 'MelisCmsNews',
//                    'controller' => 'MelisCmsNewsList',
//                    'action' => 'render-news-list-content-filter-site'
//                ),
            ),

            'center' => array(
                # search
                'album_search_filter' => 'f'
            ),

            'right' => array(
//                'news-list-news-filter-refresh' => array(
//                    'module' => 'MelisCmsNews',
//                    'controller' => 'MelisCmsNewsList',
//                    'action' => 'render-news-list-content-filter-refresh'
//                ),
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
            # edit
            'info' => view("MelisPlatformFrameworkLumenDemoToolLogic::lumen-tool/tool-edit-button")->render(),
            # delete
            'delete' => view("MelisPlatformFrameworkLumenDemoToolLogic::lumen-tool/tool-delete-button")->render()
        ),
    ),
);
