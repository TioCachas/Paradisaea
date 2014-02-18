<?php $this->Html->script('controllers/Operations/form', array('block' => 'scriptBottom')); ?>
<?php
$this->Html->css('controllers/Operations/form', array(
    'block' => 'stylesTop'));
$unit = Units::names(Units::UNITS);
$placeholderUnits = $unit['name'];
$unit = Units::names(Units::MINUTES);
$placeholderMins = $unit['name'];
?>
<form class="form-inline" role="form" id="formOperation">
    <fieldset>
        <legend><?php echo __('Dia y hora'); ?></legend>
        <div class="form-group">
            <label for="workDate"><?php echo __('Dia de trabajo'); ?></label>
            <br/>
            <input type="text" class="form-control input-lg" id="workDate" name="workDate" placeholder="<?php echo __('Dia de trabajo'); ?>">
        </div>
        <?php $textHour = __('Hora'); ?>
        <div class="form-group">
            <label for="hour" class="control-label"><?php echo $textHour; ?></label>
            <br/>
            <select id="hour" name='hour' class="form-control input-lg">
                <?php $this->Bosch->hours($hours); ?>
            </select>
        </div>
        <?php $textScrap = __('Scrap'); ?>
        <div class = "form-group">
            <label for="scrap" class="control-label"><?php echo $textScrap; ?></label>
            <br/>
            <input type="text" class="form-control input-lg" id="scrap"  name='scrap' placeholder="<?php echo $placeholderUnits; ?>">
        </div>
        <?php $textRetrabajo = __('Retrabajo'); ?>
        <div class = "form-group">
            <label for="rework" class="control-label"><?php echo $textRetrabajo; ?></label>
            <br/>
            <input type="text" class="form-control input-lg" id="rework"  name='rework' placeholder="<?php echo $placeholderUnits; ?>">
        </div>
        <?php $textModel = __('Modelo'); ?>
        <!--        <div class="form-group">
                    <label for="model" class="control-label"><?php echo $textModel; ?></label>
                    <br/>
                    <select id="model" name='model' class="form-control input-lg">
        <?php $this->Bosch->models($models); ?>
                    </select>
                </div>-->
        <?php $textModel = __('Index'); ?>
        <!--        <div class="form-group">
                    <label for="index" class="control-label"><?php echo $textModel; ?></label>
                    <br/>
                    <select id="index" name='index' class="form-control input-lg">
        <?php $this->Bosch->indexes($indexes); ?>
                    </select>
                    <i id="indexLoading" class="fa fa-spinner fa-spin hidden"></i>
                </div>-->
    </fieldset>
    <br/>
    <fieldset>
        <legend>Perdidas</legend>
        <?php $textChangeover = __('Cambio de modelo'); ?>
        <div class = "form-group">
            <label for="changeover" class="control-label"><?php echo $textChangeover; ?></label>
            <br/>
            <input type="text" class="form-control" id="changeover"  name='changeover' placeholder="<?php echo $placeholderMins; ?>">
        </div>
        <?php $textTechnicalLosses = __('Tecnicas'); ?>
        <div class = "form-group">
            <label for="technicalLosses" class="control-label"><?php echo $textTechnicalLosses; ?></label>
            <br/>
            <input type="text" class="form-control" id="technicalLosses"  name='technicalLosses' placeholder="<?php echo $placeholderMins; ?>">
        </div>
        <?php $textOrganizationalLosses = __('Organizacionales'); ?>
        <div class = "form-group">
            <label for="organizationalLosses" class="control-label"><?php echo $textOrganizationalLosses; ?></label>
            <br/>
            <input type="text" class="form-control" id="organizationalLosses"  name='organizationalLosses' placeholder="<?php echo $placeholderMins; ?>">
        </div>
        <?php $textQualityLosses = __('Calidad'); ?>
        <div class = "form-group">
            <label for="qualityLosses" class="control-label"><?php echo $textQualityLosses; ?></label>
            <br/>
            <input type="text" class="form-control" id="qualityLosses"  name='qualityLosses' placeholder="<?php echo $placeholderMins; ?>">
        </div>
        <?php $textPerformanceLosses = __('Desempeño'); ?>
        <div class = "form-group">
            <label for="performanceLosses" class="control-label"><?php echo $textPerformanceLosses; ?></label>
            <br/>
            <input type="text" class="form-control" id="performanceLosses"  name='performanceLosses' placeholder="<?php echo $placeholderMins; ?>">
        </div>
        <div class = "form-group">
            <br/>
            <button type="button" class="btn btn-primary" id="saveOperation" disabled="disabled">
                <?php echo __('Guardar'); ?>
            </button>
        </div>
    </fieldset>
    <i id='loading' class="fa fa-refresh fa-spin hidden"></i>
</form>
<hr/>
<ul class="nav nav-tabs" id="myTab">
    <li class="active"><a href="#detailCurrentDay" data-toggle="tab"><?php echo __('Operaciones del dia actual'); ?></a></li>
    <!--<li><a href="#resumenCurrentDay" data-toggle="tab"><?php echo __('Resumen dia actual'); ?></a></li>-->
</ul>
<div class="tab-content">
    <div class="tab-pane fade in active table-responsive" id="detailCurrentDay">
        <?php $this->TableOperations->render(); ?>
    </div>
    <!--    <div class="tab-pane fade table-responsive" id="resumenCurrentDay">
    <?php $this->TableOperations->byCurrentDay(); ?>
        </div>-->
</div>
<script type="text/javascript">
    var urlCaptureProduction = <?php
    echo json_encode(
            $this->Html->url(array(
                'controller' => 'Productions',
                'action' => 'createForm')));
    ?>;
    var urlList = <?php
    echo json_encode(
            $this->Html->url(array(
                'action' => 'get')));
    ?>;
    var urlCreate = <?php
    echo json_encode($this->Html->url(
                    array(
                        'action' => 'create')));
    ?>;
    var urlDelete = <?php
    echo json_encode($this->Html->url(
                    array(
                        'action' => 'delete')));
    ?>;
    var urlGetIndexes = <?php
    echo json_encode($this->Html->url(
                    array(
                        'controller' => 'Indexes', 'action' => 'getOptions')));
    ?>;
    var urlGetDefects = <?php
    echo json_encode($this->Html->url(
                    array(
                        'controller' => 'Defects', 'action' => 'getOptions')));
    ?>;
    var msgDeleteConfirmation = <?php echo json_encode('Deseas eliminar esta operacion?'); ?>;
</script>