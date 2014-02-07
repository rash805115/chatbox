<?php 

namespace phpsec\framework;

/**
 * Specify routes here.
 * The keys are URLs, the values are the controller that will be called
 * Priority is based on the array, so keep the wildcard default on last line.
 * Wildcards can be used to point to DefaultControllers
 * @note: wildcards only supported at the rightmost character
 */

FrontController::$Routes["home"] =			"user/wall/userwall";
FrontController::$Routes["login/linkedin"] =		"login/linkedin";
FrontController::$Routes["login/facebook"] =		"login/facebook";
FrontController::$Routes["login/self"] =		"login/self";
FrontController::$Routes["profile/*"] =			"user/profileview/profileviewcontroller";
FrontController::$Routes["chatroom"] =			"chatroom/start";
FrontController::$Routes["chatroom/*"] =		"chatroom/start";
FrontController::$Routes["history"] =			"chatroom/history";
FrontController::$Routes["signup"] =			"signup/signup";
FrontController::$Routes["emailverification"] =		"authentication/email/emailauthentication";
FrontController::$Routes["logout"] =			"login/logout";
FrontController::$Routes["view/*"] =			"showasis";
FrontController::$Routes["*"] =				"default";

?>