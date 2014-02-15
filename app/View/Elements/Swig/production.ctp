<?php $units = Units::symbolHtml(Units::UNITS); ?>
{% if p.status == 0 %}
<tr data-id="{{ p.id }}" class="danger">
    {% else %}
<tr data-id="{{ p.id }}" class="success">
    {% endif %}
    <td>{{ m.name }}</td>
    <td>{{ i.name }}</td>
    <td>{{ p.value }} <?php echo $units; ?></td>
    <td>{{ p.creation_date }}</td>
    <td>
        {% if p.status == 0 %}
        <i class="fa fa-eye" title="<?php echo __('Habilitar'); ?>"></i>
        {% else %}
        <i class="fa fa-eye-slash" title="<?php echo __('Deshabilitar'); ?>"></i>
        {% endif %}
    </td>
</tr>