<?php defined('SYSPATH') OR die('No direct access allowed.');

class Synapse_Synform_Field_Radio extends Synform_Element {

	protected $_options;

	public function __construct($name, $value)
	{
		parent::__construct($name);

		// The path is a little different for radio buttons
		$this->_path = preg_replace('#\[([^\[\]]++)\]#', '.\1', $name.'.'.$value);

		$this->set_attribute('type', 'radio')
			->set_attribute('value', $value)
			->set_attribute('id', $this->get_attribute('id').'_'.$value);
	}

	/**
	 * Overwrites this method to check the box if $value is anything but NULL
	 *
	 * @param mixed $value
	 * @return self
	 */
	public function set_value($value)
	{
		$this_radio = $this->get_attribute('value', NULL);

		if ($this_radio !== NULL AND (string)$value === (string)$this_radio)
		{
			$this->set_attribute('checked', 'checked');
		}

		return $this;
	}

	public function input()
	{
		return Form::radio($this->_attributes['name'], $this->_attributes['value'], NULL, $this->clean_attributes());
	}

	public function label()
	{
		$label = $this->get_label();

		if ($required = Arr::get($this->_object, 'required'))
		{
			$label = $label.($required === TRUE ? '<span class="required">*</span>' : $required);
		}

		return Form::label($this->clean_name().'_'.$this->get_attribute('value'), $label);
	}

}