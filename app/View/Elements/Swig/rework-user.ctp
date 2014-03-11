<?php $units = Units::symbolHtml(Units::UNITS); ?>
<tr data-id="{{ id }}">
    <td>{{ value }}&nbsp;<?php echo $units; ?></td>
    <td>{{ comment }}</td>
    <td>
        <i class="fa fa-times" title="<?php echo __('Eliminar'); ?>"></i>
        <i class="fa fa-refresh fa-spin hidden"></i>
    </td>
</tr>