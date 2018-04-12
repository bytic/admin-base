<tr>
    <td class="label<?php echo $this->clone->errors['name'] ? ' error' : ''; ?>">
        Nume
        <?php if (!$readonly) { ?>
            <span class="required">*</span>
        <?php } ?>
    </td>
    <td class="value">
    <?php if (!$readonly) { ?>
        <input type="text" class="text input-t8" name="name" value="<?php echo $this->clone->name; ?>" />
        <?php echo $this->clone->errors['name'] ? '<span class="error">'.$this->clone->errors['name'].'</span>' : ''?>
    <?php } else { ?>
        <?php echo $this->clone->name; ?>
    <?php } ?>
    </td>
</tr>
