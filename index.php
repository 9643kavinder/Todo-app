<?php
require_once 'app/init.php';
$itemsQuery = $db->prepare("
    SELECT id, name, done
    FROM items
    WHERE user = :user
");
$itemsQuery->execute([
    'user' => $_SESSION['user_id']
]);

$items = $itemsQuery->rowCount() ? $itemsQuery : [];


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>TO_DO</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
    <div class="list">
        <h1 class="header">TO DO</h1>
        <?php if(!empty($items)): ?>
        <ul class="items">
            <?php foreach($items as $item): ?>
        <li><span class="item<?php echo $item['done'] ? ' done' : '' ?>"><?php echo $item['name']; ?></span>
            <?php if(!$item['done']): ?>
            <a href="mark.php?as=done&item=<?php echo $item['id']; ?>" class="done-button">Mark as done</a>
            <?php endif; ?>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php else: ?>
        <p>You haven't add any items yet.</p>
        <?php endif; ?>
        <form class="item-add" action="add.php" method="post">
        <input type="text" name="name" placeholder="Type a new item here." class="input" autocomplete="off" required>
            <input type="submit" value="Add" class="submit">
        </form>
        </div>
    
    
    </body>
</html>
