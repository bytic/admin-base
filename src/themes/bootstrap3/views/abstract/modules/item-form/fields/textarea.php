<tr>
    <td class="label<?php echo $item->errors[$field] ? ' error' : ''; ?>">
        <?php echo $label; ?>
        <?php if (!$readonly && $required) { ?>
            <span class="required">*</span>
        <?php } ?>
    </td>
    <td class="value">
        <?php if (!$readonly) { ?>
            <textarea name="<?php echo $field; ?>" id="<?php echo $field; ?>" rows="10" cols="20"><?php echo $item->$field; ?></textarea>
            <?php echo $item->errors[$field] ? '<span class="error">'.$item->errors[$field].'</span>' : ''?>
        <?php } else { ?>
            <?php echo $item->$field; ?>
        <?php } ?>
    </td>
</tr>
