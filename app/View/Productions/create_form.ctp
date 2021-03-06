<form class="form-inline" role="form" id="formOperation" method="post">
    <fieldset>
        <legend><?php echo __('Agregar'); ?></legend>
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
        <?php
        $unit = Units::names(Units::UNITS);
        $placeholderUnits = $unit['name'];
        ?>
        <?php $textValue = __('Valor'); ?>
        <div class = "form-group">
            <label for="value" class="control-label"><?php echo $textValue; ?></label>
            <br/>
            <input type="text" required="required" class="form-control input-lg" id="value"  name='value' placeholder="<?php echo $placeholderUnits; ?>">
        </div>
        <div class = "form-group">
            <br/>
            <button type="submit" class="btn btn-primary btn-lg">Guardar</button>
        </div>
    </fieldset>
</form>
<br/>
<fieldset>
    <legend><?php echo __('Listar'); ?></legend>
    <table class="table table-bordered table-condensed table-striped">
        <thead>
            <tr>
                <th>Modelo</th>
                <th>Index</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productions as $production) : ?>
                <tr>
                    <td><?php echo $production['mName'] ?></td>
                    <td><?php echo $production['iName'] ?></td>
                    <td><?php echo $production['pValue'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</fieldset>
<hr/>