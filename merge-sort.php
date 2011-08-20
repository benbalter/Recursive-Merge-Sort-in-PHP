<?php
/**
 * Recursive Merge Sort Function for PHP
 * @author Benjamin J. Balter
 * @version 1.0
 */

/** 
 * Recursively merges and sorts an array
 * @param array $array the unsorted array
 * @returns array the sorted array
 */
function bb_merge_sort( $array ) {

    //if array is but one element, array is sorted, so return as is
    if ( sizeof ( $array ) == 1 )
    	return $array;
    	
    //bifurcate unsorted array
    $array2 = array_splice( $array, ( sizeof( $array ) / 2 ) );
    
    //recursively merge-sort and return
    return bb_merge( bb_merge_sort( $array ), bb_merge_sort( $array2 ) );
    
}

/** 
 * Helper function for bb_merge_sort, merges two arrays into one sorted array
 * @param array $array1 one array
 * @param array $array2 another array
 * @returns array the sorted, merged array
 */
function bb_merge( $array1, $array2 ) {
    
    //init an empty output array
    $output = array();
    
    //loop through the arrays while at least one still has elements left in it
    while( !empty( $array1 ) || !empty( $array2 ) ) 
    	
    	//one of the arrays is empty, so the last man standing wins...
    	if ( empty( $array1 ) || empty( $array2 ) )
    		$output[] = ( empty( $array2 ) ) ? array_shift( $array1 ) : array_shift( $array2 );
    		
    	//both arrays still have elements, looks like we have a showdown...
    	else 
    		$output[] = ( $array1[ 0 ] <= $array2[ 0 ] ) ? array_shift( $array1 ) : array_shift( $array2 );
    
    //pass back the output array	
    return $output;
}
?>