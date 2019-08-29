<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Pho2u
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function pho2u_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'pho2u_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function pho2u_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'pho2u_pingback_header' );

/** 
 * Add meta box for page intro
 */
 function pho2u_meta_boxes() {
    	add_meta_box(
    		'pho2u_meta_boxes', // $id
    		'Pho2u!', // $title
    		'show_pho2u_meta_boxes', // $callback
    		null, // $screen
    		'normal', // $context
    		'high' // $priority
    	);
    }
    add_action( 'add_meta_boxes', 'pho2u_meta_boxes' );
	
	function show_pho2u_meta_boxes() {
    	global $post;
    	$meta = get_post_meta( $post->ID, 'pho2u_fields', true ); ?>

    	<input type="hidden" name="pho2u_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">
		<p>
    	<label for="pho2u_fields[page_subtitle]">Subtitle</label>
    	<br>
    	<input name="pho2u_fields[page_subtitle]" id="pho2u_fields[page_subtitle]" style="width:500px;" value="<?php  if (is_array($meta) && isset($meta['page_subtitle'])){ echo $meta['page_subtitle']; } ?>" />
		</p>
        <p>
    	<label for="pho2u_fields[page_intro]">Intro Text</label>
    	<br>
    	<textarea name="pho2u_fields[page_intro]" id="pho2u_fields[page_intro]" rows="5" cols="30" style="width:500px;"><?php  if (is_array($meta) && isset($meta['page_intro'])){ echo $meta['page_intro']; } ?></textarea>
		</p>
		
		<script>
    jQuery(document).ready(function ($) {
      // Instantiates the variable that holds the media library frame.
      var meta_image_frame;
      // Runs when the image button is clicked.
      $('.image-upload').click(function (e) {
        // Get preview pane
        var meta_image_preview = $(this).parent().parent().children('.image-preview');
        // Prevents the default action from occuring.
        e.preventDefault();
        var meta_image = $(this).parent().children('.meta-image');
        // If the frame already exists, re-open it.
        if (meta_image_frame) {
          meta_image_frame.open();
          return;
        }
        // Sets up the media library frame
        meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
          title: meta_image.title,
          button: {
            text: meta_image.button
          }
        });
        // Runs when an image is selected.
        meta_image_frame.on('select', function () {
          // Grabs the attachment selection and creates a JSON representation of the model.
          var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
          // Sends the attachment URL to our custom image input field.
          meta_image.val(media_attachment.url);
          meta_image_preview.children('img').attr('src', media_attachment.url);
        });
        // Opens the media library frame.
        meta_image_frame.open();
      });
    });
  </script>

    	<?php }
		
	function save_pho2u_meta_boxes( $post_id ) {
    	// verify nonce
    	if ( !wp_verify_nonce( $_POST['pho2u_meta_box_nonce'], basename(__FILE__) ) ) {
    		return $post_id;
    	}
    	// check autosave
    	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    		return $post_id;
    	}
    	// check permissions
    	if ( 'page' === $_POST['post_type'] ) {
    		if ( !current_user_can( 'edit_page', $post_id ) ) {
    			return $post_id;
    		} elseif ( !current_user_can( 'edit_post', $post_id ) ) {
    			return $post_id;
    		}
    	}

    	$old = get_post_meta( $post_id, 'pho2u_fields', true );
    	$new = $_POST['pho2u_fields'];

    	if ( $new && $new !== $old ) {
    		update_post_meta( $post_id, 'pho2u_fields', $new );
    	} elseif ( '' === $new && $old ) {
    		delete_post_meta( $post_id, 'pho2u_fields', $old );
    	}
    }
    add_action( 'save_post', 'save_pho2u_meta_boxes' );

/**
 * Custom walkers - specifically for social and navigation menus
 */
 class pho2u_walker extends Walker_Nav_Menu {

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent\n";
	}
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent\n";
	}
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		if (in_array("current-menu-item", $classes))
		{
			$class_names = "active";
		} else {
			$class_names = "";
		}
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
		$output .= $indent . '';
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .' class="item ' . $class_names . '">';
		
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		
	}
	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$output .= "\n";
	}
}

class pho2u_walker_hidefirst extends Walker_Nav_Menu {
	private $count = 0;

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent\n";
	}
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent\n";
	}
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		// $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
		$output .= $indent . '';
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		
		$item_output = $args->before;
		if ($count==0) {  // if we are in submenu and items count is 1...
			$item_output .= '<div class="right computer only column ' . esc_attr( $class_names ) . '"><a'. $attributes .'>';
        } else {
			$item_output .= '<div class="column ' . esc_attr( $class_names ) . '"><a'. $attributes .'>';
		}
		
		
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a></div>';
		$item_output .= $args->after;
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		
		$count++;
	}
	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$output .= "\n";
	}
}

class pho2u_walker_right extends Walker_Nav_Menu {
	private $count = 0;

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent\n";
	}
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent\n";
	}
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		if (in_array("current-menu-item", $classes))
		{
			$class_names = "active";
		} else {
			$class_names = "";
		}
		// $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
		$output .= $indent . '';
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		
		$item_output = $args->before;
		if ($count==0) {  // if we are in submenu and items count is 1...
			$item_output .= '<div class="item ' . esc_attr( $class_names ) . '"><a'. $attributes .'>';
        } else {
			$item_output .= '<div class="item ' . esc_attr( $class_names ) . '"><a'. $attributes .'>';
		}
		
		
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a></div>';
		$item_output .= $args->after;
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		
		$count++;
	}
	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$output .= "\n";
	}
}
