<?php


/**
 * Base class that represents a query for the 'seatAvailability' table.
 *
 * 
 *
 * @method     SeatAvailabilityQuery orderByid($order = Criteria::ASC) Order by the id column
 * @method     SeatAvailabilityQuery orderByseatId($order = Criteria::ASC) Order by the seatId column
 * @method     SeatAvailabilityQuery orderByperformanceId($order = Criteria::ASC) Order by the performanceId column
 * @method     SeatAvailabilityQuery orderByforSale($order = Criteria::ASC) Order by the forSale column
 *
 * @method     SeatAvailabilityQuery groupByid() Group by the id column
 * @method     SeatAvailabilityQuery groupByseatId() Group by the seatId column
 * @method     SeatAvailabilityQuery groupByperformanceId() Group by the performanceId column
 * @method     SeatAvailabilityQuery groupByforSale() Group by the forSale column
 *
 * @method     SeatAvailabilityQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     SeatAvailabilityQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     SeatAvailabilityQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     SeatAvailabilityQuery leftJoinSeat($relationAlias = null) Adds a LEFT JOIN clause to the query using the Seat relation
 * @method     SeatAvailabilityQuery rightJoinSeat($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Seat relation
 * @method     SeatAvailabilityQuery innerJoinSeat($relationAlias = null) Adds a INNER JOIN clause to the query using the Seat relation
 *
 * @method     SeatAvailabilityQuery leftJoinPerformance($relationAlias = null) Adds a LEFT JOIN clause to the query using the Performance relation
 * @method     SeatAvailabilityQuery rightJoinPerformance($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Performance relation
 * @method     SeatAvailabilityQuery innerJoinPerformance($relationAlias = null) Adds a INNER JOIN clause to the query using the Performance relation
 *
 * @method     SeatAvailability findOne(PropelPDO $con = null) Return the first SeatAvailability matching the query
 * @method     SeatAvailability findOneOrCreate(PropelPDO $con = null) Return the first SeatAvailability matching the query, or a new SeatAvailability object populated from the query conditions when no match is found
 *
 * @method     SeatAvailability findOneByid(int $id) Return the first SeatAvailability filtered by the id column
 * @method     SeatAvailability findOneByseatId(int $seatId) Return the first SeatAvailability filtered by the seatId column
 * @method     SeatAvailability findOneByperformanceId(int $performanceId) Return the first SeatAvailability filtered by the performanceId column
 * @method     SeatAvailability findOneByforSale(boolean $forSale) Return the first SeatAvailability filtered by the forSale column
 *
 * @method     array findByid(int $id) Return SeatAvailability objects filtered by the id column
 * @method     array findByseatId(int $seatId) Return SeatAvailability objects filtered by the seatId column
 * @method     array findByperformanceId(int $performanceId) Return SeatAvailability objects filtered by the performanceId column
 * @method     array findByforSale(boolean $forSale) Return SeatAvailability objects filtered by the forSale column
 *
 * @package    propel.generator.simply.om
 */
abstract class BaseSeatAvailabilityQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseSeatAvailabilityQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'simply', $modelName = 'SeatAvailability', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new SeatAvailabilityQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    SeatAvailabilityQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof SeatAvailabilityQuery) {
			return $criteria;
		}
		$query = new SeatAvailabilityQuery();
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
	 * @return    SeatAvailability|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = SeatAvailabilityPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(SeatAvailabilityPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    SeatAvailability A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `SEATID`, `PERFORMANCEID`, `FORSALE` FROM `seatAvailability` WHERE `ID` = :p0';
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
			$obj = new SeatAvailability();
			$obj->hydrate($row);
			SeatAvailabilityPeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    SeatAvailability|array|mixed the result, formatted by the current formatter
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
	 * @return    SeatAvailabilityQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(SeatAvailabilityPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    SeatAvailabilityQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(SeatAvailabilityPeer::ID, $keys, Criteria::IN);
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
	 * @return    SeatAvailabilityQuery The current query, for fluid interface
	 */
	public function filterByid($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(SeatAvailabilityPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the seatId column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByseatId(1234); // WHERE seatId = 1234
	 * $query->filterByseatId(array(12, 34)); // WHERE seatId IN (12, 34)
	 * $query->filterByseatId(array('min' => 12)); // WHERE seatId > 12
	 * </code>
	 *
	 * @see       filterBySeat()
	 *
	 * @param     mixed $seatId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SeatAvailabilityQuery The current query, for fluid interface
	 */
	public function filterByseatId($seatId = null, $comparison = null)
	{
		if (is_array($seatId)) {
			$useMinMax = false;
			if (isset($seatId['min'])) {
				$this->addUsingAlias(SeatAvailabilityPeer::SEATID, $seatId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($seatId['max'])) {
				$this->addUsingAlias(SeatAvailabilityPeer::SEATID, $seatId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SeatAvailabilityPeer::SEATID, $seatId, $comparison);
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
	 * @return    SeatAvailabilityQuery The current query, for fluid interface
	 */
	public function filterByperformanceId($performanceId = null, $comparison = null)
	{
		if (is_array($performanceId)) {
			$useMinMax = false;
			if (isset($performanceId['min'])) {
				$this->addUsingAlias(SeatAvailabilityPeer::PERFORMANCEID, $performanceId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($performanceId['max'])) {
				$this->addUsingAlias(SeatAvailabilityPeer::PERFORMANCEID, $performanceId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SeatAvailabilityPeer::PERFORMANCEID, $performanceId, $comparison);
	}

	/**
	 * Filter the query on the forSale column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByforSale(true); // WHERE forSale = true
	 * $query->filterByforSale('yes'); // WHERE forSale = true
	 * </code>
	 *
	 * @param     boolean|string $forSale The value to use as filter.
	 *              Non-boolean arguments are converted using the following rules:
	 *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SeatAvailabilityQuery The current query, for fluid interface
	 */
	public function filterByforSale($forSale = null, $comparison = null)
	{
		if (is_string($forSale)) {
			$forSale = in_array(strtolower($forSale), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
		}
		return $this->addUsingAlias(SeatAvailabilityPeer::FORSALE, $forSale, $comparison);
	}

	/**
	 * Filter the query by a related Seat object
	 *
	 * @param     Seat|PropelCollection $seat The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SeatAvailabilityQuery The current query, for fluid interface
	 */
	public function filterBySeat($seat, $comparison = null)
	{
		if ($seat instanceof Seat) {
			return $this
				->addUsingAlias(SeatAvailabilityPeer::SEATID, $seat->getid(), $comparison);
		} elseif ($seat instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(SeatAvailabilityPeer::SEATID, $seat->toKeyValue('PrimaryKey', 'id'), $comparison);
		} else {
			throw new PropelException('filterBySeat() only accepts arguments of type Seat or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Seat relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SeatAvailabilityQuery The current query, for fluid interface
	 */
	public function joinSeat($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Seat');

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
			$this->addJoinObject($join, 'Seat');
		}

		return $this;
	}

	/**
	 * Use the Seat relation Seat object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SeatQuery A secondary query class using the current class as primary query
	 */
	public function useSeatQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinSeat($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Seat', 'SeatQuery');
	}

	/**
	 * Filter the query by a related Performance object
	 *
	 * @param     Performance|PropelCollection $performance The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SeatAvailabilityQuery The current query, for fluid interface
	 */
	public function filterByPerformance($performance, $comparison = null)
	{
		if ($performance instanceof Performance) {
			return $this
				->addUsingAlias(SeatAvailabilityPeer::PERFORMANCEID, $performance->getid(), $comparison);
		} elseif ($performance instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(SeatAvailabilityPeer::PERFORMANCEID, $performance->toKeyValue('PrimaryKey', 'id'), $comparison);
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
	 * @return    SeatAvailabilityQuery The current query, for fluid interface
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
	 * Exclude object from result
	 *
	 * @param     SeatAvailability $seatAvailability Object to remove from the list of results
	 *
	 * @return    SeatAvailabilityQuery The current query, for fluid interface
	 */
	public function prune($seatAvailability = null)
	{
		if ($seatAvailability) {
			$this->addUsingAlias(SeatAvailabilityPeer::ID, $seatAvailability->getid(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseSeatAvailabilityQuery