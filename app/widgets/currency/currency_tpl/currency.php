<option class="label" value="<?= $this->currency['code']; ?>"><?= $this->currency['code']; ?></option>
<?php foreach ($this->currencies as $key => $value): ?>
    <?php if ($key !== $this->currency['code']): ?>
        <option value="<?= $key; ?>"><?= $key; ?></option>
    <?php endif; ?>
<?php endforeach; ?>