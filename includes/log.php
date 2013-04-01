<?php
//define log level
define('GW_LOG_NONE',    0);
define('GW_LOG_FAIL',    1);
define('GW_LOG_ERROR',   2);
define('GW_LOG_WARNING', 4);
define('GW_LOG_NOTICE',  8);
define('GW_LOG_DEBUG',   16);
define('GW_LOG_ALL', GW_LOG_FAIL + GW_LOG_ERROR + GW_LOG_WARNING + GW_LOG_NOTICE+GW_LOG_DEBUG);

class Log
{
	var $level = GW_LOG_ALL;
	var $type = 'console';
	var $types = array('php', 'file', 'display', 'console');
	var $filename = '';
	var $console_javascript_loaded = false;
	var $console_javascript_onloads = array();
	
	
	function log($level = false, $type = false, $filename = false)
	{
		$this->set_level($level);
		$this->set_type($type);
		$this->set_filename($filename);
	}

	function set_level($level)
	{
		$old_level = $this->level;

		if (is_integer($level)) {
			$this->level = $level;
		}else {
			return false;
		}

		return $old_level;
	}

	function set_type($type)
	{
		$old_type = $this->type;
		$type = strtolower($type);

		if (in_array($type, $this->types)) {
			$this->type = $type;
		} else {
			return false;
		}

		return $old_type;
	}

	function set_filename($filename)
	{
		$old_filename = $this->filename;

		if (is_string($filename)) {
			$_filename = $filename;
		}else {
			return false;
		}

		if (isset($_filename) && file_exists($_filename) && is_file($_filename) && is_writable($_filename)) {
			$this->filename = $_filename;
		} else {
			return false;
		}

		return $old_filename;
	}

	function send($message = '', $level = GW_LOG_DEBUG, $type = false, $prefix = false)
	{
		
		if (($level & $this->level) === 0) {
			return;
		}

		$lines = $this->format_message($message, $level, $prefix);

		if ($type && in_array($type, $this->types)) {
			$_type = $type;
		} else {
			$_type = $this->type;
		}

		if ($level) {
			$_level = $this->get_level_from_integer($level);
		}
		$prepend = $_level . ': ';
		if ($prefix) {
			$prepend .= $prefix . ': ';
		}
		$pad = str_repeat(' ', strlen($prepend) - 2) . '| ';

		switch ($_type) {
			case 'php':
				$php_fail = false;
				if (function_exists('error_log') && is_callable('error_log')) {
					foreach ($lines as $key => $line) {
						if ($key === 0) {
							$_prepend = $prepend;
						} else {
							$_prepend = $pad;
						}
						if (!error_log($_prepend . $line, 0)) {
							$php_fail = true;
							break;
						}
					}
				} else {
					$php_fail = true;
				}

				if ($php_fail) {
					$this->send($message, $level, 'display', $prefix);
					return;
				}
				break;

			case 'file':
				$file_fail = false;

				if (!$file_handle = fopen($this->filename, 'a')) {
					$file_fail = true;
				} else {
					$_lines = array(
						'[' . date('c') . ']',
						'[client ' . $_SERVER['REMOTE_ADDR'] . ']',
						$prepend,
						join("\n", $lines)
					);
				}
				if (fwrite($file_handle, join(' ', $_lines) . "\n") === false) {
					$file_fail = true;
				}
				if ($file_handle) {
					fclose($file_handle);
				}
				if ($file_fail) {
					$this->send($message, $level, 'display', $prefix);
					return;
				}
				break;

			case 'display':
				$_lines = array();
				foreach ($lines as $key => $line) {
					if ($key === 0) {
						$_lines[] = $prepend . $line;
					} else {
						$_lines[] = $pad . $line;
					}
				}
				echo '<div class="GWlog_message GWlog_level_' . strtolower($_level) . '"><pre>' . join("\n", $_lines) . '</pre></div>' . "\n";
				break;

			case 'console':
				$_lines = array();
				foreach ($lines as $key => $line) {
					if ($key === 0 && $prefix) {
						$_lines[] = $prefix . ': ' . $line;
					} else {
						$_lines[] = $line;
					}
				}
				
				$_lines = $ident . $_level . ' ~\n' . str_replace('\'', '\\\'', join('\n', $_lines));
				
				if (!$this->console_javascript_loaded) {
					// Queue it for logging onload
					$this->console_javascript_onloads[] = array('message' => $_lines, 'level' => $level, 'time' => date('c'));
				} else {
					// Log it now
					echo '<script type="text/javascript" charset="utf-8">log_add(\'' . $this->_esc_js_log( $_lines ) . '\', ' . $this->_esc_js_log( $level ) . ', \'' . $this->_esc_js_log( date('c') ) . '\');</script>' . "\n";
				}
				break;
		}

		return true;
	}

	function get_level_from_integer($integer)
	{
		switch ($integer) {
			case GW_LOG_NONE:
				return 'GW_LOG_NONE';
				break;
			case GW_LOG_FAIL:
				return 'GW_LOG_FAIL';
				break;
			case GW_LOG_ERROR:
				return 'GW_LOG_ERROR';
				break;
			case GW_LOG_WARNING:
				return 'GW_LOG_WARNING';
				break;
			case GW_LOG_NOTICE:
				return 'GW_LOG_NOTICE';
				break;
			case GW_LOG_DEBUG:
				return 'GW_LOG_DEBUG';
				break;
			default:
				return 'GW_LOG_UNDEFINED';
				break;
		}
	}

	/**
	 * Formats a message for output to a log file
	 *
	 * @return boolean True on success, false on failure
	 */
	function format_message($message, $level = GW_LOG_DEBUG, $prefix = false, $tabs = 0)
	{
		$lines = array();
		
		if (is_null($message)) {
			$lines[] = 'null (' . var_export($message, true) . ')';
			return $lines;
		}
		
		if (is_bool($message)) {
			$lines[] = 'bool (' . var_export($message, true) . ')';
			return $lines;
		}

		if (is_string($message)) {
			if ($level === GW_LOG_DEBUG || $message === '') {
				$lines[] = 'string(' . strlen($message) . ') ("' . $message . '")';
			} else {
				$lines[] = $message;
			}
			return $lines;
		}

		if (is_array($message) || is_object($message)) {
			if (is_array($message)) {
				$lines[] = 'array(' . count($message) . ') (';
			} else {
				$lines[] = 'object(' . get_class($message) . ') (';
			}
			$tabs++;
			foreach ($message as $key => $value) {
				$array = $this->format_message($value, $level, false, $tabs);
				if (is_array($array)) {
					$array[0] = str_repeat('    ', $tabs) . $key . ' => ' . $array[0];
					$lines = array_merge($lines, $array);
				} else {
					$lines[] = str_repeat('    ', $tabs) . $key . ' => ' . $array;
				}
			}
			$tabs--;
			$lines[] = str_repeat('    ', $tabs) . ')';
			return $lines;
		}

		if (is_int($message)) {
			$lines[] = 'int (' . $message . ')';
			return $lines;
		}

		if (is_float($message)) {
			$lines[] = 'float (' . $message . ')';
			return $lines;
		}

		if (is_resource($message)) {
			$lines[] = 'resource (' . get_resource_type($message) . ')';
			return $lines;
		}

		$lines[] = 'unknown (' . $message . ')';
		return $lines;
	}

	/**
	 * Send a debug message
	 *
	 * @return boolean True on success, false on failure
	 */
	function debug($message, $prefix = false)
	{
		$this->send($message, GW_LOG_DEBUG, false, $prefix);
	}

	/**
	 * Send a notice message
	 *
	 * If the message is an array, then it sends each index as a separate message
	 *
	 * @return boolean True on success, false on failure
	 */
	function notice($message)
	{
		if (is_array($message)) {
			foreach ($message as $value) {
				$this->send($value, GW_LOG_NOTICE);
			}
		} else {
			$this->send($message, GW_LOG_NOTICE);
		}
	}

	/**
	 * Send a warning message
	 *
	 * If the message is an array, then it sends each index as a separate message
	 *
	 * @return boolean True on success, false on failure
	 */
	function warning($message)
	{
		if (is_array($message)) {
			foreach ($message as $value) {
				$this->send($value, GW_LOG_WARNING);
			}
		} else {
			$this->send($message, GW_LOG_WARNING);
		}
	}

	/**
	 * Send an error message
	 *
	 * If the message is an array, then it sends each index as a separate message
	 *
	 * @return boolean True on success, false on failure
	 */
	function error($message)
	{
		if (is_array($message)) {
			foreach ($message as $value) {
				$this->send($value, GW_LOG_ERROR);
			}
		} else {
			$this->send($message, GW_LOG_ERROR);
		}
	}

	/**
	 * Send an error message and die
	 *
	 * If the message is an array, then it sends each index as a separate message
	 *
	 * @return boolean True on success, false on failure
	 */
	function fail($message)
	{
		if (is_array($message)) {
			foreach ($message as $value) {
				$this->send($value, GW_LOG_FAIL);
			}
		} else {
			$this->send($message, GW_LOG_FAIL);
		}

		die();
	}

	/**
	 * Outputs javascript functions for the head of the html document
	 *
	 * Must be included in the head of the debug document somehow when using 'console' type.
	 *
	 * @return void
	 **/
	function console_javascript()
	{
		if ($this->type !== 'console') {
			return;
		}

		$this->console_javascript_loaded = true;
?>

	<script type="text/javascript" charset="utf-8">
		var GW_LOG_NONE    = 0;
		var GW_LOG_FAIL    = 1;
		var GW_LOG_ERROR   = 2;
		var GW_LOG_WARNING = 4;
		var GW_LOG_NOTICE  = 8;
		var GW_LOG_DEBUG   = 16;
		
		function log_send(message, level, time) {
			if (window.console) {
				// Works in later Safari and Firefox with Firebug
				switch (level) {
					case GW_LOG_NONE:
						// This shouldn't happen really
						break;
					case GW_LOG_FAIL:
					case GW_LOG_ERROR:
						window.console.error("[" + time + "] " + message);
						break;
					case GW_LOG_WARNING:
						window.console.warn("[" + time + "] " + message);
						break;
					case GW_LOG_NOTICE:
						window.console.info("[" + time + "] " + message);
						break;
					case GW_LOG_DEBUG:
						window.console.log("[" + time + "] " + message);
						break;
					default:
						break;
				}
			}
		}

		var log_queue = new Array();

		function log_add(message, level, time) {
			log_queue.push(new Array(message, level, time));
		}

		function log_process() {
			while (item = log_queue.shift()) {
			log_send(item[0], item[1], item[2]);
			}
		}

		function log_onload() {
<?php
		foreach ($this->console_javascript_onloads as $onload) {
			echo "\t\t\t" . 'log_send(\'' . $this->_esc_js_log( $onload['message'] ) . '\', ' . $this->_esc_js_log( $onload['level'] ) . ', \'' . $this->_esc_js_log( $onload['time'] ) . '\');' . "\n";
		}
?>
			log_process();
		}

		window.onload = log_onload;
	</script>

<?php
	}

	function _esc_js_log( $message )
	{
		return str_replace(
			array( '\'', "\n" ),
			array( '\\\'', '\n' ),
			$message
		);
	}
}


?>