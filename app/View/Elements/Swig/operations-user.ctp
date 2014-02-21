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
    <td class="text-right">
        <a href="<?php echo $this->Html->url(array('controller' => 'Productions', 'action' => 'capture')); ?>/{{oId}}" title="<?php echo __('Piezas OK'); ?>">
            {{ oProduction }}
            <?php echo $symbolHtmlUnits; ?>
        </a>
        <div class="progress" title="{{oProduction/oTarget*100}}%">
            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{ oProduction }}" aria-valuemin="0" aria-valuemax="{{ oTarget }}" style="width: {{ oProduction/oTarget*100 }}%">
            </div>
        </div>
    </td>
    {% else %}
    <td class="text-right">
        <a href="<?php echo $this->Html->url(array('controller' => 'Productions', 'action' => 'capture')); ?>/{{oId}}" title="<?php echo __('Piezas OK'); ?>">
            {{ oProduction }}
            <?php echo $symbolHtmlUnits; ?>
        </a>
        <div class="progress" title="{{oProduction/oTarget*100}}%">
            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{ oProduction }}" aria-valuemin="0" aria-valuemax="{{ oTarget }}" style="width: {{ oProduction/oTarget*100 }}%">
            </div>
        </div>
    </td>
    {% endif %}
    {% if sumPzOk >= sumTarget %}
    <td class="text-right"  title="<?php echo __('Acumulado de piezas OK'); ?>">
        {{ sumPzOk }}
        <?php echo $symbolHtmlUnits; ?>
        <div class="progress" title="{{sumPzOk/sumTarget*100}}%">
            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{ sumPzOk }}" aria-valuemin="0" aria-valuemax="{{ sumTarget }}" style="width: {{ sumPzOk/sumTarget*100 }}%">
            </div>
        </div>
    </td>
    {% else %}
    <td class="text-right" title="<?php echo __('Acumulado de piezas OK'); ?>">
        {{ sumPzOk }}
        <?php echo $symbolHtmlUnits; ?>
        <div class="progress" title="{{sumPzOk/sumTarget*100}}%">
            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{ sumPzOk }}" aria-valuemin="0" aria-valuemax="{{ sumTarget }}" style="width: {{ sumPzOk/sumTarget*100 }}%">
            </div>
        </div>
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
