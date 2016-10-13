<?php
namespace SecSession;
class SecSession {
    public static function start() {
        $remoteAddr = $_SERVER['REMOTE_ADDR'];
        $userAgent = $_SERVER['HTTP_USER_AGENT'];

        session_start();
        if (!isset($_SESSION['sec_remote-addr']) && !isset($_SESSION['sec_ua'])) {
            $_SESSION['sec_remote-addr'] = $remoteAddr;
            $_SESSION['sec_ua'] = $userAgent;
        }
        if ($_SESSION['sec_remote-addr'] !== $remoteAddr || $_SESSION['sec_ua'] !== $userAgent) {
            session_regenerate_id();
            $_SESSION = array();
            $_SESSION['sec_remote-addr'] = $remoteAddr;
            $_SESSION['sec_ua'] = $userAgent;
        }
    }
    public static function get($name) {
        return isset($_SESSION[$name]) ? $_SESSION[$name] : null;
    }
    public static function set($name, $value) {
        $_SESSION[$name] = $value;
    }
    public static function destroy() {
        session_destroy();
    }
}