<?php 
chdir('./uploads/');
echo '<h1>Using exec()</h1>';
echo '<pre>';

exec('ls -al',$result); // unix
//exec('dir,$result); // windows

foreach($result as $line)
    echo $line.PHP_EOL;

echo '</pre>';
echo '<hr />';

echo '<h1>Using passthru()</h1>';
echo '<pre>';

passthru('ls -al'); //unix
//passthru('dir'); //windows

echo '</pre>';
echo '<hr />';

echo '<h1>Using system()</h1>';
echo '<pre>';

$result = system('ls -al'); //unix
//$result = system('dir'); //windows

echo '</pre>';
echo '<hr />';

echo '<h1>Using Backticks</h1>';
echo '<pre>';

$result = `ls -al`; //unix
//$result = `dir`;//windows
echo $result;
echo '</pre>';

?>