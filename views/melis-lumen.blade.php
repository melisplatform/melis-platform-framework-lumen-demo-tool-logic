<style>
    .tr-table-header {
        background: #e61c23;
        color:#fff;
        line-height: normal;
    }
</style>
<h3>Table melis_demo_album_table_lumen</h3>
<table class='table'>
    <tr class="tr-table-header">
        <th>Id</th>
        <th>Name</th>
        <th>Date</th>
        <th>Song number</th>
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

<br>
<br>
<h3><strong>News Data</strong></h3>
<p>Sample of rendering the news data from a MelisServices class</p>
<table class='table'>
    <tr class='tr-table-header' >
        <th>ID</th>
        <th>Status</th>
        <th>Title</th>
        <th>Date Created</th>
        <th>Published Date</th>
        <th>Unpublished Date</th>
        <th>Site</th>
    </tr>
    @foreach ($newsData as $idx => $val)
        <tr>
            <td>{{ $val['cnews_id'] }}</td>
            <td>
                @if ($val['cnews_status'])
                    <i class="fa fa-circle text-success"></i>
                @else
                    <i class="fa fa-circle text-danger"></i>
                @endif
            </td>
            <td>{{ $val['cnews_title'] }}</td>
            <td>{{ $val['cnews_creation_date'] }}</td>
            <td>{{ $val['cnews_publish_date'] }}</td>
            <td>{{ $val['cnews_unpublish_date'] }}</td>
            <td>{{ $val['site_label'] }}</td>
        </tr>
    @endforeach
</table>