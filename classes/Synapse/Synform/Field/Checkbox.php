<?php defined('SYSPATH') OR die('No direct access allowed.');

class Synapse_Synform_Field_Checkbox extends Synform_Element {

	protected $_options = 1;

	public function __construct($name)
	{
		parent::__construct($name);

		$this->set_attribute('type', 'checkbox');
	}

	/**
	 * Overwrites this method to check the box if $value is anything but NULL
	 *
	 * @param mixed $value
	 * @return self
	 */
	public function set_value($value)
	{
		if ($value)
		{
			$this->set_attribute('checked', 'checked');
		}

		return $this;
	}

	public function input()
	{
		return Form::checkbox($this->_attributes['name'], $this->_options, $this->value(), $this->clean_attributes());
	}

}