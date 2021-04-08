<?php

//This function takes the contents of a CSV file and returns a two-dimensional
// array of the data
class  ParseBook{





static function parseBookList($bookList,$images)  {
    
    //Declare an array
    $books= array();

     
  /*  for($b=0;$b<count($images);$b++)
   {
       //get the string before "."  and after"/"because of name looks like img/*.gif
      $sub=substr($images[$b],strpos($images[$b],'/')+1,strpos($images[$b],'.')-strpos($images[$b],'/')-1);
      //create the multidimensional array for fullname(like "img/angels.gif" ) and subname(angels)
      $images[$b]= array("$images[$b]","$sub");
    
    }*/
    

    //Explode by newline character
    //$lines=explode("\n", $fileContents);
   
    //For each line in the above
    for($ROW=0;$ROW<count($bookList); $ROW++) {
       
                  //Trim each column entry
                  $columns[0]=$bookList[$ROW]->getBookIsbn();
                  $columns[1]=$bookList[$ROW]->getBookSellerId();

                  $columns[2]=$bookList[$ROW]->getBookAuthor();

                  $columns[3]=trim($bookList[$ROW]->getBookName());

                  $columns[4]=trim($bookList[$ROW]->getBookPrice());

                  $columns[5]=trim($bookList[$ROW]->getBookVersion());

                  $columns[6]=trim($bookList[$ROW]->getBookDescription());
                  $columns[7]=trim($bookList[$ROW]->getBookScore());

                  $columns[8]=trim($bookList[$ROW]->getBookSellerName());


                 /*
                        for($x=0;$x<count($images);$x++)
                        { //compare the subname of image and team name
                           
                             if(strtoupper($columns[0])==strtoupper($images[$x][1]))
                             { 
                              $columns[3]=$images[$x][0];
                              $correspond=true;
                              }
                                 
                         } 

                         
                         if($correspond==false)
                         {$columns[3]="null";}    
                    */
                  
                  //add the line back to the $array
                  $books[]= $columns;        
  
    }
    

    return $books;  
    

}

//Comparator function for sorting by name
static function cmpSortName ($x, $y)   {
//do not need to convert $x to array, because compare the value of multidemension array,
//$x already is an array passed from the usort
    //$arrX=explode(" ", $x);
    //$arrY=explode(" ",$y);

    if($x[0]>$y[0])
        {return 1;}
    if($x[0]<$y[0])
        {return -1;}
    else
        {return 0;}
}

//Sort by book name and return the data
static function sortbyBookName($bookData)    {

   $sort=array();
    foreach ($bookData as $key => $part) {
      
        $sort[$key] = $part[3];
   }
   array_multisort($sort, SORT_ASC,$bookData);
   return $bookData;


}

//Sort by book price return the data
static function sortbyPrice($bookData) {
    $sort=array();
    foreach ($bookData as $key => $part) {
        $sort[$key] = $part[4];
   }
   array_multisort($sort, SORT_ASC,$bookData);
   return $bookData;
}

//Sort by author and return the data
static function sortbyAuthor($bookData) {
    $sort=array();
    foreach ($bookData as $key => $part) {
        $sort[$key] = $part[2];
   }
   array_multisort($sort, SORT_ASC, $bookData);
    return $bookData;
}

//Sort by score and return the data
static function sortbyScore($bookData) {
    $sort=array();
    foreach ($bookData as $key => $part) {
        $sort[$key] = $part[7];
   }
   array_multisort($sort, SORT_ASC, $bookData);
    return $bookData;
}

//Comparator function for sorting by author
static function cmpSortAuthor (&$x, $y)   {
    if($x[1]>$y[1])
    {return 1;}
    if($x[1]<$y[1])
    {return -1;}
    else{return 0;}


}

//Comparator function for sorting by price
static function cmpSortPrice($x, $y)   {
    if($x[2]>$y[2])
    {return 1;}
    if($x[2]<$y[2])
    {return -1;}
    else{return 0;}

}



}
