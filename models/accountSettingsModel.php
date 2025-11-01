<?php
declare(strict_types=1);

function getUserById(object $pdo, int $id): array|false
{
    $sql = "SELECT * FROM users WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateUser(object $pdo, int $id, string $firstName, string $lastName, string $phone, string $address, string $city, string $zipCode): bool
{
    $sql = "UPDATE users SET first_name = :first_name, last_name = :last_name, phone = :phone, address = :address, city = :city, zip_code = :zip_code WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        ':id' => $id,
        ':first_name' => $firstName,
        ':last_name' => $lastName,
        ':phone' => $phone,
        ':address' => $address,
        ':city' => $city,
        ':zip_code' => $zipCode
    ]);
}

function updatePassword(object $pdo, int $id, string $password): bool
{
    $sql = "UPDATE users SET password = :password WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        ':id' => $id,
        ':password' => $password
    ]);
}
