<?php
$urlProductions = $this->Html->url(array(
    'controller' => 'Productions', 'action' => 'admin'));
$symbolHtmlUnits = Units::symbolHtml(Units::UNITS);
$symbolHtmlminutes = Units::symbolHtml(Units::MINUTES);
?>
<tr class="subheader">
    <td colspan="3">
        <?php echo __("Total del turno"); ?>
    </td>
    <td colspan="2" class="text-right target" title="<?php echo __('Piezas objetivo'); ?>">
        {{ oTarget }}&nbsp;<?php echo $symbolHtmlUnits; ?>
    </td>
    <td colspan="2" class="text-right productions">
        {{ oProduction }}&nbsp;<?php echo $symbolHtmlUnits; ?>
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
    <td class="text-right" title="<?php echo __('Scrap'); ?>">
        {{ oScrap }}&nbsp;<?php echo $symbolHtmlUnits; ?>
    </td>
    <td class="text-right" title="<?php echo __('Retrabajo'); ?>">
        {{ oRework }}&nbsp;<?php echo $symbolHtmlUnits; ?>
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
