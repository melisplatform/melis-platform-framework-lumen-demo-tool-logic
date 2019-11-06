<?php
    $namespace = 'MelisPlatformFrameworkLumenDemoToolLogic';
    /** @var \Zend\Mvc\I18n\Translator $zendTranslator */
    $zendTranslator = app('ZendTranslator');
    $tableConfig = config('album_table_config')['table'];
?>
<div class="me-heading bg-white">
    <div class="row">
        <div class="me-hl col-xs-12 col-sm-12 col-md-12">
            <h1 class="content-heading">{{ __('lumenDemo::translations.tr_melis_lumen_main_heading') }}</h1>
            <p>{{ __('lumenDemo::translations.tr_melis_lumen_main_sub_heading') }} </p>
        </div>
    </div>
</div>
<div class="innerAll spacing-x2">
    <!-- header area -->
    @include($namespace . "::lumen-tool/tool-header")
    {{-- album list --}}
    <?= app('melisdatatable')->createTable($tableConfig)   ?>
    @include($namespace . "::lumen-tool/tool-language-list",$coreLang)
    <!-- temp modal -->
    @include($namespace . "::lumen-tool/temp-modal")
</div>