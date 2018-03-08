<?php 
// Free result set

mysqli_free_result($result);


// Close connection

mysqli_close($conn); 
?>
<?php ob_end_flush(); ?>
          

</body>
</html>


