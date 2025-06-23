<?php
$level_care = get_query_var('level_care');
$level_title = $level_care['level_title'];
$level_text = $level_care['level_text'];
$get_level_care = $level_care['get_level_care'];
?>
<section id="level-care" class="level-care section-container">
    <div class="clinic-container">

        <div class="level-care-container">
            <h2 class="level-title">
                <?php echo $level_title; ?>
            </h2>
            <?php if($level_text !==''):?>
            <p class="level-text">
                <?php echo $level_text; ?>
            </p>
            <?php
            endif;
            
            if( count($get_level_care) > 0 ){
              
                set_query_var('level_care', $get_level_care);
                echo coltman_get_template_slug_part('components/level_of_care');
            }
            
            ?>
        </div>
    </div>
</section>