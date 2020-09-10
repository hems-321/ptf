<?php
	error_reporting(0);
	require_once ("../class/DBController.php");
	require_once ("../class/Book.php");

	global $book,$action,$id,$b_name,$a_name;
	$book = new Book();
	extract($_POST);
	
	/*Validate user input*/
	function validateInput(){
		global $book,$action,$id,$b_name,$a_name;
		
		$errors = array();
		if(empty($b_name)){
			$errors["b_name"] = "Please enter valid book name";
		}
		if(empty($a_name)){
			$errors["a_name"] = "Please enter valid author name";
		}
		
		if( empty($errors["b_name"]) ){
			if( !$book->validateBookName(strtolower($b_name), $id)){
				$errors["b_name"] = "Book name already exists.";
			}
		}

		return $errors;
	}

	switch ($action) {
		case 'getList':
			$book_data = $book->getAllBook($a_name);
			echo json_encode($book_data);
			break;
		case 'get':
			$book_data = $book->getBookById($id);
			echo json_encode($book_data[0]);
			break;	
		case 'add':
			$errors = validateInput();
			if ( empty($errors)) {
	            $insertId = $book->addBook(strtolower($b_name), strtolower($a_name));
	            if (empty($insertId)) {
	                $response = array(
	                    "message" => "Problem in adding new book record.",
	                    "status" => 0
	                );
	            } else {
	                $response = array(
	                	'message'=>'Book added successfully.',
	                	'status' => 1
	                );
	            }
	        }else{
	        	$response = array(
                	'message'=> $errors,
                	'status' => 0
                );
	        }
	        
	        echo json_encode($response);

			break;
		case 'edit':
				$errors = validateInput();
			if ( empty($errors)) {
	            $book->editBook($id,strtolower($b_name),strtolower($a_name));
                $response = array(
                	'message'=>'Book details updated successfully.',
                	'status' => 1
                );
	            
	        }else{
	        	$errors['status'] = 0;
	        	$response['message'] = $errors;
	        }
	        
	        echo json_encode($response);
			break;
		case 'delete':
			$book->deleteBook($id);
			$response = array(
				'message' => 'Book deleted successfully.',
				'status' => 1
			);
	        echo json_encode($response);
			break;
	}

?>