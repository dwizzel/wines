<!DOCTYPE html>
<html lang="<?php echo $data['lang']; ?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
  <title><?php echo $data['title']; ?></title>
  <link rel="stylesheet" href="<?php echo CSS_PATH.'global.css'; ?>">
</head>
<body>
    <div class="container">
        <?php 
        //top menu
        require_once(VIEW_PATH.'menu.php'); 
        //content
        $content = '<h1>'.$data['title'].'</h1>';
        if($data['product'] !== false){
            foreach($data['product']->fields as $k=>$v){
                $content .= '<div class="product"><strong>'.$v.'</strong>:'.$data['product']->row[$v].'</div>';
                }
            //le json link
            $content .= '<button onclick="window.location.href = \''.$data['path-json'].'\'">json format</button>';
            }
        //output 
        echo $content;    
        ?>
    </div>
</body>
</html>