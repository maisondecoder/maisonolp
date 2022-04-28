<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function watest(){
		echo "<a href='https://wa.me/6281325389241?text=Lorem%20ipsum%20dolor%20sit%20amet,%20consectetur%20adipiscing%20elit,%20sed%20do%20eiusmod%20tempor%20incididunt%20ut%20labore%20et%20dolore%20magna%20aliqua.%20Ut%20enim%20ad%20minim%20veniam,%20quis%20nostrud%20exercitation%20ullamco%20laboris%20nisi%20ut%20aliquip%20ex%20ea%20commodo%20consequat.%20Duis%20aute%20irure%20dolor%20in%20reprehenderit%20in%20voluptate%20velit%20esse%20cillum%20dolore%20eu%20fugiat%20nulla%20pariatur.%20Excepteur%20sint%20occaecat%20cupidatat%20non%20proident,%20sunt%20in%20culpa%20qui%20officia%20deserunt%20mollit%20anim%20id%20est%20laborum.%0a%20%0a%20Sed%20ut%20perspiciatis%20unde%20omnis%20iste%20natus%20error%20sit%20voluptatem%20accusantium%20doloremque%20laudantium,%20totam%20rem%20aperiam,%20eaque%20ipsa%20quae%20ab%20illo%20inventore%20veritatis%20et%20quasi%20architecto%20beatae%20vitae%20dicta%20sunt%20explicabo.%20Nemo%20enim%20ipsam%20voluptatem%20quia%20voluptas%20sit%20aspernatur%20aut%20odit%20aut%20fugit,%20sed%20quia%20consequuntur%20magni%20dolores%20eos%20qui%20ratione%20voluptatem%20sequi%20nesciunt.%20Neque%20porro%20quisquam%20est,%20qui%20dolorem%20ipsum%20quia%20dolor%20sit%20amet,%20consectetur,%20adipisci%20velit,%20sed%20quia%20non%20numquam%20eius%20modi%20tempora%20incidunt%20ut%20labore%20et%20dolore%20magnam%20aliquam%20quaerat%20voluptatem.%20Ut%20enim%20ad%20minima%20veniam,%20quis%20nostrum%20exercitationem%20ullam%20corporis%20suscipit%20laboriosam,%20nisi%20ut%20aliquid%20ex%20ea%20commodi%20consequatur?%20Quis%20autem%20vel%20eum%20iure%20reprehenderit%20qui%20in%20ea%20voluptate%20velit%20esse%20quam%20nihil%20molestiae%20consequatur,%20vel%20illum%20qui%20dolorem%20eum%20fugiat%20quo%20voluptas%20nulla%20pariatur?' target='_blank'>Test 1</a><br>";
		echo "<a href='https://wa.me/6281325389241?text=Lorem%20ipsum%20dolor%20sit%20amet,%20consectetur%20adipiscing%20elit,%20sed%20do%20eiusmod%20tempor%20incididunt%20ut%20labore%20et%20dolore%20magna%20aliqua.%20Ut%20enim%20ad%20minim%20veniam,%20quis%20nostrud%20exercitation%20ullamco%20laboris%20nisi%20ut%20aliquip%20ex%20ea%20commodo%20consequat.%20Duis%20aute%20irure%20dolor%20in%20reprehenderit%20in%20voluptate%20velit%20esse%20cillum%20dolore%20eu%20fugiat%20nulla%20pariatur.%20Excepteur%20sint%20occaecat%20cupidatat%20non%20proident,%20sunt%20in%20culpa%20qui%20officia%20deserunt%20mollit%20anim%20id%20est%20laborum.%0a%20%0a%20Sed%20ut%20perspiciatis%20unde%20omnis%20iste%20natus%20error%20sit%20voluptatem%20accusantium%20doloremque%20laudantium,%20totam%20rem%20aperiam,%20eaque%20ipsa%20quae%20ab%20illo%20inventore%20veritatis%20et%20quasi%20architecto%20beatae%20vitae%20dicta%20sunt%20explicabo.%20Nemo%20enim%20ipsam%20voluptatem%20quia%20voluptas%20sit%20aspernatur%20aut%20odit%20aut%20fugit,%20sed%20quia%20consequuntur%20magni%20dolores%20eos%20qui%20ratione%20voluptatem%20sequi%20nesciunt.%20Neque%20porro%20quisquam%20est,%20qui%20dolorem%20ipsum%20quia%20dolor%20sit%20amet,%20consectetur,%20adipisci%20velit,%20sed%20quia%20non%20numquam%20eius%20modi%20tempora%20incidunt%20ut%20labore%20et%20dolore%20magnam%20aliquam%20quaerat%20voluptatem.%20Ut%20enim%20ad%20minima%20veniam,%20quis%20nostrum%20exercitationem%20ullam%20corporis%20suscipit%20laboriosam,%20nisi%20ut%20aliquid%20ex%20ea%20commodi%20consequatur?%20Quis%20autem%20vel%20eum%20iure%20reprehenderit%20qui%20in%20ea%20voluptate%20velit%20esse%20quam%20nihil%20molestiae%20consequatur,%20vel%20illum%20qui%20dolorem%20eum%20fugiat%20quo%20voluptas%20nulla%20pariatur?' target='_blank'>Test 2</a><br>";
	}
}
