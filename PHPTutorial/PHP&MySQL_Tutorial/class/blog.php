<?php
require_once('dbc.php');

class Blog extends Dbc
{
  protected $table_name = 'blog';

  public function setCategoryName($category)
  {
    if ($category === '1') {
      return '日常';
    } elseif ($category === '2') {
      return 'プログラミング';
    } else {
      return 'その他';
    }
  }

  public function blogCreate($blogs)
  {
    $sql = 'INSERT INTO 
          blog(title, content, category, publish_status)
        VALUES
          (:title, :content, :category, :publish_status)';

    $dbh = $this->dbConnect();
    $dbh->beginTransaction();

    try {
      $stmt = $dbh->prepare($sql);
      $stmt->bindValue(':title', $blogs['title'], PDO::PARAM_STR);
      $stmt->bindValue(':content', $blogs['content'], PDO::PARAM_STR);
      $stmt->bindValue(':category', $blogs['category'], PDO::PARAM_INT);
      $stmt->bindValue(':publish_status', $blogs['publish_status'], PDO::PARAM_INT);
      $stmt->execute();
      $dbh->commit();

      echo '投稿が完了しました！';
    } catch (PDOException $e) {
      exit($e);
      $dbh->rollBack();
    }
  }

  public function blogUpdate($blogs)
  {
    $sql = "UPDATE $this->table_name SET 
              title = :title, content = :content, category = :category, publish_status = :publish_status
            WHERE
              id = :id";

    $dbh = $this->dbConnect();
    $dbh->beginTransaction();

    try {
      $stmt = $dbh->prepare($sql);
      $stmt->bindValue(':title', $blogs['title'], PDO::PARAM_STR);
      $stmt->bindValue(':content', $blogs['content'], PDO::PARAM_STR);
      $stmt->bindValue(':category', $blogs['category'], PDO::PARAM_INT);
      $stmt->bindValue(':publish_status', $blogs['publish_status'], PDO::PARAM_INT);
      $stmt->bindValue(':id', $blogs['id'], PDO::PARAM_INT);
      $stmt->execute();
      $dbh->commit();

      echo 'ブログを更新しました！';
    } catch (PDOException $e) {
      exit($e);
      $dbh->rollBack();
    }
  }

  // ブログのバリデーション
  function blogValidate($blogs)
  {
    if (empty($blogs['title'])) {
      exit('タイトルを入力してください');
    }
    if (mb_strlen($blogs['title']) > 191) {
      exit('タイトルは191文字以内にしてください');
    }

    if (empty($blogs['content'])) {
      exit('本文を入力してください');
    }

    if (empty($blogs['category'])) {
      exit('カテゴリーを選択してください');
    }

    if (empty($blogs['publish_status'])) {
      exit('公開、非公開を選択してください');
    }
  }
}