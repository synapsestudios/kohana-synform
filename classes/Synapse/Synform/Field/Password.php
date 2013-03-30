<?php defined('SYSPATH') OR die('No direct access allowed.');

class Synapse_Synform_Field_Password extends Synform_Element {

	public function __construct($name)
	{
		parent::__construct($name);

		$this->set_attribute('type', 'password');
	}

}