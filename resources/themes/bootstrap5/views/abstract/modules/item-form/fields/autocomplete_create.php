<?php

$item = $item ?? ($this->item ?? ($this->clone ?? null));
$field = $field ?? 'record_id';
$label = $label ?? ucfirst(str_replace('_', ' ', $field));
$readonly = (bool)($readonly ?? false);
$required = (bool)($required ?? false);

$searchUrl = $searchUrl ?? '';
$createUrl = $createUrl ?? '';
$searchMethod = strtoupper((string)($searchMethod ?? 'GET'));
$createMethod = strtoupper((string)($createMethod ?? 'POST'));

$queryParam = $queryParam ?? 'q';
$limitParam = $limitParam ?? 'limit';
$nameParam = $nameParam ?? 'name';
$minChars = (int)($minChars ?? 2);
$limit = (int)($limit ?? 10);
$debounceDelay = (int)($debounceDelay ?? 250);
$blurCloseDelay = (int)($blurCloseDelay ?? 200);
$disabled = (bool)($disabled ?? false);

$selectedId = $selectedId ?? ($item && isset($item->{$field}) ? $item->{$field} : '');
$selectedLabel = $selectedLabel ?? ($item && isset($item->{$field . '_label'}) ? $item->{$field . '_label'} : '');
$placeholder = $placeholder ?? translator()->trans('Search or create');

$messages = array_merge(
    [
        'empty' => translator()->trans('No matches found'),
        'create' => translator()->trans('Create'),
        'loading' => translator()->trans('Loading'),
        'error' => translator()->trans('Something went wrong'),
    ],
    $messages ?? []
);
?>
<tr>
    <td class="label<?= ($item && isset($item->errors[$field]) && $item->errors[$field]) ? ' error' : ''; ?>">
        <?= $label; ?>
        <?php if (!$readonly && $required) { ?>
            <span class="required">*</span>
        <?php } ?>
    </td>
    <td class="value">
        <?php if (!$readonly) { ?>
            <div class="btc-autocomplete-create-field position-relative"
                 data-autocomplete-create-field="true"
                 data-search-url="<?= htmlspecialchars((string)$searchUrl, ENT_QUOTES, 'UTF-8'); ?>"
                 data-search-method="<?= htmlspecialchars((string)$searchMethod, ENT_QUOTES, 'UTF-8'); ?>"
                 data-create-url="<?= htmlspecialchars((string)$createUrl, ENT_QUOTES, 'UTF-8'); ?>"
                 data-create-method="<?= htmlspecialchars((string)$createMethod, ENT_QUOTES, 'UTF-8'); ?>"
                 data-query-param="<?= htmlspecialchars((string)$queryParam, ENT_QUOTES, 'UTF-8'); ?>"
                 data-limit-param="<?= htmlspecialchars((string)$limitParam, ENT_QUOTES, 'UTF-8'); ?>"
                 data-name-param="<?= htmlspecialchars((string)$nameParam, ENT_QUOTES, 'UTF-8'); ?>"
                 data-min-chars="<?= (int)$minChars; ?>"
                 data-limit="<?= (int)$limit; ?>"
                 data-debounce-delay="<?= (int)$debounceDelay; ?>"
                 data-blur-close-delay="<?= (int)$blurCloseDelay; ?>"
                 data-readonly="<?= $readonly ? 'true' : 'false'; ?>"
                 data-disabled="<?= $disabled ? 'true' : 'false'; ?>"
                 data-message-empty="<?= htmlspecialchars((string)$messages['empty'], ENT_QUOTES, 'UTF-8'); ?>"
                 data-message-create="<?= htmlspecialchars((string)$messages['create'], ENT_QUOTES, 'UTF-8'); ?>"
                 data-message-loading="<?= htmlspecialchars((string)$messages['loading'], ENT_QUOTES, 'UTF-8'); ?>"
                 data-message-error="<?= htmlspecialchars((string)$messages['error'], ENT_QUOTES, 'UTF-8'); ?>">

                <input type="hidden"
                       name="<?= htmlspecialchars((string)$field, ENT_QUOTES, 'UTF-8'); ?>"
                       class="btc-autocomplete-create-id"
                       value="<?= htmlspecialchars((string)$selectedId, ENT_QUOTES, 'UTF-8'); ?>"/>

                <div class="input-group">
                    <input type="text"
                           class="form-control btc-autocomplete-create-input"
                           value="<?= htmlspecialchars((string)$selectedLabel, ENT_QUOTES, 'UTF-8'); ?>"
                           placeholder="<?= htmlspecialchars((string)$placeholder, ENT_QUOTES, 'UTF-8'); ?>"
                           autocomplete="off"
                        <?= $disabled ? 'disabled' : ''; ?>
                        <?= $required ? 'required' : ''; ?>
                    />
                    <button type="button"
                            class="btn btn-outline-secondary btc-autocomplete-create-reset<?= empty($selectedLabel) ? ' d-none' : ''; ?>"
                        <?= $disabled ? 'disabled' : ''; ?>
                            aria-label="<?= htmlspecialchars((string)translator()->trans('Clear'), ENT_QUOTES, 'UTF-8'); ?>">
                        <i class="fa fa-times"></i>
                    </button>
                </div>

                <div class="btc-autocomplete-create-feedback invalid-feedback d-none"></div>
                <div class="btc-autocomplete-create-menu dropdown-menu w-100"></div>
            </div>
            <?php if ($item && isset($item->errors[$field]) && $item->errors[$field]) { ?>
                <span class="error"><?= $item->errors[$field] ?></span>
            <?php } ?>
        <?php } else { ?>
            <?= htmlspecialchars((string)($selectedLabel ?: $selectedId), ENT_QUOTES, 'UTF-8'); ?>
        <?php } ?>
    </td>
</tr>
