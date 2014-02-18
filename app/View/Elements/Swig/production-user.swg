<?php $units = Units::symbolHtml(Units::UNITS); ?>
<tr data-id="{{ pId }}">
    <td>{{ lName }}</td>
    <td>{{ oWorkDate }}</td>
    <td>{{ hour }}</td>
    <td>{{ mName }}</td>
    <td>{{ iName }}</td>
    <td>{{ pValue }}&nbsp;<?php echo $units; ?></td>
    <td></td>
</tr>