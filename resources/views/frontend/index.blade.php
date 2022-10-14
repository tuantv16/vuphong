    
<?php 
	function showCategories($categories, $parent_id = 0, $char = '')
    {
        foreach ($categories as $key => $items) 
        {
            if ($items->parent_id == $parent_id) 
            {
                echo '<tr>';
                    echo '<td>';
                        if($char == '') {
                            echo $items->category_nm."No0";
                        }
                        elseif ($char == '|---') {
                            echo $items->category_nm."No1";
                        } elseif ($char == '|---|---') {
                            echo $items->category_nm."No2";
                        }
                    echo '</td>';
                echo '</tr>';
                unset($categories[$key]);
                showCategories($categories, $items->id, $char.'|---');
            }

        }
    }
?>

<table border="1" cellspacing="0" cellpadding="5">
    <tr>
        <td><strong>Hiển thị của Tuấn</strong></td>
    </tr>
    <?php showCategories($categories); ?>
</table>


