<tr>
    <td class="label<?php echo $this->clone->errors['description'] ? ' error' : ''; ?>">
        Descriere
    </td>
    <td class="value">
    <?php if (!$readonly) { ?>
        <textarea name="description" id="description" rows="10" cols="20"><?php echo htmlspecialchars($this->clone->description); ?></textarea>
        <?php echo $this->clone->errors['description'] ? '<span class="error">'.$this->clone->errors['description'].'</span>' : ''?>
        <script type="text/javascript">
            APP.addEditor('description', {width: 548, height: 300});
        </script>
    <?php } else { ?>
        <?php echo $this->clone->description ? $this->clone->description : '-'; ?>
    <?php } ?>
    </td>
</tr>
