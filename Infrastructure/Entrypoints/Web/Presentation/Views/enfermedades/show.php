<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/menu.php'; ?>

<h1>Detalle de enfermedad</h1>

<?php if (!empty($message)): ?>
    <div class="alert-error">
        <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<table class="detail-table">
    <tr>
        <th>ID</th>
        <td><?= htmlspecialchars($enfermedad->getId(), ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Nombre</th>
        <td><?= htmlspecialchars($enfermedad->getNombre(), ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Nombre Científico</th>
        <td><em><?= htmlspecialchars($enfermedad->getNombreCientifico(), ENT_QUOTES, 'UTF-8') ?></em></td>
    </tr>
    <tr>
        <th>Nivel de Gravedad</th>
        <td><?= htmlspecialchars($enfermedad->getNivelGravedad(), ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Síntomas</th>
        <td>
            <ul>
                <?php foreach ($enfermedad->getSintomas() as $sintoma): ?>
                    <li><?= htmlspecialchars($sintoma, ENT_QUOTES, 'UTF-8') ?></li>
                <?php endforeach; ?>
            </ul>
        </td>
    </tr>
    <tr>
        <th>Medicamentos</th>
        <td>
            <ul>
                <?php foreach ($enfermedad->getMedicamentos() as $medicamento): ?>
                    <li><?= htmlspecialchars($medicamento, ENT_QUOTES, 'UTF-8') ?></li>
                <?php endforeach; ?>
            </ul>
        </td>
    </tr>
    <tr>
        <th>¿Es contagiosa?</th>
        <td><?= $enfermedad->getEsContagiosa() ? 'Sí' : 'No' ?></td>
    </tr>
    <tr>
        <th>¿Cubierta por el POS?</th>
        <td><?= $enfermedad->getEsCubiertaPorPos() ? 'Sí' : 'No' ?></td>
    </tr>
    <tr>
        <th>¿Requiere incapacidad?</th>
        <td><?= $enfermedad->getRequiereIncapacidad() ? 'Sí' : 'No' ?></td>
    </tr>
</table>

<p style="margin-top: 16px;">
    <a class="btn btn-warning" href="?route=enfermedades.edit&id=<?= urlencode($enfermedad->getId()) ?>">Editar</a>
    &nbsp;
    <a class="btn" href="?route=enfermedades.index">Volver al listado</a>
</p>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
