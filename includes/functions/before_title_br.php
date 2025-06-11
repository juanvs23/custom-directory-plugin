<?php
if(!file_exists('coltman_before_title')){
    function coltman_before_title($title = 'title'){
        return '<span class="current" title="'.$title.'">';
    }
}