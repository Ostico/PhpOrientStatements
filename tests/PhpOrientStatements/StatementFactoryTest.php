<?php

namespace PhpOrientStatements;

use PhpOrientStatements\Abstracts\TestCase;

class StatementFactoryTest extends TestCase {

    protected $db_name = 'test_statement';

    public function testPrepareStatement() {

        $factory = new StatementFactory( $this->client );

        $this->assertInstanceOf(
            'PhpOrientStatements\Statement',
            $factory->prepare( 'SELECT FROM v' )
        );
    }

    public function testQueryIsForwarded() {

        $factory = new StatementFactory( $this->client );

        $this->assertEquals( [], $factory->query( 'SELECT FROM v' ) );
    }

}
