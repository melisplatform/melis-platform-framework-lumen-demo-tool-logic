<?php

return array(
    'table' => array(
        'ajaxUrl' => '/melis/lumen-get-table-data',
        'dataFunction' => '',
        'ajaxCallback' => '',
        'attributes' => [
            'id' => 'lumenDemoToolTable',
            'class' => 'table table-stripes table-primary dt-responsive nowrap',
            'cellspacing' => '0',
            'width' => '100%',
        ],
        'filters' => array(
            'left' => array(
                'show' => "l",
            ),
            'center' => array(
                'search' => "f"
            ),
            'right' => array(
                'refresh' => '<div class="lumen-table-refresh"><a class="btn btn-default melis-lumen-refresh" data-toggle="tab" aria-expanded="true" title="' . __("lumenDemo::translations.tr_melis_lumen_table_refresh") .'"><i class="fa fa-refresh"></i></a></div>'
            ),
        ),
        'columns' => array(
            'alb_id' => array(
                'text' => __('lumenDemo::translations.tr_melis_lumen_table1_heading_id'),
                'css' => array('width' => '10%', 'padding-right' => '0'),
                'sortable' => true,
            ),
            'alb_name' => array(
                'text' => __('lumenDemo::translations.tr_melis_lumen_table1_heading_name'),
                'css' => array('width' => '20%', 'padding-right' => '0'),
                'sortable' => true,
            ),
            'alb_song_num' => array(
                'text' => __('lumenDemo::translations.tr_melis_lumen_table1_heading_songs'),
                'css' => array('width' => '30%', 'padding-right' => '0'),
                'sortable' => true,
            ),
            'alb_date' => array(
                'text' => __('lumenDemo::translations.tr_melis_lumen_table1_heading_date'),
                'css' => array('width' => '30%', 'padding-right' => '0'),
                'sortable' => true,
            ),
        ),
        'searchables' => array(
            'alb_id','alb_name','alb_song_num', 'alb_date'
        ),
        'actionButtons' => array(
            'edit' => "<a href=\"#modal-template-manager-actions\" data-toggle=\"modal\" data-target=\"#lumenModal\" class=\"btn btn-success btnEditLumenAlbum\" title=\"" . __("lumenDemo::translations.tr_melis_lumen_table_edit") ."\"> <i class=\"fa fa-pencil\"> </i> </a>\t",
            'delete' => "<a class=\"btn btn-danger btnDelLumenAlbum\" title=\"" . __("lumenDemo::translations.tr_melis_lumen_table_delete")  ."\" > <i class=\"fa fa-times\"> </i> </a>"
        ),
    ),
);
