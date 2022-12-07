<form action="login" class="auth-form" method="post">
    <input type="text" class="input-task" name="login" placeholder="login" required>
    <input type="text" class="input-task" name="password" placeholder="password" required>
    <input type="submit" class="all-button" name="auth" value="Login">
</form>
<?php if ($message): ?>
<p><?php echo htmlspecialchars($message); ?></p>
<?php endif; ?>