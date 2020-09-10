<?php 
/*Book class to handle all functions realted to book management*/
class Book
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }

    /* Return author id.
       Input parameter:- Author name
       Add author if not present
    */
    function getAuthorId($a_name){
        $a_id = 0;
        //Check in existing authors
        $chkq = "SELECT id FROM author WHERE a_name = '{$a_name}'"; //Check for existing author
        $chk_res = $this->db_handle->runBaseQuery($chkq);
        if( !empty($chk_res) ){
            $a_id = $chk_res[0]['id'];
        }else{
            $query = "INSERT INTO author (a_name) VALUES (?)"; //Insert if author doesn't exists
            $paramType = "s";
            $paramValue = array(
                $a_name
            );
            $a_id = $this->db_handle->insert($query, $paramType, $paramValue);
        }
        return $a_id; //Return author id

    }
    
    /*Add book in book table.
      Params:- b_name,a_name
      Return:- int book id  
    */
    function addBook($b_name, $a_name) {
        $a_id = $this->getAuthorId(strtolower($a_name));
        $query = "INSERT INTO book (b_name, a_id) VALUES (?, ?)";
        $paramType = "si";
        $paramValue = array(
            $b_name,
            $a_id
        );
        
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
        return $insertId;
    }
    
    /*Edit an existing book
        Params:- id,b_name,a_name
    */
    function editBook($id, $b_name, $a_name) {
        $a_id = $this->getAuthorId(strtolower($a_name));
        $updated_on = date('Y-m-d H:i:s');
        $query = "UPDATE book SET b_name = ?,a_id = ?,updated_on = ? WHERE id = ?";
        $paramType = "sisi";
        $paramValue = array(
            $b_name,
            $a_id,
            $updated_on,
            $id
        );

        $this->db_handle->update($query, $paramType, $paramValue);
    }
    
    /*Softdelete an existing book
        Params:- id
    */
    function deleteBook($id) {
        $query = "UPDATE book SET is_deleted = 1 WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
        
    }
    
    /*Get book details by book id
        Params:- id
    */
    function getBookById($id) {
        $query = "SELECT 
                    b.id,b.b_name,a.a_name 
                    FROM 
                    book b 
                    LEFT JOIN 
                    author a 
                    ON 
                    a.id = b.a_id 
                    WHERE b.id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }
    
    /*Get list of books
        Params:- a_name, author name for filter default value is null
    */
    function getAllBook($a_name='') {
        $cond = 'b.is_deleted = 0';
        if(strlen($a_name)){
           $cond .= " AND a.a_name LIKE '%$a_name%'"; 
        }
        $sql = "SELECT 
                    b.id,b.b_name,a.a_name 
                    FROM 
                    book b 
                    LEFT JOIN 
                    author a 
                    ON 
                    a.id = b.a_id 
                    WHERE 
                    $cond 
                    ORDER BY
                    b.id";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

    /*Get author list
      Return:- array of authors  
    */
    function getAuthorList(){
        $sql = "SELECT a_name FROM author WHERE is_deleted!=1";
        $result = $this->db_handle->runBaseQuery($sql);

        return $result;

    }

    /*Validate book for unique records
        Params:- book_name,id
        Return Type:- Boolean
    */
    function validateBookName( $b_name, $id = 0 ){
        if($id>0){
            $cond = "id != {$id} AND b_name = '{$b_name}'"; 
        }else{
            $cond = "b_name = '{$b_name}'"; 
        }

        $chkq = "SELECT id FROM book WHERE $cond";
        $chk_res = $this->db_handle->runBaseQuery($chkq);
        if( !empty($chk_res) ){
            return false;
        }else{
            return true;
        }
    }
}
?>