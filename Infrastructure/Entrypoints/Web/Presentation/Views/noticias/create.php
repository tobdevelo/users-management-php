<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/menu.php'; ?>

<h1>Registrar noticia</h1>

<?php if (!empty($message)): ?>
    <div class="alert-error">
        <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<form method="POST" action="?route=noticias.store">
    <div>
        <label for="categoria">Categoría:</label><br>
        <input type="text" id="categoria" name="categoria" value="<?= htmlspecialchars($old['categoria'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
        <?php if (!empty($errors['categoria'])): ?><small class="alert-error"><?= htmlspecialchars($errors['categoria'], ENT_QUOTES, 'UTF-8') ?></small><?php endif; ?>
    </div><br>

    <div>
        <label for="fecha">Fecha del suceso:</label><br>
        <input type="date" id="fecha" name="fecha" value="<?= htmlspecialchars($old['fecha'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
        <?php if (!empty($errors['fecha'])): ?><small class="alert-error"><?= htmlspecialchars($errors['fecha'], ENT_QUOTES, 'UTF-8') ?></small><?php endif; ?>
    </div><br>

    <div>
        <label for="pais">País:</label><br>
        <input type="text" id="pais" name="pais" value="<?= htmlspecialchars($old['pais'] ?? 'Colombia', ENT_QUOTES, 'UTF-8') ?>" required>
        <?php if (!empty($errors['pais'])): ?><small class="alert-error"><?= htmlspecialchars($errors['pais'], ENT_QUOTES, 'UTF-8') ?></small><?php endif; ?>
    </div><br>

    <div>
        <label for="departamento">Departamento:</label><br>
        <input type="text" id="departamento" name="departamento" value="<?= htmlspecialchars($old['departamento'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
        <?php if (!empty($errors['departamento'])): ?><small class="alert-error"><?= htmlspecialchars($errors['departamento'], ENT_QUOTES, 'UTF-8') ?></small><?php endif; ?>
    </div><br>

    <div>
        <label for="ciudad">Ciudad:</label><br>
        <input type="text" id="ciudad" name="ciudad" value="<?= htmlspecialchars($old['ciudad'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
        <?php if (!empty($errors['ciudad'])): ?><small class="alert-error"><?= htmlspecialchars($errors['ciudad'], ENT_QUOTES, 'UTF-8') ?></small><?php endif; ?>
    </div><br>

    <div>
        <label for="periodista">Periodista:</label><br>
        <input type="text" id="periodista" name="periodista" value="<?= htmlspecialchars($old['periodista'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
        <?php if (!empty($errors['periodista'])): ?><small class="alert-error"><?= htmlspecialchars($errors['periodista'], ENT_QUOTES, 'UTF-8') ?></small><?php endif; ?>
    </div><br>

    <div>
        <label for="programaEmite">Programa que emite:</label><br>
        <input type="text" id="programaEmite" name="programaEmite" value="<?= htmlspecialchars($old['programaEmite'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
        <?php if (!empty($errors['programaEmite'])): ?><small class="alert-error"><?= htmlspecialchars($errors['programaEmite'], ENT_QUOTES, 'UTF-8') ?></small><?php endif; ?>
    </div><br>

    <div>
        <label for="fechaEmision">Fecha de emisión:</label><br>
        <input type="date" id="fechaEmision" name="fechaEmision" value="<?= htmlspecialchars($old['fechaEmision'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
        <?php if (!empty($errors['fechaEmision'])): ?><small class="alert-error"><?= htmlspecialchars($errors['fechaEmision'], ENT_QUOTES, 'UTF-8') ?></small><?php endif; ?>
    </div><br>

    <div>
        <label for="nivelPublico">Nivel de público:</label><br>
        <select id="nivelPublico" name="nivelPublico" required>
            <?php foreach ($nivelOptions as $option): ?>
                <option value="<?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?>" <?= (($old['nivelPublico'] ?? '') === $option) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php if (!empty($errors['nivelPublico'])): ?><small class="alert-error"><?= htmlspecialchars($errors['nivelPublico'], ENT_QUOTES, 'UTF-8') ?></small><?php endif; ?>
    </div><br>

    <div>
        <label for="descripcion">Descripción:</label><br>
        <textarea id="descripcion" name="descripcion" rows="4" cols="50" required><?= htmlspecialchars($old['descripcion'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
        <?php if (!empty($errors['descripcion'])): ?><small class="alert-error"><?= htmlspecialchars($errors['descripcion'], ENT_QUOTES, 'UTF-8') ?></small><?php endif; ?>
    </div><br>

    <button type="submit" class="btn">Guardar noticia</button>
    <a class="btn btn-warning" href="?route=noticias.index">Cancelar</a>
</form>

<?php require __DIR__ . '/../layouts/footer.php'; ?>