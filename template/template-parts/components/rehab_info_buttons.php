<?php 
$rehab_info_buttons = get_query_var('rehab_info_buttons');
$rehab_phone = $rehab_info_buttons['phone'];
$rehab_email = $rehab_info_buttons['email'];
$rehab_website = $rehab_info_buttons['website'];

//get phone and remove spaces and special characters
$phone_number = trim(preg_replace('/[^0-9]/', '', $rehab_phone));
if( isset($rehab_phone) && $rehab_phone !='' && $rehab_phone != 'Not found' || 
    isset($rehab_website) && $rehab_website !='' && $rehab_website != 'Not found' || 
    isset($rehab_email) && $rehab_email !='' && $rehab_email != 'Not found'):
?>

<h3>Connect by reaching out to the admissions team directly:</h3>
<div class="reha-info-buttons">
<?php if(isset($rehab_phone) && $rehab_phone !='' && $rehab_phone != 'Not found'):
   

    
    ?>
    <a href="tel:+1<?php echo $phone_number; ?>" target="_blank" class="clinic-button button-green">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M21.5687 18.3411L18.496 15.262C17.6335 14.3977 16.2351 14.3977 15.3725 15.262L14.8918 15.7438C14.5049 16.1305 14.2361 16.6198 14.1168 17.1542C13.0753 17.1737 11.8975 16.9962 10.8901 16.3413C10.2713 15.8804 9.68695 15.3747 9.14176 14.8284C8.68121 14.3672 8.24936 13.878 7.84867 13.3637C7.06354 12.3066 6.85634 11.0239 6.8773 9.89959C7.4106 9.78011 7.89885 9.51072 8.28479 9.12303L8.76552 8.6413C9.62804 7.77698 9.62804 6.37564 8.76552 5.51128L5.69282 2.43217C5.11779 1.85594 4.18549 1.85594 3.61051 2.43217L3.08297 2.96093C2.40669 3.63861 2.0605 4.52126 2.0425 5.40937C1.86933 7.28316 2.22745 9.3459 3.0782 11.3746C3.63992 12.7141 4.41113 14.022 5.35039 15.2377C5.36224 15.2536 5.37349 15.2697 5.3855 15.2855L5.38688 15.2845C5.86643 15.901 6.38345 16.4872 6.93502 17.0399C7.50504 17.6116 8.11071 18.1464 8.74837 18.6412L8.74222 18.6493C8.84845 18.7301 8.95681 18.8079 9.06717 18.8829C11.7476 20.8696 14.7771 21.9857 17.5964 21.9856C17.7611 21.9855 17.9252 21.9808 18.0885 21.9732C19.1386 22.1025 20.2351 21.7643 21.0412 20.9566L21.5688 20.4278C22.1438 19.8516 22.1438 18.9174 21.5687 18.3411Z"/>
        </svg>
       <?php echo $rehab_phone; ?>
    </a>

<?php endif; ?>
<?php if(isset($rehab_email) && $rehab_email !=''):?>
    <a href="mailto:<?php echo $rehab_email; ?>" target="_blank" class="clinic-button clinic-reverse">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
  <path d="M20 4H4C2.9 4 2.01 4.9 2.01 6L2 18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6C22 4.9 21.1 4 20 4ZM20 8L12 13L4 8V6L12 11L20 6V8Z"/>
</svg>
       Email
    </a>
<?php endif; ?>
<?php if(isset($rehab_website) && $rehab_website !=''):?>
    <a href="<?php echo $rehab_website; ?>" rel="noopener noreferrer" target="_blank" class="clinic-button clinic-reverse">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.20166 2.39519C7.26106 2.95817 5.53588 4.09058 4.25121 5.64469C2.96654 7.19879 2.18202 9.10243 2 11.1072H6.58979C6.85733 8.05645 7.7455 5.09179 9.20023 2.39376L9.20166 2.39519ZM6.58979 12.8928H2C2.18164 14.8977 2.96583 16.8015 4.25025 18.3559C5.53467 19.9102 7.25968 21.043 9.20023 21.6063C7.7455 18.9082 6.85733 15.9436 6.58979 12.8928ZM11.5009 21.9877C9.76188 19.2409 8.69571 16.1255 8.38841 12.8928H15.6102C15.3029 16.1255 14.2367 19.2409 12.4977 21.9877C12.1656 22.0041 11.8329 22.0041 11.5009 21.9877ZM14.7998 21.6048C16.7401 21.0416 18.465 19.9091 19.7494 18.355C21.0338 16.8009 21.8181 14.8974 22 12.8928H17.4102C17.1427 15.9436 16.2545 18.9082 14.7998 21.6063V21.6048ZM17.4102 11.1072H22C21.8184 9.10235 21.0342 7.19853 19.7498 5.64417C18.4653 4.08981 16.7403 2.95707 14.7998 2.39376C16.2545 5.09179 17.1427 8.05645 17.4102 11.1072ZM11.5009 2.01236C11.8334 1.99588 12.1666 1.99588 12.4991 2.01236C14.2376 4.75923 15.3033 7.87467 15.6102 11.1072H8.38984C8.70109 7.85468 9.76965 4.7364 11.5009 2.01236Z"/>
        </svg>
        Website
    </a>
<?php endif; ?>
<?php endif; ?>
</div>