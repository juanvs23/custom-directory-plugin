<?php
$google_review = get_query_var('google_review');
$title = $google_review['title'];
$address = $google_review['address'];
$place_id = $google_review['post_id'];
//$place_id = coltman_get_google_place_id($title, ADDIC_CLINIC_GOOGLE_API_KEY );
if($place_id != 'Not found' && $place_id != ''):

    
$reviews = get_post_meta($place_id, 'coltman_google_reviews', true);
$user_ratings_total = get_post_meta($place_id, 'user_ratings_total', true);
$rating = get_post_meta($place_id, 'rehab_rating', true);


function coltman_testimonialItem($review){
    $html = '';
    /**
     * 
     * {"author_name":"Joel J","author_url":"https://www.google.com/maps/contrib/108449804481499556564/reviews","language":"en","original_language":"en","profile_photo_url":"https://lh3.googleusercontent.com/a/ACg8ocLjLUVHx4M68QgbTKXYpflwYRNUeESF7hC8KSFrpJiLlbMgHN4=s128-c0x00000000-cc-rp-mo","rating":5,"relative_time_description":"a month ago","text":"I was very lucky to have found Luxe Recovery. I was initially apprehensive about coming to treatment, but the amazing staff quickly made me feel at home. While I realize that it is a business, it felt more like family. Luxe truly cares about its clients.nnThe house was great, and everything was kept very clean. The chef was excellent. Overall, I believe that it was the perfect environment to recover and set me on the right path to long-term sobriety. If you are considering treatment, I encourage you to take the leap. I am certainly glad that I did and am very grateful to Luxe for all of their help.","time":1739586322,"translated":false},{"author_name":"Liz Pazos","author_url":"https://www.google.com/maps/contrib/111544816239683513324/reviews","language":"en","original_language":"en","profile_photo_url":"https://lh3.googleusercontent.com/a-/ALV-UjX35jsz3naL6dAOPIZMMrc56FUGjA641tyfFSDS5oAly5D6ANtS=s128-c0x00000000-cc-rp-mo","rating":5,"relative_time_description":"a month ago","text":"I cannot recommend this place enough!! Whether itu2019s a professional team operating with intense expertise & profound compassion that is ready to tackle each individuals unique needs, or the backdrop of luxury and supreme comfort that you are seeking to cradle you thru the recovery process, Luxe checks all the boxes! Iu2019m not sure if everyone in recovery can look back on their initial detox as an overall pleasant experience but I certainly do! The food alone would be enough to make me do it all over again. I kinda wish I could live there forever but thanks to the healing, new paradigm and perspective I gained from my time there, I know I wonu2019t ever be back. Thank you so much Luxe!","time":1738880317,"translated":false}
     */
   // echo $review['text'];
    $text = str_replace('u2019','’',$review['text']);
    $author_name = $review['author_name'];
    $profile_photo_url = $review['profile_photo_url'];
    
    $html .= '<div class="google-testimonial-item swiper-slide">';
    $html .= '<p class="google-testimonial-item-text">';
    $html .= $text;
    $html .= '</p>';

    $html .= '<div class="google-testimonial-item-author">';
    $html .= '<div class="google-testimonial-item-author-image">';
    $html .= '<img loading="lazy" async src="'.$profile_photo_url.'" alt="'.$author_name.'">';
    $html .= '</div>';
    $html .= '<h3 class="google-testimonial-item-author-name">';
    $html .= $author_name;
    $html .= '</h3>';
    $html .= '</div>';
    $html .= '</div>';

    return $html;
}

//var_dump(json_decode(json_encode($reviews)));
if(isset($reviews) && $reviews !='' && is_iterable($reviews) && count($reviews) > 0):
?>
<section id="google-review-section" class="section-container">
<div class="clinic-container">
<div class="google-testimonial">
    <div class="google-testimonial-haeder">
        <div class="google-testimonial-logo">
            <div class="google-iso">
            <svg xmlns="http://www.w3.org/2000/svg" width="120" height="39" viewBox="0 0 120 39" fill="none">
  <g clip-path="url(#clip0_201_1185)">
    <path d="M116.155 23.8348L119.481 26.033C118.401 27.6093 115.819 30.3137 111.356 30.3137C105.813 30.3137 101.685 26.062 101.685 20.6533C101.685 14.8978 105.856 10.9932 110.889 10.9932C115.95 10.9932 118.43 14.9844 119.233 17.1391L119.67 18.2383L106.63 23.589C107.621 25.5269 109.168 26.5103 111.356 26.5103C113.544 26.5103 115.061 25.4401 116.155 23.8348ZM105.929 20.3499L114.638 16.7633C114.156 15.5631 112.727 14.71 111.02 14.71C108.847 14.71 105.827 16.6189 105.929 20.3499Z" fill="#FF302F"/>
    <path d="M95.3975 1.14453H99.5982V29.4311H95.3975V1.14453Z" fill="#20B15A"/>
    <path d="M88.7755 11.7448H92.8307V28.925C92.8307 36.0544 88.5859 38.99 83.5679 38.99C78.8419 38.99 75.9975 35.8375 74.9326 33.2779L78.6522 31.7449C79.3231 33.3211 80.9423 35.1868 83.5679 35.1868C86.7915 35.1868 88.7755 33.2055 88.7755 29.5035V28.1153H88.6297C87.6668 29.2721 85.8289 30.3132 83.4951 30.3132C78.6229 30.3132 74.1592 26.1049 74.1592 20.6821C74.1592 15.23 78.6229 10.9785 83.4951 10.9785C85.8144 10.9785 87.6668 12.0053 88.6297 13.1333H88.7755V11.7448ZM89.0671 20.6821C89.0671 17.2691 86.777 14.7817 83.8596 14.7817C80.913 14.7817 78.4333 17.2691 78.4333 20.6821C78.4333 24.0514 80.913 26.4954 83.8596 26.4954C86.7772 26.51 89.0673 24.0514 89.0673 20.6821" fill="#3686F7"/>
    <path d="M51.0974 20.6101C51.0974 26.1778 46.7215 30.2703 41.3534 30.2703C35.9856 30.2703 31.6094 26.1634 31.6094 20.6101C31.6094 15.0136 35.9856 10.9355 41.3534 10.9355C46.7215 10.9355 51.0974 15.0136 51.0974 20.6101ZM46.8381 20.6101C46.8381 17.1396 44.2998 14.7531 41.3534 14.7531C38.407 14.7531 35.8687 17.1396 35.8687 20.6101C35.8687 24.0519 38.407 26.4671 41.3534 26.4671C44.3 26.4671 46.8381 24.0519 46.8381 20.6101Z" fill="#FF302F"/>
    <path d="M72.3796 20.6533C72.3796 26.221 68.0035 30.3135 62.6356 30.3135C57.2675 30.3135 52.8916 26.2208 52.8916 20.6533C52.8916 15.0568 57.2675 10.9932 62.6356 10.9932C68.0035 10.9932 72.3796 15.0424 72.3796 20.6533ZM68.1055 20.6533C68.1055 17.1828 65.5675 14.7964 62.6209 14.7964C59.6742 14.7964 57.1362 17.1828 57.1362 20.6533C57.1362 24.0951 59.6745 26.5103 62.6209 26.5103C65.582 26.5103 68.1055 24.0807 68.1055 20.6533Z" fill="#FFBA40"/>
    <path d="M15.5922 26.0758C9.4802 26.0758 4.69589 21.1878 4.69589 15.1284C4.69589 9.06927 9.4802 4.18127 15.5922 4.18127C18.8889 4.18127 21.2956 5.46827 23.0752 7.11695L26.0073 4.21029C23.5276 1.85311 20.2163 0.0595703 15.5922 0.0595703C7.21941 0.0598025 0.173828 6.82793 0.173828 15.1284C0.173828 23.4289 7.21941 30.1973 15.5922 30.1973C20.1143 30.1973 23.5276 28.7223 26.197 25.9746C28.9392 23.2558 29.7852 19.4379 29.7852 16.3432C29.7852 15.3743 29.6686 14.3765 29.5372 13.639H15.5922V17.6593H25.5259C25.2341 20.1757 24.4319 21.8966 23.2503 23.0677C21.8208 24.4996 19.56 26.0758 15.5922 26.0758Z" fill="#3686F7"/>
  </g>
  <defs>
    <clipPath id="clip0_201_1185">
      <rect width="119.889" height="39" fill="white"/>
    </clipPath>
  </defs>
</svg>
            </div>
            <h3 class="reviews-title">
                Reviews
            </h3>
        </div>
        <div class="google-testonial-rating">
            <div class="google-star">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
  <path d="M5.825 21.5L7.45 14.475L2 9.75L9.2 9.125L12 2.5L14.8 9.125L22 9.75L16.55 14.475L18.175 21.5L12 17.775L5.825 21.5Z" fill="#ECC54E"/>
</svg>
            </div>
            <div class="google-rating-text">
                <?php echo $rating; ?>
            </div>
            <div class="google-rating-count">
                <?php echo '('.$user_ratings_total.')'; ?>
            </div>
        </div>
    </div>
    <div class="google-testimonial-content">
        <div class="google-testimonial-title">
            <h2>Testimonials</h2>
        </div>
        <div class="google-testimonial-wrapper">
            <div class="google-testimonals">
                <div class="testimonial-pre-testimonial">
                    <svg width="60" height="41" viewBox="0 0 60 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_201_1202)">
                    <path d="M60 0V25.5673H45.6077L55.2524 41H42.7591L34 25.5673V0H60Z" fill="#52776C"/>
                    </g>
                    <g clip-path="url(#clip1_201_1202)">
                    <path d="M26 0V25.5673H11.6077L21.2524 41H8.75913L0 25.5673V0H26Z" fill="#52776C"/>
                    </g>
                    <defs>
                    <clipPath id="clip0_201_1202">
                    <rect width="26" height="41" fill="white" transform="matrix(-1 0 0 1 60 0)"/>
                    </clipPath>
                    <clipPath id="clip1_201_1202">
                    <rect width="26" height="41" fill="white" transform="matrix(-1 0 0 1 26 0)"/>
                    </clipPath>
                    </defs>
                    </svg>
                </div>
                <div class="swiper-wrapper">
                    
                    <?php foreach ($reviews as $review) { 
                        
                        
                        echo coltman_testimonialItem($review);
                        
                        } ?>
                </div>
                <div class="google-post-testimonial">
                                <svg width="60" height="41" viewBox="0 0 60 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_201_1228)">
                    <path d="M0 0V25.5673H14.3923L4.74764 41H17.2409L26 25.5673V0H0Z" fill="#52776C"/>
                    </g>
                    <g clip-path="url(#clip1_201_1228)">
                    <path d="M34 0V25.5673H48.3923L38.7476 41H51.2409L60 25.5673V0H34Z" fill="#52776C"/>
                    </g>
                    <defs>
                    <clipPath id="clip0_201_1228">
                    <rect width="26" height="41" fill="white"/>
                    </clipPath>
                    <clipPath id="clip1_201_1228">
                    <rect width="26" height="41" fill="white" transform="translate(34)"/>
                    </clipPath>
                    </defs>
                    </svg>
    
                </div>
                <div class="google-testimonals-pagination"></div>
            </div>
        </div>
    </div>
</div>
</div>
</section>
<?php endif; ?>
<?php endif; ?>