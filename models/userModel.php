<?php
declare(strict_types=1);

function get_user_by_email(object $pdo, string $email): array|false {
    $query = "SELECT * FROM users WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function update_user_password(object $pdo, string $email, string $hashedPassword): bool {
    $query = "UPDATE users SET password = :password WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    return $stmt->execute([
        ':password' => $hashedPassword,
        ':email' => $email
    ]);
}
