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
<h3><strong>Sample 1.</strong> melis_demo_albumt_table_lumen sample data</h3>
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
<p class="display-2">Sample of rendering the <mark>News Data</mark>from a MelisServiceProvider class</p>
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
<br>
<br>
<h3><strong>Sample 3.</strong>Melis core users data (table melis_core_user)</h3>
<p>Sample data from using the melis connection db through a <mark>Lumen Model</mark></p>
<pre>
    see: melis-platform-framework-lumen-demo-tool-logic/src/Controllers/MelisLumenController.php
</pre>
<table class='table'>
    <tr class='tr-table-header' >
        <th>ID</th>
        <th>Login</th>
        <th><i class="fa fa-power-off"></i></th>
        <th>Status</th>
        <th>Photo</th>
        <th>Email</th>
        <th>Name</th>
        <th>Last login</th>
    </tr>
    @foreach ($coreUsersData as $idx => $user)
        <tr>
            <td>{{ $user['usr_id'] }}</td>
            <td>{{ $user['usr_login'] }}</td>
            <td>
                @if ($user['usr_is_online'])
                    <i class="fa fa-circle text-success"></i>
                @else
                    <i class="fa fa-circle text-danger"></i>
                @endif
            </td>
            <td>
                @if ($user['usr_status'])
                    <i class="fa fa-circle text-success"></i>
                @else
                    <i class="fa fa-circle text-danger"></i>
                @endif
            </td>
            <td>
                <?php
                    $imageSrc = "/MelisCore/images/profile/default_picture.jpg";
                    if (! empty($user['usr_image'])) {
                        $imageSrc = "data:image/jpeg;base64," . base64_encode($user['usr_image']);
                    }
                ?>
                <img class='circle-image' src="{{ $imageSrc }}" width="24" height="24" alt="">

            </td>
            <td>{{ $user['usr_email'] }}</td>
            <td>{{ $user['usr_firstname']  . " " . $user['usr_lastname'] }}</td>
            <td>{{ $user['usr_last_login_date'] }}</td>
        </tr>
    @endforeach
</table>
<br>
<br>
<h3><strong>Sample 4. </strong>Melis core users connection date (table melis_core_user)</h3>
<p>Sample data from  using the melis connection db through a <mark> Illuminate\Support\Facades\DB class </mark></p>
<pre>
    see: melis-platform-framework-lumen-demo-tool-logic/src/Controllers/MelisLumenController.php
</pre>
<table class='table'>
    <tr class='tr-table-header' >
        <th>ID</th>
        <th>User ID</th>
        <th>Last login date</th>
        <th>Last connection time</th>
    </tr>
    @foreach ($coreUserConnectionLogs as $idx => $userInfo)
        <tr>
            <td>{{ $userInfo->usrcd_id }}</td>
            <td>{{ $userInfo->usrcd_usr_login }}</td>
            <td>{{ date('Y-m-d',strtotime($userInfo->usrcd_last_login_date)) }}</td>
            <td>{{ date('h:i:s',strtotime($userInfo->usrcd_last_connection_time)) }}</td>
        </tr>
    @endforeach
</table>