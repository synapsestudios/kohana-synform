<?php defined('SYSPATH') OR die('No direct access allowed.');

class Synapse_Synform_Field_Submit extends Synform_Element {

	protected $_view = 'Button';

	public function __construct($name)
	{
		parent::__construct($name);

		$this->set_attribute('type', 'submit');
	}

	public function input()
	{
		return Form::button($this->_attributes['name'], $this->get_label(), $this->clean_attributes());
	}
}
