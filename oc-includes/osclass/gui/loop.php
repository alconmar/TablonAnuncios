<?php
/*
 * Copyright 2014 Osclass
 * Copyright 2021 Osclass by OsclassPoint.com
 *
 * Osclass maintained & developed by OsclassPoint.com
 * You may not use this file except in compliance with the License.
 * You may download copy of Osclass at
 *
 *     https://osclass-classifieds.com/download
 *
 * Do not edit or add to this file if you wish to upgrade Osclass to newer
 * versions in the future. Software is distributed on an "AS IS" basis, without
 * warranties or conditions of any kind, either express or implied. Do not remove
 * this NOTICE section as it contains license information and copyrights.
 */

?>

<?php
$loopClass = '';
$type = 'items';
if(View::newInstance()->_exists('listType')){
    $type = View::newInstance()->_get('listType');
}
if(View::newInstance()->_exists('listClass')){
    $loopClass = View::newInstance()->_get('listClass');
}
?>
<ul class="listing-card-list <?php echo $loopClass; ?>" id="listing-card-list">
    <?php
        $i = 0;

        if( $type === 'latestItems'){
	        try {
		        while ( osc_has_latest_items() ) {
			        $class = '';
			        if ( $i % 3 == 0 ) {
				        $class = 'first';
			        }
			        bender_draw_item( $class );
			        $i ++;
		        }
	        } catch ( Exception $e ) {
	        }
        } elseif( $type === 'premiums'){
            while ( osc_has_premiums() ) {
                $class = '';
                if($i%3 == 0){
                    $class = 'first';
                }
                bender_draw_item($class,false,true);
                $i++;
                if($i == 3){
                    break;
                }
            }
        } else {
            search_ads_listing_top_fn();
            while(osc_has_items()) {
                $i++;
                $class = false;
                if($i%4 == 0){
                    $class = 'last';
                }
                $admin = false;
                if(View::newInstance()->_exists( 'listAdmin' )){
                    $admin = true;
                }

                bender_draw_item($class,$admin);

                if( bender_show_as() === 'gallery') {
                    if($i%8 == 0){
                        osc_run_hook('search_ads_listing_medium');
                    }
                } else if( bender_show_as() === 'list') {
                    if($i%6 == 0){
                        osc_run_hook('search_ads_listing_medium');
                    }
                }
          }
        }
    ?>
</ul>