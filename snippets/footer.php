<footer>
   <p>&copy; PHP Motors, All rights reserved.</p>
   <p>All images used are believed to be in "Fair Use." Please notify the author if any are 
      not and they will be removed.</p>

   <?php
   // I needed help finding the file that the footer will be in and showing when it was last updated.
   // I found tutorials online from w3schools and w3resources that helped me understand this concept.
   // https://www.w3schools.com/php/func_filesystem_filemtime.asp
   // https://www.w3resource.com/php-exercises/php-basic-exercise-7.php
    function getFile() {
      $hostFile = basename($_SERVER['PHP_SELF']);
      return $hostFile;
   }

   $currentFile = getFile(); 
   echo "Last updated: ".date("d F, Y", filemtime($currentFile));
   ?>
   
</footer>