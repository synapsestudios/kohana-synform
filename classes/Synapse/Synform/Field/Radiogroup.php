<?php defined('SYSPATH') OR die('No direct access allowed.');

class Synapse_Synform_Field_Radiogroup extends Synform_Field_Group {

	protected $_has_label = TRUE;

	protected $_options = array();

	public function add_options(array $options)
	{
		foreach ($options as $value => $name)
		{
			$this->_options[$value] = $this->radio($this->_name, $value)
				->set_attribute('name', $this->_name)
				->set_label($name);
		}
		return $this;
	}

	/**
	 * Returns an instance of an element
	 * Extends the Group version as to not append the radio value
	 *
	 * @param string $method
	 * @param array $args
	 * @return object
	 */
	public function __call($method, $args)
	{
		// Element name is always first
		array_shift($args);

		// Push the new name back onto the front of $args
		array_unshift($args, $this->_name);

		return ($this->_settings !== NULL)
			// Use the above settings object to create our element
			? $this->_settings->__call($method, $args)
			// We are creating elements without a form object
			: Synform::create_element($method, $args);
	}

	public function options()
	{
		return $this->_options;
	}
}
