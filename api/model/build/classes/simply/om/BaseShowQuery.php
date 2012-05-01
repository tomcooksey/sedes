<?php


/**
 * Base class that represents a query for the 'show' table.
 *
 * 
 *
 * @method     ShowQuery orderByid($order = Criteria::ASC) Order by the id column
 * @method     ShowQuery orderByname($order = Criteria::ASC) Order by the name column
 *
 * @method     ShowQuery groupByid() Group by the id column
 * @method     ShowQuery groupByname() Group by the name column
 *
 * @method     ShowQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ShowQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ShowQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ShowQuery leftJoinShowToPerformance($relationAlias = null) Adds a LEFT JOIN clause to the query using the ShowToPerformance relation
 * @method     ShowQuery rightJoinShowToPerformance($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ShowToPerformance relation
 * @method     ShowQuery innerJoinShowToPerformance($relationAlias = null) Adds a INNER JOIN clause to the query using the ShowToPerformance relation
 *
 * @method     Show findOne(PropelPDO $con = null) Return the first Show matching the query
 * @method     Show findOneOrCreate(PropelPDO $con = null) Return the first Show matching the query, or a new Show object populated from the query conditions when no match is found
 *
 * @method     Show findOneByid(int $id) Return the first Show filtered by the id column
 * @method     Show findOneByname(string $name) Return the first Show filtered by the name column
 *
 * @method     array findByid(int $id) Return Show objects filtered by the id column
 * @method     array findByname(string $name) Return Show objects filtered by the name column
 *
 * @package    propel.generator.simply.om
 */
abstract class BaseShowQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseShowQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'simply', $modelName = 'Show', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new ShowQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    ShowQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof ShowQuery) {
			return $criteria;
		}
		$query = new ShowQuery();
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
	 * @return    Show|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = ShowPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(ShowPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    Show A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `NAME` FROM `show` WHERE `ID` = :p0';
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
			$obj = new Show();
			$obj->hydrate($row);
			ShowPeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    Show|array|mixed the result, formatted by the current formatter
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
	 * @return    ShowQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(ShowPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    ShowQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(ShowPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByid(1234); // WHERE id = 1234
	 * $query->filterByid(array(12, 34)); // WHERE id IN (12, 34)
	 * $query->filterByid(array('min' => 12)); // WHERE id > 12
	 * </code>
	 *
	 * @param     mixed $id The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ShowQuery The current query, for fluid interface
	 */
	public function filterByid($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(ShowPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the name column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByname('fooValue');   // WHERE name = 'fooValue'
	 * $query->filterByname('%fooValue%'); // WHERE name LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $name The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ShowQuery The current query, for fluid interface
	 */
	public function filterByname($name = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($name)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $name)) {
				$name = str_replace('*', '%', $name);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ShowPeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query by a related Performance object
	 *
	 * @param     Performance $performance  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ShowQuery The current query, for fluid interface
	 */
	public function filterByShowToPerformance($performance, $comparison = null)
	{
		if ($performance instanceof Performance) {
			return $this
				->addUsingAlias(ShowPeer::ID, $performance->getshowId(), $comparison);
		} elseif ($performance instanceof PropelCollection) {
			return $this
				->useShowToPerformanceQuery()
				->filterByPrimaryKeys($performance->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByShowToPerformance() only accepts arguments of type Performance or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the ShowToPerformance relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ShowQuery The current query, for fluid interface
	 */
	public function joinShowToPerformance($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('ShowToPerformance');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'ShowToPerformance');
		}

		return $this;
	}

	/**
	 * Use the ShowToPerformance relation Performance object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    PerformanceQuery A secondary query class using the current class as primary query
	 */
	public function useShowToPerformanceQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinShowToPerformance($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'ShowToPerformance', 'PerformanceQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Show $show Object to remove from the list of results
	 *
	 * @return    ShowQuery The current query, for fluid interface
	 */
	public function prune($show = null)
	{
		if ($show) {
			$this->addUsingAlias(ShowPeer::ID, $show->getid(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseShowQuery