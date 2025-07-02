<?php
use OpenAI\Client;


if(!function_exists('createRehabFunction')){

    
/**
 * Create a new post in the 'coltman_addic_clinic' custom post type.
 *
 * @param string $title The title of the post.
 *
 * @return int|false The ID of the newly created post, or false if not created.
 */
    function createRehabFunction($title){
        global $wpdb;

        $prefix = $wpdb->prefix;
        $post_type = 'coltman_addic_clinic';
        
        $addicGetPostByTitle = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT ID, post_title FROM {$prefix}posts WHERE post_title = %s AND post_type = %s AND post_status = 'publish'",
                $title,
                $post_type
            ),
        );
     
        $post_id = false;
        #create CPT Rehab
        if(empty($addicGetPostByTitle) && is_admin()){
            $post_id = wp_insert_post([
                'post_title' => $title,
                'post_status' => 'publish',
                'post_type' => $post_type,
            ]);
        }
        return $post_id;
    }
}


if(!function_exists('rehabLoadStatus')){

/**
 * Return table td with status of loading data, if $status = true then return green cell with text "Info Loaded", else return red cell with text "Not Found"
 *
 * @param bool $status Status of loading data
 *
 * @return string Table td with status of loading data
 */
    function rehabLoadStatus($status = false){
        if($status){
            return '<td class="table-success" scope="col">Info Loaded</td>';
        }else{
            return '<td class="table-danger" scope="col">'.NOTFOUND.'</td>';
        }
    }
}

if(!function_exists('rehabCleanAndAddTag')){

/**
 * Clean a string of highlights and add them to the given rehab id
 *
 * @param int $id The id of the rehab to add the highlights to.
 * @param string $cell The string of highlights to clean and add. If the string is NOTFOUND, no highlights are added.
 * @param string $tagName The name of the taxonomy to add the highlights to. This is typically "coltman_highlights".
 * @return bool True if the highlights were added successfully, false otherwise.
 */
    function rehabCleanAndAddTag($id,$cell,$tagName){
        $rehabsTags = new RehabTagsActions();
        $names = [];
        if($cell != NOTFOUND){
            $namesList = explode(", ", $cell);

            foreach($namesList as $name){
                $cleanName = str_replace("[", "", $name);
                $cleanName = str_replace("]", "", $cleanName);
                $cleanName = str_replace("'", "", $cleanName);
                $names[] = $cleanName;
            }
        }
    
        $highlight_tag = $rehabsTags->getTagsRehabByName($names, $tagName);
        $rehab_highlights = $rehabsTags->setTagToRehab($id,$highlight_tag, $tagName);
        $isHighlight = true;
        if(!$rehab_highlights || is_wp_error($rehab_highlights)){
            $isHighlight = false;
        }
        return $isHighlight;
    }
}
if(!function_exists('openaiDescriptionText')){

    
/**
 * Given a text, returns a paraphrased version of it using OpenAI's GPT-4 model.
 * If the OpenAI API key is not set, or the text is empty, the original text is returned.
 * 
 * @param string $text The text to paraphrase.
 * 
 * @return string The paraphrased text.
 */
    function openaiDescriptionText($text=""){
        $description = $text;
        if(ADDIC_CLINIC_OPENAI_KEY != "" && $text != "" && phpversion() >= '8.1' ){
            // Inicializar el cliente de OpenAI
            $client = OpenAI::client(ADDIC_CLINIC_OPENAI_KEY);
            $result= $client->chat()->create([
                'model' => 'gpt-4o-mini',
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => "Take the next text and return a Paraphrased text. Ensure the text is completely original, avoiding plagiarism while maintaining the same information: $text"
                    ]
                ]
            ]);
            $description = $result->choices[0]->message->content;
        }
        return $description;
    }
}

if(!function_exists('coltmanRehabGetVideoId')){

    
/**
 * Given a YouTube URL, extracts the video ID.
 *
 * @param string $url A YouTube URL.
 *
 * @return string|false The video ID if found, false otherwise.
 */
    function coltmanRehabGetVideoId($url){
        //https://img.youtube.com/vi/N0K8blmaJxU/hqdefault.jpg
        if( $url != '' && $url != NOTFOUND ){
            $removeJPG = explode('/hq',$url);
            return explode('com/vi/',$removeJPG[0])[1];
        }

      return false;

    }
}

if (!function_exists('coltmanRehabMap')) {
    function coltmanRehabMap ($urlAddress){
        $urlPlace ="https://www.google.com/maps/embed/v1/place?key=";
        if(ADDIC_CLINIC_GOOGLE_API_KEY != ""){
            $address = explode('&q=', $urlAddress);
            $urlAddress = $urlPlace.ADDIC_CLINIC_GOOGLE_API_KEY.'&q='.$address[1];
        }
        return $urlAddress;
    }
}
