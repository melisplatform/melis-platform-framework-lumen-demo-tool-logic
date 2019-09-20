<style>
    .tr-table-header {
        background: #e61c23;
        color:#fff;
        line-height: normal;
    }
    .display-2 {
        font-size:18px;
    }
    .circle-image {
        border-radius: 100%;
        border: 2px solid #fff;
        box-shadow: 0px 1px 1px rgba(0,0,0,0.3);
    }
</style>
<div class="lumen-album-head">
    <div class="row">
        <div id="id_meliscmsnews_list_header_left" data-meliskey="meliscmsnews_list_header_left" class="me-hl col-xs-12 col-md-9">
            <h4>{{ app('translator')->translate('tr_melis_lumen_table1_heading_songs_head_album') }}</h4>
            <p>{{ app('translator')->translate('tr_melis_lumen_demo_tool_sample_1_heading')  }}</p>
        </div>
        <div id="lumen_album_list_header_right" data-meliskey="lumen_album_list_header_right" class="me-hl col-xs-12 col-md-3" align="right">
            <a data-meliskey="lumen_album_list_header_right_add" class="btn btn-success add-lumen-album" title="Add album"><i class="fa fa-plus"></i> Add album</a>
        </div>
    </div>
</div>
{{-- filter area--}}
<div class="row">
    Filters
</div>

<table class='table'>
    <tr class="tr-table-header">
        <th>Id</th>
        <th> {{ app('translator')->translate('tr_melis_lumen_table1_heading_name') }}</th>
        <th>Date</th>
        <th> {{ app('translator')->translate('tr_melis_lumen_table1_heading_songs') }}</th>
    </tr>
    @foreach ($data as $idx => $val)
        <tr>
            <td>{{ $val->alb_id }}</td>
            <td>{{ $val->alb_name }}</td>
            <td>{{ $val->alb_date }}</td>
            <td>{{ $val->alb_song_num}}</td>
        </tr>
    @endforeach
</table>
