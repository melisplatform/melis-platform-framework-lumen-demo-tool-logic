<?php
    $namespace = 'MelisPlatformFrameworkLumenDemoToolLogic';
    $zendTranslator = app('ZendTranslator');
?>
<!-- header area -->
@include($namespace. "::lumen-tool/tool-header")
{{-- table content--}}
<?php
    app('melisgenerictable')->setTable([
        'id' => 'lumenDemoToolTable',
        'class' => 'table table-striped table-primary dt-responsive nowrap',
        'cellspacing' => '0',
        'width' => '100%'
    ]);
    $columns = array();
    $columnStyle = array();
    $tableCols = config('album_table_config')['table']['columns'];
    $tableCols['action'] = [
        'text' => 'Action'
    ];
    foreach($tableCols as $colName => $columnText) {
        $columns[] = $columnText['text'];
    }

    app('melisgenerictable')->setColumns($columns);
    echo app('melisgenerictable')->renderTable();
?>

<br>
<h3>{{ $zendTranslator->translate('tr_melis_lumen_table1_heading_songs_head_language') }}</h3>
<p>{{ $zendTranslator->translate('tr_melis_lumen_demo_tool_sample_2_heading')  }}</p>
<table class='table'>
    <tr class='tr-table-header' >
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
    $(document).ready(function() {
        <?= $dataTable ?>
    });
</script>
