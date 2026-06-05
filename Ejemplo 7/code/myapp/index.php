<?php
echo '<h1>HOLA</h1>';
echo '<h3>He montado LEMP</h3>';

try {
  $servername = 'mariadb';
  $username = 'root';
  $password = 'password';
  $database = 'docker_sample';
  $port = '3306';

  $pdo = new PDO(
    "mysql:host={$servername};port={$port};dbname={$database};charset=utf8mb4",
    $username,
    $password
  );
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo '<p>Conexion realizada con exito</p>';

  $res = $pdo->query('SELECT nombre, email FROM usuarios');
  foreach ($res as $user) {
    echo '<p>' . htmlspecialchars($user['nombre'], ENT_QUOTES, 'UTF-8')
      . ' - ' . htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') . '</p>';
  }
  $pdo = null;
} catch (PDOException $e) {
  echo 'Error: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
  exit(1);
}
