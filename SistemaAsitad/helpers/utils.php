<?php
class Utils
{
  public static function deleteSession($name)
  {
    if (isset($_SESSION[$name])) {
      $_SESSION[$name] = null;
      unset($_SESSION[$name]);
    }
  }
  
  public static function verify()
  {
    if (!isset($_SESSION['userLog'])) {
      header('Location: ' . baseUrl);
    }
  }
  public static function isAdmin(){
    if(!isset($_SESSION['administrador'])){
			header("Location:".base_url);
		}else{
			return true;
		}
  }
  public static function isPadrino(){
    if(!isset($_SESSION['padrino'])){
			header("Location:".base_url);
		}else{
			return true;
		}
  }
  public static function isMedico(){
    if(!isset($_SESSION['medico'])){
			header("Location:".base_url);
		}else{
			return true;
		}
  }
  public static function isPracticante(){
    if(!isset($_SESSION['practicante'])){
			header("Location:".base_url);
		}else{
			return true;
		}
  }
}
