<div class="lumen-album-head">
    <div class="row">
        <div id="id_meliscmsnews_list_header_left" data-meliskey="meliscmsnews_list_header_left" class="me-hl col-xs-12 col-md-9">
            <p>{{ app('ZendTranslator')->translate('tr_melis_lumen_demo_tool_sample_1_heading')  }}</p>
        </div>
        <div id="lumen_album_list_header_right" data-meliskey="lumen_album_list_header_right" class="me-hl col-xs-12 col-md-3" align="right">
            <a data-meliskey="lumen_album_list_header_right_add" data-toggle="modal" data-target="#lumenModal"  class="btn btn-success add-lumen-album" title="Add album"><i class="fa fa-plus"></i> <?= app('ZendTranslator')->translate('tr_melis_lumen_modal_add_title')?></a>
        </div>
        <?php
            echo __('lumenDemo::translations.test');
        ?>
    </div>
</div>