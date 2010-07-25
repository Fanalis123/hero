<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
* Blog Module
*
* Displays a blog
*
* @author Electric Function, Inc.
* @copyright Electric Function, Inc.
* @package Electric Publisher
*
*/

class Blog extends Front_Controller {
	function __construct() {
		parent::__construct();
	}
	
	function view ($url_path) {
		$this->load->model('blogs/blog_model');
		
		$blog_id = $this->blog_model->get_blog_id($url_path);
		
		$blog = $this->blog_model->get_blog($blog_id);
		
		if (empty($blog_id) or empty($blog)) {
			return show_404($url_path);
		}
		
		// get blog
		$content = $this->blog_model->get_blog_content($blog_id);
		
		if (empty($content)) {
			return show_404($url_path);
		}
		
		// show content
		$this->smarty->assign('content',$content);
		$this->smarty->assign($blog);
		
		return $this->smarty->display($blog['template']);
	}
}