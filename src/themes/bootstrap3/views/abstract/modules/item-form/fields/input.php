<tr>
    <td class="label<?php echo $item->errors[$field] ? ' error' : ''; ?>">
        <?php echo $label; ?>
        <?php if (!$readonly && $required) { ?>
            <span class="required">*</span>
        <?php } ?>
    </td>
    <td class="value">
        <?php if (!$readonly) { ?>
            <input type="text" class="text input-t8" name="<?php echo $field; ?>" value="<?php echo $item->$field; ?>" />
            <?php echo $item->errors[$field] ? '<span class="error">'.$item->errors[$field].'</span>' : ''?>
        <?php } else { ?>
            <?php echo $item->$field; ?>
        <?php } ?>
    </td>
</tr>
