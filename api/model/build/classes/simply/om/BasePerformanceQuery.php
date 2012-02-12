<?php


/**
 * Base class that represents a query for the 'performance' table.
 *
 * 
 *
 * @method     PerformanceQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     PerformanceQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     PerformanceQuery orderByOccurs($order = Criteria::ASC) Order by the occurs column
 *
 * @method     PerformanceQuery groupById() Group by the id column
 * @method     PerformanceQuery groupByTitle() Group by the title column
 * @method     PerformanceQuery groupByOccurs() Group by the occurs column
 *
 * @method     PerformanceQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     PerformanceQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     PerformanceQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     Performance findOne(PropelPDO $con = null) Return the first Performance matching the query
 * @method     Performance findOneOrCreate(PropelPDO $con = null) Return the first Performance matching the query, or a new Performance object populated from the query conditions when no match is found
 *
 * @method     Performance findOneById(int $id) Return the first Performance filtered by the id column
 * @method     Performance findOneByTitle(string $title) Return the first Performance filtered by the title column
 * @method     Performance findOneByOccurs(string $occurs) Return the first Performance filtered by the occurs column
 *
 * @method     array findById(int $id) Return Performance objects filtered by the id column
 * @method     array findByTitle(string $title) Return Performance objects filtered by the title column
 * @method     array findByOccurs(string $occurs) Return Performance objects filtered by the occurs column
 *
 * @package    propel.generator.simply.om
 */
abstract class BasePerformanceQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BasePerformanceQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'simply', $modelName = 'Performance', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new PerformanceQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    PerformanceQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof PerformanceQuery) {
			return $criteria;
		}
		$query = new PerformanceQuery();
		if (null !== $modelAlias) {
			$query->setModelAlias($modelAlias);
		}
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

	/**
	 * Find object by primary key.
	 * Propel uses the instance pool to skip the database if the object exists.
	 * Go fast if the query is untouched.
	 *
	 * <code>
	 * $obj  = $c->findPk(12, $con);
	 * </code>
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    Performance|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = PerformancePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(PerformancePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$this->basePreSelect($con);
		if ($this->formatter || $this->modelAlias || $this->with || $this->select
		 || $this->selectColumns || $this->asColumns || $this->selectModifiers
		 || $this->map || $this->having || $this->joins) {
			return $this->findPkComplex($key, $con);
		} else {
			return $this->findPkSimple($key, $con);
		}
	}

	/**
	 * Find object by primary key using raw SQL to go fast.
	 * Bypass doSelect() and the object formatter by using generated code.
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con A connection object
	 *
	 * @return    Performance A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `TITLE`, `OCCURS` FROM `performance` WHERE `ID` = :p0';
		try {
			$stmt = $con->prepare($sql);
			$stmt->bindValue(':p0', $key, PDO::PARAM_INT);
			$stmt->execute();
		} catch (Exception $e) {
			Propel::log($e->getMessage(), Propel::LOG_ERR);
			throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
		}
		$obj = null;
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$obj = new Performance();
			$obj->hydrate($row);
			PerformancePeer::addInstanceToPool($obj, (string) $row[0]);
		}
		$stmt->closeCursor();

		return $obj;
	}

	/**
	 * Find object by primary key.
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con A connection object
	 *
	 * @return    Performance|array|mixed the result, formatted by the current formatter
	 */
	protected function findPkComplex($key, $con)
	{
		// As the query uses a PK condition, no limit(1) is necessary.
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		$stmt = $criteria
			->filterByPrimaryKey($key)
			->doSelect($con);
		return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
	}

	/**
	 * Find objects by primary key
	 * <code>
	 * $objs = $c->findPks(array(12, 56, 832), $con);
	 * </code>
	 * @param     array $keys Primary keys to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    PropelObjectCollection|array|mixed the list of results, formatted by the current formatter
	 */
	public function findPks($keys, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
		}
		$this->basePreSelect($con);
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		$stmt = $criteria
			->filterByPrimaryKeys($keys)
			->doSelect($con);
		return $criteria->getFormatter()->init($criteria)->format($stmt);
	}

	/**
	 * Filter the query by primary key
	 *
	 * @param     mixed $key Primary key to use for the query
	 *
	 * @return    PerformanceQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(PerformancePeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    PerformanceQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(PerformancePeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterById(1234); // WHERE id = 1234
	 * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
	 * $query->filterById(array('min' => 12)); // WHERE id > 12
	 * </code>
	 *
	 * @param     mixed $id The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PerformanceQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(PerformancePeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the title column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
	 * $query->filterByTitle('%fooValue%'); // WHERE title LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $title The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PerformanceQuery The current query, for fluid interface
	 */
	public function filterByTitle($title = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($title)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $title)) {
				$title = str_replace('*', '%', $title);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(PerformancePeer::TITLE, $title, $comparison);
	}

	/**
	 * Filter the query on the occurs column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByOccurs('2011-03-14'); // WHERE occurs = '2011-03-14'
	 * $query->filterByOccurs('now'); // WHERE occurs = '2011-03-14'
	 * $query->filterByOccurs(array('max' => 'yesterday')); // WHERE occurs > '2011-03-13'
	 * </code>
	 *
	 * @param     mixed $occurs The value to use as filter.
	 *              Values can be integers (unix timestamps), DateTime objects, or strings.
	 *              Empty strings are treated as NULL.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PerformanceQuery The current query, for fluid interface
	 */
	public function filterByOccurs($occurs = null, $comparison = null)
	{
		if (is_array($occurs)) {
			$useMinMax = false;
			if (isset($occurs['min'])) {
				$this->addUsingAlias(PerformancePeer::OCCURS, $occurs['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($occurs['max'])) {
				$this->addUsingAlias(PerformancePeer::OCCURS, $occurs['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PerformancePeer::OCCURS, $occurs, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Performance $performance Object to remove from the list of results
	 *
	 * @return    PerformanceQuery The current query, for fluid interface
	 */
	public function prune($performance = null)
	{
		if ($performance) {
			$this->addUsingAlias(PerformancePeer::ID, $performance->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BasePerformanceQuery