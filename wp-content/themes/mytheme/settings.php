<?php
//Om det inte är admin-sidan, körs inte koden.
if(is_admin() == false){
    return;
}

// Lägger till ett menyalternativ "Butik" i dashboard under "Settings"
function meubeltheme_add_settings(){
    add_submenu_page(
        'options-general.php',
        "Butik",
        "Butik",
        "edit_pages",
        "butik",
        "meubeltheme_add_settings_callback"
    );

    add_submenu_page(
        'options-general.php',
        "Footer",
        "Footer",
        "edit_pages",
        "footer",
        "meubeltheme_add_settings_callback"
    );
}

function meubeltheme_add_settings_callback(){
    ?>
        <div class="wrap">
            <h2>Butiksinställningar</h2>
            <form action="options.php" method="post">
                <?php
                    settings_fields("butik");
                    do_settings_sections("butik");
                    submit_button();
                ?>
            </form>
        </div>
    <?php


    ?>
    <div class="wrap">
        <h2>Footer-settings</h2>
        <form action="options.php" method="post">
            <?php
            settings_fields("footer");
            do_settings_sections("footer");
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

add_action('admin_menu', 'meubeltheme_add_settings');

// Registrerar inställningar tillgängliga på sidan "Butik"
function meubeltheme_add_settings_init(){
    add_settings_section(
        "butik_general",
        "General",
        "meubeltheme_add_settings_section_general",
        "butik"
    );
    // Första biten, där vi skriver in "rean"
    register_setting(
        "butik",
        "store_message"
    );

    add_settings_field(
        "store_message",
        "Store Message",
        "meubeltheme_section_setting",
        "butik",
        "butik_general",
        array(
            "option_name" => "store_message",
            "option_type" => "text"
        )
    );
    //Andra biten, för öppettider
    register_setting(
        "butik",
        "store_open"
    );

    add_settings_field(
        "store_open",
        "Open",
        "meubeltheme_section_setting",
        "butik",
        "butik_general",
        array(
            "option_name" => "store_open",
            "option_type" => "time"
        )
    );
    //Tredje biten, checkbox, om store-message ska visas eller ej. 
    register_setting(
        "butik",
        "store_show_message"
    );

    add_settings_field(
        "store_show_message",
        "Show message",
        "meubeltheme_section_setting",
        "butik",
        "butik_general",
        array(
            "option_name" => "store_show_message",
            "option_type" => "checkbox"
        )
    );



    /* ---- Footer part ---- */

    // Add section to footer-settings
    add_settings_section(
        "footer_general", //section name
        "General settings for footer section", //section title
        "meubeltheme_add_settings_section_general",
        "footer"
    );

    // ---------- ADRESS FIELD ---------

    // Register setting for street-address in footer
    register_setting(
        "footer", //option group
        "address_street" // option name
    );

    add_settings_field(
        "address_street", //id
        "Address (street):", // title
        "meubeltheme_section_setting", //callback
        "footer", //page
        "footer_general", //section
        array(
            "option_name" => "address_street",
            "option_type" => "text"
        )
    );


    // ---------- ADDRESS CITY ---------
    register_setting(
        "footer",
        "address_city"
    );

    add_settings_field(
        "address_city", // id for field
        "City:", // field title
        "meubeltheme_section_setting",
        "footer", //page
        "footer_general", //section
        array(
            "option_name" => "address_city",
            "option_type" => "text"
        )
    );

    // ---------- ADDRESS zip code and state ---------
    register_setting(
        "footer",
        "address_zip"
    );

    add_settings_field(
        "address_zip", // id for field
        "Zip code and state:", // field title
        "meubeltheme_section_setting",
        "footer", //page
        "footer_general", //section
        array(
            "option_name" => "address_zip",
            "option_type" => "text"
        )
    );


    // Registrera en ny inställning för "Meubel House"
    register_setting('footer', 'copyright_year');

    // Lägg till ett nytt fält i den allmänna sektionen
    add_settings_field(
        'copyright_year',
        'Year of copyright:',
        'meubeltheme_section_setting',
        'footer',
        "footer_general", //section
        array(
            "option_name" => "copyright_year",
            "option_type" => "text"
        )
    );

}

add_action('admin_init', 'meubeltheme_add_settings_init');

function mytheme_year_setting_callback() {
    $year = get_option('mytheme_year_setting');
    echo '<input type="text" id="mytheme_year_setting" name="mytheme_year_setting" value="' . esc_attr($year) . '" />';
}

// Ritar ut sektionen "general"s beskrivning
function meubeltheme_add_settings_section_general(){
    echo "<p>Generella inställningar för butiken</p>";
}

//Ritar ut inställningsfält
// Sending submitted values to database
function meubeltheme_section_setting($args){
    $option_name = $args["option_name"];
    $option_type = $args["option_type"];
    $option_value = get_option($args["option_name"]);
    echo '<input type="' . $option_type . '" id="' . $option_name . '" name="' . $option_name . '" value="'. $option_value .'"/>';

}



/* Extra, ska kollas över!*/

// Lägg till sidan i adminmenyn
function mytheme_add_admin_page() {
    add_menu_page('Nyhetsbrevsinställningar', 'Nyhetsbrev', 'manage_options', 'mytheme-newsletter-settings', 'mytheme_newsletter_page', 'dashicons-email-alt', 110);
    // Registrera inställning
    register_setting('mytheme-newsletter-group', 'mytheme_newsletter_email');
}
add_action('admin_menu', 'mytheme_add_admin_page');

// Skapa inställningssidan
function mytheme_newsletter_page() {
    ?>
    <div class="wrap">
        <h1>Nyhetsbrevsinställningar</h1>
        <form method="post" action="options.php">
            <?php settings_fields('mytheme-newsletter-group'); ?>
            <?php do_settings_sections('mytheme-newsletter-group'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Mottagaradress för nyhetsbrev</th>
                    <td><input type="text" name="mytheme_newsletter_email" value="<?php echo esc_attr(get_option('mytheme_newsletter_email')); ?>" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}



// Add submenu page to the Appearance menu
function theme_options_page() {
    add_theme_page(
        'Theme Options', // Page title
        'Theme Options', // Menu title
        'manage_options', // Capability
        'theme-options', // Menu slug
        'theme_options_render' // Callback function
    );
}
add_action( 'admin_menu', 'theme_options_page' );


function theme_options_render() {
    ?>
    <div class="wrap">
        <h1>Theme Options</h1>
        <form action="options.php" method="post">
            <?php
            // Output security fields and hidden input fields
            settings_fields( 'theme_options' );
            // Output settings sections and their fields
            do_settings_sections( 'theme-options' );
            // Output submit button
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Register theme options
function theme_options_init() {
    register_setting(
        'theme_options', // Option group
        'theme_options', // Option name
        'theme_options_validate' // Sanitize callback
    );
// Add setting sections
    add_settings_section(
        'general', // ID
        'General Options', // Title
        'theme_options_general_text', // Callback
        'theme-options' // Page
    );
    // Add setting fields
    add_settings_field(
        'color_scheme', // ID
        'Color Scheme', // Title
        'theme_options_color_scheme_render', // Callback
        'theme-options', // Page
        'general' // Section
    );
}
add_action( 'admin_init', 'theme_options_init' );
// Render color scheme field
function theme_options_some_setting_render() {
    // Fetch options and output HTML for the field
    $options = get_option('theme_options');
    ?>
    <input type="text" name="theme_options[some_setting_id]" value="<?php echo esc_attr($options['some_setting_id'] ?? ''); ?>">
    <?php
}