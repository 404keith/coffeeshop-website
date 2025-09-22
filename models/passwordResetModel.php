<?php
declare(strict_types=1);

function create_password_reset(object $pdo, string $email, string $token, string $expires): bool
{
    $query = "INSERT INTO password_resets (email, token, expires_at) VALUES (:email, :token, :expires);";
    $stmt = $pdo->prepare($query);
    return $stmt->execute([
        ':email' => $email,
        ':token' => $token,
        ':expires' => $expires
    ]);
}

function find_valid_token(object $pdo, string $token): array|false
{
    $query = "SELECT * FROM password_resets WHERE token = :token AND expires_at > NOW();";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':token', $token, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function delete_password_reset(object $pdo, string $email): bool
{
    $query = "DELETE FROM password_resets WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    return $stmt->execute([':email' => $email]);
}


