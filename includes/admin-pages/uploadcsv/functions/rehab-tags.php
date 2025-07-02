<?php

class RehabTagsActions{



    public function addRehabTags($tags,$tagNames){
        global $wpdb;
        $prefix = $wpdb->prefix;
        $rehabTags = [];
        foreach($tags as $tag){
            $tagId = $wpdb->get_results("SELECT term_id FROM {$prefix}terms WHERE name = '{$tag}'")[0]->term_id;
            if(!$tagId){
                $rehabTags[] = wp_insert_term($tag, $tagNames,[
                    'description' => '',
                ]);

            }
        }
        return $rehabTags;
        
    }
   
    public function  getTagsRehabByName($names, $tagName){
        global $wpdb;
       
       
        $prefix = $wpdb->prefix;
        $rehabTags=[];
        foreach($names as $name){
            $tagId= $wpdb->get_results("SELECT term_id FROM {$prefix}terms WHERE name = '{$name}'")[0]->term_id;
            if($tagId != null){
                $rehabTags[] = $tagId;
            }
        }

        return $rehabTags;
         
    }
    public function setTagToRehab($post_id,$tag_ids, $tagName){
        global $wpdb;
        $prefix = $wpdb->prefix;
        $findTagById = [];
        foreach($tag_ids as $tag_id){
        
            $findTagById[] = $wpdb->get_results("SELECT name FROM {$prefix}terms WHERE term_id = {$tag_id}")[0]->name;

        }
       return wp_set_post_terms($post_id, $findTagById, $tagName);
        
    }
}