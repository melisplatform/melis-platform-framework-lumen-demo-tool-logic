<h3>Table melis_demo_album_table_lumen</h3>
<table class='table'>
    <tr>
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

<h3>News Data</h3>