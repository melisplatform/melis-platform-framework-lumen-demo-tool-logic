<table class='table table-bordered table-striped'>
    <thead>
        <tr>
            <th>Id</th>
            <th> {{ __("lumenDemo::translations.tr_melis_lumen_table1_heading_name") }}</th>
            <th>Date</th>
            <th> {{ __("lumenDemo::translations.tr_melis_lumen_table1_heading_songs") }} </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $idx => $val)
            <tr>
                <td>{{ $val->alb_id }}</td>
                <td>{{ $val->alb_name }}</td>
                <td>{{ $val->alb_date }}</td>
                <td>{{ $val->alb_song_num}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
