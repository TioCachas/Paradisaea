<?php $this->Html->script('controllers/Operations/form', array('block' => 'scriptBottom')); ?>
<?php $this->Html->css('controllers/Operations/form', array('block' => 'stylesTop')); ?>
<form class="form-inline" role="form" id="formOperation">
    <?php $textHour = __('Hora'); ?>
    <div class="form-group">
        <label for="hour" class="control-label"><?php echo $textHour; ?></label>
        <br/>
        <select id="hour" name='hour' class="form-control input-lg">
            <?php $this->Bosch->hours($hours); ?>
        </select>
    </div>
    <?php $textModel = __('Modelo'); ?>
    <div class="form-group">
        <label for="model" class="control-label"><?php echo $textModel; ?></label>
        <br/>
        <select id="model" name='model' class="form-control input-lg">
            <?php $this->Bosch->models($models); ?>
        </select>
    </div>
    <?php $textModel = __('Index'); ?>
    <div class="form-group">
        <label for="index" class="control-label"><?php echo $textModel; ?></label>
        <br/>
        <select id="index" name='index' class="form-control input-lg">
            <?php $this->Bosch->indexes($indexes); ?>
        </select>
        <i id="indexLoading" class="fa fa-spinner fa-spin hidden"></i>
    </div>
    <hr/>
    <?php
    $textProduction = __('Piezas OK');
    $unit = Units::names(Units::UNITS);
    $placeholderUnits = $unit['name'];
    $unit = Units::names(Units::MINUTES);
    $placeholderMins = $unit['name'];
    ?>
    <div class = "form-group">
        <label for="production" class="control-label"><?php echo $textProduction; ?></label>
        <br/>
        <input type="text" class="form-control" id="production"  name='production' placeholder="<?php echo $placeholderUnits; ?>">
    </div>
    <?php $textScrap = __('Scrap'); ?>
    <div class = "form-group">
        <label for="scrap" class="control-label"><?php echo $textScrap; ?></label>
        <br/>
        <input type="text" class="form-control" id="scrap"  name='scrap' placeholder="<?php echo $placeholderUnits; ?>">
    </div>
    <?php $textRetrabajo = __('Retrabajo'); ?>
    <div class = "form-group">
        <label for="rework" class="control-label"><?php echo $textRetrabajo; ?></label>
        <br/>
        <input type="text" class="form-control" id="rework"  name='rework' placeholder="<?php echo $placeholderUnits; ?>">
    </div>
    <?php $textChangeover = __('Cambio de modelo'); ?>
    <div class = "form-group">
        <label for="changeover" class="control-label"><?php echo $textChangeover; ?></label>
        <br/>
        <input type="text" class="form-control" id="changeover"  name='changeover' placeholder="<?php echo $placeholderMins; ?>">
    </div>
    <?php $textTechnicalLosses = __('Paro tecnico'); ?>
    <div class = "form-group">
        <label for="technicalLosses" class="control-label"><?php echo $textTechnicalLosses; ?></label>
        <br/>
        <input type="text" class="form-control" id="technicalLosses"  name='technicalLosses' placeholder="<?php echo $placeholderMins; ?>">
    </div>
    <?php $textOrganizationalLosses = __('Organizational losses'); ?>
    <div class = "form-group">
        <label for="organizationalLosses" class="control-label"><?php echo $textOrganizationalLosses; ?></label>
        <br/>
        <input type="text" class="form-control" id="organizationalLosses"  name='organizationalLosses' placeholder="<?php echo $placeholderMins; ?>">
    </div>
    <div class = "form-group">
        <br/>
        <button type="button" class="btn btn-primary" id="saveOperation" disabled="disabled">
            <?php echo __('Guardar'); ?>
        </button>
    </div>
    <i id='loading' class="fa fa-refresh fa-spin hidden"></i>
</form>
<hr/>
<ul class="nav nav-tabs" id="myTab">
    <li class="active"><a href="#detailCurrentDay" data-toggle="tab"><?php echo __('Operaciones del dia actual'); ?></a></li>
    <li><a href="#resumenCurrentDay" data-toggle="tab"><?php echo __('Resumen dia actual'); ?></a></li>
</ul>
<div class="tab-content">
    <div class="tab-pane fade in active table-responsive" id="detailCurrentDay">
        <?php $this->TableOperations->render(); ?>
    </div>
    <div class="tab-pane fade table-responsive" id="resumenCurrentDay">
        <?php $this->TableOperations->byCurrentDay(); ?>
    </div>
</div>
<script type="text/javascript">
    var urlList = <?php echo json_encode($this->Html->url(array('action' => 'get'))); ?>;
    var urlCreate = <?php echo json_encode($this->Html->url(array('action' => 'create'))); ?>;
    var urlDelete = <?php echo json_encode($this->Html->url(array('action' => 'delete'))); ?>;
    var urlGetIndexes = <?php echo json_encode($this->Html->url(array('controller' => 'Indexes', 'action' => 'getOptions'))); ?>;
    var urlGetDefects = <?php echo json_encode($this->Html->url(array('controller' => 'Defects', 'action' => 'getOptions'))); ?>;
    var msgDeleteConfirmation = <?php echo json_encode('Deseas eliminar esta operacion?'); ?>;
</script>
<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
    Launch demo modal
</button>
<div class="modal fade bs-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">
                    <?php echo __('Scrap'); ?>
                </h4>
            </div>
            <div class="modal-body">
                <form class="form-inline" role="form" id="formOperation">
                    <?php $textWorkstation = __('Estacion de trabajo'); ?>
                    <div class="form-group">
                        <label for="workstation" class="control-label"><?php echo $textWorkstation; ?></label>
                        <br/>
                        <select id="workstation" name='workstation' class="form-control input-lg">
                            <?php $this->Bosch->workstations($workstations); ?>
                        </select>
                    </div>
                    <?php $textDefects = __('Tipo de defecto'); ?>
                    <div class="form-group">
                        <label for="defect" class="control-label"><?php echo $textDefects; ?></label>
                        <br/>
                        <select id="defect" name='defect' class="form-control input-lg">
                            <?php $this->Bosch->defects($defects); ?>
                        </select>
                        <i id="defectLoading" class="fa fa-spinner fa-spin hidden"></i>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
