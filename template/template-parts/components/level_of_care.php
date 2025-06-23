<?php
$level_care = get_query_var('level_care');
//var_dump($level_care);
$init = 0;
?>
<div class="tablist">
    <div class="tab-nav-content">
        <ul class="tab-navs">
            <?php
            $count_a = 0;
            foreach($level_care as $level){
                echo '<li class="tab-nav"><h3 class="tab-nav-title '.($count_a == $init ? 'active-nav' : '').'" data-target="'.$level['id'].'">'.$level['title'].'</h3></li>';
                $count_a++; 
            }
            ?>
        </ul>
    </div>
    <div class="tab-content">

        <?php  
        $count_b = 0;
        foreach($level_care as $level): ?>
            <div class="tab-item <?php echo $count_b == $init ? 'open-tab' : ''; ?>" id="<?php echo $level['id'];?>">
                <div class="tab-item-header">
                    <h3 class="tab-nav-title <?php echo $count_b == $init ? 'active-nav' : '';?>">
                        <?php echo $level['title']; ?>
                    </h3>
                </div>
                <div class="tab-item-content">
                    <?php echo $level['content']; ?>
                </div>
            </div>
        <?php 
            $count_b++;
        endforeach;?>
    </div>
</div>