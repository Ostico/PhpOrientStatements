# PhpOrientStatements

> This project is a META-Project using the RDD (Readme Driven Development) process.

An attempt to create Prepared Statements to be used with the PhpOrient library

## Installation

To install the most recent version of the library just type

    git clone git@github.com:Ostico/PhpOrientStatements.git

then enter the directory `PhpOrientStatements` and run

    php composer.phar install

to install the dependencies of the project

## Usage

### Client initialization

To initialize the client we first need to instantiate a `PhpOrient` client and pass it as a dependency

```php
$client = new PhpOrient( 'localhost', 2424 );
$client->username = 'root';
$client->password = 'root_pass';

//The prepare method will be put inside PhpOrient so, for now we make it a simple Factory
//TODO: remove and place inside PhpOrient Client itself
//Ex:
//$preparedStatement = $client->prepare( 'select from :name' );
//
$preparedClient = new StatementFactory( $client );
```

### Create a prepared statement

To create a new prepared statement, we can use both question marks or the name placeholders

```php
$questionSql = 'select from Users where name = ? and age > ?';
$questionStatement = $preparedClient->prepare( $questionSql );

$nameSql = 'select from Users where name = :name and age > :age';
$nameStatement = $preparedClient->prepare( $nameSql );
```

Bind values and parameters

Then, to bind a value to the parameter

```php
$questionStatement->bindValue( 1, 'John' );
$questionStatement->bindValue( 2, 18, Statement::PARAM_INT );
```

or, with named placeholders

```php
$nameStatement->bindValue( 'name', 'John', Statement::PARAM_STR );
$nameStatement->bindValue( 'age', 18, Statement::PARAM_INT );
```
As a third optional parameter you can pass to `bindValue` the type of the value that need to be bounded, using the `Statement::PARAM_*` constants.

Alternatively, you can bind a variable to the parameter. It will be passed by reference and evaluated only when the statement is executed. As a third option parameter you can specity the type of the variable that you are binding.

```php
$questionStatement->bindParam( 1, $name, Statement::PARAM_STR );
$questionStatement->bindParam( 2, $age, Statement::PARAM_INT );

$nameStatement->bindParam( 'name', $name );
$nameStatement->bindParam( 'age', $age, Statement::PARAM_INT );

$name = 'John';
$age = 18;
```

### Execute prepared statements

To execute the prepared statement you could use

```php
$nameStatement->execute()
```

It returns a boolean that indicated whether the query executed without errors.

If you did not binded all the question mark or named placeholders in your statement, you can do it we you execute the statement passing an associative array as an input to the `execute` method

```php
$statement->execute([
    'name' => 'John',
    'age' => 18
]);
```

In this case every binded value will be treated as a `Statement::PARAM_STR`.

### Fetch results

Eventually, to fetch the results, we have various options.

The method `fetchColumn` allows us to retrieve the value of a column from the next row of a result set. It returns `false` if there are no more rows.

```php
if ( $preparedStatement->execute() ) {
    // returns the value of the first column of the next row in the result set
    $value = $statement->fetchColumn(0);
}
```

Notice than `fetchColumn` should not be used to retrieve boolean columns, as it is impossible to distinguish a value of `false` from there being no more rows to retrieve. Use `fetch` instead.

The method `fetch` fetches the next row from a result set.



The method `fetchAll` returns an array containing all the rows of a result set

```php
if ( $preparedStatement->execute() ) {
    /**
     * @var $resultSet \PhpOrient\Protocols\Binary\Data\Record[]|[]
     */
    $resultSet = $preparedStatement->fetchAll();
}
```
