<?php
$username = $_POST['username'];
$message = $_POST['message'];

if (empty($username) || empty($message)) {
  echo 'Enter your nickname and message.';
  return;
}

$file_path = realpath('./chat.txt');
$pointer = fopen($file_path, 'r+');

$max_messages = 25;

if (flock($pointer, LOCK_SH)) {
  $messages = explode(PHP_EOL, fread($pointer, filesize($file_path)));
  $messages[] = $username . ': ' . remove_new_lines($message);
  $messages = array_filter($messages, 'strlen'); //removing only null values
  $messages_count = count($messages);
  if ($messages_count > $max_messages) {
    $messages = array_slice($messages, $messages_count - $max_messages);
  }
  rewind($pointer);
  ftruncate($pointer, 0);
  
  foreach ($messages as $message) {
    fwrite($pointer, $message . PHP_EOL);
  }
  flock($pointer, LOCK_UN);
}
fclose($pointer);

function remove_new_lines($text) {
  return str_replace(["\r\n","\r","\n"], ' ', $text);
}

?>
