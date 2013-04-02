<?php defined('SYSPATH') OR die('No direct access allowed.');

class Synapse_Synform_Field_Textarea extends Synform_Element {

	public function __construct($name)
	{
		parent::__construct($name);

		$this->set_attribute('type', 'textarea')
			// Textareas should have a default rows and cols attribute
			->set_attribute('rows', '10')
			->set_attribute('cols', '50');
	}

	public function render()
	{
		// Make the value available in $object->value
		$this->value = $this->get_attribute('value', '');

		// Remove the value from the attributes
		unset($this->_attributes['value']);

		return parent::render();
	}

}
