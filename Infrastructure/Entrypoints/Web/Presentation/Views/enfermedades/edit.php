<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/menu.php'; ?>

<h1>Editar enfermedad</h1>

<?php if (!empty($message)): ?>
    <div class="alert-error">
        <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<form method="POST" action="?route=enfermedades.update">
    <input type="hidden" name="id" value="<?= htmlspecialchars($old['id'] ?? $enfermedad->getId(), ENT_QUOTES, 'UTF-8') ?>">

    <div class="form-group">
        <label for="nombre">Nombre</label><br>
        <input type="text" id="nombre" name="nombre"
            value="<?= htmlspecialchars($old['nombre'] ?? $enfermedad->getNombre(), ENT_QUOTES, 'UTF-8') ?>">
        <?php if (!empty($errors['nombre'])): ?>
            <div class="field-error"><?= htmlspecialchars($errors['nombre'], ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="nombreCientifico">Nombre Científico</label><br>
        <input type="text" id="nombreCientifico" name="nombreCientifico"
            value="<?= htmlspecialchars($old['nombreCientifico'] ?? $enfermedad->getNombreCientifico(), ENT_QUOTES, 'UTF-8') ?>">
        <?php if (!empty($errors['nombreCientifico'])): ?>
            <div class="field-error"><?= htmlspecialchars($errors['nombreCientifico'], ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="nivelGravedad">Nivel de Gravedad</label><br>
        <select id="nivelGravedad" name="nivelGravedad">
            <?php foreach ($nivelGravedadOptions as $opt): ?>
                <option value="<?= htmlspecialchars($opt, ENT_QUOTES, 'UTF-8') ?>"
                    <?= (($old['nivelGravedad'] ?? $enfermedad->getNivelGravedad()) === $opt) ? 'selected' : '' ?>>
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
        <textarea id="sintomas" name="sintomas" rows="4" cols="50"><?= htmlspecialchars(
            implode("\n", $old['sintomas'] ?? $enfermedad->getSintomas()),
            ENT_QUOTES, 'UTF-8'
        ) ?></textarea>
        <?php if (!empty($errors['sintomas'])): ?>
            <div class="field-error"><?= htmlspecialchars($errors['sintomas'], ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="medicamentos">Medicamentos <small>(uno por línea)</small></label><br>
        <textarea id="medicamentos" name="medicamentos" rows="4" cols="50"><?= htmlspecialchars(
            implode("\n", $old['medicamentos'] ?? $enfermedad->getMedicamentos()),
            ENT_QUOTES, 'UTF-8'
        ) ?></textarea>
        <?php if (!empty($errors['medicamentos'])): ?>
            <div class="field-error"><?= htmlspecialchars($errors['medicamentos'], ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label>
            <input type="checkbox" name="esContagiosa" value="1"
                <?= (isset($old['esContagiosa']) ? !empty($old['esContagiosa']) : $enfermedad->getEsContagiosa()) ? 'checked' : '' ?>>
            ¿Es contagiosa?
        </label>
    </div>

    <div class="form-group">
        <label>
            <input type="checkbox" name="esCubiertaPorPos" value="1"
                <?= (isset($old['esCubiertaPorPos']) ? !empty($old['esCubiertaPorPos']) : $enfermedad->getEsCubiertaPorPos()) ? 'checked' : '' ?>>
            ¿Está cubierta por el POS?
        </label>
    </div>

    <div class="form-group">
        <label>
            <input type="checkbox" name="requiereIncapacidad" value="1"
                <?= (isset($old['requiereIncapacidad']) ? !empty($old['requiereIncapacidad']) : $enfermedad->getRequiereIncapacidad()) ? 'checked' : '' ?>>
            ¿Requiere incapacidad?
        </label>
    </div>

    <button type="submit" class="btn btn-primary">Guardar cambios</button>
    &nbsp;
    <a class="btn" href="?route=enfermedades.index">Cancelar</a>
</form>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
