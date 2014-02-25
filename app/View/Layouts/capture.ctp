<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">
        <title>Bosch</title>
        <?php echo $this->Html->css('vendors/bootstrap/min'); ?>
        <?php echo $this->Html->css('vendors/font-awesome/min'); ?>
        <?php echo $this->Html->css('vendors/jqueryui/min'); ?>
        <?php
        $this->Html->css('base', array(
            'block' => 'stylesTop'));
        ?>
        <?php echo $this->fetch('stylesTop'); ?>
    </head>
    <body>
        <?php echo $this->element('Capture/menu'); ?>
        <div class="jumbotron" id="logoBosch">
            <div class="container">
                <h1>
                    <?php echo $title; ?>
                </h1>
                <p>
                    <?php echo $description; ?>
                </p>
            </div>
        </div>
        <div class="container">
            <?php echo $this->fetch('content'); ?>
        </div>
        <?php echo $this->fetch('jsVars'); ?>
        <?php echo $this->Html->script('init') . PHP_EOL; ?>
        <?php echo $this->Html->script('vendors/jquery/1.10.1.min') . PHP_EOL; ?>
        <?php echo $this->Html->script('vendors/underscore/min') . PHP_EOL; ?>
        <?php echo $this->Html->script('vendors/swig/min') . PHP_EOL; ?>
        <?php echo $this->Html->script('vendors/backbone/min') . PHP_EOL; ?>
        <?php echo $this->Html->script('vendors/bootstrap/min') . PHP_EOL; ?>
        <?php echo $this->Html->script('vendors/jqueryui/min') . PHP_EOL; ?>
        <?php echo $this->Html->script('capture') . PHP_EOL; ?>
        <?php echo $this->fetch('scriptBottom') . PHP_EOL; ?>
        <script type="text/javascript">
            jQuery(function($) {
                $.datepicker.regional['es'] = {
                    closeText: 'Cerrar',
                    prevText: '&#x3c;Ant',
                    nextText: 'Sig&#x3e;',
                    currentText: 'Hoy',
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun',
                        'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    dayNames: ['Domingo', 'Lunes', 'Martes', 'Mi&eacute;rcoles', 'Jueves', 'Viernes', 'S&aacute;bado'],
                    dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mi&eacute;', 'Juv', 'Vie', 'S&aacute;b'],
                    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'S&aacute;'],
                    weekHeader: 'Sm',
                    dateFormat: 'dd/mm/yy',
                    firstDay: 1,
                    isRTL: false,
                    showMonthAfterYear: false,
                    yearSuffix: ''};
                $.datepicker.setDefaults($.datepicker.regional['es']);
            });

            function renderOptions(target, options)
            {
                $(target).html('');
                options.forEach(function(o) {
                    var option = $('<option>');
                    option.val(o.value);
                    option.html(o.text);
                    $(target).append(option);
                });
            }
        </script>
    </body>
</html>
