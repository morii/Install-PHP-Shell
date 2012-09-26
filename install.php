#!/usr/bin/php
<?php
function git_clone() {
  $out = array();
  $ret = -1;
  exec('git clone git://github.com/morii/PHP-Shell.git 2>git_log', $out, $ret);
  return $ret==0?true:false;
}

function make_new_user($user) {
  $home = "/home/{$user}/";
  if(!mkdir("{$home}bin", 0755, true))
    return 0;
  if(!copy('PHP-Shell/php_shell', "{$home}bin/php_shell"))
    return 0;
  exec("echo {$home}bin/php_shell >>/etc/shells");
  exec("groupadd {$user}", $out, $ret);
  if($ret!=0)
    return 0;
  exec("useradd -d {$home} -s {$home}bin/php_shell -g {$user} {$user}", $out, $ret);
  if($ret!=0)
    return 0;
  exec("passwd {$user}");
  chown("{$home}", $user);
  chown("{$home}bin/", $user);
  chown("{$home}bin/php_shell", $user);
  chgrp("{$home}", $user);
  chgrp("{$home}bin/", $user);
  chgrp("{$home}bin/php_shell", $user);
  chmod("{$home}bin/php_shell", 0755);
  return 1;
}

function process_args() {
  global $argv, $argc;
  $longopt = array('user:', 'test');
  $options =  getopt('u:t');

  foreach($options as $opt => $arg) {
    switch($opt) {
    case 'u':
    case 'user':
      global $user;
      $user = $arg;
      break;
    case 't':
    case 'test':
      global $test;
      $test = true;
      break;
    }
  }
}
?>
<?php
$user = 'php_shell';
if(getenv('USER') != 'root') 
  die("You need to be root to be able install PHP Shell\n");

process_args();

echo "Starting instalation:\n";
echo "Clonning repository:\t";
if(git_clone())
  echo "OK\n";
else
  die("Failed\nCouldn't clone repository: check you internet connection\n");

$ret = make_new_user($user); 
echo "Making new user:\t";
if($ret)
  echo "OK\n";
else
  die("Failed\nCouldn't make new user\n");

echo "Cleaning up:\t";
$out = array();
exec("rm -rf PHP-Shell", $out, $ret);
if($ret==0)
  echo "OK\n";
else
  echo "Failed\nCouldn't remove unnecesary files\n";

echo "Installation ended succesfuly\n";

?>
