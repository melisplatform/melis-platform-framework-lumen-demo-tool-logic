<?php
    $namespace = 'MelisPlatformFrameworkLumenDemoToolLogic';

?>
<!-- header area -->
@include($namespace. "::lumen-tool/tool-header")
{{-- filter area --}}
@include($namespace. "::lumen-tool/tool-table-filters")
{{-- table content--}}
<table class='table' id="lumen-demo-table"
       data-start     = "<?= $tableConfig['start']?>"
       data-limit     = "<?= $tableConfig['limit']?>"
       data-search    = "<?= $tableConfig['search']?>"
       data-order-by  = "<?= $tableConfig['orderBy']?>"
       data-order-dir = "<?= $tableConfig['orderDir']?>"
>
    <tr class="tr-table-header">
        <th>Id</th>
        <th> {{ app('ZendTranslator')->translate('tr_melis_lumen_table1_heading_name') }}</th>
        <th>Date</th>
        <th> {{ app('ZendTranslator')->translate('tr_melis_lumen_table1_heading_songs') }}</th>
        <th class="text-center"> Action </th>
    </tr>
    @foreach ($data as $idx => $val)
        <tr>
            <td>{{ $val->alb_id }}</td>
            <td>{{ $val->alb_name }}</td>
            <td>{{ $val->alb_date }}</td>
            <td>{{ $val->alb_song_num}}</td>
            <td class=" dtActionCls text-center" ><div><a href="#modal-template-manager-actions" data-toggle="modal" class="btn btn-success btnEditTemplates" title="Edit"> <i class="fa fa-pencil"> </i> </a> <a class="btn btn-danger btnDelTemplate" title="Delete"> <i class="fa fa-times"> </i> </a></div></td>
        </tr>
    @endforeach
</table>

