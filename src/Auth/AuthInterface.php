<?php
namespace Auth;

interface AuthInterface {
    public function isClientLoggedIn();
    public function loginClient($clientId);
    public function logoutClient();
}
?>
