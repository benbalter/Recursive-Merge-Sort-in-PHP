<?php
/**
 * Example Usage of PHP Recursive Merge Sort
 * @author Benjamin J. Balter
 * @version 1.0
 */

//grab merge-sort functions 
include( 'merge-sort.php' );

//establish an arbitrary array to sort
$array = array( 3, 1, 4, 1, 5, 9, 2, 6, 5, 3, 8, 9, 7, 9, 3, 2, 3, 8, 4 );

//merge sort the array back onto itself
$array = bb_merge_sort( $array ); 

//format as a string and output
?>
The sorted array is: <?php echo implode(', ', $array ); ?>