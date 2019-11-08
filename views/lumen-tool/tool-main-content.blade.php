<?php $namespace = 'MelisPlatformFrameworkLumenDemoToolLogic'; ?>
<!-- header area -->
@include($namespace . "::lumen-tool/tool-header")
<div class="innerAll spacing-x2">
    {{-- album list --}}
    <?= app('melisdatatable')->createTable(config('album_table_config')['table']) ?>
    @include($namespace . "::lumen-tool/tool-language-list",$coreLang)
    <!-- temp modal -->
    @include($namespace . "::lumen-tool/temp-modal")
</div>