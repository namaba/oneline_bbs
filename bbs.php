
<!DOCTYPE html>
<html>
<head>
  <meta charset='UTF-8'>
  <title>oneline</title>
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="assets/css/form.css">
  <link rel="stylesheet" href="assets/css/main.css">
  <link rel="stylesheet" href="assets/css/timeline2.css">
</head>
<body>
  <form method='post' action='bbs.php'>
    <input type='text' name='nickname' placeholder='nickname' require>
    <textarea name="comment" placeholder='comment'></textarea>
    <button type="submit">つぶやく</button>
  </form>

    <?php
      // POST送信が行われたら、下記の処理を実行
      // テストコメント
      if(isset($_POST) && !empty($_POST)){

        // データベースに接続
        // $dsn='mysql:dbname=oneline_bbs;host=localhost';
        // $User='root';
        // $password='';


        $dsn='mysql:dbname=LAA0686086;host= mysql105.phy.lolipop.lan';
        $User='LAA0686086';
        $password='nexseed1204';
        $dbh= new PDO($dsn,$User,$password);
        $dbh->query('SET NAMES utf8');

        $nickname = $_POST['nickname'];
        $comment = $_POST['comment'];

        // SQL分作成(INSERT文)
        $sql = 'INSERT INTO `posts` (`id`, `nickname`, `comment`, `created`) VALUES (NULL, "'.$nickname.'","'.$comment.'", now())';
        $stmt=$dbh->prepare($sql);
        // insert文実行
        $stmt->execute();

        $sql = 'SELECT * FROM posts WHERE 1';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();


        echo '<table border=1 >';
        while(1){
          $rec = $stmt->fetch(PDO::FETCH_ASSOC);
          if($rec==false){
            break;
          }
            echo '<tr>';
            echo '<td>'.$rec['id'].'</td>';
            echo '<td>'.$rec['nickname'].'</td>';
            echo '<td>'.$rec['comment'].'</td>';
            echo '<td>'.$rec['created'].'</td>';
            echo'</tr>';
        }
        echo '</table>';
      }





      // データベースから切断
      $dbn = null;

    ?>

<!-- </body>
</html>