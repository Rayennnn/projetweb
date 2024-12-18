<?php
require_once 'db_connect.php';

try {
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		$sql = "DELETE FROM answers";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		$sql = "DELETE FROM comments";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		$pdo->commit();
	}
   
} catch (PDOException $e) {
    $pdo->rollBack();

    echo json_encode(['status' => 'error', 'message' => 'Failed to delete comments and answers: ' . $e->getMessage()]);
}
?>
