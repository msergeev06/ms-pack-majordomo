<?php

namespace MSergeev\Packages\Majordomo\Lib;

use MSergeev\Core\Lib\Config;

class Functions
{
	/**
	 * Summary of sayReply
	 * @param mixed $ph        Phrase
	 * @param mixed $level     Level (default 0)
	 * @param mixed $replyto   Original request
	 * @return void
	 */
	public static function sayReply ($ph, $level = 0, $replyto='')
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/common.class.php');
		sayReply($ph, $level, $replyto);
	}

	/**
	 * Summary of sayTo
	 * @param mixed $ph        Phrase
	 * @param mixed $level     Level (default 0)
	 * @param mixed $destination  Destination terminal name
	 * @return void
	 */
	public static function sayTo ($ph, $level = 0, $destination = '')
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/common.class.php');
		sayTo($ph,$level,$destination);
	}

	/**
	 * Summary of say
	 * @param mixed $ph        Phrase
	 * @param mixed $level     Level (default 0)
	 * @param mixed $member_id Member ID (default 0)
	 * @param mixed $source    ???
	 * @return void
	 */
	public static function say ($ph, $level = 0, $member_id = 0, $source = '')
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/common.class.php');
		say($ph, $level, $member_id,$source);
	}

	/**
	 * Summary of processCommand
	 * @param mixed $command Command
	 * @return void
	 */
	public static function processCommand ($command)
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/common.class.php');
		processCommand($command);
	}

	/**
	 * Summary of timeConvert
	 * @param mixed $tm Time
	 * @return int|string
	 */
	public static function timeConvert ($tm)
	{
		$tm = trim($tm);

		if (preg_match('/^(\d+):(\d+)$/', $tm, $m))
		{
			$hour     = $m[1];
			$minute   = $m[2];
			$trueTime = mktime($hour, $minute, 0, (int)date('m'), (int)date('d'), (int)date('Y'));
		}
		elseif (preg_match('/^(\d+)$/', $tm, $m))
		{
			$trueTime = $tm;
		}
		else
		{
			$trueTime = 0;
		}

		return $trueTime;
	}

	/**
	 * Summary of timeNow
	 * @param mixed $tm time (default 0)
	 * @return string
	 */
	public static function timeNow($tm = 0)
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/common.class.php');
		return timeNow($tm);
	}

	/**
	 * Summary of isWeekEnd
	 * @return bool
	 */
	public static function isWeekEnd()
	{
		if (date('w') == 0 || date('w') == 6)
		{
			return true; // sunday, saturday
		}

		return false;
	}

	/**
	 * Summary of isWeekDay
	 * @return bool
	 */
	public static function isWeekDay()
	{
		return !self::isWeekEnd();
	}

	/**
	 * Summary of timeIs
	 * @param mixed $tm Time
	 * @return bool
	 */
	public static function timeIs($tm)
	{
		if (date('H:i') == $tm)
			return true;

		return false;
	}

	/**
	 * Summary of timeBefore
	 * @param mixed $tm Time
	 * @return bool
	 */
	public static function timeBefore($tm)
	{
		$trueTime = self::timeConvert($tm);

		if (time() <= $trueTime)
			return true;

		return false;
	}

	/**
	 * Summary of timeAfter
	 * @param mixed $tm Time
	 * @return bool
	 */
	public static function timeAfter ($tm)
	{
		$trueTime = self::timeConvert($tm);

		if (time() >= $trueTime)
			return true;

		return false;
	}

	/**
	 * Summary of timeBetween
	 * @param mixed $tm1 Time 1
	 * @param mixed $tm2 Time 2
	 * @return bool
	 */
	public static function timeBetween ($tm1, $tm2)
	{
		$trueTime1 = self::timeConvert($tm1);
		$trueTime2 = self::timeConvert($tm2);

		if ($trueTime1 > $trueTime2)
		{
			if ($trueTime2 < time())
			{
				$trueTime2 += 24 * 60 * 60;
			}
			else
			{
				$trueTime1 -= 24 * 60 * 60;
			}
		}

		if ((time() >= $trueTime1) && (time() <= $trueTime2))
			return true;

		return false;
	}

	/**
	 * Summary of addScheduledJob
	 * @param mixed $title    Title
	 * @param mixed $commands Commands
	 * @param mixed $datetime Date
	 * @param mixed $expire   Expire time (default 60)
	 * @return mixed
	 */
	public static function addScheduledJob($title, $commands, $datetime, $expire = 60)
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/common.class.php');
		return addScheduledJob($title, $commands, $datetime, $expire);
	}

	/**
	 * Summary of clearScheduledJob
	 * @param mixed $title Title
	 * @return void
	 */
	public static function clearScheduledJob($title)
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/common.class.php');
		clearScheduledJob($title);
	}

	/**
	 * Delete job from schedule
	 * @param mixed $id Job id
	 * @return void
	 */
	public static function deleteScheduledJob($id)
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/common.class.php');
		deleteScheduledJob($id);
	}

	/**
	 * Summary of setTimeOut
	 * @param mixed $title    Title
	 * @param mixed $commands Commands
	 * @param mixed $timeout  Timeout
	 * @return mixed
	 */
	public static function setTimeOut($title, $commands, $timeout)
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/common.class.php');
		return setTimeOut($title, $commands, $timeout);
	}

	/**
	 * Summary of clearTimeOut
	 * @param mixed $title Title
	 * @return void
	 */
	public static function clearTimeOut($title)
	{
		self::clearScheduledJob($title);
	}

	/**
	 * Summary of timeOutExists
	 * @param mixed $title Title
	 * @return int
	 */
	public static function timeOutExists($title)
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/common.class.php');
		return timeOutExists($title);
	}

	/**
	 * Summary of runScheduledJobs
	 * @return void
	 */
	public static function runScheduledJobs()
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/common.class.php');
		runScheduledJobs();
	}

	/**
	 * Summary of textToNumbers
	 * @param mixed $text Text
	 * @return mixed
	 */
	public static function textToNumbers($text)
	{
		return ($text);
	}

	/**
	 * Summary of recognizeTime
	 * @param mixed $text    Text
	 * @param mixed $newText New text
	 * @return array|double|int
	 */
	public static function recognizeTime($text, &$newText)
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/common.class.php');
		return recognizeTime($text, $newText);
	}

	/**
	 * Summary of registerEvent
	 * @param mixed $eventName Event name
	 * @param mixed $details   Details (default '')
	 * @param mixed $expire_in Expire time (default 365)
	 * @return mixed
	 */
	public static function registerEvent($eventName, $details = '', $expire_in = 365)
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/common.class.php');
		return registerEvent($eventName, $details, $expire_in);
	}

	/**
	 * Summary of registeredEventTime
	 * @param mixed $eventName Event name
	 * @return mixed
	 */
	public static function registeredEventTime($eventName)
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/common.class.php');
		return registeredEventTime($eventName);
	}

	/**
	 * Summary of getRandomLine
	 * @param mixed $filename File name
	 * @return mixed
	 */
	public static function getRandomLine($filename)
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/common.class.php');
		return getRandomLine($filename);
	}

	/**
	 * Summary of playSound
	 * @param mixed $filename  File name
	 * @param mixed $exclusive Exclusive (default 0)
	 * @param mixed $priority  Priority (default 0)
	 * @return void
	 */
	public static function playSound($filename, $exclusive = 0, $priority = 0)
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/common.class.php');
		playSound($filename, $exclusive, $priority);
	}

	/**
	 * Summary of playMedia
	 * @param mixed $path Path
	 * @param mixed $host Host (default 'localhost')
	 * @return int
	 */
	public static function playMedia($path, $host = 'localhost')
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/common.class.php');
		return playMedia($path, $host);
	}

	/**
	 * Summary of runScript
	 * @param mixed $id     ID
	 * @param mixed $params Params (default '')
	 * @return mixed
	 */
	public static function runScript($id, $params = '')
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/common.class.php');
		return runScript($id, $params);
	}

	/**
	 * Summary of callScript
	 * @param mixed $id     ID
	 * @param mixed $params Params (default '')
	 * @return void
	 */
	public static function callScript($id, $params = '')
	{
		self::runScript($id,$params);
	}

	/**
	 * Summary of getURL
	 * @param mixed $url      Url
	 * @param mixed $cache    Cache (default 0)
	 * @param mixed $username User name (default '')
	 * @param mixed $password Password (default '')
	 * @return mixed
	 */
	public static function getURL($url, $cache = 0, $username = '', $password = '')
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/common.class.php');
		return getURL($url, $cache, $username, $password);
	}

	/**
	 * Summary of safe_exec
	 * @param mixed $command   Command
	 * @param mixed $exclusive Exclusive (default 0)
	 * @param mixed $priority  Priority (default 0)
	 * @return mixed
	 */
	public static function safe_exec($command, $exclusive = 0, $priority = 0)
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/common.class.php');
		return safe_exec($command, $exclusive, $priority);
	}

	/**
	 * Summary of execInBackground
	 * @param mixed $cmd Command
	 * @return void
	 */
	public static function execInBackground($cmd)
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/common.class.php');
		execInBackground($cmd);
	}

	/**
	 * Summary of getFilesTree
	 * @param mixed $destination Destination
	 * @param mixed $sort        Sort (default 'name')
	 * @return array
	 */
	public static function getFilesTree($destination, $sort = 'name')
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/common.class.php');
		return getFilesTree($destination, $sort);
	}

	/**
	 * Summary of isOnline
	 * @param mixed $host Host
	 * @return int
	 */
	public static function isOnline ($host)
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/common.class.php');
		return isOnline ($host);
	}

	/**
	 * Summary of checkAccess
	 * @param mixed $object_type Object type
	 * @param mixed $object_id   Object ID
	 * @return bool
	 */
	public static function checkAccess($object_type, $object_id)
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/common.class.php');
		return checkAccess($object_type, $object_id);
	}

	/**
	 * Summary of registerError
	 * @param mixed $code    Code (default 'custom')
	 * @param mixed $details Details (default '')
	 * @return void
	 */
	public static function registerError($code = 'custom', $details = '')
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/common.class.php');
		registerError($code, $details);
	}

	/**
	 * Возвращает true если ОС - Windows
	 * @return bool
	 */
	public static function IsWindowsOS()
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/common.class.php');
		return IsWindowsOS();
	}

	/**
	 * Summary of makePayload
	 * @param mixed $data Data
	 * @return string
	 */
	public static function makePayload($data)
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/common.class.php');
		return makePayload($data);
	}

	/**
	 * Summary of HexStringToArray
	 * @param mixed $buf Buffer
	 * @return array
	 */
	public static function HexStringToArray($buf)
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/common.class.php');
		return HexStringToArray($buf);
	}

	/**
	 * Summary of HexStringToString
	 * @param mixed $buf Buf
	 * @return string
	 */
	public static function HexStringToString($buf)
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/common.class.php');
		return HexStringToString($buf);
	}

	/**
	 * Summary of binaryToString
	 * @param mixed $buf Buf
	 * @return string
	 */
	public static function binaryToString($buf)
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/common.class.php');
		return binaryToString($buf);
	}

	/**
	 * Summary of return_memory_usage
	 * @return string
	 */
	public static function return_memory_usage()
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/common.class.php');
		return return_memory_usage();
	}

	/**
	 * Summary of SendMail
	 * @param mixed $from   From
	 * @param mixed $to     To
	 * @param mixed $subj   Subject
	 * @param mixed $body   Body
	 * @param mixed $attach Attachement (default '')
	 * @return bool
	 */
	public static function SendMail($from, $to, $subj, $body, $attach = "")
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/general.class.php');
		return SendMail($from, $to, $subj, $body, $attach);
	}

	/**
	 * Summary of SendMail_HTML
	 * @param mixed $from   From
	 * @param mixed $to     To
	 * @param mixed $subj   Subject
	 * @param mixed $body   Body
	 * @param mixed $attach Attache (default '')
	 * @return bool
	 */
	public static function SendMail_HTML($from, $to, $subj, $body, $attach = "")
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/general.class.php');
		return SendMail_HTML($from, $to, $subj, $body, $attach);
	}

	/**
	 * Write Exceptions
	 * @param string $errorMessage string Exception message
	 * @param string $logLevel     exception level, default=debug
	 * @return void
	 */
	public static function DebMes($errorMessage, $logLevel = "debug")
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/general.class.php');
		DebMes($errorMessage, $logLevel);
	}

	/**
	 * Summary of addClass
	 * @param mixed $class_name   Class name
	 * @param mixed $parent_class Parent class (default '')
	 * @return mixed
	 */
	public static function addClass($class_name, $parent_class = '')
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/objects.class.php');
		return addClass($class_name, $parent_class);
	}

	/**
	 * Summary of addClassMethod
	 * @param mixed $class_name  Class method
	 * @param mixed $method_name Method name
	 * @param mixed $code        Code (default '')
	 * @return mixed
	 */
	public static function addClassMethod($class_name, $method_name, $code = '')
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/objects.class.php');
		return addClassMethod($class_name, $method_name, $code);
	}

	/**
	 * Summary of addClassProperty
	 * @param mixed $class_name    Class name
	 * @param mixed $property_name Property name
	 * @param mixed $keep_history  Flag keep history (default 0)
	 * @return mixed
	 */
	public static function addClassProperty($class_name, $property_name, $keep_history = 0)
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/objects.class.php');
		return addClassProperty($class_name, $property_name, $keep_history);
	}

	/**
	 * Summary of addClassObject
	 * @param mixed $class_name  Class name
	 * @param mixed $object_name Object name
	 * @return mixed
	 */
	public static function addClassObject($class_name, $object_name)
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/objects.class.php');
		return addClassObject($class_name, $object_name);
	}

	/**
	 * Summary of getValueIdByName
	 * @param mixed $object_name Object name
	 * @param mixed $property    Property
	 * @return int
	 */
	public static function getValueIdByName($object_name, $property)
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/objects.class.php');
		return getValueIdByName($object_name, $property);
	}

	/**
	 * Summary of addLinkedProperty
	 * @param mixed $object   Object
	 * @param mixed $property Property
	 * @param mixed $module   Module
	 * @return int
	 */
	public static function addLinkedProperty($object, $property, $module)
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/objects.class.php');
		return addLinkedProperty($object, $property, $module);
	}

	/**
	 * Summary of removeLinkedProperty
	 * @param mixed $object   Object
	 * @param mixed $property Property
	 * @param mixed $module   Module
	 * @return int
	 */
	public static function removeLinkedProperty($object, $property, $module)
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/objects.class.php');
		return removeLinkedProperty($object, $property, $module);
	}

	/**
	 * Summary of getObject
	 * @param mixed $name Object name
	 * @access public
	 * @return int|objects
	 */
	public static function getObject($name)
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/objects.class.php');
		return getObject($name);
	}

	/**
	 * Summary of getObjectsByClass
	 * @param mixed $class_name Class name
	 * @return array|int
	 */
	public static function getObjectsByClass($class_name)
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/objects.class.php');
		return getObjectsByClass($class_name);
	}

	/**
	 * Summary of getGlobal
	 * @param mixed $varname Variable name
	 * @return mixed
	 */
	public static function getGlobal($varname)
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/objects.class.php');
		return getGlobal($varname);
	}

	/**
	 * getHistoryValueId
	 *
	 * Return history value id
	 *
	 * @access public
	 */
	public static function getHistoryValueId($varname)
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/objects.class.php');
		return getHistoryValueId($varname);
	}

	/**
	 * getHistory
	 *
	 * Return history data
	 *
	 * @access public
	 */
	public static function getHistory($varname, $start_time, $stop_time = 0)
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/objects.class.php');
		return getHistory($varname, $start_time, $stop_time);
	}

	/**
	 * getHistoryMin
	 *
	 * Return history data
	 *
	 * @access public
	 */
	public static function getHistoryMin($varname, $start_time, $stop_time = 0)
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/objects.class.php');
		return getHistoryMin($varname, $start_time, $stop_time);
	}

	/**
	 * getHistoryMax
	 *
	 * Return history data
	 *
	 * @access public
	 */
	public static function getHistoryMax($varname, $start_time, $stop_time = 0)
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/objects.class.php');
		return getHistoryMax($varname, $start_time, $stop_time);
	}

	/**
	 * getHistoryCount
	 *
	 * Return history data
	 *
	 * @access public
	 */
	public static function getHistoryCount($varname, $start_time, $stop_time = 0)
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/objects.class.php');
		return getHistoryCount($varname, $start_time, $stop_time);
	}

	/**
	 * getHistorySum
	 *
	 * Return history data
	 *
	 * @access public
	 */
	public static function getHistorySum($varname, $start_time, $stop_time = 0)
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/objects.class.php');
		return getHistorySum($varname, $start_time, $stop_time);
	}

	/**
	 * getHistoryAvg
	 *
	 * Return history data
	 *
	 * @access public
	 */
	public static function getHistoryAvg($varname, $start_time, $stop_time = 0)
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/objects.class.php');
		return getHistoryAvg($varname, $start_time, $stop_time);
	}

	/**
	 * getHistoryValue
	 *
	 * Return history value
	 *
	 * @access public
	 */
	public static function getHistoryValue($varname, $time, $nerest = false)
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/objects.class.php');
		return getHistoryValue($varname, $time, $nerest);
	}

	/**
	 * Summary of setGlobal
	 * @param mixed $varname   Variable name
	 * @param mixed $value     Value
	 * @param mixed $no_linked No-Linked (default 0)
	 * @return int
	 */
	public static function setGlobal($varname, $value, $no_linked = 0)
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/objects.class.php');
		return setGlobal($varname, $value, $no_linked);
	}

	/**
	 * Summary of callMethod
	 * @param mixed $method_name Method name
	 * @param mixed $params      Params (default 0)
	 * @return mixed
	 */
	public static function callMethod($method_name, $params = 0)
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/objects.class.php');
		return callMethod($method_name, $params);
	}

	/**
	 * Summary of processTitle
	 * @param mixed $title  Title
	 * @param mixed $object Object (default 0)
	 * @return mixed
	 */
	public static function processTitle($title, $object = 0)
	{
		include_once(Config::getConfig("DOCUMENT_ROOT") . 'lib/objects.class.php');
		return processTitle($title, $object);
	}

	/**
	 * Alias for setGlobal
	 * @param mixed $varname   Variable name
	 * @param mixed $value     Value
	 * @param mixed $no_linked No-Linked (default 0)
	 * @return int
	 */
	public static function sg($varname, $value, $no_linked = 0)
	{
		return self::setGlobal($varname,$value,$no_linked);
	}

	/**
	 * Alias for getGlobal
	 * @param mixed $varname Variable name
	 * @return mixed
	 */
	public static function gg($varname)
	{
		return self::getGlobal($varname);
	}

	/**
	 * Alias for callMethod
	 * @param mixed $method_name Method name
	 * @param mixed $params      Params (default 0)
	 * @return mixed
	 */
	public static function cm($method_name, $params = 0)
	{
		return self::callMethod($method_name,$params);
	}

	/**
	 * Alias for callMethod
	 * @param mixed $method_name Method name
	 * @param mixed $params      Params (default 0)
	 * @return mixed
	 */
	public static function runMethod($method_name, $params = 0)
	{
		return self::callMethod($method_name,$params);
	}

	/**
	 * Alias for runScript
	 * @param mixed $script_id Script ID
	 * @param mixed $params    Parameters
	 * @return mixed
	 */
	public static function rs($script_id, $params = 0)
	{
		return self::runScript($script_id,$params);
	}
}