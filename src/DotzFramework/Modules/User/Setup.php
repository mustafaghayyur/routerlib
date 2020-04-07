<?php
namespace DotzFramework\Modules\User;

use DotzFramework\Core\Dotz;
use DotzFramework\Modules\Migrations;

/**
 * Used to add/remove this module from your application.
 */
class Setup {

	public static function install(){

		// sql for enabling User module in the database
		$upSql = [
			'CREATE TABLE user (
					id INT AUTO_INCREMENT NOT NULL, 
					email VARCHAR(120) NOT NULL UNIQUE,
					username VARCHAR(120) NOT NULL UNIQUE, 
					password VARCHAR(255) NOT NULL, 
					PRIMARY KEY(id)
				);',
		];

		$downSql = ['DROP TABLE user;'];

		$version = Migrations\Create::migration(
			null, 
			Migrations\SQL::generate($upSql), 
			Migrations\SQL::generate($downSql),
			'user module migration'
		);

		$settings = <<< EOD
{
	"============":"Use https://jsonformatter.curiousconcept.com/ to validate your JSON",
	
	"------------":"Configurations for User Module-------",
	"------------":"Only applies if you use the module.-------",
	
	"------------":"Which Auth method is being used on this app [session|token].-------",
	"authMethod":"session",
	
	"------------":"If set to true, the email field will be used as the username-------",
	"emailAsUser":true,
	
	"------------":"Secret key for token based authentication.-------",	
	"secretKey":"GHILIVYIJkhuogfuy78587697687",
	
	"------------":"For Tokens: times-out in this many seconds.-------",	
	"------------":"For Sessions: times-out in this many seconds of inactivity.-------",	
	"timeout":"1800",

	"------------":"Used only in Session based logins-------",	
	"------------":"Add the URI (excluding the App URL) for Login, Logout, Register and Logged-in pages below:-------",	
	"loginUri":"user/login",
	"logoutUri":"user/logout",
	"registerUri":"user/signup",
	"loggedInUri":"user/index"
}
EOD;

		$c = Dotz::config('app');
		$path = '/'. trim($c->systemPath, '/') .'/configs/user.txt';

		file_put_contents(
			$path, 
			$settings
		);

		echo "<h2>User Module activated</h2>";
		echo "<p>The database migration needs to be run in order to use authentication and other User module functions. In your command line, cd into the application's root directory and run the following command:</p>";
		echo "<code> > ./vendor/bin/doctrine-migrations migrations:execute --up {$version} </code>";
		echo '<p>This will enable the module. A new \'user.txt\' file has been added to the configs directory holding settings for this module.';
		die();

	}

	/**
	 * Don't need the User module anymore?
	 * 
	 * Are you sure?
	 * 
	 * Create a controller and run Setup::uninstall()
	 * Then delete the controller (make it in-accessible to the public).
	 */
	public static function uninstall(){

		// sql for removing User module from the database
		$upSql = [
			'DROP TABLE user;'
		];
		
		$downSql = [];

		$version = Migrations\Create::migration(
			null, 
			Migrations\SQL::generate($upSql), 
			Migrations\SQL::generate($downSql),
			'user module migration'
		);

		echo "<h2>User Module de-activated</h2>";
		echo "<p>The database migration needs to be run in order to use authentication and other User module functions. In your command line, cd into the application's root directory and run the following command:</p>";
		echo "<code> > ./vendor/bin/doctrine-migrations migrations:execute --up {$version} </code>";
		echo '<p>This will druop the user table. The \'configs/user.txt\' file will require manual deleting.';
		die();
	
	}

}