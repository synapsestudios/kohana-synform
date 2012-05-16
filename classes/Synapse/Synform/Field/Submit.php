<?php defined('SYSPATH') OR die('No direct access allowed.');

class Synapse_Synform_Field_Submit extends Synapse_Synform_Element {

	protected $_view = 'button/submit';

	public function __construct($name)
	{
		parent::__construct($name);

		$this->set_attribute('type', 'submit');
	}

}
