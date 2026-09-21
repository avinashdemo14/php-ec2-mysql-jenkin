<?php
require 'config.php';

// CREATE
if (isset($_POST['create'])) {
    $sql = "INSERT INTO users (name, email) VALUES (:name, :email)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['name' => $_POST['name'], 'email' => $_POST['email']]);
}

// UPDATE
if (isset($_POST['update'])) {
    $sql = "UPDATE users SET name=:name, email=:email WHERE id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['name' => $_POST['name'], 'email' => $_POST['email'], 'id' => $_POST['id']]);
}

// DELETE
if (isset($_GET['delete'])) {
    $sql = "DELETE FROM users WHERE id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $_GET['delete']]);
}

// READ
$stmt = $pdo->query("SELECT * FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>PDO CRUD Single Page</title>
</head>
<body>
<h2>Create User Jenkin</h2>
<form method="post">
    <input type="text" name="name" placeholder="Names" required>
    <input type="email" name="email" placeholder="Email" required>
    <button type="submit" name="create">Add</button>
</form>

<h2>User List</h2>
<table border="1">
<tr><th>ID</th><th>Name</th><th>Email</th><th>Actions</th></tr>
<?php foreach ($users as $user): ?>
<tr>
    <td><?= $user['id'] ?></td>
    <td><?= $user['name'] ?></td>
    <td><?= $user['email'] ?></td>
    <td>
        <!-- Update Form -->
        <form method="post" style="display:inline;">
            <input type="hidden" name="id" value="<?= $user['id'] ?>">
            <input type="text" name="name" value="<?= $user['name'] ?>">
            <input type="email" name="email" value="<?= $user['email'] ?>">
            <button type="submit" name="update">Update</button>
        </form>
        <!-- Delete Link -->
        <a href="?delete=<?= $user['id'] ?>" onclick="return confirm('Delete this user?')">Delete</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
</body>
</html>
