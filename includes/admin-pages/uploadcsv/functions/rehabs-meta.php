<?php

use function ElementorDeps\DI\get;

class RehabMetaContent{
    public $postMeta = false;

    
    
    /**
     * Set simple post meta for rehab
     *
     * @param string $key The meta key
     * @param mixed $meta The meta value
     * @param int $id The post ID
     *
     * @return bool|array The result of update_post_meta
     */
    public function setSimpleRehabMeta($key,$meta, $id){
        if ($id && $meta != NOTFOUND) {
            $this->postMeta =  update_post_meta($id, $key, $meta);
        }
        return $this->postMeta;
    }

    
    /**
     * Upload image to wordpress media
     *
     * @param int $id The post ID
     * @param string $image The image URL
     *
     * @return array|false The result of uploaimageToWordpressMedia
     */
    public function uploaimageToWordpressMedia($id,$image){
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
        require_once( ABSPATH . 'wp-admin/includes/image.php' );

        
        $temp_file = download_url( $image );
        
        if( is_wp_error( $temp_file ) ) {
            return false;
        }

        $image_name = get_post($id)->post_name.'-'.uniqid('', true).'-'.'.webp';
        $image_title = get_post($id)->post_name.'-'.uniqid('', true);
      


        # if image is not "image/webp" transform it to "image/webp" and return to the temp file
      
            $image = imagecreatefromstring(file_get_contents($temp_file));
          
            imagewebp($image, $temp_file, 80);
   

        // move the temp file into the uploads directory
	    $file = array(
            'name'     => $image_name ,
            'type'     => mime_content_type( $temp_file ),
            'tmp_name' => $temp_file,
            'size'     => filesize( $temp_file ),
	    );

        $sideload = wp_handle_sideload(
            $file,
            array(
                'test_form'   => false // no needs to check 'action' parameter
            )
        );

        if( ! empty( $sideload[ 'error' ] ) ) {
            // you may return error message if you want
            return false;
        }

        $attachment_id = wp_insert_attachment(
            array(
                'guid'           => $sideload[ 'url' ],
                'post_mime_type' => $sideload[ 'type' ],
                'post_title'     =>  $image_title,
                'post_content'   => '',
                'post_status'    => 'inherit',
            ),
            $sideload[ 'file' ]
        );
    
        if( is_wp_error( $attachment_id ) || ! $attachment_id ) {
            return false;
        }
    
        // update medatata, regenerate image sizes
    
        wp_update_attachment_metadata(
            $attachment_id,
            wp_generate_attachment_metadata( $attachment_id, $sideload[ 'file' ] )
        );

        $get_url = wp_get_attachment_image_url($attachment_id,'full');
        $get_metadata = wp_get_attachment_metadata($attachment_id);

        $image_ogject = [
            'url'=>$get_url,
            'id'=>$attachment_id,
            'alt'=>$get_metadata['image_meta']['_wp_attachment_image_alt'],
            'title'=>$get_metadata['image_meta']['title'],
            'mime' => $get_metadata['image_meta']['mime_type'],
            'sizes' => $get_metadata['sizes'],
            'width' => $get_metadata['width'],
            'height' => $get_metadata['height'],
            'item' => $get_metadata['image_meta']['aperture']

        ];
        return ['id'=>$attachment_id,'image'=>  (object) $image_ogject];
    }


    /**
     * Add rehab banner (fearured image)
     *
     * @param int $id The post ID
     * @param string $banner The banner URL
     *
     * @return bool|array The result of set_post_thumbnail
     */
    public function addRehabBanner($id,$banner){


        if(!$banner || $banner == NOTFOUND){
            return false;
        }
        $banner = $this->uploaimageToWordpressMedia($id,$banner);
        if($banner){
           # add featered image
          return set_post_thumbnail( $id, $banner['id'] );
        }
    }

    /**
     * Add rehab gallery
     *
     * @param int $id The post ID
     * @param string $gallery The gallery URL
     *
     * @return bool|array The result of update_post_meta
     */
    public function addRehabGallery($id,$gallery, $title){
       // var_dump(json_decode($gallery));
        if(!is_iterable(json_decode($gallery))){
            return false;
        }
            if(count(json_decode($gallery)) < 1){
                return false;
            }
            $galleryData = [];
            $count = 0;
            foreach(json_decode($gallery) as $image){
                if($count>6) {
                    break;
                }
                $gallery_item = $this->uploaimageToWordpressMedia($id,$image);
                if($gallery_item){
                    $galleryData[] = $gallery_item['image'] ;
                }
                $count++;
            }
          
            return $this->setSimpleRehabMeta( $title, json_encode($galleryData), $id);
        
    }

    public function rehaAddmetaAcordeon($postId, $acordeon, $title){
       // var_dump(json_decode($acordeon));
        if(!is_iterable(json_decode($acordeon))){
            return false;
        };
       
        $metaAccordeon = [];
        $acordeon = json_decode($acordeon);

        foreach($acordeon as $item){
            $obj=[];
            $item_id = $title ."_". mt_rand(1000, 10000) . '_parent';
            $item_content = $item->content;
            $item_title = $item->title;
            $item_image = $item->image;

            $obj['id'] = $item_id;
            if($item_title){
                $obj['title'] = $item_title;
            }
            
            
            if($item_content){
                $obj['content'] = $item_content;
            }
            
            if($item_image){
                $image_obj =$this->uploaimageToWordpressMedia($postId,$item_image)['image'];
                
              //  var_dump($image_obj->url);
                $obj['image'] = $image_obj->url;
            }
        
            if($obj){
                array_push($metaAccordeon,$obj);
            }

        }
        
        return $this->setSimpleRehabMeta($title, json_encode($metaAccordeon), $postId);
    }


}