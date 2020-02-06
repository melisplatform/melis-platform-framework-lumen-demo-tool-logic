<?php $namespace = 'MelisPlatformFrameworkLumenDemoToolLogic'; ?>
<!-- header area -->
@include($namespace . "::lumen-tool/tool-header")
<div class="innerAll spacing-x2">
    <div class="row">
        <div class="me-hl col-12 col-md-9">
            <h3>{{ __('lumenDemo::translations.tr_melis_lumen_table1_heading_songs_head_album')  }}</h3>
            <br>
            <p>{{ __('lumenDemo::translations.tr_melis_lumen_album_header') }}</p>
        </div>
    </div>
    {{-- album list --}}
    <?= app('melisdatatable')->createTable(config('album_table_config')['table']) ?>
    @include($namespace . "::lumen-tool/tool-language-list",$coreLang)
    <!-- temp modal -->
    @include($namespace . "::lumen-tool/temp-modal")
</div>