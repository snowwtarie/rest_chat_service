<?php

require __DIR__ . '/Class/Class.database.php';

require __DIR__ . '/DAO/User.DAO.php';

$db = Database::createInstance();

$query = $db->query('SELECT id_user FROM user');

//print_r($query->fetchAll(PDO::FETCH_ASSOC));

$ids = $query->fetchAll(PDO::FETCH_ASSOC);

foreach($ids as $id) {
    print_r($id);
}

echo '<hr>';

$dao = new UserDAO();

$users = $dao->findAll();

print_r($users);


/*if(count(($query->fetchAll(PDO::FETCH_ASSOC)), COUNT_RECURSIVE) == 0) {
    echo 'Vide';
} else {
    var_dump($query->fetchAll(PDO::FETCH_ASSOC));
    foreach($query->fetchAll(PDO::FETCH_ASSOC) as $row) {
        print_r($row);
    }
    echo '<!-- It worked -->';
}*/