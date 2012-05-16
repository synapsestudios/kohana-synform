<?php defined('SYSPATH') OR die('No direct access allowed.');

class Synapse_Synform_Field_Password extends Synapse_Synform_Element {

	protected $_view = 'input/password';

	public function __construct($name)
	{
		parent::__construct($name);

		$this->set_attribute('type', 'password');
	}

}