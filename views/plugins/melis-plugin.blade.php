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
