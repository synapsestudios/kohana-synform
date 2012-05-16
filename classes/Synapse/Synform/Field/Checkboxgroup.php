<?php defined('SYSPATH') OR die('No direct access allowed.');

class Synapse_Synform_Field_CheckboxGroup extends Synapse_Synform_Field_Group {

	protected $_has_label = TRUE;

	protected $_view = 'choice/checkboxGroup';

	protected $_options = array();

	protected $_settings;

	public function __construct($name)
	{
		parent::__construct($name);
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

}