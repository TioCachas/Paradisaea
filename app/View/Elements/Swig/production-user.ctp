<?php $units = Units::symbolHtml(Units::UNITS); ?>
<tr data-id="{{ pId }}">
    <td>{{ mName }}</td>
    <td>{{ iName }}</td>
    <td>{{ value }}&nbsp;<?php echo $units; ?></td>
    <td>
        <i class="fa fa-times" title="<?php echo __('Eliminar'); ?>"></i>
        <i class="fa fa-refresh fa-spin hidden"></i>
    </td>
</tr>hp