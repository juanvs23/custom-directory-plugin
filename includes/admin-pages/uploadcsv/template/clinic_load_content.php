<?php
use PhpOffice\PhpSpreadsheet\Reader\Csv;

if(!function_exists('clinicLoadContent')){
    function clinicLoadContent(){
        ob_start();
        ?>
        <link rel="stylesheet" href="<?php echo ADDIC_CLINIC_PLUGIN_URL . 'assets/admin/libs/bootstrap/css/bootstrap.css'; ?>">
        <link rel="stylesheet" href="<?php echo ADDIC_CLINIC_PLUGIN_URL . 'assets/admin/css/admins-pages.css'; ?>">
        <section class="form-content">
            <div class="row justify-content-center">
            <h1 class="display-4 col-12 text-center">
                Upload rehabs centers
            </h1>
                <div class="col-md-8">
                    <form action="" class="update-csv-content" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="csv">Upload CSV</label>
                            <input type="file" name="csv" id="csv" class="form-control mb-4" required accept=".csv">
                            <button class="btn btn-primary" type="submit">Upload</button>
                        </div>
                    </form>
                    <?php
                    if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
                        $csv = $_FILES['csv'];
                        if($csv["type"] == "text/csv"){
                            $reader = new Csv();
                            $reader->setDelimiter(';');
                            $reader->setReadEmptyCells(true);
                            $spreadsheet = $reader->load($csv["tmp_name"]);
                            $sheet = $spreadsheet->getActiveSheet();
                            $fieldnames = ADDIC_FIELDS;
                            $rowLocation = 1;
                            // Read rows
                            $id = false;
                            ?>
                            <div class="table-responsive" style="height: 400px; overflow-y: scroll">
                                <caption class="display-5">List of rehabs</caption>
                                <table class="table table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col" >#</th>
                                            <?php
                                            foreach ($fieldnames as $field){
                                                echo '<th scope="col">'.$field.'</th>';
                                            }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        <?php
                                            $rehabMeta = new RehabMetaContent();
                                            $rehabsTags = new RehabTagsActions();
                                            foreach ($sheet->getRowIterator() as $row ){
                                                $row = $row->getCellIterator();
                                                $row->setIterateOnlyExistingCells(true);
                                                echo '<tr>';
                                                // Read cells
                                                $cellCount = 0;
                                                if( $rowLocation > 1){
                                                    echo '<th>'.($rowLocation - 1).'</th>';
                                                }
                                                foreach ($row as $cell){

                                                    $cell = $cell->getValue();
                                                   
                                                    if( $rowLocation > 1){
                                                        $field = $fieldnames[$cellCount];
                                                        if($field == "url"){
                                                            echo '<td><a target="_blank" href="'.$cell.'">'.$cell.'</a></td>';
                                                        }
                                                        if($field == "title"){
                                                        $id = createRehabFunction($cell);
                                                            if( $id ){
                                                                wp_set_object_terms($id,['Free Membership'], 'coltman_type_membership');
                                                               
                                                               echo '<td style="min-width:350px;display:block;"><a href="'.get_edit_post_link($id).'">'.$cell.'</a></td>';
                                                            }else{
                                                                echo '<td class="table-danger" colspan="30" scope="col">This rehab already exist</td>';
                                                            }
                                                        }

                                                        if( $id && $field == "rehab_price_range"){
                                                            $rehab_price_range = false;
                                                            if($cell != NOTFOUND){
                                                                $rehab_price_range = $rehabMeta->setSimpleRehabMeta($field,$cell, $id);
                                                            }
                                                            echo rehabLoadStatus($rehab_price_range);
                                                        }
                                                        if( $id && $field == "rehab_address"){
                                                            $rehab_adress = $rehabMeta->setSimpleRehabMeta($field,$cell, $id);
                                                            echo rehabLoadStatus($rehab_adress);
                                                        }
                                                        if( $id && $field == "rehab_website"){
                                                            $url = $cell;
                                                            if($cell != NOTFOUND){
                                                                $url = explode("?", $url)[0];
                                                            }
                                                            $website = $rehabMeta->setSimpleRehabMeta($field,$url, $id);
                                                            echo rehabLoadStatus($website);
                                                        }
                                                        /**
                                                         * rehab rating
                                                         */
                                                        if( $id && $field == "rehab_rating"){
                                                           $rating = $cell;
                                                           if($cell != NOTFOUND){
                                                                $rating = explode(" ", $cell)[0];
                                                           }
                                                           // replace csv data for google review rating
                                                           // find place_id from google map
                                                           $place_id = coltman_get_google_place_id(get_the_title($id));
                                                          
                                                           if($place_id != 'Not found'){
                                                            // get google rating, total users, reviews
                                                         
                                                            $reviews = coltman_get_google_reviews_widget($place_id);
                                                            
                                                            $google_rating = $reviews['rating'];
                                                            $user_ratings_total = $reviews['user_ratings_total'];
                                                            // reviews sanitices
                                                            $reviews_array = coltman_get_save_reviews($reviews['reviews']);

                                                            //save new rating
                                                            $rehab_rating = update_post_meta($id, 'rehab_rating', $google_rating);

                                                            // save google place id
                                                            $google_place_id= update_post_meta($id, 'google_place_id', $place_id);

                                                            // save total users
                                                            $user_ratings_total = update_post_meta($id, 'user_ratings_total', $user_ratings_total);

                                                            // save reviews
                                                            $save_reviews = update_post_meta($id, 'coltman_google_reviews', $reviews_array);
                                                            
                                                            if($save_reviews && $rehab_rating && $user_ratings_total && $google_place_id){
                                                                echo '<td style="min-width:350px;display:block;">'.get_the_title($id).'<br>'. $google_rating.'<br>'.$place_id .'</td>';
                                                            }else{
                                                                echo rehabLoadStatus(false);
                                                                
                                                            }

                                                           }else{
                                                               $rehab_rating = $rehabMeta->setSimpleRehabMeta($field,$rating, $id);
                                                               echo rehabLoadStatus($rehab_rating);
                                                            }


                                                        }
                                                        if( $id && $field == "rehab_banner"){
                                                            $rehab_banner =  $rehabMeta->addRehabBanner($id,$cell);
                                                            echo rehabLoadStatus($rehab_banner);
                                                        }
                                                        if( $id && $field == "rehab_image_gallery"){
                                                            $isGallery = false;
                                                            if($cell != NOTFOUND){
                                                                $isGallery = $rehabMeta->addRehabGallery($id,$cell, $field);
                                                            }
                                                            echo rehabLoadStatus($isGallery);
                                                        }
                                                        if($id && $field == "rehab_phone"){
                                                            $rehab_phone = $rehabMeta->setSimpleRehabMeta($field,$cell, $id);
                                                            echo rehabLoadStatus($rehab_phone);
                                                        }
                                                        if( $id && $field == "rehab_description"){
                                                            $decode = json_decode($cell);
                                                            $cleanName = str_replace('["', "", $decode);
                                                            $cleanName = str_replace('"]', "", $cleanName);

                                                            if($cleanName[0] != NOTFOUND && $cleanName[0] != ''){
                                                               
                                                                $openDescription = $rehabMeta->setSimpleRehabMeta($field,$cleanName[0], $id);
                                                                echo rehabLoadStatus($openDescription);
                                                            }else{
                                                                echo rehabLoadStatus(false);
                                                            }
                                                            
                                                        }
                                                        if( $id && $field == "rehab_insurance"){
                                                            $rehab_insurance = false;
                                                            if($cell =="Accepted"){

                                                                $rehab_insurance = $rehabMeta->setSimpleRehabMeta($field,"on", $id);
                                                            }
                                                            echo rehabLoadStatus($rehab_insurance);
                                                        }
                                                        if( $id && $field == "rehab_state"){
                                                            $rehabMeta->setSimpleRehabMeta($field,$cell, $id);
                                                            $getStateTag = $rehabsTags->getTagsRehabByName([$cell], 'coltman_locations')[0];
                                                            if(!$getStateTag){
                                                                $addStateTag = $rehabsTags->addRehabTags([$cell], 'coltman_locations')[0];
                                                                if($addStateTag){
                                                                    echo '<b>New County added: '.$cell.'</b>';
                                                                }
                                                            }
                                                            $is_tag = true;
                                                            $tag = wp_set_post_terms($id, [$getStateTag], 'coltman_locations');
                                                            if(!$tag || is_wp_error($tag)){
                                                                $is_tag = false;
                                                            }
                                                            echo rehabLoadStatus($is_tag);
                                                        }
                                                        if( $id && $field == "rehab_city"){
                                                            $rehab_city = $rehabMeta->setSimpleRehabMeta($field,$cell, $id);
                                                            echo rehabLoadStatus($rehab_city);
                                                        }
                                                        if( $id && $field == "rehab_language"){
                                                            $tagName = "coltman_languages";
                                                            $names = explode(", ", $cell);
                                                            $termList = [];
                                                            foreach($names as $name){
                                                                if( term_exists($name, $tagName) ){
                                                                    $termList[] = $name;
                                                                }
                                                            }
                                                            $lang = term_exists($termList[0], $tagName);

                                                            $rehabMeta->setSimpleRehabMeta($field,$lang['term_id'], $id);
                                                            $language_tag = wp_set_object_terms($id,$termList,$tagName,true);
                                                            echo rehabLoadStatus($language_tag);
                                                        }
                                                      
                                                        if( $id && $field == "rehab_google_maps"){
                                                            $googleMap = coltmanRehabMap($cell);
                                                            $googleMap = $rehabMeta->setSimpleRehabMeta($field,$googleMap, $id);
                                                            echo rehabLoadStatus($googleMap);
                                                        }
                                                        if( $id && $field == "rehab_faq"){
                                                           $rehab_faq = $rehabMeta->rehaAddmetaAcordeon($id,$cell, "rehab_faq");
                                                           echo rehabLoadStatus($rehab_faq);
                                                        }
                                                        if( $id && $field == "rehab_highlight_blocks"){
                                                            if($cell != NOTFOUND){
                                                                $rehab_highlight_blocks = $rehabMeta->rehaAddmetaAcordeon($id,$cell, "rehab_highlight_blocks");
                                                                echo rehabLoadStatus($rehab_highlight_blocks);

                                                            }else{
                                                                echo rehabLoadStatus(false);
                                                            }
                                                        }
                                                        if( $id && $field == "rehab_staff"){
                                                            if($cell !="" || count(json_decode($cell))> 0 ){
                                                                $rehabMeta->setSimpleRehabMeta($field,'on', $id);
                                                                $rehabMeta->rehaAddmetaAcordeon($id,$cell, "rehab_staff_members");
                                                                echo rehabLoadStatus(true);
                                                            }else{
                                                                $rehabMeta->setSimpleRehabMeta($field,'', $id);
                                                                $rehabMeta->setSimpleRehabMeta($field,'[]', $id);
                                                                echo rehabLoadStatus(false);
                                                            }
                                                        }
                                                        if( $id && $field == "coltman_clients"){
                                                            $tagName = "coltman_clients";
                                                            $names = explode(", ", $cell);
                                                            $termList = [];
                                                            foreach($names as $name){
                                                                if( term_exists($name, $tagName) ){
                                                                    $termList[] = $name;
                                                                }
                                                            }
                                                            $client_tag = wp_set_object_terms($id,$termList,$tagName,true);
                                                            echo rehabLoadStatus($client_tag);
                                                        }
                                                        if( $id && $field == "coltman_highlights"){
                                                            $tagName = 'coltman_highlights';
                                                            $namesList = explode(", ", $cell);
                                                            $names = [];
                                                            foreach($namesList as $name){
                                                                $cleanName = str_replace("[", "", $name);
                                                                $cleanName = str_replace("]", "", $cleanName);
                                                                $cleanName = str_replace("'", "", $cleanName);
                                                                if( term_exists($cleanName, $tagName) ) {
                                                                    $names[] = $cleanName;
                                                                }
                                                            }
                                                            $highlight_tag = wp_set_object_terms($id,$names,$tagName,true);
                                                            echo rehabLoadStatus($highlight_tag);
                                                        }

                                                        if( $id && $field == "coltman_insurance_method"){
                                                            $tagName = "coltman_insurance_method";
                                                            $namesList = explode(", ", $cell);
                                                            $names = [];
                                                            foreach($namesList as $name){
                                                                $cleanName = str_replace("[", "", $name);
                                                                $cleanName = str_replace("]", "", $cleanName);
                                                                $cleanName = str_replace("'", "", $cleanName);
                                                                if (term_exists($cleanName, $tagName)) {
                                                                    $names[] = $cleanName;
                                                                }
                                                            }
                                                            $highlight_tag = wp_set_object_terms($id,$names,$tagName,true);
                                                            echo rehabLoadStatus($highlight_tag);
                                                        }
                                                       
                                                        if( $id && $field == "coltman_amenities"){
                                                            $tagName = "coltman_amenities";
                                                            $namesList = explode(", ", $cell);
                                                            $names = [];

                                                            foreach($namesList as $name){
                                                                $cleanName = str_replace("[", "", $name);
                                                                $cleanName = str_replace("]", "", $cleanName);
                                                                $cleanName = str_replace("'", "", $cleanName);
                                                                if(term_exists($cleanName, $tagName)){
                                                                    $names[] = $cleanName;
                                                                }

                                                            }
                                                            $haveAmenities = wp_set_object_terms($id,$names,$tagName,true);
                                                            echo rehabLoadStatus($haveAmenities);
                                                        }
                                                        if( $id && $field == "coltman_level_care"){
                                                            $tagName = "coltman_level_care";
                                                            $namesList = explode(", ", $cell);
                                                            $names = [];

                                                            foreach($namesList as $name){
                                                                $cleanName = str_replace("[", "", $name);
                                                                $cleanName = str_replace("]", "", $cleanName);
                                                                $cleanName = str_replace("'", "", $cleanName);
                                                                if(preg_match("/Detox/", $cleanName)){
                                                                    $names[] = "Detox";
                                                                }
                                                                if(preg_match("/Outpatient/", $cleanName)){
                                                                    $names[] = "Outpatient Program";
                                                                }
                                                                if(preg_match("/Intensive Outpatient Program/", $cleanName)){
                                                                    $names[] = "IOP";
                                                                }
                                                                if(preg_match("/Residential/", $cleanName) || preg_match("/Inpatient Treatment/", $cleanName)){
                                                                    $names[] = "Inpatient Treatment";
                                                                }
                                                            }
                                                            $is_level_care = wp_set_object_terms($id,$names,$tagName,true);
                                                            echo rehabLoadStatus($is_level_care);
                                                        }


                                                        if( $id && $field == "coltman_treatments"){
                                                            $tagName = "coltman_treatments";
                                                            $cleanName = str_replace("[", "", $cell);
                                                            $cleanName = str_replace("]", "", $cleanName);
                                                            $cleanName = str_replace("'", "", $cleanName);

                                                            $therapies  = explode(', ', $cleanName);
                                                            $cleanTherapies = [];
                                                            foreach($therapies as $therapy){
                                                                if( term_exists( $therapy, $tagName )){
                                                                    $cleanTherapies[] = $therapy;
                                                                }
                                                            }
                                                            $save_tretaments = wp_set_object_terms( $id, $cleanTherapies, $tagName, true );
                                                            echo rehabLoadStatus($save_tretaments);
                                                        }
                                                        if( $id && $field == "coltman_conditions"){
                                                            $tagName = "coltman_conditions";
                                                            $namesList = explode(", ", $cell);
                                                            $names = [];

                                                            $behavioralHealth = [
                                                                "Anger",
                                                                "Chronic Relapse",
                                                                "Gambling",
                                                                "Gaming",
                                                                "Internet Addiction",
                                                                "Narcissism",
                                                                "Pornography",
                                                                "Sex Addiction",
                                                                "Sex Addiction",
                                                                "Shopping",
                                                                "Weight Loss",
                                                            ];

                                                            $eatingDisorders =[
                                                                "Anorexia",
                                                                "Binge Eating",
                                                                "Bulimia",
                                                                "Eating Disorders",
                                                            ];
                                                            $mentalHealth =[
                                                                "ADHD",
                                                                "Anxiety",
                                                                "Bipolar",
                                                                "Burnout",
                                                                "Codependency",
                                                                "Depression",
                                                                "Grief and Loss",
                                                                "OCD",
                                                                "Personality Disorders",
                                                                "PTSD",
                                                                "Schizophrenia",
                                                                "Self-Harm",
                                                                "Stress",
                                                                "Suicidality",
                                                                "Trauma",
                                                            ];

                                                            $substances = [
                                                                "Adderall",
                                                                "Alcohol",
                                                                "Benzodiazepines",
                                                                "Cocaine",
                                                                "Drug Addiction",
                                                                "Ecstasy",
                                                                "Fentanyl",
                                                                "Heroin",
                                                                "LSD",
                                                                "Marijuana",
                                                                "MDMA",
                                                                "Methamphetamine",
                                                                "Prescription Drugs",
                                                                "Psychedelics",
                                                                "Substance Abuse",
                                                                "Xanax"
                                                            ];

                                                            foreach($namesList as $name){
                                                                $cleanName = str_replace("[", "", $name);
                                                                $cleanName = str_replace("]", "", $cleanName);
                                                                $cleanName = str_replace("'", "", $cleanName);
                                                                if(in_array($cleanName, $behavioralHealth)){
                                                                    $names[] = $cleanName;
                                                                }
                                                                if(in_array($cleanName, $eatingDisorders)){
                                                                    $names[] = $cleanName;
                                                                }
                                                                if(in_array($cleanName, $mentalHealth)){
                                                                    $names[] = $cleanName;
                                                                }
                                                                if(in_array($cleanName, $substances)){
                                                                    $names[] = $cleanName;
                                                                }
                                                               
                                                            }
                                                           

                                                            $is_tag = true;
                                                            $names=array_unique($names);
                                                            $tag = wp_set_object_terms($id, $names, $tagName);
                                                            if(!$tag || is_wp_error($tag)){
                                                                $is_tag = false;
                                                            }
                                                            //var_dump($tag);
                                                            echo rehabLoadStatus($is_tag);
                                                        }

                                                        // Add video url
                                                        if( $id && $field == "rehab_video_url"){
                                                            
                                                            
                                                            
                                                            
                                                            if ( $cell != "Not found" ) {
                                                                $getVideoId = coltmanRehabGetVideoId($cell);
                                                                # code...

                                                               // var_dump($cell);
                                                                $rehabMeta->setSimpleRehabMeta($field,$getVideoId, $id);
                                                                $rehabMeta->setSimpleRehabMeta('rehab_video_preload', $cell, $id);
                                                                $haveVideo = true;
                                                                echo rehabLoadStatus( $rehabMeta);
                                                            }
                                                        }

                                                    }
                                                   
                                                    $cellCount++;
                                                }
                                                $rowLocation++;
                                                echo '</tr>';
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php
                        }
                        die();
                    }
                    
                    
                    
                    
                    ?>
                </div>
            </div>
        </section>
        <?php
        return ob_get_clean();
    }
}