<?php
$templates = array();
$dir = dir('.');
foreach (new DirectoryIterator('.') as $fileInfo) {
    if($fileInfo->isDot()) {
        continue;
    }
    if($fileInfo->isDir() && file_exists('./'.$fileInfo->getFilename().'/web')) {
        $templates[] = $fileInfo->getFilename();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <title>Silex templates</title>
  </head>
  <body>
    <h1>Silex templates</h1>
<?php
if(count($templates)>0) {
    print('    <ul>'.PHP_EOL);
    foreach($templates as $template) {
        print('      <li><a href="'.$template.'/web">'.$template.'</a></li>'.PHP_EOL);
    }
    print('    </ul>'.PHP_EOL);
}
?>
  </body>
</html>
