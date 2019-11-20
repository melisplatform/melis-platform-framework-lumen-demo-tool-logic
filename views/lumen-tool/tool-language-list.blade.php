<br>
<h3>{{ __('lumenDemo::translations.tr_melis_lumen_table1_heading_songs_head_language') }}</h3>
<p>{{ __('lumenDemo::translations.tr_melis_lumen_second_header')  }}</p>
<table class='table table-striped'>
    <tr style="border-color: #e61c23;background-color: #e61c23;">
        <th>ID</th>
        <th> {{ __('lumenDemo::translations.tr_melis_lumen_table1_heading_name') }}</th>
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