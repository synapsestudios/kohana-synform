<?php defined('SYSPATH') OR die('No direct access allowed.');

class Synapse_Synform_Field_Text extends Synform_Element {

	public function __construct($name)
	{
		parent::__construct($name);

		$this->set_attribute('type', 'text');
	}

	public function input()
	{
		return Form::input($this->_attributes['name'], $this->value(), $this->clean_attributes());
	}
}
