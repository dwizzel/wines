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
        if(isset($data['products']) && $data['products'] !== false){
            $content .= '<ul class="listing">';
            foreach($data['products'] as $k=>$v){
                //$content .= '<li onclick="window.location.href = \''.$data['path-page'].$v['prodID'].'/\'">';
                $content .= '<li>';
                $content .= '<a href="'.$data['path-page'].$v['prodID'].'/">';
                $content .= '<h2>'.$v['prodName'].'</h2>';
                $content .= '<div class="price">'.money_format('%i', $v['prodSellPrice']).'$</div>';
                $content .= '</a>';
                $content .= '</li>';
            }
            $content .= '</ul>'; 
            //le add new product bottom
            $content .= '<button class="add" onclick="window.location.href = \''.$data['path-new'].'\'">+</button>';
                
        }else{
            $content .= '<p>The product list is empty!</p>';
        }
        //output 
        echo $content;    
        ?>
    </div>
</body>
</html>