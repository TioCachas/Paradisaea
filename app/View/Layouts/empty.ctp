<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php echo $this->Html->css('empty'); ?>
        <?php echo $this->fetch('stylesTop'); ?>
    </head>
    <body class="emtpy">
        <?php echo $this->fetch('content'); ?>
        <?php echo $this->fetch('jsVars'); ?>
        <?php echo $this->fetch('scriptBottom') . PHP_EOL; ?>
    </body>
</html>
