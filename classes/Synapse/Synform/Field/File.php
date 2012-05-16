<?php defined('SYSPATH') OR die('No direct access allowed.');

class Synapse_Synform_Field_File extends Synform_Element {

	protected $_view = 'input/upload';

	public function __construct($name)
	{
		parent::__construct($name);

		$this->set_attribute('type', 'file');
	}

	public function input()
	{
		return Form::file($this->_attributes['name'], $this->_attributes);
	}

}