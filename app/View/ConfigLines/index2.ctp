<?php $textLines = __('Líneas de producción'); ?>
<div class="form-group">
    <label for="hour" class="control-label"><?php echo $textLines; ?></label>
    <br/>
    <select id="hour" name='hour' class="form-control input-lg">
        <?php $this->Bosch->lines($lines); ?>
    </select>
</div>
<form class="form-inline" role="form" id="formOperation">
    <?php $textProduction = __('Producción'); ?>
    <div class = "form-group">
        <label for="production" class="control-label"><?php echo $textProduction; ?></label>
        <br/>
        <input type="text" class="form-control input-lg" id="production"  name='production' placeholder="<?php echo $textProduction; ?>">
    </div>
    <?php $textScrap = __('Scrap'); ?>
    <div class = "form-group">
        <label for="scrap" class="control-label"><?php echo $textScrap; ?></label>
        <br/>
        <input type="text" class="form-control input-lg" id="scrap"  name='scrap' placeholder="<?php echo $textScrap; ?>">
    </div>
    <?php $textRetrabajo = __('Retrabajo'); ?>
    <div class = "form-group">
        <label for="rework" class="control-label"><?php echo $textRetrabajo; ?></label>
        <br/>
        <input type="text" class="form-control input-lg" id="rework"  name='rework' placeholder="<?php echo $textRetrabajo; ?>">
    </div>
    <div class = "form-group">
        <br/>
        <button type="button" class="btn btn-primary btn-lg" id="saveOperation" disabled="disabled">
            <?php echo __('Guardar'); ?>
        </button>
    </div>
    <i id='loading' class="fa fa-refresh fa-spin hidden"></i>
</form>