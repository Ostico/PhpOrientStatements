<?php

namespace PhpOrientStatements;

/**
 * class Statement
 *
 * @package PhpOrientStatements
 */
class Statement
{
    // TODO: adjust the values so they are the same as in PDO
    const PARAM_STR = 0;
    const PARAM_INT = 1;
    const PARAM_BOOL = 2;
    const PARAM_NULL = 3;

    public function __construct($statement)
    {
        $this->statement = $statement;
    }

    /**
     * binds the value to the given parameter
     *
     * @param mixed
     * @param mixed
     * @param int
     * @return bool
     */
    public function bindValue($parameter, $value, $dataType = self::PARAM_STR)
    {

    }

    public function bindParam($parameter, &$variable, $dataType = self::PARAM_STR)
    {

    }

    /**
     * executes a prepared statement binding the parameters as strings
     *
     * @var array
     * @return bool
     */
    public function execute($parameters)
    {

    }
}
