<?php
if (!isset($errors)) {
    $errors = [];
}
if (!empty($errors) && is_array($errors)): ?>
  <div class="error">
    <?php foreach ($errors as $error): ?>
      <p><?php echo htmlspecialchars($error); ?></p>
    <?php endforeach; ?>
  </div>
<?php endif; ?>