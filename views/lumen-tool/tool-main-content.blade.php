<?php
    $namespace = 'MelisPlatformFrameworkLumenDemoToolLogic';
    /** @var \Zend\Mvc\I18n\Translator $zendTranslator */
    $zendTranslator = app('ZendTranslator');
    /** @var \MelisCore\View\Helper\MelisGenericTable $melisGenericTable */
    $melisGenericTable = app('melisgenerictable');
    $tableConfig = config('album_table_config')['table'];
?>
<!-- header area -->
@include($namespace. "::lumen-tool/tool-header")
{{-- table content--}}
<?php
    $melisGenericTable->setTable([
        'id' => 'lumenDemoToolTable',
        'class' => 'table table-striped table-primary dt-responsive nowrap',
        'cellspacing' => '0',
        'width' => '100%'
    ]);
    $columns = array();
    $columnStyle = array();
    $tableCols = $tableConfig['columns'];
    if(isset($tableConfig['actionButtons']) && ! empty($tableConfig['actionButtons'])) {
        $tableCols['action'] = [
            'text' => 'Action'
        ];
    }
    foreach($tableCols as $colName => $columnText) {
        $columns[] = $columnText['text'];
    }

    $melisGenericTable->setColumns($columns);
    echo $melisGenericTable->renderTable();
?>

<br>
<h3>{{ $zendTranslator->translate('tr_melis_lumen_table1_heading_songs_head_language') }}</h3>
<p>{{ $zendTranslator->translate('tr_melis_lumen_demo_tool_sample_2_heading')  }}</p>
<table class='table table-striped'>
    <tr>
        <th>ID</th>
        <th> {{ $zendTranslator->translate('tr_melis_lumen_table1_heading_name') }}</th>
        <th>Locale</th>
    </tr>
    @foreach ($coreLang as $idx => $val)
        <tr>
            <td>{{ $val['lang_id'] }}</td>
            <td>{{ $val['lang_name'] }}</td>
            <td>{{ $val['lang_locale'] }}</td>
        </tr>
    @endforeach
</table>

{{--  dynamic table with pagination same with the common melis datatable --}}
<script type="text/javascript">
    //this script cannot be separated to this file since all table configuration and initialization are done here
    // render table to DataTable plugin

    window.melisInitDataTable = function(requiredSettings){
        if (typeof (requiredSettings) == "object") {
            var settings = {
                paging : true,
                ordering : true,
                serverSide : true,
                searching: true,
                // ordering of the table default [column,direction]
                order: [[ 0, "desc" ]],
                responsive:true,
                processing: true,
                lengthMenu: [ [5, 10, 25, 50], [5, 10, 25, 50] ],
                pageLength: 10,
                bSort: true,
                searchDelay: 1500,
                columnDefs : [
                    { responsivePriority:1, targets: 0 },
                    { responsivePriority:2, targets: -1 }
                ],
                language: {
                    url : "/melis/MelisCore/Language/getDataTableTranslations",
                },
            };
        }
        // add ajax
        if(requiredSettings.hasOwnProperty('ajaxUrl')) {
            settings.ajax = {
                url : requiredSettings.ajaxUrl,
                type : "POST",
            };
        }
        // check for columns
        if(requiredSettings.hasOwnProperty('columns')) {
            var tmpColumns = [];
            var tmpDefColumns = [];
            if (Object.keys(requiredSettings.columns).length > 0) {
                var ctr = 0;
                // loop all columns
                $.each(requiredSettings.columns, function(index, item) {
                    tmpColumns.push({
                        "data" : index
                    });
                    settings.columnDefs.push({
                        "width" : item.css.width,
                        'targets' : ctr
                    });
                    ctr++;
                });
            }
            // set datatable columns
            settings.columns = tmpColumns;
        }

        if(requiredSettings.hasOwnProperty('filters')) {
            var preDefinedFilters = ['l','f'];
            var tableTop = '<"filter-bar"<"row"';
            var leftDom = '<"fb-dt-left col-xs-12 col-md-4"';
            var centerDom = '<"fb-dt-center col-xs-12 col-md-4"';
            var rightDom = '<"fb-dt-right col-xs-12 col-md-4"';
            var tableBottom = '<"bottom" t<"pagination-cont clearfix"rip>>';
            var jsSdomContentInit = [];

            // left filter area
            if(Object.keys(requiredSettings.filters.left).length > 0) {
                // loop all left filters
                $.each(requiredSettings.filters.left,function(index,item) {
                    // check for predefined datatble content
                    if(preDefinedFilters.indexOf(item) >= 0) {
                        // construct correct syntax of datatable filter
                        leftDom = leftDom + '<"'+ index  +'"'+ item +'>';
                    } else {
                        // construct correct syntax of datatable filter
                        leftDom = leftDom + '<"'+ index +'">';
                        // append needed function for callback function after datatable initiliazation
                        jsSdomContentInit.push(function(){
                            return $("." + index).html(item);
                        })
                    }
                });
            }
            // center filter area
            if(Object.keys(requiredSettings.filters.center).length > 0) {
                // loop all center filters
                $.each(requiredSettings.filters.center,function(index,item) {
                    // check for predefined datatble content
                    if(preDefinedFilters.indexOf(item) >= 0) {
                        // construct correct syntax of datatable filter
                        centerDom = centerDom + '<"'+ index  +'"'+ item +'>';
                    } else {
                        // construct correct syntax of datatable filter
                        centerDom = centerDom + '<"'+ index +'">';
                        // append needed function for callback function after datatable initiliazation
                        jsSdomContentInit.push(function(){
                            return $("." + index).html(item);
                        })
                    }
                });
            }
            // right filter area
            if(Object.keys(requiredSettings.filters.right).length > 0) {
                // loop all right filters
                $.each(requiredSettings.filters.right,function(index,item) {
                    // check for predefined datatble content
                    if(preDefinedFilters.indexOf(item) >= 0) {
                        // construct correct syntax of datatable filter
                        rightDom = rightDom + '<"'+ index  +'"'+ item +'>';
                    } else {
                        // construct correct syntax of datatable filter
                        rightDom = rightDom + '<"'+ index +'">';
                        // append needed function for callback function after datatable initiliazation
                        jsSdomContentInit.push(function(){
                            return $("." + index).html(item);
                        })
                    }
                });
            }
            // set datatable sDom or Filters
            settings.sDom = tableTop + leftDom + ">" + centerDom + ">" + rightDom + ">>>" + tableBottom;
        }
        // add action buttons
        if (requiredSettings.hasOwnProperty('actionButtons')){
            // check if it has elements
            if(Object.keys(requiredSettings.actionButtons).length > 0) {
                settings.columns.push({
                    "data" : "actions"
                });
                var actionButtons = "";
                $.each(requiredSettings.actionButtons, function(idx, item) {
                    actionButtons = actionButtons + item;
                });
                settings.columnDefs.push({
                    "targets" : -1,
                    "data" : null,
                    "width" : "10%",
                    "bSortable" : false,
                    "sClass" : "dtActionCls",
                    "mRender": function(){
                        return actionButtons;
                    }
                })
            }

        }
        // // initialized datatable
        var melisDataTable = $(requiredSettings.target).DataTable(settings).columns.adjust().responsive.recalc();
        //run callback function for addtional filters
        $(requiredSettings.target).on('init.dt',function(){
            // get all filter function
            if (jsSdomContentInit.length > 0) {
                $.each(jsSdomContentInit,function(index,fn){
                    // run all functions
                    fn();
                });
            }
            // get datatable search field
            var searchField = $(requiredSettings.target).parent().siblings('.filter-bar').find('.search input[type="search"]');
            // unbind
            searchField.unbind();
            // for better logic trigger search when there are 2 or more characters
            searchField.typeWatch({
                captureLength : 2,
                callback : function(value) {
                    melisDataTable.search(value).draw();
                }
            });
        });
    }

    melisInitDataTable(<?= json_encode($tableConfig)?>);
</script>
