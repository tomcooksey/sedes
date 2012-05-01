<?php


/**
 * Base class that represents a query for the 'seat' table.
 *
 * 
 *
 * @method     SeatQuery orderByid($order = Criteria::ASC) Order by the id column
 * @method     SeatQuery orderByrowId($order = Criteria::ASC) Order by the rowId column
 * @method     SeatQuery orderByname($order = Criteria::ASC) Order by the name column
 * @method     SeatQuery orderBynumber($order = Criteria::ASC) Order by the number column
 * @method     SeatQuery orderBynoSeat($order = Criteria::ASC) Order by the noSeat column
 *
 * @method     SeatQuery groupByid() Group by the id column
 * @method     SeatQuery groupByrowId() Group by the rowId column
 * @method     SeatQuery groupByname() Group by the name column
 * @method     SeatQuery groupBynumber() Group by the number column
 * @method     SeatQuery groupBynoSeat() Group by the noSeat column
 *
 * @method     SeatQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     SeatQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     SeatQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     SeatQuery leftJoinRow($relationAlias = null) Adds a LEFT JOIN clause to the query using the Row relation
 * @method     SeatQuery rightJoinRow($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Row relation
 * @method     SeatQuery innerJoinRow($relationAlias = null) Adds a INNER JOIN clause to the query using the Row relation
 *
 * @method     SeatQuery leftJoinSeatToAvailability($relationAlias = null) Adds a LEFT JOIN clause to the query using the SeatToAvailability relation
 * @method     SeatQuery rightJoinSeatToAvailability($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SeatToAvailability relation
 * @method     SeatQuery innerJoinSeatToAvailability($relationAlias = null) Adds a INNER JOIN clause to the query using the SeatToAvailability relation
 *
 * @method     SeatQuery leftJoinSeatToOrder($relationAlias = null) Adds a LEFT JOIN clause to the query using the SeatToOrder relation
 * @method     SeatQuery rightJoinSeatToOrder($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SeatToOrder relation
 * @method     SeatQuery innerJoinSeatToOrder($relationAlias = null) Adds a INNER JOIN clause to the query using the SeatToOrder relation
 *
 * @method     Seat findOne(PropelPDO $con = null) Return the first Seat matching the query
 * @method     Seat findOneOrCreate(PropelPDO $con = null) Return the first Seat matching the query, or a new Seat object populated from the query conditions when no match is found
 *
 * @method     Seat findOneByid(int $id) Return the first Seat filtered by the id column
 * @method     Seat findOneByrowId(int $rowId) Return the first Seat filtered by the rowId column
 * @method     Seat findOneByname(string $name) Return the first Seat filtered by the name column
 * @method     Seat findOneBynumber(string $number) Return the first Seat filtered by the number column
 * @method     Seat findOneBynoSeat(boolean $noSeat) Return the first Seat filtered by the noSeat column
 *
 * @method     array findByid(int $id) Return Seat objects filtered by the id column
 * @method     array findByrowId(int $rowId) Return Seat objects filtered by the rowId column
 * @method     array findByname(string $name) Return Seat objects filtered by the name column
 * @method     array findBynumber(string $number) Return Seat objects filtered by the number column
 * @method     array findBynoSeat(boolean $noSeat) Return Seat objects filtered by the noSeat column
 *
 * @package    propel.generator.simply.om
 */
abstract class BaseSeatQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseSeatQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'simply', $modelName = 'Seat', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new SeatQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    SeatQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof SeatQuery) {
			return $criteria;
		}
		$query = new SeatQuery();
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
	 * @return    Seat|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = SeatPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(SeatPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    Seat A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `ROWID`, `NAME`, `NUMBER`, `NOSEAT` FROM `seat` WHERE `ID` = :p0';
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
			$obj = new Seat();
			$obj->hydrate($row);
			SeatPeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    Seat|array|mixed the result, formatted by the current formatter
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
	 * @return    SeatQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(SeatPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    SeatQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(SeatPeer::ID, $keys, Criteria::IN);
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
	 * @return    SeatQuery The current query, for fluid interface
	 */
	public function filterByid($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(SeatPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the rowId column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByrowId(1234); // WHERE rowId = 1234
	 * $query->filterByrowId(array(12, 34)); // WHERE rowId IN (12, 34)
	 * $query->filterByrowId(array('min' => 12)); // WHERE rowId > 12
	 * </code>
	 *
	 * @see       filterByRow()
	 *
	 * @param     mixed $rowId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SeatQuery The current query, for fluid interface
	 */
	public function filterByrowId($rowId = null, $comparison = null)
	{
		if (is_array($rowId)) {
			$useMinMax = false;
			if (isset($rowId['min'])) {
				$this->addUsingAlias(SeatPeer::ROWID, $rowId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($rowId['max'])) {
				$this->addUsingAlias(SeatPeer::ROWID, $rowId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SeatPeer::ROWID, $rowId, $comparison);
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
	 * @return    SeatQuery The current query, for fluid interface
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
		return $this->addUsingAlias(SeatPeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query on the number column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterBynumber('fooValue');   // WHERE number = 'fooValue'
	 * $query->filterBynumber('%fooValue%'); // WHERE number LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $number The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SeatQuery The current query, for fluid interface
	 */
	public function filterBynumber($number = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($number)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $number)) {
				$number = str_replace('*', '%', $number);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SeatPeer::NUMBER, $number, $comparison);
	}

	/**
	 * Filter the query on the noSeat column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterBynoSeat(true); // WHERE noSeat = true
	 * $query->filterBynoSeat('yes'); // WHERE noSeat = true
	 * </code>
	 *
	 * @param     boolean|string $noSeat The value to use as filter.
	 *              Non-boolean arguments are converted using the following rules:
	 *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SeatQuery The current query, for fluid interface
	 */
	public function filterBynoSeat($noSeat = null, $comparison = null)
	{
		if (is_string($noSeat)) {
			$noSeat = in_array(strtolower($noSeat), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
		}
		return $this->addUsingAlias(SeatPeer::NOSEAT, $noSeat, $comparison);
	}

	/**
	 * Filter the query by a related Row object
	 *
	 * @param     Row|PropelCollection $row The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SeatQuery The current query, for fluid interface
	 */
	public function filterByRow($row, $comparison = null)
	{
		if ($row instanceof Row) {
			return $this
				->addUsingAlias(SeatPeer::ROWID, $row->getid(), $comparison);
		} elseif ($row instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(SeatPeer::ROWID, $row->toKeyValue('PrimaryKey', 'id'), $comparison);
		} else {
			throw new PropelException('filterByRow() only accepts arguments of type Row or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Row relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SeatQuery The current query, for fluid interface
	 */
	public function joinRow($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Row');

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
			$this->addJoinObject($join, 'Row');
		}

		return $this;
	}

	/**
	 * Use the Row relation Row object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    RowQuery A secondary query class using the current class as primary query
	 */
	public function useRowQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinRow($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Row', 'RowQuery');
	}

	/**
	 * Filter the query by a related SeatAvailability object
	 *
	 * @param     SeatAvailability $seatAvailability  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SeatQuery The current query, for fluid interface
	 */
	public function filterBySeatToAvailability($seatAvailability, $comparison = null)
	{
		if ($seatAvailability instanceof SeatAvailability) {
			return $this
				->addUsingAlias(SeatPeer::ID, $seatAvailability->getseatId(), $comparison);
		} elseif ($seatAvailability instanceof PropelCollection) {
			return $this
				->useSeatToAvailabilityQuery()
				->filterByPrimaryKeys($seatAvailability->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterBySeatToAvailability() only accepts arguments of type SeatAvailability or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the SeatToAvailability relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SeatQuery The current query, for fluid interface
	 */
	public function joinSeatToAvailability($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('SeatToAvailability');

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
			$this->addJoinObject($join, 'SeatToAvailability');
		}

		return $this;
	}

	/**
	 * Use the SeatToAvailability relation SeatAvailability object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SeatAvailabilityQuery A secondary query class using the current class as primary query
	 */
	public function useSeatToAvailabilityQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinSeatToAvailability($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'SeatToAvailability', 'SeatAvailabilityQuery');
	}

	/**
	 * Filter the query by a related OrderSeat object
	 *
	 * @param     OrderSeat $orderSeat  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SeatQuery The current query, for fluid interface
	 */
	public function filterBySeatToOrder($orderSeat, $comparison = null)
	{
		if ($orderSeat instanceof OrderSeat) {
			return $this
				->addUsingAlias(SeatPeer::ID, $orderSeat->getseatId(), $comparison);
		} elseif ($orderSeat instanceof PropelCollection) {
			return $this
				->useSeatToOrderQuery()
				->filterByPrimaryKeys($orderSeat->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterBySeatToOrder() only accepts arguments of type OrderSeat or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the SeatToOrder relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SeatQuery The current query, for fluid interface
	 */
	public function joinSeatToOrder($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('SeatToOrder');

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
			$this->addJoinObject($join, 'SeatToOrder');
		}

		return $this;
	}

	/**
	 * Use the SeatToOrder relation OrderSeat object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    OrderSeatQuery A secondary query class using the current class as primary query
	 */
	public function useSeatToOrderQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinSeatToOrder($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'SeatToOrder', 'OrderSeatQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Seat $seat Object to remove from the list of results
	 *
	 * @return    SeatQuery The current query, for fluid interface
	 */
	public function prune($seat = null)
	{
		if ($seat) {
			$this->addUsingAlias(SeatPeer::ID, $seat->getid(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseSeatQuery