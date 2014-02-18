<?php
$urlProductions = $this->Html->url(array(
    'controller' => 'Productions', 'action' => 'admin'));
$urlScrap = $this->Html->url(array(
    'controller' => 'Productions', 'action' => 'admin'));
$urlRework = $this->Html->url(array(
    'controller' => 'Productions', 'action' => 'admin'));
$urlChangeover = $this->Html->url(array(
    'controller' => 'Productions', 'action' => 'admin'));
$urlTechnical = $this->Html->url(array(
    'controller' => 'Productions', 'action' => 'admin'));
$urlOrganizational = $this->Html->url(array(
    'controller' => 'Productions', 'action' => 'admin'));
?>
{% if oStatus == 0 %}
<tr data-id="{{ oId }}" class="danger">
    {% else %}
<tr data-id="{{ oId }}" class="success">
    {% endif %}
    <td class='line'>{{ lName }}</td>
    <td class='hour'>
        {{ hour }}
        <i class="fa fa-refresh fa-spin hidden"></i>
    </td>
    <td>
        {{ user }}
    </td>
    <td>{{ oCreationDate }}</td>
    <td>
        <a href="<?php echo $urlProductions; ?>/{{ oId }}">
            {{ oProduction }}
        </a>
    </td>
    <td>
        <a href="<?php echo $urlScrap; ?>/{{ oId }}">
            {{ oScrap }}
        </a>
    </td>
    <td>
        <a href="<?php echo $urlRework; ?>/{{ oId }}">
            {{ oRework }}
        </a>
    </td>
    <td>
        <a href="<?php echo $urlChangeover; ?>/{{ oId }}">
            {{ oChangeover }}
        </a>
    </td>
    <td>
        <a href="<?php echo $urlTechnical; ?>/{{ oId }}">
            {{ oTechnicalLosses }}
        </a>
    </td>
    <td>
        <a href="<?php echo $urlOrganizational; ?>/{{ oId }}">
            {{ oOrganizationalLosses }}
        </a>
    </td>
    <td>
        <a href="<?php echo $urlOrganizational; ?>/{{ oId }}">
            {{ oQualityLosses }}
        </a>
    </td>
    <td>
        <a href="<?php echo $urlOrganizational; ?>/{{ oId }}">
            {{ oPerformanceLosses }}
        </a>
    </td>
    <td>
        <span class="status">
            {% if oStatus == 0 %}
            <i class="fa fa-eye" title="<?php echo __('Habilitar'); ?>"></i>
            {% else %}
            <i class="fa fa-eye-slash" title="<?php echo __('Deshabilitar'); ?>"></i>
            {% endif %}
            <i class="fa fa-refresh fa-spin hidden"></i>
        </span>
    </td>
</tr>