<?php
// used for communication to DATABASE (MYSQL)
declare(strict_types=1);

function get_all_categories(object $pdo): array {
    $query = "SELECT * FROM categories";
    $statement = $pdo->prepare($query);
    $statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
