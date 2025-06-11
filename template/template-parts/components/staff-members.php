<?php
$staff_list = get_query_var('staff_list');
//var_dump($staff_list);
?>
<div class="staff-list-conta">
    <div class="staff-member-list">
        <div class="swiper-wrapper">
            <?php foreach($staff_list as $staff):
                echo '<div class="swiper-slide">'; 
                set_query_var('member',$staff);
                echo coltman_get_template_slug_part('components/member_item');
                echo '</div>';
            endforeach; ?>
        </div>
         <div class="swiper-pagination staff-member-pagination"></div>
    </div>
</div>