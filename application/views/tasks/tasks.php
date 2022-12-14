<h1>Task list</h1>
<?php if (isset($message)): ?>
    <p><?php echo htmlspecialchars($message); ?></p>
<?php endif; ?>
<hr>
<div class="main">
    <div>
        <form action="task/create" method="POST">
            <input type="text" class="input-task" placeholder="Enter text..." name="description" required>
            <input type="submit" class="add-task-button" name="create" value="Add task">
        </form>
        <br>
        <div class="all-buttons-section">
            <?php if (!empty($tasks)): ?>
                <form action="task/delete-all" method="POST">
                    <input type="submit" class="all-button" value="Remove all">
                </form>
                <form action="task/ready-all" method="POST">
                    <input type="submit" class="all-button" value="Ready all">
                </form>
            <?php endif; ?>
            <form action="logout" method="POST">
                <input type="submit" class="all-button" value="Logout">
            </form>
        </div>
    </div>
    <hr>
    <?php foreach ($tasks as $task): ?>
        <?
            $statusText = $task['status'] ? 'Unready' : 'Ready';
        ?>
        <div class="task-list">
            <div>
                <div class="task-list">
                    <h3><?php echo htmlspecialchars($task['description']); ?></h3>
                    <form action="task/ready/<?php echo htmlspecialchars($task['id']); ?>" method="POST">
                        <input type="submit" class="all-button" name="button" value="<?php echo htmlspecialchars($statusText); ?>">
                    </form>
                    <form action="task/delete/<?php echo htmlspecialchars($task['id']); ?>" method="POST">
                        <input type="submit" class="all-button" name="button" value="Delete">
                    </form>
                </div>
            </div>
            <div>
                <?php if ($task['status']): ?>
                    <div class="status-circle green"></div>
                <?php else: ?>
                    <div class="status-circle red"></div>
                <?php endif; ?>
            </div>
        </div>
        <hr>
    <?php endforeach; ?>
</div>