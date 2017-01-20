<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="<?php echo  base_url();?>css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/bootstrap-responsive.css" rel="stylesheet">
</head>
<body >    
    <div class="container-fluid">    
    <?php
    if(isset($breadcrumb)&& is_array($breadcrumb) && count($breadcrumb) > 0){
    ?>            
    <div class="row-fluid">
        <div class="span12">
            <div class="span2">
                
            </div>
            <div class="span10" style="margin-left:5px;">
                <div>
                    <ul class="breadcrumb">
                    <?php
                    foreach ($breadcrumb as $key=>$value) {
                     if($value!=''){
                    ?>
                        <li><a href="<?php echo $value; ?>"><?php echo $key; ?></a> <span class="divider">></span></li>
                        <?php }else{?>
                        <li class="active"><?php echo $key; ?></li>
                        <?php }
                    }
                    ?>        
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php
        }
    ?>            
       </div>  
</body>
</html>    
