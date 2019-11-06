<div class="widget-head">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#" class="glyphicons plus" data-toggle="tab" aria-expanded="true"><i></i>{{ __('lumenDemo::translations.tr_melis_lumen_modal_add_title') }}</a></li>
    </ul>
</div>
<div class="widget-body innerAll inner-2x">
    <div class="tab-content">
        <div class="tab-pane active">
            <div class="main-content">
                <?= $form ?>
                <br>
                <div align="right">
                    <button data-dismiss="modal" class="btn btn-danger pull-left lumen-modal-close" ><i class="fa fa-times"></i> <?= __('lumenDemo::translations.tr_common_close')?></button>
                    <button type="submit" class="btn btn-success" id="btn-save-lumen-album"><i class="fa fa-save"></i>  <?= __('lumenDemo::translations.tr_common_save')?></button>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>