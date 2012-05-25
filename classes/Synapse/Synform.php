<?php defined('SYSPATH') OR die('No direct access allowed.');

class Synapse_Synform {

	/**
	 * Returns an instance of a form field
	 *
	 * @param   string $field
	 * @param   array  $args
	 * @return  object
	 */
	public static function create_element($field, $args)
	{
		$element = 'Synform_Field_'.ucfirst($field);

		$class = new ReflectionClass($element);

		return $class->newInstanceArgs($args);
	}

	public static function factory($name = NULL, $group = 'default')
	{
		return new Synform($name, $group);
	}

	/**
	 * Settings for elements created by this object
	 *
	 * @var array
	 */
	protected $_settings = array();

	/**
	 * Array of message strings organized into the element name they belong to
	 * and in the group they were added as
	 *
	 * ex: $_messages['first_name']['error'] = 'required'
	 *
	 * @var array
	 */
	protected $_messages = array();

	/**
	 * Values for elements created by this object
	 *
	 * @var array
	 */
	protected $_values = array();

	protected $_elements = array();

	/**
	 * The main Form element for this form
	 *
	 * @var object
	 */
	protected $_form;
	protected $_name;

	public function __construct($name = NULL, $group = 'default')
	{
		$config = Kohana::$config->load('synform.'.$group);
		$this->_settings = array_merge($this->_settings, $config);

		// Store the name for when we create the form element in open()
		$this->_name = $name;
	}

	/**
	 * Returns an instance of an element
	 *
	 * @param string $method
	 * @param array $args
	 * @return object
	 */
	public function __call($method, $args)
	{
		$instance = self::create_element($method, $args);

		// Load settings from this form object
		$instance->load_settings($this);

		$this->_elements[] = $instance;

		return $instance;
	}

	/**
	 * Adds an array of messages into a specific group
	 *
	 * ex: add_messages('error', (array)$errors)
	 *
	 * @param string $group
	 * @param array $messages
	 * @return object
	 */
	public function add_messages($group, array $messages)
	{
		$this->_messages[$group] = Arr::merge(Arr::get($this->_messages, $group, array()), $messages);

		return $this;
	}

	/**
	 * Returns all the messages for a field or $default if it is not set
	 *
	 * @param string $path
	 * @param mixed $default
	 * @return mixed
	 */
	public function messages($path, $default = FALSE)
	{
		$messages = array();

		foreach ($this->_messages as $group => $msgs)
		{
			if (($msg = Arr::path($msgs, $path)) !== NULL)
			{
				// They should always be arrays
				$messages[$group] = (array)$msg;
			}
		}

		return (count($messages) > 0) ? $messages : $default;
	}

	/**
	 * Merges arrays into the values array
	 *
	 * ex: add_values($_POST, $user->as_array())
	 *
	 * @param array $args
	 * @return object
	 */
	public function add_values()
	{
		$args = func_get_args();

		foreach ($args as $array)
		{
			$this->_values = Arr::merge($this->_values, $array);
		}

		return $this;
	}

	/**
	 * Returns the value for a field or $default if it is not set
	 *
	 * @param string $field
	 * @param mixed $default
	 * @return mixed
	 */
	public function get_value($path, $default = FALSE)
	{
		return Arr::path($this->_values, $path, $default);
	}

	/**
	 * Sets a value into the _settings array
	 *
	 * @param string $key
	 * @param mixed $value
	 * @return void
	 */
	public function __set($key, $value)
	{
		$this->_settings[$key] = $value;
	}

	/**
	 * Sets a value into the _settings array
	 *
	 * @param string $key
	 * @param mixed $value
	 * @return self
	 */
	public function set($key, $value)
	{
		$this->__set($key, $value);

		return $this;
	}

	/**
	 * Returns a value from the _settings araay
	 *
	 * @param string $key
	 * @return mixed
	 */
	public function __get($key)
	{
		return $this->_settings[$key];
	}

	public function name()
	{
		return $this->_name;
	}

	/**
	 * Renders the view for opening a form
	 *
	 * @return View
	 */
	public function open($action = NULL, array $attributes = array())
	{
		$open = Form::open($action, $attributes);

		$this->_elements['open'] = $open;

		return $open;
	}

	/**
	 * Renders the view for opening a form (with the multipart attribute)
	 *
	 * @return View
	 */
	public function open_multipart($action = NULL, array $attributes = array())
	{
		// Set multi-part form type
		$attributes['enctype'] = 'multipart/form-data';

		return $this->open($action, $attributes);
	}

	/**
	 * Renders the view for closing a form
	 *
	 * @return string
	 */
	public function close()
	{
		$close = Form::close();

		$this->_elements['close'] = $close;

		return $close;
	}

	public function as_array()
	{
		$elements = $this->_elements;

		$data = array(
			'open'  => $elements['open'],
			'close' => $elements['close'],
		);

		unset($elements['open'], $elements['close']);

		foreach ($elements as $element)
		{
			$attributes = $element->get_attributes();

			$data[$attributes['name']] = $element->as_array();
		}

		return $data;
	}

}