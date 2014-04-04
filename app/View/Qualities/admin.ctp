<?php
if (isset($appBosch) === true) {
    $this->Html->script('controllers/Qualities/admin', array('block' => 'scriptBottom'));
    $appBosch->crud = $this->TioCachas->urlsCRUD();
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
        <?php echo __("La operación no es válida."); ?>
    </div>
    <?php
}
