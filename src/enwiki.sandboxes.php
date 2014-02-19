<?php

require_once( __DIR__ . "/vendor/autoload.php" );
$api = new \Mediawiki\Api\MediawikiApi( "http://en.wikipedia.org/w/api.php" );
//TODO load details from a config somewhere!
$user = new \Mediawiki\Api\ApiUser( 'Addbot', 'imapassword[=' );
if( $api->login( $user ) !== true ) {
	throw new RuntimeException( 'Can not run as failed to login' );
}
$editFlags = new \Mediawiki\DataModel\EditFlags( '[[User:' . $user->getUsername() . '|Bot:]] Cleaning sandbox', true, true );

$revids = array(
	'Wikipedia:Sandbox' => 596189391,
	'Wikipedia_talk:Sandbox' => 596123853,
	'Wikipedia:Tutorial/Editing/sandbox' => 596186177,
	'Template:X1' => 594608507,
	'Template:X2' => 593873441,
	'Template:X3' => 593500666,
	'Template:X4' => 589171175,
	'Template:X5' => 595647416,
	'Template:X6' => 593501823,
	'Template:X7' => 593501679,
	'Template:X8' => 594527877,
	'Template:X9' => 593746938,
	'Template_talk:X1' => 533789048,
	'Template_talk:X2' => 553337220,
	'Template_talk:X3' => 524185013,
	'Template_talk:X4' => 524185031,
	'Template_talk:X5' => 524185045,
	'Template_talk:X6' => 524185065,
	'Template_talk:X7' => 533452229,
	'Template_talk:X8' => 524185102,
	'Template_talk:X9' => 524185122,
);

foreach( $revids as $name => $revid ) {

	$task = new \Mediawiki\Bot\Tasks\CleanSandbox(
		$api,
		$revid,
		$editFlags
	);
	echo $name . " => " . $task->run() . "\n";

}