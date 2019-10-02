<div class="modal-content">
    <div class="modal-body padding-none">
        <div class="wizard">
            <div class="widget widget-tabs widget-tabs-double widget-tabs-responsive margin-none border-none">
                <div class="widget-head">
                    <ul class="nav nav-tabs">
                        <?php if ( empty($data)) {?>
                            <li class="active"><a href="#" class="glyphicons plus" data-toggle="tab" aria-expanded="true"><i></i> Add album</a></li>
                        <?php } else {?>
                            <li class="active"><a href="#" class="glyphicons pencil" data-toggle="tab" aria-expanded="true"><i></i> Edit album</a></li>
                        <?php }?>
                    </ul>
                </div>
                <div class="widget-body innerAll inner-2x">
                    <div class="tab-content">
                        <div class="tab-pane active">
                            <form action="POST" name="lumen_demo_tool_add_album" id="lumen_demo_tool_add_album">
                                <div class="form-group">
                                    <label for="alb_name">
                                        Name
                                        <i class="fa fa-info-circle fa-lg pull-right tip-info" data-toggle="tooltip" data-placement= "left" data-original-title="Name of the album"></i>
                                    </label>
                                    <input type="text" id="alb_name" class="form-control" name="alb_name" value="{{ $data->alb_name ?? null }}">
                                </div>
                                <div class="form-group">
                                    <label for="alb_song_num">
                                        Songs
                                        <i class="fa fa-info-circle fa-lg pull-right tip-info" data-toggle="tooltip" data-placement="left" data-original-title="Song number"></i>
                                    </label>
                                    <input type="text" id="alb_song_num" class="form-control" name="alb_song_num" value="{{ $data->alb_song_num ?? null}}">
                                </div>
                                <?php if (!empty($data)){?>
                                <input type="hidden" id="alb_id" class="form-control" name="alb_id" value="{{ $data->alb_id }}">
                                    <div class="form-group">
                                        <label for="alb_date">
                                            Date
                                            <i class="fa fa-info-circle fa-lg pull-right tip-info" data-toggle="tooltip" data-placement= "left" data-original-title="Date"></i>
                                        </label>
                                        <input type="text" id="alb_date" class="form-control" name="alb_date" value="{{ $data->alb_date }}" readonly>
                                    </div>
                                <?php } ?>
                                <br>
                                <div align="right">
                                    <button data-dismiss="modal" class="btn btn-danger pull-left lumen-modal-close" ><i class="fa fa-times"></i> <?php echo app('ZendTranslator')->translate('tr_meliscore_common_close')?></button>
                                    <button type="submit" class="btn btn-success" id="btn-save-lumen-album"><i class="fa fa-save"></i>  <?php echo app('ZendTranslator')->translate('tr_meliscore_tool_gen_save')?></button>
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

