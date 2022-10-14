<?php 

	function showCategories($categories, $parent_id = 0, $char = '')
    {
        foreach ($categories as $key => $items) 
        {
            if ($items->parent_id == $parent_id) 
            {
                ?>
                    <?php echo  ($char == '-')?'<div class="border-item-1">':'';?>
                    <?php echo  ($char == '--')?'<div class="border-item-2">':'';?>
                    <li
                        <?php 
                        if($char == '') { echo 'id="'.$items->id.'"'; }
                        elseif ($char == '-') { echo 'class="dropdown" child="'.$items->id.'" child-id="'.$items->parent_id.'-'.$items->id.'"';}
                        elseif ($char == '--') { echo 'class="dropdown-submenu" children-child-id="'.$items->parent_id.'|'.$items->id.'"';}
                        ?>
                    >
                        <?php
                            if($char == '') {  echo '<a href="/'.$items->slug.'">'.$items->category_nm.'</a>';}
                            if ($char == '-') { 
                                echo '<a href="/'.$items->slug.'" class="dropdown-toggle" data-toggle="dropdown">'.$items->category_nm.'  <b class="caret"></b></a>';
                            }
                            elseif ($char == '--') { echo '<a href="/'.$items->slug.'">'.$items->category_nm.'</a>';}
                        ?>
                        
                    </li>
                    <?php echo ($char != '')?'</div>':'';?>
                <?php
                
                unset($categories[$key]);
                showCategories($categories, $items->id, $char.'-');

                //    echo '<li class="'.($char == '')?'':'dropdown'.'"><a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$items->category_nm.' <b class="caret"></b></a>';
                //         echo '<ul class="dropdown-menu">';
                //             echo '<li><a href="#">'.$items->category_nm.'</a></li>';
                //             echo '<li class="dropdown-submenu"> <a tabindex="-1" href="#">'.$items->category_nm.'</a>';
                //                 echo '<ul class="dropdown-menu">';
                //                     echo '<li><a href="#">'.$items->category_nm.'</a></li>';
                //                 echo '</ul>';
                //             echo '</li>';
                //         echo '</ul>';
                //     echo '</li>';

            }

        }
    }

?>

<div class="container">

    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ asset("/")}}"><i class="fa fa-home" aria-hidden="true"></i></a>
    </div>
    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav">
        {{showCategories($category)}}
        <!-- <li><a href="#">Link</a></li>
        <li><a href="#">Link</a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Multi Level <b class="caret"></b></a>
            <ul class="dropdown-menu">
            <li><a href="#">Level 1</a></li>
            <li class="dropdown-submenu"> <a tabindex="-1" href="#">More options</a>
                <ul class="dropdown-menu">
                    <li><a tabindex="-1" href="#">Level 2</a>
                    </li>
                    <li class="dropdown-submenu"> <a href="#">More..</a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Level 3</a>
                            </li>
                            <li><a href="#">Level 3</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#">Level 2</a>
                    </li>
                    <li><a href="#">Level 2</a>
                    </li>
                </ul>
            </li>
            <li><a href="#">Level 1</a></li>
            </ul>
        </li> -->
        </ul>
    </div><!-- /.navbar-collapse -->
</div><!-- end container -->
