<?php

namespace PhpOrientStatements;

use PhpOrientStatements\Abstracts\TestCase;

class StatementTest extends TestCase {

    protected $db_name = 'test_statement';

    private $mockClient;

    public function setUp() {
        parent::setUp();

        $this->mockClient = \Mockery::mock('\PhpOrient\PhpOrient');
    }

    public function testExecuteWithoutBindings() {
        $factory = new StatementFactory( $this->mockClient );

        $query = 'SELECT FROM v';

        $statement = $factory->prepare( $query );

        $this->mockClient->shouldReceive( 'query' )->once()->with( $query );

        $statement->execute();
    }

    public function testExecuteWithParamBinding() {
        $factory = new StatementFactory( $this->mockClient );

        $statement = $factory->prepare( 'SELECT FROM v WHERE param = ?' );

        $this->mockClient->shouldReceive( 'query' )->once()
            ->with( 'SELECT FROM v WHERE param = 42' );

        $statement->execute([42]);
    }
}
