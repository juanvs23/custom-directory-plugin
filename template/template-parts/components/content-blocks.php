<?php
$content_blocks_list = get_query_var('content_blocks_list');
// var_dump($content_blocks_list);
?>
<?php 
if($content_blocks_list !== '' ){
?>
<section class="clinic-section " style="background-color: #fff">
    <div class="clinic-container">
        <?php foreach($content_blocks_list as $block): ?>
        <div class="block-custom-container faq-container">
            <div class="content-block-ama-left">
                <div class="content-block-ama-title"> <?php echo $block->title?></div>
            </div>
            <div class="content-block-ama-right">
                <div class="content-block-ama-content">
                       <div class="content-block-wrapper" >
                       <?php echo str_replace('u00e0','',$block->content); ?>
                       </div>
                </div>
                <button class="btn-content-block-ama" data-open="View Less" data-close="View More">
                    <span>Read More</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                            <g clip-path="url(#clip0_108_4978)">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.7073 16.2069C12.5198 16.3943 12.2655 16.4996 12.0003 16.4996C11.7352 16.4996 11.4809 16.3943 11.2933 16.2069L5.63634 10.5499C5.54083 10.4576 5.46465 10.3473 5.41224 10.2253C5.35983 10.1033 5.33225 9.97204 5.33109 9.83926C5.32994 9.70648 5.35524 9.5748 5.40552 9.4519C5.4558 9.329 5.53006 9.21735 5.62395 9.12346C5.71784 9.02957 5.82949 8.95531 5.95239 8.90503C6.07529 8.85475 6.20696 8.82945 6.33974 8.8306C6.47252 8.83176 6.60374 8.85934 6.72575 8.91175C6.84775 8.96416 6.9581 9.04034 7.05034 9.13585L12.0003 14.0859L16.9503 9.13585C17.1389 8.9537 17.3915 8.8529 17.6537 8.85518C17.9159 8.85746 18.1668 8.96263 18.3522 9.14804C18.5376 9.33344 18.6427 9.58426 18.645 9.84645C18.6473 10.1087 18.5465 10.3613 18.3643 10.5499L12.7073 16.2069Z" fill="#FFFFFF"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_108_4978">
                                <rect width="24" height="24" fill="white" transform="translate(0 0.5)"/>
                                </clipPath>
                            </defs>
                        </svg>
                </button>
            </div>
        </div>
         <?php endforeach; ?>
    </div>
</section>
<?php
}
?>
