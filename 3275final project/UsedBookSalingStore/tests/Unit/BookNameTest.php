<?php

use PHPUnit\Framework\TestCase;

//Require entities
require_once('../UsedBookSalingStore/inc/Entities/Book.class.php');


class BookNameTest extends TestCase
{ 
    /**
     @return void
     */
    public function testBookName():void
    {

      $currBook= new Book();
      $currBook->setBookName('cityLife');
      $this->assertEquals("cityLife", $currBook->getBookName());
  
    }
     /**
     @return void
     */
    public function testBookDescription():void
    {

      $currBook= new Book();
      $currBook->setBookDescription('this is a new book.');
      $this->assertEquals("this is a new book.", $currBook->getBookDescription());
  
    }
}