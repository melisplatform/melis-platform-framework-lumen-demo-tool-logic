<?php
    # zend translator
    $zendTranslator = app('ZendTranslator');
    $form = [
       'alb_name' => [
           'type' => 'text',
           'label' => $zendTranslator->translate('tr_melis_lumen_table1_heading_name'),
           'value' => $data->alb_name ?? null,
           'attributes' => [
               'required' => 'required'
           ]
       ],
       'alb_song_num' => [
           'type' => 'text',
           'label' => $zendTranslator->translate('tr_melis_lumen_table1_heading_songs'),
           'value' => $data->alb_song_num ?? null
       ]
    ];
    if (! empty($data)) {
        $form['alb_date'] = [
            'type' => 'text',
            'label' => 'Date',
            'value' => $data->alb_date,
            'attributes' => [
                'disabled' => true
            ]
        ];
        $form['alb_id'] = [
            'type' => 'hidden',
            'value' => $data->alb_id
        ];
    }

?>
<div class="modal-content">
    <div class="modal-body padding-none">
        <div class="wizard">
            <div class="widget widget-tabs widget-tabs-double widget-tabs-responsive margin-none border-none">
                <div class="widget-head">
                    <ul class="nav nav-tabs">
                        <?php if ( empty($data)) {?>
                            <li class="active"><a href="#" class="glyphicons plus" data-toggle="tab" aria-expanded="true"><i></i><?= $zendTranslator->translate('tr_melis_lumen_modal_add_title')?></a></li>
                        <?php } else {?>
                            <li class="active"><a href="#" class="glyphicons pencil" data-toggle="tab" aria-expanded="true"><i></i><?= $zendTranslator->translate('tr_melis_lumen_modal_edit_title')?></a></li>
                        <?php }?>
                    </ul>
                </div>
                <div class="widget-body innerAll inner-2x">
                    <div class="tab-content">
                        <div class="tab-pane active">
                            <form action="POST" name="lumen_demo_tool_add_album" id="lumen_demo_tool_add_album">

                                @foreach ($form as $key => $element)
                                    <div class="form-group">
                                        <label for="{{ $key  }}">
                                            {{ $element['label'] ?? null }} <?= isset($element['attributes']['required']) ? "*" : null ?>
                                            <i class="fa fa-info-circle fa-lg pull-right tip-info" data-toggle="tooltip" data-placement= "left" data-original-title="{{ $element['label'] ?? null }}"></i>
                                        </label>
                                        <input type={{ $element['type'] }} id="{{ $key }}" class="form-control" name=" {{ $key }}" value="{{ $element['value'] ?? null }}" <?= isset($element['attributes']['disabled']) ? "disabled = " .$element['attributes']['disabled'] : null ?>>
                                    </div>
                                @endforeach

                                <br>
                                <div align="right">
                                    <button data-dismiss="modal" class="btn btn-danger pull-left lumen-modal-close" ><i class="fa fa-times"></i> <?php echo $zendTranslator->translate('tr_meliscore_common_close')?></button>
                                    <button type="submit" class="btn btn-success" id="btn-save-lumen-album"><i class="fa fa-save"></i>  <?php echo $zendTranslator->translate('tr_meliscore_common_add')?></button>
                                </div>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

