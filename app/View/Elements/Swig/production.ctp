<?php $units = Units::symbolHtml(Units::UNITS); ?>
{% if pStatus == 0 %}
<tr data-id="{{ pId }}" class="danger">
    {% else %}
<tr data-id="{{ pId }}" class="success">
    {% endif %}
    <td>{{ mName }}</td>
    <td>{{ iName }}</td>
    <td>{{ pValue }} <?php echo $units; ?></td>
    <td>{{ pCreationDate }}</td>
    <td>
        <span class="status">
            {% if pStatus == 0 %}
            <i class="fa fa-eye" title="<?php echo __('Habilitar'); ?>"></i>
            {% else %}
            <i class="fa fa-eye-slash" title="<?php echo __('Deshabilitar'); ?>"></i>
            {% endif %}
            <i class="fa fa-refresh fa-spin hidden"></i>
        </span>
    </td>
</tr>