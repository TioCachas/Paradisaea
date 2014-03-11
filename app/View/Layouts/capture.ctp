<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="/favicon.ico">
        <title>Bosch</title>
        <?php echo $this->Html->css('vendors/bootstrap/min'); ?>
        <?php echo $this->Html->css('vendors/font-awesome/min'); ?>
        <?php echo $this->Html->css('base'); ?>
        <?php echo $this->Html->css('menu'); ?>
        <?php echo $this->Html->css('footer'); ?>
        <?php echo $this->fetch('stylesTop'); ?>
    </head>
    <body>
        <header>
            <?php echo $this->element('Capture/menu'); ?>
            <div id="titles" class="jumbotron">
                <?php if (isset($title) === true): ?>
                    <div class="container">
                        <h1><?php echo $title; ?></h1>
                        <?php if (isset($description) === true): ?>
                            <p><?php echo $description; ?></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </header>
        <div class="container" id='mainContent'>
            <?php echo $this->fetch('content'); ?>
        </div>
        <?php echo $this->Html->script('globalization') . PHP_EOL; ?>
        <?php echo $this->fetch('jsVars'); ?>
        <?php echo $this->Html->script('init') . PHP_EOL; ?>
        <?php echo $this->Html->script('vendors/jquery/1.10.1.min') . PHP_EOL; ?>
        <?php echo $this->Html->script('base') . PHP_EOL; ?>
        <?php echo $this->Html->script('vendors/underscore/min') . PHP_EOL; ?>
        <?php echo $this->Html->script('vendors/swig/min') . PHP_EOL; ?>
        <?php echo $this->Html->script('vendors/backbone/min') . PHP_EOL; ?>
        <?php echo $this->Html->script('vendors/bootstrap/min') . PHP_EOL; ?>
        <?php echo $this->Html->script('capture') . PHP_EOL; ?>
        <?php echo $this->fetch('scriptBottom') . PHP_EOL; ?>
        <footer>
            <?php echo $this->element('footer'); ?>
        </footer>
    </body>
</html>
