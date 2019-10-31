<?php
    $namespace = 'MelisPlatformFrameworkLumenDemoToolLogic';
    /** @var \Zend\Mvc\I18n\Translator $zendTranslator */
    $zendTranslator = app('ZendTranslator');
    /** @var \MelisCore\View\Helper\MelisGenericTable $melisGenericTable */
    $melisGenericTable = app('melisgenerictable');
    $tableConfig = config('album_table_config')['table'];
?>
<div class="me-heading bg-white">
    <div class="row">
        <div class="me-hl col-xs-12 col-sm-12 col-md-12">
            <h1 class="content-heading"><?= $zendTranslator->translate('tr_melis_code_example_lumen_tool_head_title')?></h1>
            <p><?= $zendTranslator->translate('tr_melis_code_example_lumen_tool_head_desc') ?> </p>
        </div>
    </div>
</div>
<div class="innerAll spacing-x2">
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
    {{--  dynamic table with pagination same with the common melis datatable --}}
    <script type="text/javascript">
        // melis helper in intializing a datable.
        melisHelper.melisInitDataTable(<?= json_encode($tableConfig)?>);
    </script>

    {{-- other sample data --}}
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


    {{-- include modal --}}
    @include($namespace ."::lumen-tool/tool-modal-content")
</div>