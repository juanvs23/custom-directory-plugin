<?php
$conditions_list = get_query_var('conditions_list');
$get_all_conditions = wp_get_post_terms($conditions_list['post_id'], $conditions_list['taxonomy'],array( 'order' => 'ASC', 'orderby' => 'name' ));
// var_dump($get_all_conditions);


$behavioralHealth = [];
$eatingDisorders = [];
$mentalHealth = [];
$substances = [];

$get_parent_conditions = get_terms([
    'taxonomy' => 'coltman_conditions',
    'hide_empty' => false,
    'parent' => 0
]);


?>
   


<div class="conditions-container" style="padding: 0px;">

<?php 

    
    $filter = $parent_condition->term_id;
    $child_filters = array_filter($get_all_conditions, function ($condition) use ($filter) {
        return $condition->parent == $filter;
    });
    if(count($child_filters) > 0):
    ?>
        <div class="parent-condition">
        <div class="parent-info">
            <h2 class="parent-title"><?php echo __('What We Treat', 'addic-clinic-directory'); ?></h2>
           
            <div class="parent-description"></div>
            
        </div>
     
            <?php
          
            echo coltman_get_terms_list([
                'taxonomy_title'=>'', 
                'terms'=>$child_filters, 
                'link'=> true, 
                'imit'=> 10, 
                'toolip'=> true,
                'have_button'=>true,
            ] );
            ?>

        </div>
    <?php 
endif;?>
    
</div>
