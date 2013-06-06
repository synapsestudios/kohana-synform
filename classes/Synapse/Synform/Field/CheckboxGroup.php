<?php defined('SYSPATH') OR die('No direct access allowed.');

class Synapse_Synform_Field_CheckboxGroup extends Synform_Field_Group {

	protected $_has_label = TRUE;

	protected $_options = array();

	public function __construct($name)
	{
		parent::__construct($name);

		$this->set_attribute('type', 'checkboxGroup');
	}

	public function add_options(array $options)
	{
		foreach ($options as $value => $name)
		{
			$this->_options[$value] = $this->checkbox($value)
				->set_label($name);
		}
		return $this;
	}

	public function options()
	{
		return $this->_options;
	}

	public function render()
	{
		$out = '';
		foreach ($this->_options as $option)
		{
			$out .= $option->render();
		}
		return $out;
	}
}
