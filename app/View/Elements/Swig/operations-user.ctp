<?php
$urlProductions = $this->Html->url(array(
    'controller' => 'Productions', 'action' => 'admin'));
$symbolHtmlUnits = Units::symbolHtml(Units::UNITS);
$symbolHtmlminutes = Units::symbolHtml(Units::MINUTES);
?>
{% if oProduction >= oTarget %}
<tr data-id="{{ oId }}" class="bosch greaterOrEqualThat">
    {% else %}
<tr data-id="{{ oId }}" class="bosch lessThat">
    {% endif %}
    <td>{{ hStart }}</td>
    <td>{{ hEnd }}</td>
    <td class="text-right target" title="<?php echo __('Piezas objetivo'); ?>">
        {{ oTarget }}&nbsp;<?php echo $symbolHtmlUnits; ?>&nbsp;/&nbsp;{{ sumTarget }}&nbsp;<?php echo $symbolHtmlUnits; ?>
    </td>
    <td class="text-right productions">
        <a href='<?php echo $this->Html->url(array('controller' => 'Productions', 'action' => 'capture')); ?>/{{oId}}'>
            {{ oProduction }}&nbsp;<?php echo $symbolHtmlUnits; ?>&nbsp;/&nbsp;{{ sumPzOk }}&nbsp;<?php echo $symbolHtmlUnits; ?>
        </a>
    </td>
    <td>
        {% if oProduction >= oTarget %}
        <div class="progress" title="{{oProduction/oTarget*100}}%">
            <div class="text-center progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{ oProduction }}" aria-valuemin="0" aria-valuemax="{{ oTarget }}" style="width: {{ oProduction/oTarget*100 }}%">
                {{oProduction/oTarget*100}}%
            </div>
        </div>
        {% else %}
        <div class="progress" title="{{oProduction/oTarget*100}}%">
            <div class="text-center progress-bar progress-bar-danger" role="progressbar" aria-valuenow="{{ oProduction }}" aria-valuemin="0" aria-valuemax="{{ oTarget }}" style="width: {{ oProduction/oTarget*100 }}%">
                {{oProduction/oTarget*100}}%
            </div>
        </div>
        {% endif %}
    </td>
    <td class="text-right" title="<?php echo __('Scrap'); ?>">
        {{ oScrap }}&nbsp;<?php echo $symbolHtmlUnits; ?>&nbsp;/&nbsp;{{ sumScrap }}&nbsp;<?php echo $symbolHtmlUnits; ?>
    </td>
    <td class="text-right" title="<?php echo __('Retrabajo'); ?>">
        {{ oRework }}&nbsp;<?php echo $symbolHtmlUnits; ?>&nbsp;/&nbsp;{{ sumRework }}&nbsp;<?php echo $symbolHtmlUnits; ?>
    </td>
    <td class="text-right" title="<?php echo __('Perdidas por cambio de modelo'); ?>">
        {{ oChangeover }}&nbsp;<?php echo $symbolHtmlminutes; ?>
    </td>
    <td class="text-right" title="<?php echo __('Perdidas tecnicas'); ?>">
        {{ oTechnicalLosses }}&nbsp;<?php echo $symbolHtmlminutes; ?>
    </td>
    <td class="text-right" title="<?php echo __('Perdidas organizacionales'); ?>">
        {{ oOrganizationalLosses }}&nbsp;<?php echo $symbolHtmlminutes; ?>
    </td>
    <td class="text-right" title="<?php echo __('Perdidas por calidad'); ?>">
        {{ oQualityLosses }}&nbsp;<?php echo $symbolHtmlminutes; ?>
    </td>
    <td class="text-right" title="<?php echo __('Perdidas por desempeño'); ?>">
        {{ oPerformanceLosses }}&nbsp;<?php echo $symbolHtmlminutes; ?>
    </td>
</tr>
