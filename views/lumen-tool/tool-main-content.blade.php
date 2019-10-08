<?php $namespace = 'MelisPlatformFrameworkLumenDemoToolLogic'; ?>
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
<script type="text/javascript">
    //this script cannot be separated to this file since all table configuration and initialization are done here
    // render table to DataTable plugin
    $(document).ready(function() {
        <?= $dataTable ?>
    });
</script>
