<?php
class Stock {
    private $pdo;

    function __construct($pdo) {
        $this->pdo = $pdo;
    }
    //fetching all stocks
  function getAll() {
        $stmt = $this->pdo->prepare("SELECT * FROM stocks");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //adding a product to stock
    function add($name, $category, $current, $min, $status, $last_restocked) {
        $sql = "INSERT INTO stocks (name, category, current, min, status, last) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$name, $category, $current, $min, $status, $last_restocked]);
    }
    //updating stock details
    function update($id, $name, $category, $current, $min, $status) {
        $sql = "UPDATE stocks SET name=?, category=?, current=?, min=?, status=? WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$name, $category, $current, $min, $status, $id]);
    }
    //deleting a stock item
    function delete($id) {
    $stmt = $this->pdo->prepare("DELETE FROM stocks WHERE id = ?");
    $stmt->execute([$id]);
    }
    //fetching a stock item by id
    function getById($id) {
    $stmt = $this->pdo->prepare("SELECT * FROM stocks WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}