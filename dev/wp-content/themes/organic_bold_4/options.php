<?php
/**
* A unique identifier is defined to store the options in the database and reference them from the theme.
* By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
* If the identifier changes, it'll appear as if the options have been reset.
*
*/

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = wp_get_theme('style.css');
	$themename = $themename['Name'];
	$themename = preg_replace("/\W/", "", strtolower($themename) );

	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);

	// echo $themename;
}

/**
* Defines an array of options that will be used to generate the settings page and be saved in the database.
* When creating the "id" fields, make sure to use all lowercase and no spaces.
*
*/

function optionsframework_options() {

	// Radio button array for columns
	$columns_array = array("one" => __("One Column Layout", 'organicthemes'),"two" => __("Two Column Layout", 'organicthemes'),"three" => __("Three Column Layout", 'organicthemes'));

	// Test data
	$test_array = array("one" => __("One", 'organicthemes'),"two" => __("Two", 'organicthemes'),"three" => __("Three", 'organicthemes'),"four" => __("Four", 'organicthemes'),"five" => __("Five", 'organicthemes'));

	// Multicheck Array
	$multicheck_array = array("one" => __("French Toast", 'organicthemes'), "two" => __("Pancake", 'organicthemes'), "three" => __("Omelette", 'organicthemes'), "four" => __("Crepe", 'organicthemes'), "five" => __("Waffle", 'organicthemes'));

	// Multicheck Defaults
	$multicheck_defaults = array("one" => "true","five" => "true");

	// Background Defaults
	$background_defaults = array('color' => '', 'image' => '', 'repeat' => 'repeat','position' => 'top center','attachment'=>'scroll');
	
	// Slider Transition Array
	$transition_array = array("1000" => __("1 Second", 'organicthemes'), "2000" => __("2 Seconds", 'organicthemes'), "4000" => __("4 Seconds", 'organicthemes'), "6000" => __("6 Seconds", 'organicthemes'), "8000" => __("8 Seconds", 'organicthemes'), "10000" => __("10 Seconds", 'organicthemes'), "12000" => __("12 Seconds", 'organicthemes'), "14000" => __("14 Seconds", 'organicthemes'), "16000" => __("16 Seconds", 'organicthemes'), "18000" => __("18 Seconds", 'organicthemes'), "20000" => __("20 Seconds", 'organicthemes'), "30000" => __("30 Seconds", 'organicthemes'), "60000" => __("1 Minute", 'organicthemes'), "999999999" => __("Hold Frame", 'organicthemes'));
	
	// Slider Transition Style Array
	$transition_style = array("fade" => __("Fade", 'organicthemes'), "slide" => __("Slide", 'organicthemes'));
	
	// Yes or No Array
	$yesno_array = array("true" => __("Yes", 'organicthemes'), "false" => __("No", 'organicthemes'));


	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Add all categories option
	$options_categories[0] = __("All Categories", 'organicthemes');

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages['false'] = __("Select a page:", 'organicthemes');
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_stylesheet_directory_uri() . '/images/';

	$options = array();
	
	$options[] = array( "name" => __("Slider", 'organicthemes'),
							"type" => "heading");
	
		$options[] = array( "name" => __("Featured Slideshow Category", 'organicthemes'),
							"desc" => __("Choose the category you wish to display in the homepage slideshow.", 'organicthemes'),
							"id" => "category_slideshow_home",
							"std" => __("Select a category:", 'organicthemes'),
							"type" => "select",
							"options" => $options_categories);
							
		$options[] = array( "name" => __("Featured Slideshow Posts To Display", 'organicthemes'),
							"desc" => __("Enter the number of posts you would like to display on the homepage slideshow.", 'organicthemes'),
							"id" => "postnumber_slideshow_home",
							"std" => "20",
							"type" => "text");
							
		$options[] = array( "name" => __("Slideshow Transition Interval", 'organicthemes'),
							"desc" => __("Choose the transition time for the slideshow. This is the time the frame is held before transitioning to the next slide.", 'organicthemes'),
							"id" => "transition_interval",
							"std" => "10000",
							"type" => "select",
							"options" => $transition_array);
							
		$options[] = array( "name" => __("Slideshow Transition Style", 'organicthemes'),
							"desc" => __("Choose the transition style for the slideshow.", 'organicthemes'),
							"id" => "transition_style",
							"std" => "slide",
							"type" => "select",
							"options" => $transition_style);

	$options[] = array( "name" => __("Homepage", 'organicthemes'),
						"type" => "heading");
						
		$options[] = array( "name" => __("Featured Posts Category", 'organicthemes'),
							"desc" => __("Choose the category you wish to display in 3 column featured post section.", 'organicthemes'),
							"id" => "category_features",
							"std" => __("Select a category:", 'organicthemes'),
							"type" => "select",
							"options" => $options_categories);
									
		$options[] = array( "name" => __("Featured Posts Displayed", 'organicthemes'),
							"desc" => __("Enter the number of posts you would like to display in the 3 column featured post section.", 'organicthemes'),
							"id" => "postnumber_features",
							"std" => "3",
							"type" => "text");
							
		$options[] = array( "name" => __("News Posts Category", 'organicthemes'),
							"desc" => __("Choose the category you wish to display in the news section.", 'organicthemes'),
							"id" => "category_news",
							"std" => __("Select a category:", 'organicthemes'),
							"type" => "select",
							"options" => $options_categories);
									
		$options[] = array( "name" => __("News Posts Displayed", 'organicthemes'),
							"desc" => __("Enter the number of posts you would like to display in the news section.", 'organicthemes'),
							"id" => "postnumber_news",
							"std" => "3",
							"type" => "text");
							
		$options[] = array( "name" => __("Display News Category Title?", 'organicthemes'),
							"desc" => __("Selecting this option will display the category title above the news section.", 'organicthemes'),
							"id" => "display_news_cat",
							"std" => "1",
							"type" => "checkbox");
							
		$options[] = array( "name" => __("Display Homepage Middle Section?", 'organicthemes'),
							"desc" => __("Selecting this option will display the 3 column featured posts in the middle section of the homepage.", 'organicthemes'),
							"id" => "display_home_mid",
							"std" => "1",
							"type" => "checkbox");
							
		$options[] = array( "name" => __("Display Homepage Bottom Section?", 'organicthemes'),
							"desc" => __("Selecting this option will display the full width featured posts in the bottom section of the homepage.", 'organicthemes'),
							"id" => "display_home_bottom",
							"std" => "1",
							"type" => "checkbox");
							
	$options[] = array( "name" => __("Layout", 'organicthemes'),
						"type" => "heading");
							
		$options[] = array( "name" => __("Display Post Featured Image or Video?", 'organicthemes'),
							"desc" => __("Selecting this option will display the featured image or video in an individual post.", 'organicthemes'),
							"id" => "display_feature_post",
							"std" => "1",
							"type" => "checkbox");
							
		$options[] = array( "name" => __("Display Slideshow Page Content?", 'organicthemes'),
							"desc" => __("Selecting this option will display the page title and body content on the slideshow page template.", 'organicthemes'),
							"id" => "display_slideshow_info",
							"std" => "1",
							"type" => "checkbox");
							
		$options[] = array( "name" => __("Enable CSS3 Full Width Background Image?", 'organicthemes'),
							"desc" => __("Enables an applied background image to stretch to the full width of the browser. Do not use with a tiled background.", 'organicthemes'),
							"id" => "background_stretch",
							"std" => "0",
							"type" => "checkbox");
							
		$options[] = array( "name" => __("Enable Responsive Layout?", 'organicthemes'),
							"desc" => __("Enables the responsive site layout for the iPhone, iPad and mobile devices.", 'organicthemes'),
							"id" => "enable_responsive",
							"std" => "1",
							"type" => "checkbox");
						
	$options[] = array( "name" => __("Blog", 'organicthemes'),
						"type" => "heading");
						
		$options[] = array( "name" => __("Blog Template Category", 'organicthemes'),
							"desc" => __("Choose the category you wish to display on the blog page template.", 'organicthemes'),
							"id" => "category_blog",
							"std" => __("Select a category:", 'organicthemes'),
							"type" => "select",
							"options" => $options_categories);
									
		$options[] = array( "name" => __("Blog Posts To Display", 'organicthemes'),
							"desc" => __("Enter the number of posts you would like to display on the blog page template.", 'organicthemes'),
							"id" => "postnumber_blog",
							"std" => "5",
							"type" => "text");
							
	$options[] = array( "name" => __("Portfolio", 'organicthemes'),
						"type" => "heading");
		
		$options[] = array( "name" => __("Portfolio Columns", 'organicthemes'),
							"id" => "portfolio_columns",
							"std" => "three",
							"type" => "radio",
							"options" => $columns_array);
							
		$options[] = array( "name" => __("Portfolio Category", 'organicthemes'),
							"desc" => __("Choose the category you wish to display on the portfolio page template. Sub-categories will be displayed as portfolio filters.", 'organicthemes'),
							"id" => "category_portfolio",
							"std" => __("Select a category:", 'organicthemes'),
							"type" => "select",
							"options" => $options_categories);
							
		$options[] = array( "name" => __("Display Portfolio Info?", 'organicthemes'),
							"desc" => __("Selecting this option will display the post title and excerpt for portfolio posts on the portfolio page template.", 'organicthemes'),
							"id" => "display_portfolio_info",
							"std" => "1",
							"type" => "checkbox");
						
	$options[] = array( "name" => __("Social", 'organicthemes'),
						"type" => "heading");
							
		$options[] = array( "name" => __("Blog Social Links", 'organicthemes'),
							"desc" => __("Selecting this option will display the social links on the blog page template. Disabling this feature may increase the blog load time.", 'organicthemes'),
							"id" => "display_social_blog",
							"std" => "1",
							"type" => "checkbox");
							
		$options[] = array( "name" => __("Post Social Links", 'organicthemes'),
							"desc" => __("Selecting this option will display the social links on the individual posts.", 'organicthemes'),
							"id" => "display_social_post",
							"std" => "1",
							"type" => "checkbox");
							
		$options[] = array( "name" => __("Twitter Name", 'organicthemes'),
							"desc" => __("Please enter your Twitter username.", 'organicthemes'),
							"id" => "twitter_user",
							"std" => __("organicthemes", 'organicthemes'),
							"type" => "text");
							
		$options[] = array( "name" => __("Facebook Page Link", 'organicthemes'),
							"desc" => __("Enter a link to your Facebook page or profile.", 'organicthemes'),
							"id" => "facebook_link",
							"std" => "",
							"type" => "text");
							
		$options[] = array( "name" => __("Twitter Account Link", 'organicthemes'),
							"desc" => __("Enter a link to your Twitter account.", 'organicthemes'),
							"id" => "twitter_link",
							"std" => "",
							"type" => "text");
							
		$options[] = array( "name" => __("LinkedIn Account Link", 'organicthemes'),
							"desc" => __("Enter a link to your LinkedIn page.", 'organicthemes'),
							"id" => "linkedin_link",
							"std" => "",
							"type" => "text");
							
		$options[] = array( "name" => __("Dribbble Page Link", 'organicthemes'),
							"desc" => __("Enter a link to your Dribbble page.", 'organicthemes'),
							"id" => "dribbble_link",
							"std" => "",
							"type" => "text");
							
		$options[] = array( "name" => __("Skype Account Link", 'organicthemes'),
							"desc" => __("Enter a link to your Skype account. (e.g. skype://MySkypeName)", 'organicthemes'),
							"id" => "skype_link",
							"std" => "",
							"type" => "text");
							
		$options[] = array( "name" => __("Google Plus Profile Link", 'organicthemes'),
							"desc" => __("Enter a link to your Google Plus page.", 'organicthemes'),
							"id" => "plus_link",
							"std" => "",
							"type" => "text");
							
		$options[] = array( "name" => __("Pinterest Profile Link", 'organicthemes'),
							"desc" => __("Enter a link to your Pinterest page.", 'organicthemes'),
							"id" => "pinterest_link",
							"std" => "",
							"type" => "text");
							
		$options[] = array( "name" => __("Github Link", 'organicthemes'),
							"desc" => __("Enter a link to your Github page.", 'organicthemes'),
							"id" => "github_link",
							"std" => "",
							"type" => "text");
							
		$options[] = array( "name" => __("Instagram Link", 'organicthemes'),
							"desc" => __("Enter a link to your Instagram page.", 'organicthemes'),
							"id" => "instagram_link",
							"std" => "",
							"type" => "text");
							
		$options[] = array( "name" => __("YouTube Link", 'organicthemes'),
							"desc" => __("Enter a link to your YouTube page.", 'organicthemes'),
							"id" => "youtube_link",
							"std" => "",
							"type" => "text");
							
		$options[] = array( "name" => __("Email Address", 'organicthemes'),
							"desc" => __("Enter your email address.", 'organicthemes'),
							"id" => "email_link",
							"std" => "",
							"type" => "text");
							
	$options[] = array( "name" => __("Colors", 'organicthemes'),
						"type" => "heading");
												
		$options[] = array( "name" => __("Link Color", 'organicthemes'),
							"desc" => __("Select the color you wish to use for the link colors.", 'organicthemes'),
							"id" => "link_color",
							"std" => "#ff6666",
							"type" => "color");
							
		$options[] = array( "name" => __("Link Hover Color", 'organicthemes'),
							"desc" => __("Select the color you wish to use for the text link hover colors.", 'organicthemes'),
							"id" => "link_hover_color",
							"std" => "#ff3333",
							"type" => "color");
							
		$options[] = array( "name" => __("Heading Link Color", 'organicthemes'),
							"desc" => __("Select the color you wish to use for the heading link colors.", 'organicthemes'),
							"id" => "heading_link_color",
							"std" => "#333333",
							"type" => "color");
							
		$options[] = array( "name" => __("Heading Link Hover Color", 'organicthemes'),
							"desc" => __("Select the color you wish to use for the heading link hover colors.", 'organicthemes'),
							"id" => "heading_link_hover_color",
							"std" => "#ff3333",
							"type" => "color");
							
		$options[] = array( "name" => __("Highlight Color", 'organicthemes'),
							"desc" => __("Select the color you wish to use for the highlight color. This refers primarily to button colors.", 'organicthemes'),
							"id" => "highlight_color",
							"std" => "#ff3333",
							"type" => "color");
						
	return $options;
}