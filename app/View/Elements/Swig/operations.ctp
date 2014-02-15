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
{% if o.status == 0 %}
<tr data-id="{{ o.id }}" class="danger">
    {% else %}
<tr data-id="{{ o.id }}" class="success">
    {% endif %}
    <td class='line'>{{ l.name }}</td>
    <td class='hour'>
        {{ a.hour }}
        <i class="fa fa-refresh fa-spin hidden"></i>
    </td>
    <td>
        {{ a.user }}
    </td>
    <td>{{ o.creation_date }}</td>
    <td>
        <a href="<?php echo $urlProductions; ?>/{{ o.id }}">
            {{ o.production }}
        </a>
    </td>
    <td>
        <a href="<?php echo $urlScrap; ?>/{{ o.id }}">
            {{ o.scrap }}
        </a>
    </td>
    <td>
        <a href="<?php echo $urlRework; ?>/{{ o.id }}">
            {{ o.rework }}
        </a>
    </td>
    <td>
        <a href="<?php echo $urlChangeover; ?>/{{ o.id }}">
            {{ o.changeover }}
        </a>
    </td>
    <td>
        <a href="<?php echo $urlTechnical; ?>/{{ o.id }}">
            {{ o.technical_losses }}
        </a>
    </td>
    <td>
        <a href="<?php echo $urlOrganizational; ?>/{{ o.id }}">
            {{ o.organizational_losses }}
        </a>
    </td>
    <td>
        <a href="<?php echo $urlOrganizational; ?>/{{ o.id }}">
            {{ o.quality_losses }}
        </a>
    </td>
    <td>
        <a href="<?php echo $urlOrganizational; ?>/{{ o.id }}">
            {{ o.performance_losses }}
        </a>
    </td>
    <td>
        <span class="status">
            {% if o.status == 0 %}
            <i class="fa fa-eye" title="<?php echo __('Habilitar'); ?>"></i>
            {% else %}
            <i class="fa fa-eye-slash" title="<?php echo __('Deshabilitar'); ?>"></i>
            {% endif %}
            <i class="fa fa-refresh fa-spin hidden"></i>
        </span>
    </td>
</tr>