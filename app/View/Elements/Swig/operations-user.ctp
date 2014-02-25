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
        <span>
            {{ oProduction }}&nbsp;<?php echo $symbolHtmlUnits; ?>&nbsp;/&nbsp;{{ sumPzOk }}&nbsp;<?php echo $symbolHtmlUnits; ?>
        </span>
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
