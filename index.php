<?php
	/*Landing page*/
	require_once ("class/DBController.php"); //add database controller class to manage db level functions
	require_once ("class/Book.php"); //Add books class to handle book module level functions

	$book = new Book(); //Instantiate Book class
	$result = $book->getAllBook(); //Get list of books
	$authorList = $book->getAuthorList(); //get list of authors
	require_once "web/book.php"; //load html sections

?>