<?php
$connection = mysql_connect( 'localhost', 'sjsucsor_160g4', 'groupfourdb' );
if (!$connection)
{
 die('Could not connect: ' . mysql_error());
}
mysql_select_db( 'sjsucsor_160g4fall2013' );
$query    = "SELECT * FROM coursedetails";
$result   = mysql_query( $query );
$col_name = array( );
for ( $i = 0; $i < mysql_num_fields( $result ); $i++ ) {
    $col_name[ $i ] = mysql_field_name( $result, $i );
}
?>
<!DOCTYPE html>
<html>
 <head>
   <title>coursedetails</title>
   <link rel="stylesheet" type="text/css" href="casablanca.css">
 </head>
 <body>
   <a href="index.php">Home</a>
   <br />
   <br />
   <table>
     <thead>
       <tr>
<?php foreach ($col_name as $name) :?>
         <th scope="col"> <?=$name?> </th>
<?php endforeach; ?>
       </tr>
     </thead>
     <tfoot>
       <tr>
<?php for ( $i = 0; $i < count( $col_name); $i++ ) : ?>
         <td></td>
<?php endfor; ?>
       </tr>
     </tfoot>
     <tbody>
<?php while ( $row = mysql_fetch_array( $result ) ) : ?>
       <tr>
<?php foreach ($col_name as $name) : ?>
<?php $temp = $row[ $name ];?>
         <td>
<?php if ( !empty( $temp ) ) : ?>
<?php if ( preg_match( '/(download\?|(jpg|png|gif|bmp)$)/i', $temp ) ) : ?>
           <img height="95px" src="<?=$temp?>">
<?php else : ?>
           <p><?=$temp?></p>
<?php endif; ?>
<?php endif; ?>
         </td>
<?php endforeach; ?>
       </tr>
<?php endwhile; ?>
     </tbody>
   </table>
 </body>
</html>
<?php mysql_close();?>