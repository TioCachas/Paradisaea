<?php
$urlProductions = $this->Html->url(array(
    'controller' => 'Productions', 'action' => 'admin'));
$symbolHtmlUnits = Units::symbolHtml(Units::UNITS);
$symbolHtmlminutes = Units::symbolHtml(Units::MINUTES);
?>
{% if oProduction >= oTarget %}
<tr data-id="{{ oId }}" class="success">
    {% else %}
<tr data-id="{{ oId }}" class="danger">
    {% endif %}
    <td>{{ hour }}</td>
    <td class="text-right" title="<?php echo __('Piezas objetivo'); ?>">
        {{ oTarget }}
        <?php echo $symbolHtmlUnits; ?>
    </td>
    <td class="text-right" title="<?php echo __('Acumulado piezas objetivo'); ?>">
        {{ sumTarget }}
        <?php echo $symbolHtmlUnits; ?>
    </td>
    {% if oProduction >= oTarget %}
    <td class="text-right"  title="<?php echo __('Piezas OK'); ?>">
        <a href="<?php echo $this->Html->url(array('controller' => 'Productions', 'action' => 'createForm')); ?>/{{oId}}">
            {{ oProduction }}
            <?php echo $symbolHtmlUnits; ?>
            <i class="fa fa-thumbs-o-up pull-right"></i>
        </a>
    </td>
    {% else %}
    <td class="text-right" title="<?php echo __('Piezas OK'); ?>">
        <a href="<?php echo $this->Html->url(array('controller' => 'Productions', 'action' => 'createForm')); ?>/{{oId}}">
            {{ oProduction }}
            <?php echo $symbolHtmlUnits; ?>
            <i class="fa fa-thumbs-o-down pull-right"></i>
        </a>
    </td>
    {% endif %}
    {% if sumPzOk >= sumTarget %}
    <td class="text-right"  title="<?php echo __('Acumulado de piezas OK'); ?>">
        {{ sumPzOk }}
        <?php echo $symbolHtmlUnits; ?>
        <i class="fa fa-thumbs-o-up pull-right"></i>
    </td>
    {% else %}
    <td class="text-right" title="<?php echo __('Acumulado de piezas OK'); ?>">
        {{ sumPzOk }}
        <?php echo $symbolHtmlUnits; ?>
        <i class="fa fa-thumbs-o-down pull-right"></i>
    </td>
    {% endif %}
    <td class="text-right" title="<?php echo __('Scrap'); ?>">
        {{ oScrap }}
        <?php echo $symbolHtmlUnits; ?>
    </td>
    <td class="text-right" title="<?php echo __('Retrabajo'); ?>">
        {{ oRework }}
        <?php echo $symbolHtmlUnits; ?>
    </td>
    <td class="text-right" title="<?php echo __('Perdidas por cambio de modelo'); ?>">
        {{ oChangeover }}
        <?php echo $symbolHtmlminutes; ?>
    </td>
    <td class="text-right" title="<?php echo __('Perdidas tecnicas'); ?>">
        {{ oTechnicalLosses }}
        <?php echo $symbolHtmlminutes; ?>
    </td>
    <td class="text-right" title="<?php echo __('Perdidas organizacionales'); ?>">
        {{ oOrganizationalLosses }}
        <?php echo $symbolHtmlminutes; ?>
    </td>
    <td class="text-right" title="<?php echo __('Perdidas por calidad'); ?>">
        {{ oQualityLosses }}
        <?php echo $symbolHtmlminutes; ?>
    </td>
    <td class="text-right" title="<?php echo __('Perdidas por desempeño'); ?>">
        {{ oPerformanceLosses }}
        <?php echo $symbolHtmlminutes; ?>
    </td>
</tr>