<?php $this->Html->css('elements/carousel',array('block'=>'stylesTop'));?>
<!-- Carousel-->
<div id="boschCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators ">
        <li data-target="#boschCarousel" data-slide-to="0" class="btn-primary active"></li>
        <li data-target="#boschCarousel" data-slide-to="1" class='btn-primary'></li>
        <li data-target="#boschCarousel" data-slide-to="2" class='btn-primary'></li>
    </ol>
    <div class="carousel-inner">
        <div class="item active">
            <?php echo $this->Html->image('slider/i1.jpg', array('data-src' => 'slider/i1.jpg')); ?>
            <div class="container">
                <div class="carousel-caption">
                    <h1>Daily Monitor</h1>
                    <p></p>
                    <p>
                        <a class="btn btn-lg btn-primary" href="<?php echo $this->Html->url(array('controller' => 'Sesion', 'action' => 'index')); ?>" role="button">
                            <?php echo __('Ingresar'); ?>
                        </a>
                    </p>
                </div>
            </div>
        </div>
        <div class="item">
            <?php echo $this->Html->image('slider/i2.jpg', array('data-src' => 'slider/i2.jpg')); ?>
            <div class="container">
                <div class="carousel-caption">
                    <h1>Daily Monitor</h1>
                    <p></p>
                    <p>
                        <a class="btn btn-lg btn-primary" href="<?php echo $this->Html->url(array('controller' => 'Sesion', 'action' => 'index')); ?>" role="button">
                            <?php echo __('Ingresar'); ?>
                        </a>
                    </p>
                </div>
            </div>
        </div>
        <div class="item">
            <?php echo $this->Html->image('slider/i3.jpg', array('data-src' => 'slider/i3.jpg')); ?>
            <div class="container">
                <div class="carousel-caption">
                    <h1>Daily Monitor</h1>
                    <p></p>
                    <p>
                        <a class="btn btn-lg btn-primary" href="<?php echo $this->Html->url(array('controller' => 'Sesion', 'action' => 'index')); ?>" role="button">
                            <?php echo __('Ingresar'); ?>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <a class="left carousel-control" href="#boschCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
    <a class="right carousel-control" href="#boschCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
</div>
<!-- /.carousel -->