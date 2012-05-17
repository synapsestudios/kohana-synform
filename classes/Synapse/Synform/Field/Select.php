<?php defined('SYSPATH') OR die('No direct access allowed.');

class Synapse_Synform_Field_Select extends Synform_Element {

	protected $_has_label = TRUE;

	protected $_view = 'choice/select';

	protected $_options = array();
	protected $_option_attributes = array();

	protected $_settings;

	public function __construct($name)
	{
		parent::__construct($name);

		$this->_attributes['type'] = 'select';
	}

	public function add_option($value, $name, array $attributes = array())
	{
		$this->_options[$value] = $name;
		$this->_option_attributes[$value] = $attributes;

		return $this;
	}

	public function add_options(array $options)
	{
		foreach ($options as $value => $name)
		{
			$this->add_option($value, $name);
		}
		return $this;
	}

	public function options()
	{
		return $this->_options;
	}

	public function option_attributes($value)
	{
		return Arr::get($this->_option_attributes, $value, array());
	}

	public function input()
	{
		return Form::select($this->_attributes['name'], $this->_options, Arr::get($this->_attributes, 'value'), $this->_attributes);
	}

}
