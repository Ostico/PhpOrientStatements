<?php

namespace PhpOrientStatements;

use PhpOrient\PhpOrient;

/**
 * class Statement
 *
 * @package PhpOrientStatements
 */
class Statement {

    const PARAM_NULL = 0;
    const PARAM_INT  = 1;
    const PARAM_STR  = 2;
    const PARAM_LOB  = 3;
    const PARAM_STMT = 4; //Represents a recordset type. We could use to map Orient document objects
    const PARAM_BOOL = 5;

    /**
     * Allows completely customize the way data is treated on the fly
     * (only valid inside PDOStatement::fetchAll()).
     * @see: http://php.net/manual/en/pdo.constants.php
     */
    const FETCH_FUNC = 10;

    /**
     * @var PhpOrient
     */
    private $client;

    /**
     * @var string
     */
    private $statement;

    public function __construct( $client, $statement ) {
        $this->client = $client;
        $this->statement = $statement;
    }

    /**
     * binds the value to the given parameter
     *
     * @param mixed
     * @param mixed
     * @param int
     *
     * @return bool
     */
    public function bindValue( $parameter, $value, $dataType = self::PARAM_STR ) {

    }

    public function bindParam( $parameter, &$variable, $dataType = self::PARAM_STR ) {

    }

    /**
     * executes a prepared statement binding the parameters as strings
     *
     * @var array
     * @return bool
     */
    public function execute( array $parameters = [] ) {
        $this->client->query($this->statement);
    }
}
