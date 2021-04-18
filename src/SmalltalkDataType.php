<?php


namespace Sequeltak;


use ErrorException;
use LogicException;

/**
 * Class SmalltalkDataType
 *
 * @author Michal Tuček <michaltk1@gmail.com>
 * @package Sequeltak
 */
class SmalltalkDataType
{
    public const STRING = 'String';
    public const NUMBER = 'Number';
    public const DATE = 'Date';
    public const SET = 'Set';
    public const LIST = 'List';
    public const BAG = 'Bag';
    public const OBJECT = 'Object';

    /**
     * Formats raw SQL value into a Smalltalk compatible value.
     * @param $value<p>
     * Raw SQL value.
     * </p>
     * @param string $dataType<p>
     * Must be a constant from this class.
     * </p>
     * @return string <p>
     * Formatted value for Smalltalk.
     * </p>
     * @throws ErrorException <p>
     * When accessing non-implemented methods.
     * </p>
     * @throws LogicException <p>
     * When $dataType is not a constant from this class.
     * </p>
     */
    public static function formatValue($value, string $dataType): string
    {
        switch ($dataType) {
            case self::OBJECT:
            case self::NUMBER:
                return $value;
            case self::STRING:
                return "'" . $value . "'";
            case self::DATE:
                return self::formatDate($value);
            case self::SET:
            case self::LIST:
            case self::BAG:
                throw new ErrorException("Method not yet implemented!");
            default:
                throw new LogicException("");
        }
    }

    /**
     * Formats raw SQL date into a Smalltalk compatible value.
     * @param $value <p>
     * Raw SQL value.
     * </p>
     * @return string <p>
     * Formatted date value for Smalltalk.
     * </p>
     */
    private static function formatDate($value): string
    {
        $value = explode('-', $value);
        return "'" . $value[1] . " " . $value[2] . " " . $value[0] . "' asDate" ;
    }
}