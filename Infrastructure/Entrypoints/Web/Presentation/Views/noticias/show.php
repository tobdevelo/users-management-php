<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/menu.php'; ?>

<h1>Detalle de noticia</h1>

<?php if (!empty($message)): ?>
    <div class="alert-error">
        <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<table>
    <tbody>
        <tr><th>ID</th><td><?= htmlspecialchars($noticia->id(), ENT_QUOTES, 'UTF-8') ?></td></tr>
        <tr><th>Categoría</th><td><?= htmlspecialchars($noticia->categoria(), ENT_QUOTES, 'UTF-8') ?></td></tr>
        <tr><th>Fecha del suceso</th><td><?= htmlspecialchars($noticia->fecha(), ENT_QUOTES, 'UTF-8') ?></td></tr>
        <tr><th>País</th><td><?= htmlspecialchars($noticia->pais(), ENT_QUOTES, 'UTF-8') ?></td></tr>
        <tr><th>Departamento</th><td><?= htmlspecialchars($noticia->departamento(), ENT_QUOTES, 'UTF-8') ?></td></tr>
        <tr><th>Ciudad</th><td><?= htmlspecialchars($noticia->ciudad(), ENT_QUOTES, 'UTF-8') ?></td></tr>
        <tr><th>Periodista</th><td><?= htmlspecialchars($noticia->periodista(), ENT_QUOTES, 'UTF-8') ?></td></tr>
        <tr><th>Programa que emite</th><td><?= htmlspecialchars($noticia->programaEmite(), ENT_QUOTES, 'UTF-8') ?></td></tr>
        <tr><th>Fecha de emisión</th><td><?= htmlspecialchars($noticia->fechaEmision(), ENT_QUOTES, 'UTF-8') ?></td></tr>
        <tr><th>Nivel de público</th><td><?= htmlspecialchars($noticia->nivelPublico(), ENT_QUOTES, 'UTF-8') ?></td></tr>
        <tr><th>Descripción</th><td><?= nl2br(htmlspecialchars($noticia->descripcion(), ENT_QUOTES, 'UTF-8')) ?></td></tr>
    </tbody>
</table>

<p>
    <a class="btn btn-warning" href="?route=noticias.edit&amp;id=<?= urlencode($noticia->id()) ?>">Editar</a>
    <a class="btn" href="?route=noticias.index">Volver a la lista</a>
</p>

<?php require __DIR__ . '/../layouts/footer.php'; ?>