<?php
if (isset($appBosch) === true) {
    $this->Html->script('controllers/Scraps/admin', array('block' => 'scriptBottom'));
    $appBosch->crud = $this->TioCachas->urlsCRUD();
    $appBosch->urlDefects = $this->Html->url(array('controller' => 'Defects', 'action' => 'getByWorkstationAndType'));
    ?>
    <div id="grid"></div>
    <?php $this->start('jsVars'); ?>
    <script type="text/javascript">
        var appBosch = <?php echo json_encode($appBosch); ?>;
    </script>
    <?php
    $this->end();
} else {
    ?>
    <div class="alert alert-info">
        <?php echo __("No existen estaciones de trabajo y/o códigos de falla para scrap"); ?>
    </div>
    <?php
}
