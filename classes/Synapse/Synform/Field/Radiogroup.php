<?php defined('SYSPATH') OR die('No direct access allowed.');

class Synapse_Synform_Field_Radiogroup extends Synform_Field_Group {

	protected $_has_label = TRUE;

	protected $_options = array();

	public function __construct($name)
	{
		parent::__construct($name);
		$this->set_attribute('type', 'radiogroup');
	}

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

	public function render()
	{
		$out = '';

		$values = $this->_settings->values();
		foreach ($this->_options as $option)
		{
			if ($option->get_attribute('value') == Arr::get($values, $this->_name))
			{
				$option->set_attribute('checked', 'checked');
			}

			$option->set_value('value', $option->get_attribute('value'));
			$out .= $option->render();
		}

		return Kostache::factory($this->view())
			->set('container', $this->container())
			->set('errors', $this->errors())
			->set('help', $this->help())
			->set('input', $out)
			->set('label', $this->label())
			->set('value', $this->value())
			->render();
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
