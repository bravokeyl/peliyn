<?php
if (!class_exists('peliyn_Redux_Framework_config')) {

    class peliyn_Redux_Framework_config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            add_action( 'redux/loaded', array( $this, 'remove_demo' ) );
            
            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        function compiler_action($options, $css) {
        
        }

        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => __('Section via hook', 'peliyn'),
                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'peliyn'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }

        function change_arguments($args) {
            //$args['dev_mode'] = true;

            return $args;
        }

        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }

        public function setSections() {
            
            // Background Patterns Reader
            $sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url    = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns        = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode('.', $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct             = wp_get_theme();
            $this->theme    = $ct;
            $item_name      = $this->theme->get('Name');
            $tags           = $this->theme->Tags;
            $screenshot     = $this->theme->get_screenshot();
            $class          = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'peliyn'), $this->theme->display('Name'));
            
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                <?php endif; ?>

                <h4><?php echo $this->theme->display('Name'); ?></h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', 'peliyn'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'peliyn'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . __('Tags', 'peliyn') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
            <?php
            if ($this->theme->parent()) {
                printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'peliyn'), $this->theme->parent()->display('Name'));
            }
            ?>

                </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            if (file_exists(dirname(__FILE__) . '/info-html.html')) {
                /** @global WP_Filesystem_Direct $wp_filesystem  */
                global $wp_filesystem;
                if (empty($wp_filesystem)) {
                    require_once(ABSPATH . '/wp-admin/includes/file.php');
                    WP_Filesystem();
                }
                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
            }

            // ACTUAL DECLARATION OF SECTIONS
            $this->sections[] = array(
                'icon'      => 'el-icon-cogs',
                'title'     => __('General Settings', 'peliyn'),
                'fields'    => array(
                    array(
                        'id'        => 'opt-logo',
                        'type'      => 'media',
                        'title'     => __('Upload Your Logo', 'peliyn'),
                        'desc'      => __('If logo is not set then site name is used.', 'peliyn'),
                        'subtitle'  => __('Optimal height of logo is 50px.', 'peliyn'),
                    ),
                    array(
                        'id'        => 'opt-favicon',
                        'type'      => 'media',
                        'title'     => __('Upload Your Favicon', 'peliyn'),
                        // 'desc'      => __('Favicon', 'peliyn'),
                        // 'subtitle'  => __('', 'peliyn'),
                    ),
                    array(
                            'id'        => 'opt-fixmenu',
                            'type'      => 'checkbox',
                            'title'     => __('Fix Menu bar to Top.', 'peliyn'),
                            //'subtitle'  => __('', 'peliyn'),
                            // 'desc'      => __('', 'peliyn'),
                            'default'   => '1'// 1 = on | 0 = off
                        ),
                    array(                    
                          'id'        => 'opt-layout',       
                         'type'      => 'image_select',      
                         'compiler'  => true,        
                         'title'     => __('Main Layout', 'peliyn'),         
                         'subtitle'  => __('Select main content and sidebar alignment. Choose between 1, 2 or 3 column layout.', 'peliyn'),      
                         'options'   => array(       
                             '1' => array('alt' => 'Full Width',       'img' => ReduxFramework::$_url . 'assets/img/1col.png'),      
                             '2' => array('alt' => 'Left Sidebar',  'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),      
                             '3' => array('alt' => 'Right Sidebar', 'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),      
                         ),      
                         'default'   => '1'      
         
                     ), 
                
                    array(
                        'id'        => 'opt-copyright',
                        'type'      => 'editor',
                        'title'     => __('Footer Text', 'peliyn'),
                       // 'subtitle'  => __('You can use the following shortcodes in your footer text: [wp-url] [site-url] [theme-url] [login-url] [logout-url] [site-title] [site-tagline] [current-year]', 'peliyn'),
                        'default'   => '&copy; 2015 Peliyn, All Rights Reserved.',
                    ), 
                )
            );
            $this->sections[] = array(
                    'title'   => __('Slider' , 'peliyn' ),
                    'desc'    => __('Front page slider images','peliyn'),
                    'icon'    => 'el-icon-th-list',
                    'fields'    => array(
                                // array(
                                //     'id'        => 'opt-slides',
                                //     'type'      => 'slides',
                                //     'title'     => __('Slides Options', 'peliyn'),
                                //     'subtitle'  => __('Unlimited slides with drag and drop sortings.', 'peliyn'),
                                //     'desc'      => __('This field will store all slides values into a multidimensional array to use into a foreach loop.', 'peliyn'),
                                //     'placeholder'   => array(
                                //         'title'         => __('This is a title', 'peliyn'),
                                //         'description'   => __('Description Here', 'peliyn'),
                                //         'url'           => __('Give us a link!', 'peliyn'),
                                //     ),
                               // ),
                                array(
                                    'id'        => 'opt-slider-background',
                                    'type'      => 'background',
                                    //'background-size' => false ,
                                    //'background-color' => false ,
                                    //'background-attachment' => false,
                                    //'background-repeat' => false ,
                                    'output'    => array('#home'),
                                    'title'     => __('Slider Background', 'peliyn'),
                                    'subtitle'  => __('upload image for slider background here', 'peliyn'),
                                ),
                                array(
                                    'id'        => 'opt-slider-text',
                                    'type'      => 'multi_text',
                                    'title'     => __('Slider Text', 'peliyn'),
                                    'subtitle'  => __('Enter slider text here', 'peliyn'),
                                ),
                                array(
                                    'id'        => 'opt-slider-textc',
                                    'type'      => 'color',
                                    'title'     => __('Slider Text Color', 'peliyn'),
                                    'validate'  => 'color',
                                    'output'    => array('h1.intro-title'),
                                    'subtitle'  => __('default(#fff)', 'peliyn'),
                                ),

                            )
                    );

            $this->sections[] = array(
                'title'     => __('About', 'peliyn'),
                'desc'      => __('Tell your story.', 'peliyn'),
                'icon'      => 'el-icon-fire',
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields'    => array(
                                array(
                                    'id'        => 'opt-storyheadline',
                                    'type'      => 'text',
                                    'title'     => __('Your Story Heading', 'peliyn'),
                                    'default'   => 'Discover our story',
                                ),
                                array(
                                        'id'        => 'opt-storysubhead',
                                        'type'      => 'text',
                                        'title'     => __('Your Story Sub Heading', 'peliyn'),
                                        'default'   => 'Welcome To Leaff',
                                    ),
                                array(
                                        'id'        => 'opt-storydesc',
                                        'type'      => 'editor',
                                        'title'     => __('Your Story Description', 'peliyn'),
                                        'default'   => 'Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it.',
                                    ),
                                array(
                                        'id'        => 'opt-storybg',
                                        'type'      => 'background',
                                        'background-size' => false,
                                        'output'    => array('#about'),
                                        'title'     => __('Background', 'peliyn'),
                                        'subtitle'  => __('Set backgound for this section(default color:#fff).', 'peliyn'),
                                ),
                                array(
                                            'id'        => 'opt-storyhc',
                                            'type'      => 'color',
                                            'output'    => array('#about h2'),
                                            'title'     => __('Heading Color', 'peliyn'),
                                            'default'   =>'#000'
                                ),
                                array(
                                            'id'        => 'opt-storyshc',
                                            'type'      => 'color',
                                            'output'    => array('#about h3'),
                                            'title'     => __('Sub Heading Color', 'peliyn'),
                                            'default'   => '#a7a9ac'
                                ),
                                array(
                                            'id'        => 'opt-storydc',
                                            'type'      => 'color',
                                            'output'    => array('#about'),
                                            'title'     => __('Description Color', 'peliyn'),
                                            'default'   => '#666'
                                ),
                            )
                  
                        );
            $this->sections[] = array(
                'title'     => __('Dishes', 'peliyn'),
                'desc'      => __('Chef Recommended / New.', 'peliyn'),
                'icon'      => 'dashicons-before dashicons-carrot',
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields'    => array(
                                array(
                                    'id'        => 'opt-sep-dishes',
                                    'type'      => 'background',
                                    'title'     => __('Callout Image ', 'peliyn'),
                                    'desc'      => 'Upload image',
                                    'subtitle'  => 'Before Dishes Section',
                                    'default'   => '',
                                    'output'    => array('#callout-one'),
                                ),
                                array(
                                    'id'        => 'opt-septxtdishes',
                                    'type'      => 'text',
                                    'title'     => __('Callout Text', 'peliyn'),
                                    'desc'      => '',
                                    'default'   => 'Premium food at affordable price.',
                                ),
                                array(
                                    'id'        => 'opt-septxtdishesc',
                                    'type'      => 'color',
                                    'title'     => __('Callout Text color', 'peliyn'),
                                    'desc'      => '',
                                    'validate'  => 'color',
                                    'output'    => array('#callout-one .callout-text')
                                ),
                                array(
                                    'id'        => 'opt-dishheadline',
                                    'type'      => 'text',
                                    'title'     => __('Heading', 'peliyn'),
                                    'default'   => 'Chef Recommended / New',
                                ),
                                array(
                                        'id'        => 'opt-dishsubhead',
                                        'type'      => 'text',
                                        'title'     => __('Sub Heading', 'peliyn'),
                                        'default'   => 'Signature Dishes Recommended By Our Chef',
                                    ),
                                array(
                                        'id'        => 'opt-dishbg',
                                        'type'      => 'background',
                                        'background-size' => false,
                                        'output'    => array('#dishes'),
                                        'title'     => __('Background', 'peliyn'),
                                        'subtitle'  => __('Set backgound for this section(default color:#fff).', 'peliyn'),
                                ),
                                array(
                                            'id'        => 'opt-dishhc',
                                            'type'      => 'color',
                                            'output'    => array('#dishes h2'),
                                            'title'     => __('Heading Color', 'peliyn'),
                                            'default'   =>'#000'
                                ),
                                array(
                                            'id'        => 'opt-dishshc',
                                            'type'      => 'color',
                                            'output'    => array('#dishes h3'),
                                            'title'     => __('Sub Heading Color', 'peliyn'),
                                            'default'   => '#a7a9ac'
                                ),
                                array(
                                            'id'        => 'opt-dishdc',
                                            'type'      => 'color',
                                            'output'    => array('#dishes'),
                                            'title'     => __('Description', 'peliyn'),
                                            'default'   => '#666'
                                ),
    
                            )
                  
                        );
            $this->sections[] = array(
                'title'     => __('Popular Menu', 'peliyn'),
                'desc'      => __('Popular Dishes.', 'peliyn'),
                'icon'      => 'el-icon-star',
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields'    => array(

                                array(
                                    'id'        => 'opt-sep-menu',
                                    'type'      => 'background',
                                    'title'     => __('Callout Image', 'peliyn'),
                                    'desc'      => 'Upload image',
                                    'default'   => '',
                                    'subtitle'  => 'Before Popular Menu Section',
                                    'output'    => array('#callout-two'),
                                ),
                                array(
                                    'id'        => 'opt-septxtmenu',
                                    'type'      => 'text',
                                    'title'     => __('Callout Text', 'peliyn'),
                                    'desc'      => '',
                                    'default'   => 'Try the taste of Italy.',
                                ),
                                array(
                                    'id'        => 'opt-septxtmenuc',
                                    'type'      => 'color',
                                    'title'     => __('Callout Text color', 'peliyn'),
                                    'desc'      => '',
                                    'validate'  => 'color',
                                    'output'    => array('#callout-two .callout-text')
                                ),
                                array(
                                    'id'        => 'opt-pmenuheadline',
                                    'type'      => 'text',
                                    'title'     => __('Heading', 'peliyn'),
                                    'default'   => 'Popular Dishes',
                                ),
                                array(
                                        'id'        => 'opt-pmenusubhead',
                                        'type'      => 'text',
                                        'title'     => __('Sub Heading', 'peliyn'),
                                        'default'   => 'Our Most Popular Menu',
                                    ),
                                 array(
                                    'id'        => 'opt-pmenucat',
                                    'type'      => 'select',
                                    'data'      => 'posts',
                                    'args'      => array('post_type'=>'p_dishes', 'posts_per_page' => -1),
                                    'multi'     => true,
                                    'title'     => __('Select Posts', 'peliyn'),
                                    // 'subtitle'  => __('', 'peliyn'),
                                    'desc'      => __('You can select multiple posts', 'peliyn'),
                                ),
                                array(
                                        'id'        => 'opt-pmenubg',
                                        'type'      => 'background',
                                        'background-size' => false,
                                        'output'    => array('#popular'),
                                        'title'     => __('Background', 'peliyn'),
                                        'subtitle'  => __('Set backgound for this section(default color:#fff).', 'peliyn'),
                                ),
                                array(
                                        'id'        => 'opt-pmenuhc',
                                        'type'      => 'color',
                                        'output'    => array('#popular h2'),
                                        'title'     => __('Heading Color', 'peliyn'),
                                        'default'   =>'#000'
                                ),
                                array(
                                        'id'        => 'opt-pmenushc',
                                        'type'      => 'color',
                                        'output'    => array('#popular h3'),
                                        'title'     => __('Sub Heading Color', 'peliyn'),
                                        'default'   => '#a7a9ac'
                                ),
                                array(
                                        'id'        => 'opt-pmenudc',
                                        'type'      => 'color',
                                        'output'    => array('#popular'),
                                        'title'     => __('Description', 'peliyn'),
                                        'default'   => '#666'
                                ),
                                array(
                                        'id'        => 'opt-pmenumore',
                                        'type'      => 'text',
                                        'title'     => __('View Menu text', 'peliyn'),
                                        'desc'      => 'More text which is under popular menu section',
                                        'default'   => 'Veiw Menu',
                                ),
                                array(
                                        'id'        => 'opt-pmenuurl',
                                        'type'      => 'text',
                                        'title'     => __('View Menu URL', 'peliyn'),
                                        'validate'  => 'url',
                                        'default'   => home_url().'/dishes',
                                ),
                            )
                  
                        );
                      $this->sections[] = array(        
                            'title'     => __('Testimonials', 'peliyn'),        
                            'desc'      => __('', 'peliyn'),        
                            'icon'      => 'dashicons-before dashicons-heart',      
                            // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!         
                            'fields'    => array(       
                    
                                            array(      
                                                'id'        => 'opt-test',      
                                                'type'      => 'background',        
                                                'title'     => __('Testimonials Background', 'peliyn'),         
                                                'desc'      => 'Upload image',      
                                                'default'   => '',      
                                                'output'    => array('#callout-three'),         
                                            ),      
                                            array(      
                                                'id'        => 'opt-test-color',        
                                                'type'      => 'color',         
                                                'title'     => __('Testimonials Color', 'peliyn'),      
                                                'desc'      => '',      
                                                'output'    => array('.testimonials-slider'),       
                                                'validate'  => 'color'      
                                                //'default'   => '',        
                                            ),      
                                            array(      
                                                'id'        => 'opt-test-rev',      
                                                'type'      => 'color',         
                                                'title'     => __('Reviewer Name color', 'peliyn'),         
                                                'desc'      => '',      
                                                'output'    => array('h4.reviewer-name'),       
                                                'validate'  => 'color'      
                                                //'default'   => '',        
                                            ),      
                                            array(      
                                                'id'        => 'opt-test-rev-star',         
                                                'type'      => 'color',         
                                                'title'     => __('Review star color', 'peliyn'),       
                                                'desc'      => '',      
                                                'output'    => array('.stars'),         
                                                'validate'  => 'color'      
                                                //'default'   => '',        
                                            ),      
                                       )        
                            ); 

            $this->sections[] = array(
                'title'     => __('Gallery', 'peliyn'),
                'desc'      => __('', 'peliyn'),
                'icon'      => 'el-icon-list',
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields'    => array(
                                array(
                                    'id'        => 'opt-gheadline',
                                    'type'      => 'text',
                                    'title'     => __('Heading', 'peliyn'),
                                    'default'   => 'Gallery',
                                ),
                                array(
                                        'id'        => 'opt-gsubhead',
                                        'type'      => 'text',
                                        'title'     => __('Sub Heading', 'peliyn'),
                                        'default'   => 'See the Gallery',
                                    ),
                                array(
                                        'id'        => 'opt-gdesc',
                                        'type'      => 'editor',
                                        'title'     => __('Gallery Short desciption', 'peliyn'),
                                        'default'   => 'The European languages are members of family. Their separate existence is a myth. For science, music Europe uses the same vocabulary.',
                                    ),
                                array(
                                        'id'        => 'opt-gallery',
                                        'type'      => 'gallery',
                                        'title'     => __('Add/Edit Gallery', 'peliyn'),
                                        'subtitle'  => __('Create a new Gallery by selecting existing or uploading new images using the WordPress native uploader', 'peliyn'),
                                        // 'desc'      => __('', 'peliyn'),
                                    ),
                                array(
                                        'id'        => 'opt-gbg',
                                        'type'      => 'background',
                                        'background-size' => false,
                                        'output'    => array('#gallery .side-image'),
                                        'title'     => __('Background', 'peliyn'),
                                        'subtitle'  => __('Set backgound for this section(default color:#fae7d7).', 'peliyn'),
                                ),
                                array(
                                        'id'        => 'opt-ghc',
                                        'type'      => 'color',
                                        'output'    => array('#gallery h2'),
                                        'title'     => __('Heading Color', 'peliyn'),
                                        'default'   =>'#000'
                                ),
                                array(
                                        'id'        => 'opt-gshc',
                                        'type'      => 'color',
                                        'output'    => array('#gallery h3'),
                                        'title'     => __('Sub Heading Color', 'peliyn'),
                                        'default'   => '#a7a9ac'
                                ),
                                array(
                                        'id'        => 'opt-gdc',
                                        'type'      => 'color',
                                        'output'    => array('#gallery'),
                                        'title'     => __('Description', 'peliyn'),
                                        'default'   => '#666'
                                ),
                                array(
                                        'id'        => 'opt-gmore',
                                        'type'      => 'text',
                                        'title'     => __('View Menu text', 'peliyn'),
                                        'desc'      => 'More text which is under Gallery section',
                                        'default'   => 'Veiw Gallery',
                                ),
                                array(
                                        'id'        => 'opt-gurl',
                                        'type'      => 'text',
                                        'title'     => __('View Gallery URL', 'peliyn'),
                                        'validate'  => 'url',
                                        'default'   => home_url().'/dishes',
                                ),
                            )
                  
                        );
            $this->sections[] = array(
                'icon'      => 'el-icon-magic',
                'title'     => __('Services', 'peliyn'),
                'fields'    => array(

                                    array(
                                    'id'        => 'opt-sheadline',
                                    'type'      => 'text',
                                    'title'     => __('Heading', 'peliyn'),
                                    'default'   => 'We provide the following',
                                ),
                                array(
                                        'id'        => 'opt-ssubhead',
                                        'type'      => 'text',
                                        'title'     => __('Sub Heading', 'peliyn'),
                                        'default'   => 'Services',
                                    ),
                                array(
                                        'id'        => 'opt-sbox1h',
                                        'type'      => 'text',
                                        'title'     => __('Box One Heading', 'peliyn'),
                                        'default'   => 'Opened 24/7',
                                    ),
                                array(
                                        'id'        => 'opt-sbox1',
                                        'type'      => 'editor',
                                        'title'     => __('Box One', 'peliyn'),
                                        'default'   => 'Thus, then, one of our own noble stamp, even a whaleman, is the tutelary guardian of England.',
                                    ),
                                 array(
                                        'id'        => 'opt-sbox2h',
                                        'type'      => 'text',
                                        'title'     => __('Box Two Heading', 'peliyn'),
                                        'default'   => 'Free parking',
                                    ),
                                 array(
                                        'id'        => 'opt-sbox2',
                                        'type'      => 'editor',
                                        'title'     => __('Box Two', 'peliyn'),
                                        'default'   => 'Thus, then, one of our own noble stamp, even a whaleman, is the tutelary guardian of England.',
                                    ),
                                  array(
                                        'id'        => 'opt-sbox3h',
                                        'type'      => 'text',
                                        'title'     => __('Box Three Heading', 'peliyn'),
                                        'default'   => 'Central Location',
                                    ),
                                  array(
                                        'id'        => 'opt-sbox3',
                                        'type'      => 'editor',
                                        'title'     => __('Box Three', 'peliyn'),
                                        'default'   => 'Thus, then, one of our own noble stamp, even a whaleman, is the tutelary guardian of England.',
                                    ),
                                   array(
                                        'id'        => 'opt-sbox4h',
                                        'type'      => 'text',
                                        'title'     => __('Box Four Heading', 'peliyn'),
                                        'default'   => 'High quality',
                                    ),
                                   array(
                                        'id'        => 'opt-sbox4',
                                        'type'      => 'editor',
                                        'title'     => __('Box Four', 'peliyn'),
                                        'default'   => 'Thus, then, one of our own noble stamp, even a whaleman, is the tutelary guardian of England.',
                                    ),
                                array(
                                        'id'        => 'opt-sbg',
                                        'type'      => 'background',
                                        'background-size' => false,
                                        'output'    => array('#services'),
                                        'title'     => __('Background', 'peliyn'),
                                        'subtitle'  => __('Set backgound for this section(default color:#fff).', 'peliyn'),
                                ),
                                array(
                                            'id'        => 'opt-shc',
                                            'type'      => 'color',
                                            'output'    => array('#services h2'),
                                            'title'     => __('Heading Color', 'peliyn'),
                                            'default'   =>'#000'
                                ),
                                array(
                                            'id'        => 'opt-sshc',
                                            'type'      => 'color',
                                            'output'    => array('#services h3'),
                                            'title'     => __('Sub Heading Color', 'peliyn'),
                                            'default'   => '#a7a9ac'
                                ),
                                array(
                                            'id'        => 'opt-sdc',
                                            'type'      => 'color',
                                            'output'    => array('#services'),
                                            'title'     => __('Description', 'peliyn'),
                                            'default'   => '#666'
                                ),

                    )
                );
            $this->sections[] = array(
                'icon'      => 'dashicons-before dashicons-email',
                'title'     => __('Contact', 'peliyn'),
                'fields'    => array(
                         array(
                                    'id'        => 'opt-resh',
                                    'type'      => 'text',
                                    'title'     => __('Enter reservation heading.', 'peliyn'),
                                    'default'   => 'Make a reservation',
                                ),
                         array(
                                    'id'        => 'opt-ressh',
                                    'type'      => 'text',
                                    'title'     => __('Enter reservation sub heading.', 'peliyn'),
                                    'default'   => 'Book a table',
                                ),
                         array(
                                    'id'        => 'opt-subh',
                                    'type'      => 'text',
                                    'title'     => __('Enter Subscription Heading.', 'peliyn'),
                                    'default'   => 'Subscribe',
                                ),
                         array(
                                    'id'        => 'opt-subsh',
                                    'type'      => 'text',
                                    'title'     => __('Enter Subscription sub heading.', 'peliyn'),
                                    'default'   => 'SUBSCRIBE TO OUR NEWSLETTER',
                                ),
                           // array(
                           //          'id'        => 'opt-contact',
                           //          'type'      => 'text',
                           //          'title'     => __('Enter email address for contact form.', 'peliyn'),
                           //          'validate'  => 'email',
                           //          'default'   => '',
                           //      ),
                           // array(
                           //          'id'        => 'opt-connum',
                           //          'type'      => 'text',
                           //          'title'     => __('Enter phone number.', 'peliyn'),
                           //          'subtitle'  => __('(99-9999-9999) html allowed', 'peliyn'),
                           //          'validate'  => 'html',
                           //          'default'   => '',
                           //      ),
                            array(
                                    'id'        => 'opt-cf7',
                                    'type'      => 'text',
                                    'title'     => __('Enter Contact Form 7 Shortcode', 'peliyn'),
                                    'desc'      => 'you must be using contact form 7 plugin',
                                    'default'   => '',
                                ),
                            array(
                                    'id'        => 'opt-mcp',
                                    'type'      => 'text',
                                    'title'     => __('Enter MailChimp Shortcode.', 'peliyn'),
                                    'desc'      => 'You should be using MailChimp for WordPress Plugin',
                                    'default'   => '',
                                ),
                    )
                );
             $this->sections[] = array(
                'icon'      => 'el-icon-share-alt',
                'title'     => __('Social', 'peliyn'),
                'fields'    => array(
                    array(
                                    'id'        => 'opt-fb',
                                    'type'      => 'text',
                                    'title'     => __('Facebook', 'peliyn'),
                                    'desc'      => 'Enter Facebook page Url',
                                    'default'   => '',
                                    'validate'  => 'url'
                                ),
                            array(
                                    'id'        => 'opt-gp',
                                    'type'      => 'text',
                                    'title'     => __('GooglePlus', 'peliyn'),
                                    'desc'      => 'Enter GooglePlus Page Url',
                                    'default'   => '',
                                    'validate'  => 'url'
                                ),
                            array(
                                    'id'        => 'opt-tw',
                                    'type'      => 'text',
                                    'title'     => __('Twitter', 'peliyn'),
                                    'desc'      => 'Enter Twitter Page Url',
                                    'default'   => '',
                                    'validate'  => 'url'
                                ),
                            array(
                                    'id'        => 'opt-ln',
                                    'type'      => 'text',
                                    'title'     => __('LinkedIn', 'peliyn'),
                                    'desc'      => 'Enter LinkedIn page Url',
                                    'default'   => '',
                                    'validate'  => 'url'
                                ),
                            array(
                                    'id'        => 'opt-pin',
                                    'type'      => 'text',
                                    'title'     => __('Pinterest', 'peliyn'),
                                    'desc'      => 'Enter Pinterest page Url',
                                    'default'   => '',
                                    'validate'  => 'url'
                                ),
                            array(
                                    'id'        => 'opt-yout',
                                    'type'      => 'text',
                                    'title'     => __('Youtube', 'peliyn'),
                                    'desc'      => 'Enter Youtube page Url',
                                    'default'   => '',
                                    'validate'  => 'url'
                                ),
                    )
                
             );

            /*TO DO */
            //  $this->sections[] = array(
            //     'icon'      => 'el-icon-share-alt',
            //     'title'     => __('Separator', 'peliyn'),
            //     'fields'    => array(
            //             array(
            //                     'id'        => 'opt-sep1',
            //                     'type'      => 'media',
            //                     'title'     => __('About/Dishes', 'peliyn'),
            //                     'desc'      => 'Upload image to separate',
            //                     'default'   => '',
            //                     ),
            //             array(
            //                     'id'        => 'opt-septxt1',
            //                     'type'      => 'text',
            //                     'title'     => __('Separator Heading', 'peliyn'),
            //                     'desc'      => 'Upload image to separate',
            //                     'default'   => '',
            //                     ),
            //             array(
            //                     'id'        => 'opt-sep2',
            //                     'type'      => 'media',
            //                     'title'     => __('Dishes/Popular', 'peliyn'),
            //                     'desc'      => 'Upload image to separate',
            //                     'default'   => '',
            //                     ),
            //             array(
            //                     'id'        => 'opt-septxt2',
            //                     'type'      => 'text',
            //                     'title'     => __('Separator Heading', 'peliyn'),
            //                     'desc'      => 'Upload image to separate',
            //                     'default'   => '',
            //                     ),
            //             array(
            //                     'id'        => 'opt-sep3',
            //                     'type'      => 'media',
            //                     'title'     => __('Services/Gallery', 'peliyn'),
            //                     'desc'      => 'Upload image to separate',
            //                     'default'   => '',
            //                     ),
            //             array(
            //                     'id'        => 'opt-septxt3',
            //                     'type'      => 'text',
            //                     'title'     => __('Separator Heading', 'peliyn'),
            //                     'desc'      => 'Upload image to separate',
            //                     'default'   => '',
            //                     ),
            //             array(
            //                     'id'        => 'opt-sep4',
            //                     'type'      => 'media',
            //                     'title'     => __('Gallery/Reservation', 'peliyn'),
            //                     'desc'      => 'Upload image to separate',
            //                     'default'   => '',
            //                     ),
            //             array(
            //                     'id'        => 'opt-septxt4',
            //                     'type'      => 'text',
            //                     'title'     => __('Separator Heading', 'peliyn'),
            //                     'desc'      => 'Upload image to separate',
            //                     'default'   => '',
            //                     ),
            //             )
            // );
            $this->sections[] = array(
                'title'     => __('Import / Export', 'peliyn'),
                'desc'      => __('Import and Export your Redux Framework settings from file, text or URL.', 'peliyn'),
                'icon'      => 'el-icon-refresh',
                'fields'    => array(
                    array(
                        'id'            => 'opt-import-export',
                        'type'          => 'import_export',
                        'title'         => 'Import Export',
                        'subtitle'      => 'Save and restore your Redux options',
                        'full_width'    => false,
                    ),
                ),
            );                     
                    
        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'peliyn-help-tab-1',
                'title'     => __('Support', 'peliyn'),
                'content'   => __('<p>Mail to spithemes@gmail.com for immediate support.</p>', 'peliyn')
            );
        }
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.
        
            $peliyn_opt_dashicon = '<i class="el-icon-leaf" style="font-size:30px;"></i>' ;

            $this->args = array(
                'opt_name' => 'peliyn_theme_options',
                'display_name' => $peliyn_opt_dashicon.'<span style="margin-left:20px;">'.__('Peliyn - Responsive Theme','peliyn').'</span>',
                'display_version' => false,
                'page_slug' => 'peliyn_options',
                'page_title' => 'Peliyn Options',
                'update_notice' => true,
                'intro_text' => '',
                'footer_text' => '',
                'menu_type' => 'menu',
                'menu_icon' => 'dashicons-art',
                'menu_title' => 'Peliyn Options',
                'allow_sub_menu' => true,
               // 'page_parent_post_type' => 'your_post_type',
                'customizer' => true,
                'default_show' => true,
                'default_mark' => '',
                'google_api_key' => 'AIzaSyAs5dY0u8SN7BH9JqlP4KbJ7mi7XTArI7Q',
                'class' => 'peliyn-class',
                'hints' => 
                array(
                  'icon' => 'el-icon-question-sign',
                  'icon_position' => 'right',
                  'icon_size' => 'normal',
                  'tip_style' => 
                  array(
                    'color' => 'light',
                  ),
                  'tip_position' => 
                  array(
                    'my' => 'top left',
                    'at' => 'bottom right',
                  ),
                  'tip_effect' => 
                  array(
                    'show' => 
                    array(
                      'duration' => '500',
                      'event' => 'mouseover',
                    ),
                    'hide' => 
                    array(
                      'duration' => '500',
                      'event' => 'mouseleave unfocus',
                    ),
                  ),
                ),
                'output' => true,
                'output_tag' => true,
                'compiler' => true,
                'global_variable' => 'peliyn_options',
                'page_icon' => 'icon-themes',
                'page_permissions' => 'manage_options',
                'save_defaults' => true,
                'show_import_export' => true,
                'transient_time' => '3600',
                'network_sites' => true,
              );

        }

    }
    
    global $reduxConfig;
    $reduxConfig = new peliyn_Redux_Framework_config();
}

/*TO DO */
/**
*Custom function for the callback referenced above
 */
if (!function_exists('peliyn_my_custom_field')):
    function peliyn_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;

/**
* Custom function for the callback validation referenced above
*TODO
 * */
if (!function_exists('peliyn_validate_callback_function')):
    function peliyn_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';

        /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;
