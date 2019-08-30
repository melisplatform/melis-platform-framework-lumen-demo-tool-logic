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
<h3><strong>Sample 1.</strong> melis_demo_album_table_lumen sample data</h3>
<p>Sample of getting the data from table melis_demo_album_table_lumen using typical <strong>Lumen</strong> model</p>
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
<h3><strong>Sample 2.</strong> MelisServiceProvider class</h3>
<p class="display-2">Sample of rendering the <mark>Melis back-office language data</mark>from a MelisServiceProvider class</p>
<table class='table'>
    <tr class='tr-table-header' >
        <th>ID</th>
        <th>Locale</th>
        <th>Lang name</th>
    </tr>
    @foreach ($coreLang as $idx => $val)
        <tr>
            <td>{{ $val['lang_id'] }}</td>
            <td>{{ $val['lang_locale'] }}</td>
            <td>{{ $val['lang_name'] }}</td>
        </tr>
    @endforeach
</table>