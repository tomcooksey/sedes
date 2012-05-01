<?php


/**
 * Base class that represents a query for the 'ticketType' table.
 *
 * 
 *
 * @method     TicketTypeQuery orderByid($order = Criteria::ASC) Order by the id column
 * @method     TicketTypeQuery orderByperformanceId($order = Criteria::ASC) Order by the performanceId column
 * @method     TicketTypeQuery orderByname($order = Criteria::ASC) Order by the name column
 * @method     TicketTypeQuery orderByprice($order = Criteria::ASC) Order by the price column
 *
 * @method     TicketTypeQuery groupByid() Group by the id column
 * @method     TicketTypeQuery groupByperformanceId() Group by the performanceId column
 * @method     TicketTypeQuery groupByname() Group by the name column
 * @method     TicketTypeQuery groupByprice() Group by the price column
 *
 * @method     TicketTypeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     TicketTypeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     TicketTypeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     TicketTypeQuery leftJoinPerformance($relationAlias = null) Adds a LEFT JOIN clause to the query using the Performance relation
 * @method     TicketTypeQuery rightJoinPerformance($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Performance relation
 * @method     TicketTypeQuery innerJoinPerformance($relationAlias = null) Adds a INNER JOIN clause to the query using the Performance relation
 *
 * @method     TicketTypeQuery leftJoinTicketTypeToOrderTicketType($relationAlias = null) Adds a LEFT JOIN clause to the query using the TicketTypeToOrderTicketType relation
 * @method     TicketTypeQuery rightJoinTicketTypeToOrderTicketType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TicketTypeToOrderTicketType relation
 * @method     TicketTypeQuery innerJoinTicketTypeToOrderTicketType($relationAlias = null) Adds a INNER JOIN clause to the query using the TicketTypeToOrderTicketType relation
 *
 * @method     TicketType findOne(PropelPDO $con = null) Return the first TicketType matching the query
 * @method     TicketType findOneOrCreate(PropelPDO $con = null) Return the first TicketType matching the query, or a new TicketType object populated from the query conditions when no match is found
 *
 * @method     TicketType findOneByid(int $id) Return the first TicketType filtered by the id column
 * @method     TicketType findOneByperformanceId(int $performanceId) Return the first TicketType filtered by the performanceId column
 * @method     TicketType findOneByname(string $name) Return the first TicketType filtered by the name column
 * @method     TicketType findOneByprice(int $price) Return the first TicketType filtered by the price column
 *
 * @method     array findByid(int $id) Return TicketType objects filtered by the id column
 * @method     array findByperformanceId(int $performanceId) Return TicketType objects filtered by the performanceId column
 * @method     array findByname(string $name) Return TicketType objects filtered by the name column
 * @method     array findByprice(int $price) Return TicketType objects filtered by the price column
 *
 * @package    propel.generator.simply.om
 */
abstract class BaseTicketTypeQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseTicketTypeQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'simply', $modelName = 'TicketType', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new TicketTypeQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    TicketTypeQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof TicketTypeQuery) {
			return $criteria;
		}
		$query = new TicketTypeQuery();
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
	 * @return    TicketType|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = TicketTypePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(TicketTypePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    TicketType A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `PERFORMANCEID`, `NAME`, `PRICE` FROM `ticketType` WHERE `ID` = :p0';
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
			$obj = new TicketType();
			$obj->hydrate($row);
			TicketTypePeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    TicketType|array|mixed the result, formatted by the current formatter
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
	 * @return    TicketTypeQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(TicketTypePeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    TicketTypeQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(TicketTypePeer::ID, $keys, Criteria::IN);
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
	 * @return    TicketTypeQuery The current query, for fluid interface
	 */
	public function filterByid($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(TicketTypePeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the performanceId column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByperformanceId(1234); // WHERE performanceId = 1234
	 * $query->filterByperformanceId(array(12, 34)); // WHERE performanceId IN (12, 34)
	 * $query->filterByperformanceId(array('min' => 12)); // WHERE performanceId > 12
	 * </code>
	 *
	 * @see       filterByPerformance()
	 *
	 * @param     mixed $performanceId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TicketTypeQuery The current query, for fluid interface
	 */
	public function filterByperformanceId($performanceId = null, $comparison = null)
	{
		if (is_array($performanceId)) {
			$useMinMax = false;
			if (isset($performanceId['min'])) {
				$this->addUsingAlias(TicketTypePeer::PERFORMANCEID, $performanceId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($performanceId['max'])) {
				$this->addUsingAlias(TicketTypePeer::PERFORMANCEID, $performanceId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(TicketTypePeer::PERFORMANCEID, $performanceId, $comparison);
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
	 * @return    TicketTypeQuery The current query, for fluid interface
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
		return $this->addUsingAlias(TicketTypePeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query on the price column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByprice(1234); // WHERE price = 1234
	 * $query->filterByprice(array(12, 34)); // WHERE price IN (12, 34)
	 * $query->filterByprice(array('min' => 12)); // WHERE price > 12
	 * </code>
	 *
	 * @param     mixed $price The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TicketTypeQuery The current query, for fluid interface
	 */
	public function filterByprice($price = null, $comparison = null)
	{
		if (is_array($price)) {
			$useMinMax = false;
			if (isset($price['min'])) {
				$this->addUsingAlias(TicketTypePeer::PRICE, $price['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($price['max'])) {
				$this->addUsingAlias(TicketTypePeer::PRICE, $price['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(TicketTypePeer::PRICE, $price, $comparison);
	}

	/**
	 * Filter the query by a related Performance object
	 *
	 * @param     Performance|PropelCollection $performance The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TicketTypeQuery The current query, for fluid interface
	 */
	public function filterByPerformance($performance, $comparison = null)
	{
		if ($performance instanceof Performance) {
			return $this
				->addUsingAlias(TicketTypePeer::PERFORMANCEID, $performance->getid(), $comparison);
		} elseif ($performance instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(TicketTypePeer::PERFORMANCEID, $performance->toKeyValue('PrimaryKey', 'id'), $comparison);
		} else {
			throw new PropelException('filterByPerformance() only accepts arguments of type Performance or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Performance relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    TicketTypeQuery The current query, for fluid interface
	 */
	public function joinPerformance($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Performance');

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
			$this->addJoinObject($join, 'Performance');
		}

		return $this;
	}

	/**
	 * Use the Performance relation Performance object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    PerformanceQuery A secondary query class using the current class as primary query
	 */
	public function usePerformanceQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinPerformance($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Performance', 'PerformanceQuery');
	}

	/**
	 * Filter the query by a related OrderTicketType object
	 *
	 * @param     OrderTicketType $orderTicketType  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TicketTypeQuery The current query, for fluid interface
	 */
	public function filterByTicketTypeToOrderTicketType($orderTicketType, $comparison = null)
	{
		if ($orderTicketType instanceof OrderTicketType) {
			return $this
				->addUsingAlias(TicketTypePeer::ID, $orderTicketType->gettypeId(), $comparison);
		} elseif ($orderTicketType instanceof PropelCollection) {
			return $this
				->useTicketTypeToOrderTicketTypeQuery()
				->filterByPrimaryKeys($orderTicketType->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByTicketTypeToOrderTicketType() only accepts arguments of type OrderTicketType or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the TicketTypeToOrderTicketType relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    TicketTypeQuery The current query, for fluid interface
	 */
	public function joinTicketTypeToOrderTicketType($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('TicketTypeToOrderTicketType');

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
			$this->addJoinObject($join, 'TicketTypeToOrderTicketType');
		}

		return $this;
	}

	/**
	 * Use the TicketTypeToOrderTicketType relation OrderTicketType object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    OrderTicketTypeQuery A secondary query class using the current class as primary query
	 */
	public function useTicketTypeToOrderTicketTypeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinTicketTypeToOrderTicketType($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'TicketTypeToOrderTicketType', 'OrderTicketTypeQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     TicketType $ticketType Object to remove from the list of results
	 *
	 * @return    TicketTypeQuery The current query, for fluid interface
	 */
	public function prune($ticketType = null)
	{
		if ($ticketType) {
			$this->addUsingAlias(TicketTypePeer::ID, $ticketType->getid(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseTicketTypeQuery