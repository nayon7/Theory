<?php


// Theme Support //
function theory_support(){

        load_theme_textdomain('theory');
        add_theme_support('post-thumbnails');
        add_theme_support('custom-logo');
        add_theme_support('title-tag');
        add_theme_support('html5',array('search form','comment-list'));
        add_theme_support('post-formats',array('image','gallery','video'));

          register_nav_menus( array(
                  'primary' => __( 'Primary Menu',      'theory_support' ),
                  'social'  => __( 'Social Links Menu', 'theory_support' ),
          ) );
  }

add_action('after_setup_theme','theory_support');

//shortCode filtaring area

add_filter('widget_text','do_shortcode');


// All Enqueue Files //

function theory_theme(){



        wp_enqueue_style("theory-css",get_theme_file_uri("/assets/css/main.css"),null,"2.0");
        wp_enqueue_style("theory-style",get_stylesheet_uri(),null,"2.0");

        wp_enqueue_script("theoryu-modernizr",get_theme_file_uri("/assets/js/skel.min.js"),array("jquery"),null,"2.0",true);
        wp_enqueue_script("theory-plugins",get_theme_file_uri("/assets/js/util.js"),array("jquery"),null,"2.0",true);
        wp_enqueue_script("theory-main-js",get_theme_file_uri("/assets/js/main.js"),array("jquery"),null,"2.0",true);


}
add_action("wp_enqueue_scripts","theory_theme");


// Register Custom Post Type  For Slider//

function theory_theme_custom_post() {
      register_post_type( 'banner',
        array(
            'labels' => array(
                'name' => __( 'banners' ),
                'singular_name' => __( 'banner' )
            ),
            'supports' => array('title', 'editor', 'custom-fields', 'thumbnail', 'page-attributes'),
            'public' => false,
            'show_ui' => true
        )
    );
      register_post_type( 'service',
        array(
            'labels' => array(
                'name' => __( 'services' ),
                'singular_name' => __( 'service' )
            ),
            'supports' => array('title', 'editor', 'custom-fields', 'thumbnail', 'page-attributes'),
            'public' => false,
            'show_ui' => true
        )
    );
      register_post_type( 'testimonial',
        array(
            'labels' => array(
                'name' => __( 'testimonials' ),
                'singular_name' => __( 'testimonial' )
            ),
            'supports' => array('title', 'editor', 'custom-fields', 'thumbnail', 'page-attributes'),
            'public' => false,
            'show_ui' => true
        )
    );
      register_post_type( 'postsection',
        array(
            'labels' => array(
                'name' => __( 'postsections' ),
                'singular_name' => __( 'postsection' )
            ),
            'supports' => array('title', 'editor', 'custom-fields', 'thumbnail', 'page-attributes'),
            'public' => false,
            'show_ui' => true
        )
    );
}


add_action( 'init', 'theory_theme_custom_post' );

//this is a Widget Area
function theory_widget(){
      register_sidebar (array(
            'name'       =>__('Right Sidebar','theory'),
            'id'         =>   'sidebar',
            'description'=>__('this is a sidebar','theory'),
            'before_widget'=> '<div id="%1$s" class="widget "%2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' =>  '</h2>',

          ));

      register_sidebar (array(
            'name'       =>__('Footer Sidebar','theory'),
            'id'         =>   'footer1',
            'description'=>__('this is a Footer','theory'),
            'before_widget'=> '<li id="%1$s" class="widget %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' =>  '</h2>',

          ));

      register_sidebar (array(
            'name'       =>__('Footer Bottom','theory'),
            'id'         =>   'footer2',
            'description'=>__('this is a Footer','theory'),
            'before_widget'=> '<li id="%1$s" class="widget %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' =>  '</h2>',

          ));

      register_sidebar (array(
            'name'       =>__('Footer Bottom','theory'),
            'id'         =>   'footer3',
            'description'=>__('this is a Footer','theory'),
            'before_widget'=> '<section>',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' =>  '</h2>',

          ));

      register_sidebar (array(
            'name'       =>__('Footer Bottom','theory'),
            'id'         =>   'footer4',
            'description'=>__('this is a Footer','theory'),
            'before_widget'=> '<section>',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' =>  '</h2>',

          ));


}
add_action('widgets_init','theory_widget');

//This is a Shortcode Area

function thumbpost_shortcode($atts){
    extract( shortcode_atts( array(
        'count' => '3',
    ), $atts) );

    $q = new WP_Query(
        array('posts_per_page' => $count, 'post_type' => 'post',)
        );

    $list = '<ul>';
    while($q->have_posts()) : $q->the_post();
        $idd = get_the_ID();
        $list .= '
        <li>
            '.get_the_post_thumbnail($idd, 'thumbnail').'
            <p><a href="'.get_permalink().'">'.get_the_title().'</a></p>
            <span>'.get_the_date('d F Y', $idd).'</span>
        </li>
        ';
    endwhile;
    $list.= '</ul>';
    wp_reset_query();
    return $list;
}
add_shortcode('thumb_posts', 'thumbpost_shortcode');




function theory_pagination(){
  global $wp_query;
  $links = paginate_links(array(
        'current'     =>  max(1,get_query_var('paged')),
        'total'       =>  $wp_query->max_num_pages,
        'type'        =>  'list'
  ));

  $links  =  str_replace("page-numbers","justify-content-between pagination",$links);
  echo $links;

}


function theory_search_form($form){

  $homedir      =  home_url("/");
  $newform      =  <<<FORM
  <form class = "form-inline ml-auto" action= "{$homedir}" method="get">
        <input class="form-control border-0 " type="search" placeholder="write something">
  </form>

FORM;
      return $newform;
}

add_filter("get_search_form","theory_search_form");




function create_header_hook(){
        register_post_type( 'theory_product',
          array(
            'labels' => array(
              'name' =>__('products'),
              'singular_name'=>__('product'),
                'all_items'           => __( 'All Movies', 'theory'),
                'show_in_nav_menu'    => true,

            ),
            'public'  => true,
            'has_archive'=>true,
            'show_ui'   => true,
            'supports'  => array('thumbnail','editor','title','excerpt'),
            'menu_position' => 5,
          )
      );
}




add_action("init","create_header_hook");


/*

class simple_widget extends WP_widget
{

  function __construct()
  {
    parent::__construct(
      'sipmle',
      esc_html__('simple widget'),
      array(
            'description'     =>  esc_html__('this is a simple widget','theory'),
      )
    );
  }
  public function widget ($args,$instance){
    echo $args['before_widget'];
    if (!empty($instance['title'])) {
       echo $args['before_title']. apply_filters('widget_title',$instance['title']).$args['after_title'];
    }?>
      <p><?php echo $instance ['name']; ?></p>
    <?php
    echo $args ['after_widget'];
  }
  Public function form($instance){
      $title = !empty($instance['title'])? $instance['title']: esc_html__('Title','theory');
      $name = !empty($instance['name'])? $instance['name']: esc_html__('Name','theory');?>
      <p>

          <label for="<?php echo esc_attr($this->get_field_id('title')) ?>">
            <?  php esc_attr_e('Title','theory'); ?>
          </label>
          <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('title')) ?>" name="<?php echo esc_attr($this->get_field_name('title')) ?>" value="<?php echo esc_attr($title) ?>">
      </p>
      <p>

          <label for="<?php echo esc_attr($this->get_field_id('name')) ?>">
            <?  php esc_attr_e('Name','theory'); ?>
          </label>
          <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('name')) ?>" name="<?php echo esc_attr($this->get_field_name('name')) ?>" value="<?php echo esc_attr($name) ?>">
      </p>

<?php
  }

  public function update($new_instance,$old_instance){
    $instance = array();
    $instance['title'] = (!empty($new_instance['title']))? strip_tags($new_instance['title']):'';
    $instance['name'] = (!empty($new_instance['name']))? strip_tags($new_instance['name']):'';

    return $instance;
  }

}




function theory_widget_area(){
      register_widget('simple_widget');
}


add_action("widgets_init","theory_widget_area");

*/

class My_Widget extends WP_Widget {


	public function __construct() {

		parent::__construct( 'my_widget', __('My Widget','theory'),array(
              'name'            =>  'hello widget',
              'description'     =>  'this is a Text Widget',
    ));
	}


  public function widget($args, $instance){

      echo $args['before_widget'].$args['before_title']."Amader Widget".$args['after_title'].$args['after_widget'];

  }

  public function form($instance){
 ?>

        <p>
          <label for=""> <input type="text" name="" value=""> </label>
        </p>

 <?php }

  public function update($new_instance,$old_instance){

  }


}


function My_Widget(){
 register_widget( 'My_Widget' );

}


add_action( 'widgets_init','My_Widget');


function shortcode_area($attr){


      return sprintf ('<button type ="button" class="btn btn-%s">%s</button>',
          $attr['type'],
          $attr['content']
    );

      return sprintf ('<button type ="button" class="btn btn-%s">%s</button>',
          $attr['type'],
          $attr['content']
    );

}
add_shortcode('button','shortcode_area');

function shortcode_areas($attr,$content='theory'){
            $ami = array(
                'type'    => 'primary',
                'title'   =>__("button","theory")
            );

            $button_attr = shortcode_atts($ami,$attr);



      return sprintf ('<button type ="button" class="btn btn-%s">%s</button>',
            $button_attr['type'],
              $content
    );

}



add_shortcode('buttons','shortcode_areas');






function theorydon($attr,$content){

        $tumi = array(
            'type'    => 'danger',
            'title'   =>__("bugfat","theory")
        );

        $button_attr = shortcode_atts($tumi,$attr);

        return sprintf('<button type="button" class="btn btn-%s">%s</button>',
          $button_attr['type'],
          do_shortcode($content)
      );

}

add_shortcode('bugfat','theorydon');


function theory($attr,$content){
      return strtoupper(do_shortcode($content));
}

add_shortcode('hello','theory');


function theory_maps($attr){
        $def = array(
            'width'     => '300',
            'height'    => '200',
            'place'     => 'bogra',

        );
        $maps_att = shortcode_atts($def,$attr);

        $maps = <<<EOD

        <div>
              <div>
                    <iframe width="{$maps_att['width']}" height="{$maps_att['height']}" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                    src="https://maps.google.com/maps?q={$maps_att['place']}&amp;ie=UTF8&amp;&amp;output=embed"></iframe><br />
              </div>
        </div>

EOD;


return $maps;
}

add_shortcode('maps','theory_maps');




function gmap(){
        vc_map(array(
              'name'                      =>      __('G map','theory'),
              'description'               =>      __('This is for G maps', 'theory'),
              'base'                      =>        'maps',
              'icon'                      =>        'fa fa-map',
              'show_settings_on_create'   =>        true,
              'category'                  =>      __('content','theory'),
              'params'                    =>      array(
                    array(
                        'type'            =>      'textfield',
                        'holder'          =>      'iframe',
                        'admin_label'     =>      true,
                        'heading'         =>    __('Location Name','theory'),
                        'param_name'      =>      'place',
                    ),
                    array(
                        'type'            =>      'textfield',
                        'holder'          =>      'iframe',
                        'admin_label'     =>      true,
                        'heading'         =>    __('width','theory'),
                        'param_name'      =>      'width',
                    ),
                    array(
                        'type'            =>      'textfield',
                        'holder'          =>      'iframe',
                        'admin_label'     =>      true,
                        'heading'         =>    __('height','theory'),
                        'param_name'      =>      'height',
                    ),

              ),
        ));

}

add_action('vc_before_init','gmap');





  if ( !class_exists( 'redux-framework' ) && file_exists( dirname( __FILE__ ) . '/redux-framework/ReduxCore/framework.php' ) ) {
    require_once( dirname( __FILE__ ) . '/redux-framework/ReduxCore/framework.php' );
  }
  if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/redux-framework/sample/function-config.php' ) ) {
    require_once( dirname( __FILE__ ) . '/redux-framework/sample/function-config.php' );
  }


// start elementor section


class ElementorCustomElement{
    private static $instance = null;
    public static  function get_instance(){
        if(!self::$instance)
            self::$instance = new self;
              return self::$instance;
    }

    public function init(){
      add_action('elementor/widgets/widgets_registered',array($this,'widgets_registered'));
    }

      public function widgets_registered(){
        if(defined('ELEMENTOR_PATH') && class_exists('elementor\Widget_Base')){
                  $widget_file = get_template_directory().'/lib/custom_widget.php';
                  $template_file =   locate_template($widget_file);
                    if (!$template_file || !is_readable($template_file)){
                      $template_file = get_template_directory().'/lib/custom_widget.php';
                    }
                    if($template_file && is_readable($template_file)){
                        require_once $template_file;
                    }

        }
      }

}
ElementorCustomElement::get_instance()->init();
