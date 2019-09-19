<?php
include 'include/dbinfo.php';
//innehållet som finns i filen "include/dbinfo.php" ska klistras in på det stället i den filen som koden finns i
// mysql -u -p
// use database;
try {
    $dbh = new PDO(
        'mysql:host=localhost;dbname=' . $database . '',
         $user,
          $password
    );
//try loopen innehåller koden som potentiellt kan kasta ett undantag

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
//Catch kommer att kallas om ett undantag inträffar i tryblocket

$sth = $dbh->prepare('SELECT * FROM tweet
            JOIN users
            ON tweet.user_id = users.id');
//$dbh = database handle, $sth = statement handle.

$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);

include 'views/index_layout.php';
?>