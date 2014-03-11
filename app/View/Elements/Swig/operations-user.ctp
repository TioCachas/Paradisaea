<?php
$urlProductions = $this->Html->url(array(
    'controller' => 'Productions', 'action' => 'admin'));
$symbolHtmlUnits = Units::symbolHtml(Units::UNITS);
$symbolHtmlminutes = Units::symbolHtml(Units::MINUTES);
?>
{% if parseInt(oProduction) >= parseInt(oTarget) %}
<tr data-id="{{ oId }}" class="bosch greaterOrEqualThat">
    {% else %}
<tr data-id="{{ oId }}" class="bosch lessThat">
    {% endif %}
    <td>{{ hStart }}</td>
    <td>{{ hEnd }}</td>
    <td>{{ models }}</td>
    <td class="text-right target" title="<?php echo __('Piezas objetivo'); ?>">
        {{ oTarget }}&nbsp;<?php echo $symbolHtmlUnits; ?>
    </td>
    <td class="text-right" title="<?php echo __('Piezas objetivo acumuladas'); ?>">
        {{ sumTarget }}&nbsp;<?php echo $symbolHtmlUnits; ?>        
    </td>
    <td class="text-right productions">
        <span>
            {{ oProduction }}&nbsp;<?php echo $symbolHtmlUnits; ?>
        </span>
        <i class="fa fa-refresh fa-spin hidden"></i>
    </td>
    <td class="text-right">
        {{ sumPzOk }}&nbsp;<?php echo $symbolHtmlUnits; ?>
    </td>
    <td>
        <div class="progress" style="position: relative;">
            <div class="progress-bar progress-bar-success" role="progressbar" style="width: {{ parseInt(oProduction/oTarget*100) }}%">
            </div>
            <div class="progress-bar progress-bar-danger" role="progressbar" style="width: {{ 100 - parseInt(oProduction/oTarget*100) }}%">
            </div>
            <div style="position: absolute; color: #fff; right: 0;">
                {{parseInt(oProduction/oTarget*100)}}%
            </div>
        </div>
    </td>
    <td class="text-right scrapValue" title="<?php echo __('Scrap'); ?>">
        <span>
            {{ oScrap }}&nbsp;<?php echo $symbolHtmlUnits; ?>&nbsp;/&nbsp;{{ sumScrap }}&nbsp;<?php echo $symbolHtmlUnits; ?>
        </span>
        <i class="fa fa-refresh fa-spin hidden"></i>
    </td>
    <td class="text-right reworkValue" title="<?php echo __('Retrabajo'); ?>">
        <span>
            {{ oRework }}&nbsp;<?php echo $symbolHtmlUnits; ?>&nbsp;/&nbsp;{{ sumRework }}&nbsp;<?php echo $symbolHtmlUnits; ?>
        </span>
        <i class="fa fa-refresh fa-spin hidden"></i>
    </td>
    <td class="text-right changeoverValue" title="<?php echo __('Perdidas por cambio de modelo'); ?>">
        <span>
            {{ oChangeover }}&nbsp;<?php echo $symbolHtmlminutes; ?>
        </span>
        <i class="fa fa-refresh fa-spin hidden"></i>
    </td>
    <td class="text-right technicalValue" title="<?php echo __('Perdidas tecnicas'); ?>">
        <span>
            {{ oTechnicalLosses }}&nbsp;<?php echo $symbolHtmlminutes; ?>
        </span>
        <i class="fa fa-refresh fa-spin hidden"></i>
    </td>
    <td class="text-right organizationalValue" title="<?php echo __('Perdidas organizacionales'); ?>">
        <span>
            {{ oOrganizationalLosses }}&nbsp;<?php echo $symbolHtmlminutes; ?>
        </span>
        <i class="fa fa-refresh fa-spin hidden"></i>
    </td>
    <td class="text-right qualityValue" title="<?php echo __('Perdidas por calidad'); ?>">
        <span>
            {{ oQualityLosses }}&nbsp;<?php echo $symbolHtmlminutes; ?>
        </span>
        <i class="fa fa-refresh fa-spin hidden"></i>
    </td>
    <td class="text-right performanceValue" title="<?php echo __('Perdidas por desempeño'); ?>">
        <span>
            {{ oPerformanceLosses }}&nbsp;<?php echo $symbolHtmlminutes; ?>
        </span>
        <i class="fa fa-refresh fa-spin hidden"></i>
    </td>
</tr>
