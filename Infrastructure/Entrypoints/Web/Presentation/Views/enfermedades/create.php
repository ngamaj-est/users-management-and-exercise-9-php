<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/menu.php'; ?>

<h1>Registrar enfermedad</h1>

<?php if (!empty($message)): ?>
    <div class="alert-error">
        <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<?php if (!empty($success)): ?>
    <div class="alert-success">
        <?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<form method="POST" action="?route=enfermedades.store">

    <div class="form-group">
        <label for="nombre">Nombre</label><br>
        <input type="text" id="nombre" name="nombre"
            value="<?= htmlspecialchars($old['nombre'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        <?php if (!empty($errors['nombre'])): ?>
            <div class="field-error"><?= htmlspecialchars($errors['nombre'], ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="nombreCientifico">Nombre Científico</label><br>
        <input type="text" id="nombreCientifico" name="nombreCientifico"
            value="<?= htmlspecialchars($old['nombreCientifico'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        <?php if (!empty($errors['nombreCientifico'])): ?>
            <div class="field-error"><?= htmlspecialchars($errors['nombreCientifico'], ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="nivelGravedad">Nivel de Gravedad</label><br>
        <select id="nivelGravedad" name="nivelGravedad">
            <?php foreach ($nivelGravedadOptions as $opt): ?>
                <option value="<?= htmlspecialchars($opt, ENT_QUOTES, 'UTF-8') ?>"
                    <?= (($old['nivelGravedad'] ?? '') === $opt) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($opt, ENT_QUOTES, 'UTF-8') ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php if (!empty($errors['nivelGravedad'])): ?>
            <div class="field-error"><?= htmlspecialchars($errors['nivelGravedad'], ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="sintomas">Síntomas <small>(uno por línea)</small></label><br>
        <textarea id="sintomas" name="sintomas" rows="4" cols="50"><?= htmlspecialchars(implode("\n", $old['sintomas'] ?? []), ENT_QUOTES, 'UTF-8') ?></textarea>
        <?php if (!empty($errors['sintomas'])): ?>
            <div class="field-error"><?= htmlspecialchars($errors['sintomas'], ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="medicamentos">Medicamentos <small>(uno por línea)</small></label><br>
        <textarea id="medicamentos" name="medicamentos" rows="4" cols="50"><?= htmlspecialchars(implode("\n", $old['medicamentos'] ?? []), ENT_QUOTES, 'UTF-8') ?></textarea>
        <?php if (!empty($errors['medicamentos'])): ?>
            <div class="field-error"><?= htmlspecialchars($errors['medicamentos'], ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label>
            <input type="checkbox" name="esContagiosa" value="1"
                <?= !empty($old['esContagiosa']) ? 'checked' : '' ?>>
            ¿Es contagiosa?
        </label>
    </div>

    <div class="form-group">
        <label>
            <input type="checkbox" name="esCubiertaPorPos" value="1"
                <?= !empty($old['esCubiertaPorPos']) ? 'checked' : '' ?>>
            ¿Está cubierta por el POS?
        </label>
    </div>

    <div class="form-group">
        <label>
            <input type="checkbox" name="requiereIncapacidad" value="1"
                <?= !empty($old['requiereIncapacidad']) ? 'checked' : '' ?>>
            ¿Requiere incapacidad?
        </label>
    </div>

    <button type="submit" class="btn btn-primary">Registrar enfermedad</button>
    &nbsp;
    <a class="btn" href="?route=enfermedades.index">Cancelar</a>
</form>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
