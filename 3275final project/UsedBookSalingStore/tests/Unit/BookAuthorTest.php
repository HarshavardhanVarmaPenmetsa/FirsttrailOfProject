<?php

use PHPUnit\Framework\TestCase;
//use Book;

//Require entities
require_once('../UsedBookSalingStore/inc/Entities/Book.class.php');


class BookAuthorTest extends TestCase
{ 
    /**
     @return void
     */
    public function testBookAuthor():void
    {

      $currBook= new Book();
      $currBook->setBookAuthor('ashwin');
      $this->assertEquals("ashwin", $currBook->getBookAuthor());
  
    }
}