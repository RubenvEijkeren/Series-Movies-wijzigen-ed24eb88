<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <?php
        $host = '127.0.0.1';
        $db   = 'netland';
        $user = 'root';
        $pass = 'ABC';
        $charset = 'utf8mb4';
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            $pdo = new PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
        $info = $pdo->query('SELECT * FROM movies WHERE id = ' . $_GET['id']);
    	foreach ($info as $show) {
    		foreach ($show as $key => $value) {
    			if ($key != 'id' && $key != 'trailerID'){
    				echo "<span style='font-weight:bold'>". $key . "</span>: " . $value . "<br>";
    			}
    			if($key === 'trailerID'){
    				echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/'.$value.' frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
    			}
    		}
    	}
    ?>
</body>
</html>