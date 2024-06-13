<html>
 <head>
  <title>Hello...</title>

  <!-- <meta charset="utf-8">  -->

  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<body>
    <div class="container">
        <h1>Hi! I'm happy</h1><br>
        <h2>MySQL</h2><br>
    <?php
    $conn = mysqli_connect('db', 'user', 'test', 'myDb');

    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      exit();
    }

    $query = "SELECT * From Person";
    $result = mysqli_query($conn, $query);

    echo '<table class="table table-striped">';
    echo '<thead><tr><th></th><th>id</th><th>name</th></tr></thead>';
    while($value = $result->fetch_array())
    {
        echo '<tr>';
        echo '<td><a href="#"><span class="glyphicon glyphicon-search"></span></a></td>';
        foreach($value as $element){
            echo '<td>' . $element . '</td>';
        }

        echo '</tr>';
    }
    echo '</table>';

    $result->close();
    mysqli_close($conn);

    echo '<h2>PostgreSQL</h2><br>';
    $conn_pg = pg_connect("host=localhost dbname=myDb user=user password=test");

    if (!$conn_pg) {
        echo "Ошибка подключения к PostgreSQL: " . pg_last_error();
        exit;
    }
    
    $query_pg = "SELECT * FROM Person";
    $result_pg = pg_query($conn_pg, $query_pg);

    if (!$result_pg) {
        echo "Ошибка выполнения запроса: " . pg_last_error();
        exit;
    }

    echo '<table class="table table-striped">';
    echo '<thead><tr><th></th><th>id</th><th>name</th></tr></thead>';
    while ($row_pg = pg_fetch_assoc($result_pg)) {
        echo '<tr>';
        echo '<td><a href="#"><span class="glyphicon glyphicon-search"></span></a></td>';
        echo '<td>' . $row_pg['id'] . '</td>';
        echo '<td>' . $row_pg['name'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';

    pg_free_result($result_pg);
    pg_close($conn_pg);

    ?>
    </div>
</body>
</html>