<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bosch</title>
        <?php echo $this->Html->css('vendors/font-awesome/min'); ?>
        <?php echo $this->Html->css('base'); ?>
        <?php echo $this->Html->css('empty'); ?>
        <?php echo $this->fetch('stylesTop'); ?>
    </head>
    <body>
        <?php echo $this->Html->script('globalization') . PHP_EOL; ?>
        <?php echo $this->fetch('content'); ?>
        <?php echo $this->fetch('jsVars'); ?>
        <?php echo $this->Html->script('init') . PHP_EOL; ?>
        <?php echo $this->Html->script('vendors/jquery/1.10.1.min') . PHP_EOL; ?>
        <?php echo $this->Html->script('base') . PHP_EOL; ?>
        <?php echo $this->Html->script('vendors/swig/min') . PHP_EOL; ?>
        <?php echo $this->Html->script('vendors/bootstrap/min') . PHP_EOL; ?>
        <?php echo $this->fetch('scriptBottom') . PHP_EOL; ?>
    </body>
</html>
