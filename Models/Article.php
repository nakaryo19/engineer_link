<?php
require_once('../Models/Db.php');

class Article extends Db {

    public function __construct($dbh = null){
        parent::__construct($dbh);
    }

 
    /*articlesテーブルにデータを挿入
    *
    * @param 引数なし
    * @return 返り値なし
    */
    public function create($post,$session){
        
        
        $sql = 'INSERT INTO articles(title, text, user_id, category_id, created_at) VALUES (:title, :text, :user_id, :category_id, :created_at)';

        $this->dbh->beginTransaction();
        
        try{
            $date = date("Y-m-d H:i:s");
            $stmt = $this->dbh->prepare($sql);
            
            
            $params = array(
                ':title'=>$post['title'],
                ':text'=>$post['text'],
                ':user_id'=>$session['login_user']['id'],
                ':category_id'=>$post['category'],
                ':created_at'=>$date
            );
            
            $stmt->execute($params);
            $this->dbh->commit();
            
            //リロード時の多重登録防止
            //$url = $_SERVER['REQUEST_URI'];
            //header("Location: {$url}");
            //exec;

        } catch(PDOException $e){
            $this->dbh->rollback();
            exit($e);
        }
    }
    

    /*articlesテーブルから全てデータを取得
    *
    * @param integer $page ページ番号
    * @return Array $result 全作品データ
    */
    public function findAll($page = 0):Array {
        $sql = 'SELECT a.*, u.user_name AS user_name, u.img AS user_img  FROM articles a 
        LEFT JOIN users u ON u.id = a.user_id ORDER BY created_at DESC';
        $sql .= ' LIMIT 20 OFFSET '.(20 * $page);
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    public function findByNew(){
        $sql = 'SELECT a.*, u.user_name AS user_name, u.img AS user_img  FROM articles a 
        LEFT JOIN users u ON u.id = a.user_id 
        ORDER BY id DESC LIMIT 5';
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($result);
        return $result;
        
    }

    /*
    *articlesテーブルから指定idに一致する作品データを取得
    *
    *@param integer $id 作品のid
    *@return Array $result 指定の作品データ
    */
    public function findByID($id):Array {
        $sql = 'SELECT a.*, c.name AS category, u.user_name AS user_name, u.img AS user_img 
        FROM articles a 
        LEFT JOIN category c ON c.id = a.category_id 
        LEFT JOIN users u ON u.id = a.user_id 
        WHERE a.id = :id';
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam(':id', $id, PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        //var_dump($result);
        return $result;
    }

    /*
    *テーブルから全データ数を取得
    
    
    */
    public function countAll():Int {
        $sql = 'SELECT count(*) as count FROM articles';
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
        $count = $sth->fetchColumn();
        return $count;
    }
    
    //個人の投稿履歴
    public function findByHistory($id):Array {
        $sql = 'SELECT * FROM articles WHERE user_id = :user_id ORDER BY created_at DESC';
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam(':user_id', $id, PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    

    public function delete($id) {
        $sql = 'DELETE FROM articles Where id = :id';

        $this->dbh->beginTransaction();
        try{
            $sth = $this->dbh->prepare($sql);
            $sth->bindParam(':id', $id, PDO::PARAM_INT);
            $sth->execute();
            $this->dbh->commit();

        } catch(PDOException $e){
            $this->dbh->rollback();
            exit($e);
        }
    }

    public function update($post) {
        $sql = 'UPDATE articles SET
        title = :title, category_id= :category_id, text= :text, update_at= :update_at WHERE id= :id';

        try{
            $date = date("Y-m-d H:i:s");
            $stmt = $this->dbh->prepare($sql);
            
            $params = array(
                ':title'=>$post['title'],
                ':category_id'=>$post['category'],
                ':text'=>$post['text'],
                ':update_at'=>$date,
                ':id'=>$post['id']
            );
            $stmt->execute($params);
            //echo "更新しました";

        } catch(PDOException $e){
            echo "更新失敗".$e->getMessage() ."\n";
            exit();
        }
    }
    

    //　カテゴリー　セレクトボックス用
    public function selectCategory():Array {
        $sql = 'SELECT * FROM category';
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    
    //　投稿後、詳細画面確認用
    public function toDetail(){
        $sql = 'SELECT MAX(id) AS id FROM articles';
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;   
    }

    

    // キーワード・カテゴリー検索
    public function keywordAndCategorySearch($input_keyword, $input_category)
    {
        $sql = 'SELECT a.*, u.user_name AS user_name, u.img AS user_img, c.name FROM articles a 
        LEFT JOIN users u ON u.id = a.user_id 
        LEFT JOIN category c ON c.id = a.category_id ';
        $conditions = [];
        if (isset($input_category)) {
            $categoryConditions = [];
            foreach ($input_category as $category) {
                $categoryConditions[] = 'c.name LIKE "%' . $category . '%"';
            }
            // (c.name LIKE "%php%" or c.name LIKE "%java%")
            $conditions[] = '(' . implode(' OR ', $categoryConditions) . ')';
        }
        if (isset($input_keyword) && $input_keyword !== "") {
            $keywords = preg_split('/[\s|\x{3000}]+/u', $input_keyword);
            $keywordConditions = [];
            foreach ($keywords as $keyword) {
                $keywordConditions[] = <<<EOT
                    (
                        a.title LIKE "%{$keyword}%"
                        OR a.text LIKE "%{$keyword}%"
                    )
                EOT;
            }
            // (a.title LIKE "%最大%" OR a.text LIKE "%最大%") AND (a.title LIKE "%特徴%" OR a.text LIKE "%特徴%")
            $conditions[] = '(' . implode(' AND ', $keywordConditions) . ')';
        }
        if (!empty($conditions)) {
            // where (c.name LIKE "%php%" or c.name LIKE "%java%")
            // AND (a.title LIKE "%最大%" OR a.text LIKE "%最大%") AND (a.title LIKE "%特徴%" OR a.text LIKE "%特徴%")
            $sql .= ' where ' . implode(' AND ', $conditions);
        }
        // var_dump($sql);
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    
    public function favorite($u_id,$a_id){
        try{
            $sql = 'SELECT * FROM favorites WHERE article_id = :a_id AND user_id = :u_id';
            $stmt = $this->dbh->prepare($sql);
            
            $params = array(
                ':u_id'=>$u_id,
                ':a_id'=>$a_id
            );
            
            $stmt->execute($params);
            $resultCount = $stmt->rowCount();
            
            // レコードが1件でもある場合
            if(!empty($resultCount)){
                // レコードを削除する
                $sql = 'DELETE FROM favorites WHERE article_id = :a_id AND user_id = :u_id';
                $stmt = $this->dbh->prepare($sql);
                $params = array(
                    ':u_id'=>$u_id,
                    ':a_id'=>$a_id
                );
            
                $stmt->execute($params);
                echo count($this->getGood($a_id));
            }else{
                // レコードを挿入する
                $sql = 'INSERT INTO favorites (article_id, user_id) VALUES (:a_id, :u_id)';
                $stmt = $this->dbh->prepare($sql);
                $params = array(
                    ':a_id'=>$a_id,
                    ':u_id'=>$u_id
                );
                
                $stmt->execute($params);
                echo count($this->getGood($a_id));
            }
            

        } catch(PDOException $e){
            exit($e);
        }
    }
    
    //いいねを取得
    function getGood($a_id){
        try {
            $sql = 'SELECT * FROM favorites WHERE article_id = :a_id';
            $stmt = $this->dbh->prepare($sql);
            $params = array(':a_id' => $a_id);
            $stmt->execute($params);
            return $stmt->fetchAll();
            
        }catch(Exception $e) {
            error_log('エラー発生：'.$e->getMessage());
        }
    }
   
    
    //いいねした情報があるか確認
    function isGood($u_id, $a_id){

        try {
            $sql = 'SELECT * FROM favorites WHERE article_id = :a_id AND user_id = :u_id';
            $data = array(':u_id' => $u_id, ':a_id' => $a_id);
            $stmt = $this->dbh->prepare($sql);
            
            $params = array(
                ':u_id'=>$u_id,
                ':a_id'=>$a_id,
            );
            $stmt->execute($params);

            if($stmt->rowCount()){
                //debug('お気に入りです');
                return true;
            }else{
                //debug('特に気に入ってません');
                return false;
            }

        } catch (Exception $e) {
            error_log('エラー発生:' . $e->getMessage());
        }
    }
    
    // いいねした投稿を取得
    function getUserGood($u_id){
        try {
            $sql = 'SELECT a.*, u.user_name AS user_name, u.img AS user_img FROM articles a 
            INNER JOIN users u ON u.id = a.user_id 
            INNER JOIN favorites f ON a.id = f.article_id 
            WHERE f.user_id = :a_id ORDER BY a.created_at DESC';
            $params = array(':u_id' => $u_id);
            
            $sth = $this->dbh->prepare($sql);
            $sth->execute($params);
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $result;
            
        } catch (Exception $e) {
            error_log('エラー発生：'.$e->getMessage());
        }
    }


}
?>