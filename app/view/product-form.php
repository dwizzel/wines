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
        //le formulaire
        $content .= '<form method="'.$data['form']['method'].'" action="'.$data['form']['path'].'">';
        foreach($data['form']['fields'] as $k=>$v){
            $content .= '<div class="label">'.$v['label'].':</div>';
            $content .= '<div class="input"><input type="'.$v['type'].'" value="'.addcslashes($v['value'], '"').'" name="'.$k.'"></div>';              
        }
        $content .= '<button type="'.$data['form']['button']['type'].'">'.$data['form']['button']['text'].'</button>';
        $content .= '</form>';
        //output
        echo $content;
        ?>
        </form>
    </div>
</body>
</html>