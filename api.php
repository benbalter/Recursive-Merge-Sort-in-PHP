<?php
/**
 * RESTful Recursive Merge-Sort API
 * Returns results in JSON, JSONP or XML formats
 * @author Benjamin J. Balter
 * @version 1.0
 *
 * GET or POST field 'input' as comma-separated list of integers
 * Optionally pass field 'format' as either json or xml to force a specific return format
 * Optionally pass callback if JSONP is preferred over JSON
 * Example: api.php?input=1,2,5,3,8,7,4,6&format=xml
 */

//grab merge-sort function
include( 'merge-sort.php' );

//verify that the user passed input
if ( !isset( $_REQUEST['input'] ) ) {
	header( 'HTTP/1.1 400 Bad Request' );
	die('Please either GET or POST a comma separated list of values as "input"');
}

//sanitize user input
$input = preg_replace( '/[^0-9,]/', '', $_REQUEST['input'] );

//parse input into arary
$input = explode( ',', $input );

//remove empty elements that emerged as a result of sanitization
$input = array_filter( $input );

//verify that the user passed input
if ( empty( $input ) ) {
	header( 'HTTP/1.1 400 Bad Request' );
	die('Please pass at least one numeric value as a comma separated list in the "input" field');
}

//merge-sort
$sorted = bb_merge_sort( $input );

//determine which format to return
$format = isset( $_REQUEST['format'] ) ? $_REQUEST['format'] : 'json';

//if format is json (or no format given), merge-sort, encode as json, and exit
if ( strtolower( $format ) == 'json' || strtolower( $format ) == 'jsonp' ) {
	
	//santize callback
	$callback = ( !empty( $_REQUEST['callback'] ) ) ? preg_replace( '/[^a-z0-9-_.]/i', '', $_REQUEST['callback'] ) : null;
	
	//if user provided a callback, and callback still is valid after sanitization, return JSONP
	if ( !empty( $callback ) )
		echo $callback . '('.  json_encode( $sorted ) . ');';
	else //return plain JSON 	
		echo json_encode( $sorted );
	
	exit(); 
}

//output as XML
/**
 Example Output:
 
 <?xml version="1.0" ?>
 <results>
 	<formatted>
 		1, 2, 3, 4, 5, 6, 7, 8
 	</formatted>
 	<raw>
 		<element>
 			1
 		</element>
 		<element>
 			2
 		</element>
 		
 		…
 		
 	</raw>
 </results>
 */

//parse array into a string for XML 
$formatted = implode(', ', $sorted );

//echo opening XML tag in case apache has short PHP tags on
echo '<?xml version="1.0" ?>' . "\n";
?>
<results>
	<formatted>
		<?php echo implode( ', ', $sorted ) . "\n"; ?>
	</formatted>
	<raw>
<?php foreach ( $sorted as $elem ) { ?>
		<element><?php echo $elem; ?></element>
<?php } ?>
	<raw>
</results>