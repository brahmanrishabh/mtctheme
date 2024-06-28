<?php
/**
 * GIT DEPLOYMENT SCRIPT
 *
 * Used for automatically deploying websites via a webhook.
 *
 * https://gist.github.com/1809044
 */

define( 'TOKEN', 'jY8lW1tB3mV4lR0zP9xZ6hJ7hJ6vR8gR' );
$output = '';
if ( empty( $_GET['token'] ) || $_GET['token'] != TOKEN ) {
	$output .= '<h1>Unauthorized</h1>';
} else {
	/*The commands*/
	$commands = array(
		'whoami',
		'echo $PWD',
		'git reset --hard HEAD',
		'git pull',
		'git status',
		'git submodule sync',
		'git submodule update',
		'git submodule status',
	);
	/*Run the commands for output*/
	foreach ( $commands as $command ) {
		/*Run it*/
		$tmp = exec( $command );
		/*Output*/
		$output .= "<span style=\"color: #6BE234;\">\$</span> <span style=\"color: #729FCF;\">{$command}\n</span>";
		$output .= htmlentities( trim( $tmp ) ) . "\n";
	}
}
/*Make it pretty for manual user access (and why not?)*/
?>
<!DOCTYPE HTML>
<html lang="en-US">

<head>
	<meta charset="UTF-8">
	<title>GIT DEPLOYMENT SCRIPT</title>
</head>

<body style="background-color: #000000; color: #FFFFFF; font-weight: bold; padding: 0 10px;">
	<pre>
	_____________________________
	|                            |
	|                            |
	| Git Deployment Script v0.2 |
	|              darthrax 2023 |
	|____________________________|

	<?php echo $output; ?>
	</pre>
</body>

</html>
