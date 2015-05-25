<?php

namespace PhpOrientStatements;

use PhpOrient\PhpOrient;

/**
 * Class StatementFactory
 *
 * @package PhpOrientStatements
 */
class StatementFactory {
    /**
     * The client that manages database connection
     *
     * @var PhpOrient
     */
    private $client;

    public function __construct( PhpOrient $client ) {
        $this->client = $client;
    }

    /**
     * returns a prepared statement
     *
     * @var string
     * @return Statement
     */
    public function prepare( $statement ) {
        $preparedStatement = new Statement( $statement );

        return $preparedStatement;
    }

    //every method non defined by this class, we pass it to the normal client
    public function __call( $method, $args ) {
        return $this->client->$method( $args );
//        return call_user_func_array( [ $this->client, $method ], $args );
    }
}
