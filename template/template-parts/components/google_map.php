<?php
$rehab_google_maps = get_query_var('rehab_google_maps');
$map = $rehab_google_maps['map'];
$address = $rehab_google_maps['address'];
$title = $rehab_google_maps['title'];
$phone = $rehab_google_maps['phone_number'];
$phone_number = trim(preg_replace('/[^0-9]/', '', $phone));
?>
<div class="google-map-container">
    <div class="google-left">
        <div class="google-map">
            <?php if($map != '' && $map != 'Not found' ): ?>
            <iframe preload="auto" loading="lazy" src="<?php echo $map; ?>" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <?php endif; ?>
        </div>
    </div>
    <div class="google-right">
        <div class="google-info">
            <?php if(isset($title) && $title != '' && $title != 'Not found'):?>
            <h2 class="google-title">
                <?php echo $title; ?>
            </h2>
            <?php endif; ?>
            <?php if(isset($address) && $address != '' && $address != 'Not found'):?>
            <p class="google-address">
                <?php echo $address; ?>
            </p>
            <?php endif; ?>

            <div class="google-phone">
                <?php if(isset($phone_number) && $phone_number != '' && $phone_number != 'Not found'):?>
                <a href="tel:+1<?php echo $phone_number; ?>" target="_blank" class="clinic-button button-green">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M21.5687 18.3411L18.496 15.262C17.6335 14.3977 16.2351 14.3977 15.3725 15.262L14.8918 15.7438C14.5049 16.1305 14.2361 16.6198 14.1168 17.1542C13.0753 17.1737 11.8975 16.9962 10.8901 16.3413C10.2713 15.8804 9.68695 15.3747 9.14176 14.8284C8.68121 14.3672 8.24936 13.878 7.84867 13.3637C7.06354 12.3066 6.85634 11.0239 6.8773 9.89959C7.4106 9.78011 7.89885 9.51072 8.28479 9.12303L8.76552 8.6413C9.62804 7.77698 9.62804 6.37564 8.76552 5.51128L5.69282 2.43217C5.11779 1.85594 4.18549 1.85594 3.61051 2.43217L3.08297 2.96093C2.40669 3.63861 2.0605 4.52126 2.0425 5.40937C1.86933 7.28316 2.22745 9.3459 3.0782 11.3746C3.63992 12.7141 4.41113 14.022 5.35039 15.2377C5.36224 15.2536 5.37349 15.2697 5.3855 15.2855L5.38688 15.2845C5.86643 15.901 6.38345 16.4872 6.93502 17.0399C7.50504 17.6116 8.11071 18.1464 8.74837 18.6412L8.74222 18.6493C8.84845 18.7301 8.95681 18.8079 9.06717 18.8829C11.7476 20.8696 14.7771 21.9857 17.5964 21.9856C17.7611 21.9855 17.9252 21.9808 18.0885 21.9732C19.1386 22.1025 20.2351 21.7643 21.0412 20.9566L21.5688 20.4278C22.1438 19.8516 22.1438 18.9174 21.5687 18.3411Z"/>
                    </svg>
                    <?php echo $phone; ?>
                </a>
                <?php endif; ?>
                
            </div>
        </div>
    </div>
</div>