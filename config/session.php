<?php
// for security
                                         // 1 = true
ini_set('session.use_only_cookies', 1);
 ini_set('session.use_strict_mode', 1);  // it make sure that the website only use a session id that our server created, also makes the session id more complex.

session_set_cookie_params([
'lifetime' => 1800, // cookie will get destroyed after certain amount of time, 1800=30mins in sec.
'domain' => 'localhost',
'path' => '/',
'secure' => true,
'httponly' => true
]);

session_start();

if (isset($_SESSION['user_id'])) {
		if (!isset($_SESSION['last_regeneration'])) {
			 regenerate_session_id_loggedin();

		} else {
			$interval = 60*30; // 30 MINUTES
			 if (time() - $_SESSION['last_regeneration'] >= $interval  ) {
					regenerate_session_id_loggedin();
			 }
		}

} else {
		//regenerate session id every 30 mins:
		if (!isset($_SESSION['last_regeneration'])) {
		   regenerate_session_id();

		} else {
		  $interval = 60*30; // 30 MINUTES
		   if (time() - $_SESSION['last_regeneration'] >= $interval  ) {
		      regenerate_session_id();
		   }
		}
}

function regenerate_session_id_loggedin(){
  session_regenerate_id(true); // - regenerate a more secure or complex session id.

	$userId = $_SESSION['user_id'];
	$newSessionId = session_create_id();
	$sessionId = $newSessionId . "_" .$userId;
	session_id($sessionId);

   // session_create_id()- can mix user name, for creating session id.
   $_SESSION['last_regeneration'] = time();
}




function regenerate_session_id(){
  session_regenerate_id(true); //- regenerate a more secure or complex session id.

   // session_create_id()- can mix user name, for creating session id.
   $_SESSION['last_regeneration'] = time();
}
