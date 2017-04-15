<?php

//Adding the tipograhphy
add_action( 'admin_menu', 'my_fonts' );

function my_fonts() {
    add_theme_page( 'Fonts', 'Fonts', 'edit_theme_options', 'fonts', 'fonts' );
}

function fonts() {
?>
    <div class="wrap">
        <div><br></div>
        <h2>Fonts</h2>
 
        <form method="post" action="options.php">
            <?php wp_nonce_field( 'update-fonts' ); ?>
            <?php settings_fields( 'fonts' ); ?>
            <?php do_settings_sections( 'fonts' ); ?>
            <?php submit_button(); ?>
        </form>
    </div>
<?php
}

add_action( 'admin_init', 'font_init' );

function font_init() {
    register_setting( 'fonts', 'fonts' );
 
// Settings fields and sections
    add_settings_section( 'font_section', 'Typography Options', 'font_description', 'fonts' );
    add_settings_field( 'body-font', 'Body Font', 'body_font_field', 'fonts', 'font_section' );//for the body
    add_settings_field( 'h1-font', 'Header 1 Font', 'h1_font_field', 'fonts', 'font_section' );//for the h1-tags
    add_settings_field( 'h2-font', 'Header 2 Font', 'h2_font_field', 'fonts', 'font_section' );//for the h2-tags
    add_settings_field( 'h3-font', 'Header 3 Font', 'h3_font_field', 'fonts', 'font_section' );//for the h3-tags
    add_settings_field( 'p-font', 'p Font', 'p_font_field', 'fonts', 'font_section' );//for the p-tags
}

function font_description() {
    echo 'Use the form below to change fonts of your theme.';
}

//Adding codes to get the body's font changes
function body_font_field() {
    $options = (array) get_option( 'fonts' );
    $fonts = get_fonts();
 
    if ( isset( $options['body-font'] ) )
        $current = $options['body-font'];
    else
        $current = 'arial';
 
    ?>
        <select name="fonts[body-font]">
        <?php foreach( $fonts as $key => $font ): ?>
            <option <?php if($key == $current) echo "SELECTED"; ?> value="<?php echo $key; ?>"><?php echo $font['name']; ?></option>
        <?php endforeach; ?>
        </select>
    <?php
}

//Adding codes to get all the h1-tags's font changes
function h1_font_field() {
    $options = (array) get_option( 'fonts' );
    $fonts = get_fonts();
    $current = 'arial';
 
    if ( isset( $options['h1-font'] ) )
        $current = $options['h1-font'];
 
    ?>
        <select name="fonts[h1-font]">
        <?php foreach( $fonts as $key => $font ): ?>
            <option <?php if($key == $current) echo "SELECTED"; ?> value="<?php echo $key; ?>"><?php echo $font['name']; ?></option>
        <?php endforeach; ?>
        </select>
    <?php
}

//Adding codes to get all the h2-tags's font changes
function h2_font_field() {
    $options = (array) get_option( 'fonts' );
    $fonts = get_fonts();
    $current = 'arial';
 
    if ( isset( $options['h2-font'] ) )
        $current = $options['h2-font'];
 
    ?>
        <select name="fonts[h2-font]">
        <?php foreach( $fonts as $key => $font ): ?>
            <option <?php if($key == $current) echo "SELECTED"; ?> value="<?php echo $key; ?>"><?php echo $font['name']; ?></option>
        <?php endforeach; ?>
        </select>
    <?php
}

//Adding codes to get all the h3-tags's font changes
function h3_font_field() {
    $options = (array) get_option( 'fonts' );
    $fonts = get_fonts();
    $current = 'arial';
 
    if ( isset( $options['h3-font'] ) )
        $current = $options['h3-font'];
 
    ?>
        <select name="fonts[h3-font]">
        <?php foreach( $fonts as $key => $font ): ?>
            <option <?php if($key == $current) echo "SELECTED"; ?> value="<?php echo $key; ?>"><?php echo $font['name']; ?></option>
        <?php endforeach; ?>
        </select>
    <?php
}

//Adding codes to get all the p-tags's font changes
function p_font_field() {
    $options = (array) get_option( 'fonts' );
    $fonts = get_fonts();
    $current = 'arial';
 
    if ( isset( $options['p-font'] ) )
        $current = $options['p-font'];
 
    ?>
        <select name="fonts[p-font]">
        <?php foreach( $fonts as $key => $font ): ?>
            <option <?php if($key == $current) echo "SELECTED"; ?> value="<?php echo $key; ?>"><?php echo $font['name']; ?></option>
        <?php endforeach; ?>
        </select>
    <?php
}

//Getting the fonts
function get_fonts() {
    $fonts = array(
        	'Merienda' 	=> array(
            'name' 		=> 'Merienda',
            'font' 		=> '@import url(https://fonts.googleapis.com/css?family=Merienda);',
            'css' 		=> "font-family: 'Merienda', cursive;"
        ),
        	'ubuntu' 	=> array(
            'name' 		=> 'Ubuntu',
            'font' 		=> '@import url(https://fonts.googleapis.com/css?family=Ubuntu);',
            'css' 		=> "font-family: 'Ubuntu', sans-serif;"
        ),
        	'lobster' 	=> array(
            'name' 		=> 'Lobster',
            'font' 		=> '@import url(https://fonts.googleapis.com/css?family=Lobster);',
            'css' 		=> "font-family: 'Lobster', cursive;"
        ),
        	'Handlee' 	=> array(
            'name' 		=> 'Handlee',
            'font' 		=> '@import url(https://fonts.googleapis.com/css?family=Handlee);',
            'css' 		=> "font-family: 'Handlee', cursive;"
        ),
        	'Redressed' => array(
            'name' 		=> 'Redressed',
            'font' 		=> '@import url(https://fonts.googleapis.com/css?family=Redressed);',
            'css' 		=> "font-family: 'Redressed', cursive;"
         )

    );
     return apply_filters( 'get_fonts', $fonts );
}

//Adding the CSS...
add_action( 'wp_head', 'font_head' );
function font_head() {
    $options = (array) get_option( 'fonts' );
    $fonts = get_fonts();

//...for the body
    $body_key = 'arial';
    if ( isset( $options['body-font'] ) )
        $body_key = $options['body-font'];
 
    if ( isset( $fonts[ $body_key ] ) ) {
        $body_font = $fonts[ $body_key ];
 
        echo '<style>';
        echo $body_font['font'];
        echo 'body { ' . $body_font['css'] . ' } ';
        echo '</style>';
    }

//...for the h1-tags
 	$h1_key = 'arial';
 	if ( isset( $options['h1-font'] ) )
        $h1_key = $options['h1-font'];
 
    if ( isset( $fonts[ $h1_key ] ) ) {
        $h1_key = $fonts[ $h1_key ];
 
        echo '<style>';
        echo $h1_key['font'];
        echo 'h1  { ' . $h1_key['css'] . ' } ';
        echo '</style>';
    }

//...for the h2-tags
 	$h2_key = 'arial';
 	if ( isset( $options['h2-font'] ) )
        $h2_key = $options['h2-font'];
 
    if ( isset( $fonts[ $h2_key ] ) ) {
        $h2_key = $fonts[ $h2_key ];
 
        echo '<style>';
        echo $h2_key['font'];
        echo 'h2  { ' . $h2_key['css'] . ' } ';
        echo '</style>';
    }

//...for the h3-tags
 	$h3_key = 'arial';
 	if ( isset( $options['h3-font'] ) )
        $h3_key = $options['h3-font'];
 
    if ( isset( $fonts[ $h3_key ] ) ) {
        $h3_key = $fonts[ $h3_key ];
 
        echo '<style>';
        echo $h3_key['font'];
        echo 'h3  { ' . $h3_key['css'] . ' } ';
        echo '</style>';
    }

//...for the p-tags
 	$p_key = 'arial';
 	if ( isset( $options['p-font'] ) )
        $p_key = $options['p-font'];
 
    if ( isset( $fonts[ $p_key ] ) ) {
        $p_key = $fonts[ $p_key ];
 
        echo '<style>';
        echo $p_key['font'];
        echo 'p  { ' . $p_key['css'] . ' } ';
        echo '</style>';
    }
}