<?php


/**
 * Base class that represents a query for the 'orderSeat' table.
 *
 * 
 *
 * @method     OrderSeatQuery orderByid($order = Criteria::ASC) Order by the id column
 * @method     OrderSeatQuery orderByseatId($order = Criteria::ASC) Order by the seatId column
 * @method     OrderSeatQuery orderByorderId($order = Criteria::ASC) Order by the orderId column
 *
 * @method     OrderSeatQuery groupByid() Group by the id column
 * @method     OrderSeatQuery groupByseatId() Group by the seatId column
 * @method     OrderSeatQuery groupByorderId() Group by the orderId column
 *
 * @method     OrderSeatQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     OrderSeatQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     OrderSeatQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     OrderSeatQuery leftJoinSeat($relationAlias = null) Adds a LEFT JOIN clause to the query using the Seat relation
 * @method     OrderSeatQuery rightJoinSeat($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Seat relation
 * @method     OrderSeatQuery innerJoinSeat($relationAlias = null) Adds a INNER JOIN clause to the query using the Seat relation
 *
 * @method     OrderSeatQuery leftJoinOrder($relationAlias = null) Adds a LEFT JOIN clause to the query using the Order relation
 * @method     OrderSeatQuery rightJoinOrder($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Order relation
 * @method     OrderSeatQuery innerJoinOrder($relationAlias = null) Adds a INNER JOIN clause to the query using the Order relation
 *
 * @method     OrderSeat findOne(PropelPDO $con = null) Return the first OrderSeat matching the query
 * @method     OrderSeat findOneOrCreate(PropelPDO $con = null) Return the first OrderSeat matching the query, or a new OrderSeat object populated from the query conditions when no match is found
 *
 * @method     OrderSeat findOneByid(int $id) Return the first OrderSeat filtered by the id column
 * @method     OrderSeat findOneByseatId(int $seatId) Return the first OrderSeat filtered by the seatId column
 * @method     OrderSeat findOneByorderId(int $orderId) Return the first OrderSeat filtered by the orderId column
 *
 * @method     array findByid(int $id) Return OrderSeat objects filtered by the id column
 * @method     array findByseatId(int $seatId) Return OrderSeat objects filtered by the seatId column
 * @method     array findByorderId(int $orderId) Return OrderSeat objects filtered by the orderId column
 *
 * @package    propel.generator.simply.om
 */
abstract class BaseOrderSeatQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseOrderSeatQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'simply', $modelName = 'OrderSeat', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new OrderSeatQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    OrderSeatQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof OrderSeatQuery) {
			return $criteria;
		}
		$query = new OrderSeatQuery();
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
	 * @return    OrderSeat|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = OrderSeatPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(OrderSeatPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    OrderSeat A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `SEATID`, `ORDERID` FROM `orderSeat` WHERE `ID` = :p0';
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
			$obj = new OrderSeat();
			$obj->hydrate($row);
			OrderSeatPeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    OrderSeat|array|mixed the result, formatted by the current formatter
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
	 * @return    OrderSeatQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(OrderSeatPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    OrderSeatQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(OrderSeatPeer::ID, $keys, Criteria::IN);
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
	 * @return    OrderSeatQuery The current query, for fluid interface
	 */
	public function filterByid($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(OrderSeatPeer::ID, $id, $comparison);
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
	 * @return    OrderSeatQuery The current query, for fluid interface
	 */
	public function filterByseatId($seatId = null, $comparison = null)
	{
		if (is_array($seatId)) {
			$useMinMax = false;
			if (isset($seatId['min'])) {
				$this->addUsingAlias(OrderSeatPeer::SEATID, $seatId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($seatId['max'])) {
				$this->addUsingAlias(OrderSeatPeer::SEATID, $seatId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(OrderSeatPeer::SEATID, $seatId, $comparison);
	}

	/**
	 * Filter the query on the orderId column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByorderId(1234); // WHERE orderId = 1234
	 * $query->filterByorderId(array(12, 34)); // WHERE orderId IN (12, 34)
	 * $query->filterByorderId(array('min' => 12)); // WHERE orderId > 12
	 * </code>
	 *
	 * @see       filterByOrder()
	 *
	 * @param     mixed $orderId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    OrderSeatQuery The current query, for fluid interface
	 */
	public function filterByorderId($orderId = null, $comparison = null)
	{
		if (is_array($orderId)) {
			$useMinMax = false;
			if (isset($orderId['min'])) {
				$this->addUsingAlias(OrderSeatPeer::ORDERID, $orderId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($orderId['max'])) {
				$this->addUsingAlias(OrderSeatPeer::ORDERID, $orderId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(OrderSeatPeer::ORDERID, $orderId, $comparison);
	}

	/**
	 * Filter the query by a related Seat object
	 *
	 * @param     Seat|PropelCollection $seat The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    OrderSeatQuery The current query, for fluid interface
	 */
	public function filterBySeat($seat, $comparison = null)
	{
		if ($seat instanceof Seat) {
			return $this
				->addUsingAlias(OrderSeatPeer::SEATID, $seat->getid(), $comparison);
		} elseif ($seat instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(OrderSeatPeer::SEATID, $seat->toKeyValue('PrimaryKey', 'id'), $comparison);
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
	 * @return    OrderSeatQuery The current query, for fluid interface
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
	 * Filter the query by a related Order object
	 *
	 * @param     Order|PropelCollection $order The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    OrderSeatQuery The current query, for fluid interface
	 */
	public function filterByOrder($order, $comparison = null)
	{
		if ($order instanceof Order) {
			return $this
				->addUsingAlias(OrderSeatPeer::ORDERID, $order->getid(), $comparison);
		} elseif ($order instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(OrderSeatPeer::ORDERID, $order->toKeyValue('PrimaryKey', 'id'), $comparison);
		} else {
			throw new PropelException('filterByOrder() only accepts arguments of type Order or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Order relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    OrderSeatQuery The current query, for fluid interface
	 */
	public function joinOrder($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Order');

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
			$this->addJoinObject($join, 'Order');
		}

		return $this;
	}

	/**
	 * Use the Order relation Order object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    OrderQuery A secondary query class using the current class as primary query
	 */
	public function useOrderQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinOrder($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Order', 'OrderQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     OrderSeat $orderSeat Object to remove from the list of results
	 *
	 * @return    OrderSeatQuery The current query, for fluid interface
	 */
	public function prune($orderSeat = null)
	{
		if ($orderSeat) {
			$this->addUsingAlias(OrderSeatPeer::ID, $orderSeat->getid(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseOrderSeatQuery