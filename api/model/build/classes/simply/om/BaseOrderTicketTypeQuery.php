<?php


/**
 * Base class that represents a query for the 'orderTicketType' table.
 *
 * 
 *
 * @method     OrderTicketTypeQuery orderByid($order = Criteria::ASC) Order by the id column
 * @method     OrderTicketTypeQuery orderBytypeId($order = Criteria::ASC) Order by the typeId column
 * @method     OrderTicketTypeQuery orderByorderId($order = Criteria::ASC) Order by the orderId column
 * @method     OrderTicketTypeQuery orderByquantity($order = Criteria::ASC) Order by the quantity column
 *
 * @method     OrderTicketTypeQuery groupByid() Group by the id column
 * @method     OrderTicketTypeQuery groupBytypeId() Group by the typeId column
 * @method     OrderTicketTypeQuery groupByorderId() Group by the orderId column
 * @method     OrderTicketTypeQuery groupByquantity() Group by the quantity column
 *
 * @method     OrderTicketTypeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     OrderTicketTypeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     OrderTicketTypeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     OrderTicketTypeQuery leftJoinTicketType($relationAlias = null) Adds a LEFT JOIN clause to the query using the TicketType relation
 * @method     OrderTicketTypeQuery rightJoinTicketType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TicketType relation
 * @method     OrderTicketTypeQuery innerJoinTicketType($relationAlias = null) Adds a INNER JOIN clause to the query using the TicketType relation
 *
 * @method     OrderTicketTypeQuery leftJoinOrder($relationAlias = null) Adds a LEFT JOIN clause to the query using the Order relation
 * @method     OrderTicketTypeQuery rightJoinOrder($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Order relation
 * @method     OrderTicketTypeQuery innerJoinOrder($relationAlias = null) Adds a INNER JOIN clause to the query using the Order relation
 *
 * @method     OrderTicketType findOne(PropelPDO $con = null) Return the first OrderTicketType matching the query
 * @method     OrderTicketType findOneOrCreate(PropelPDO $con = null) Return the first OrderTicketType matching the query, or a new OrderTicketType object populated from the query conditions when no match is found
 *
 * @method     OrderTicketType findOneByid(int $id) Return the first OrderTicketType filtered by the id column
 * @method     OrderTicketType findOneBytypeId(int $typeId) Return the first OrderTicketType filtered by the typeId column
 * @method     OrderTicketType findOneByorderId(int $orderId) Return the first OrderTicketType filtered by the orderId column
 * @method     OrderTicketType findOneByquantity(int $quantity) Return the first OrderTicketType filtered by the quantity column
 *
 * @method     array findByid(int $id) Return OrderTicketType objects filtered by the id column
 * @method     array findBytypeId(int $typeId) Return OrderTicketType objects filtered by the typeId column
 * @method     array findByorderId(int $orderId) Return OrderTicketType objects filtered by the orderId column
 * @method     array findByquantity(int $quantity) Return OrderTicketType objects filtered by the quantity column
 *
 * @package    propel.generator.simply.om
 */
abstract class BaseOrderTicketTypeQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseOrderTicketTypeQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'simply', $modelName = 'OrderTicketType', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new OrderTicketTypeQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    OrderTicketTypeQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof OrderTicketTypeQuery) {
			return $criteria;
		}
		$query = new OrderTicketTypeQuery();
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
	 * @return    OrderTicketType|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = OrderTicketTypePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(OrderTicketTypePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    OrderTicketType A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `TYPEID`, `ORDERID`, `QUANTITY` FROM `orderTicketType` WHERE `ID` = :p0';
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
			$obj = new OrderTicketType();
			$obj->hydrate($row);
			OrderTicketTypePeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    OrderTicketType|array|mixed the result, formatted by the current formatter
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
	 * @return    OrderTicketTypeQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(OrderTicketTypePeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    OrderTicketTypeQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(OrderTicketTypePeer::ID, $keys, Criteria::IN);
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
	 * @return    OrderTicketTypeQuery The current query, for fluid interface
	 */
	public function filterByid($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(OrderTicketTypePeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the typeId column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterBytypeId(1234); // WHERE typeId = 1234
	 * $query->filterBytypeId(array(12, 34)); // WHERE typeId IN (12, 34)
	 * $query->filterBytypeId(array('min' => 12)); // WHERE typeId > 12
	 * </code>
	 *
	 * @see       filterByTicketType()
	 *
	 * @param     mixed $typeId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    OrderTicketTypeQuery The current query, for fluid interface
	 */
	public function filterBytypeId($typeId = null, $comparison = null)
	{
		if (is_array($typeId)) {
			$useMinMax = false;
			if (isset($typeId['min'])) {
				$this->addUsingAlias(OrderTicketTypePeer::TYPEID, $typeId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($typeId['max'])) {
				$this->addUsingAlias(OrderTicketTypePeer::TYPEID, $typeId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(OrderTicketTypePeer::TYPEID, $typeId, $comparison);
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
	 * @return    OrderTicketTypeQuery The current query, for fluid interface
	 */
	public function filterByorderId($orderId = null, $comparison = null)
	{
		if (is_array($orderId)) {
			$useMinMax = false;
			if (isset($orderId['min'])) {
				$this->addUsingAlias(OrderTicketTypePeer::ORDERID, $orderId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($orderId['max'])) {
				$this->addUsingAlias(OrderTicketTypePeer::ORDERID, $orderId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(OrderTicketTypePeer::ORDERID, $orderId, $comparison);
	}

	/**
	 * Filter the query on the quantity column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByquantity(1234); // WHERE quantity = 1234
	 * $query->filterByquantity(array(12, 34)); // WHERE quantity IN (12, 34)
	 * $query->filterByquantity(array('min' => 12)); // WHERE quantity > 12
	 * </code>
	 *
	 * @param     mixed $quantity The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    OrderTicketTypeQuery The current query, for fluid interface
	 */
	public function filterByquantity($quantity = null, $comparison = null)
	{
		if (is_array($quantity)) {
			$useMinMax = false;
			if (isset($quantity['min'])) {
				$this->addUsingAlias(OrderTicketTypePeer::QUANTITY, $quantity['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($quantity['max'])) {
				$this->addUsingAlias(OrderTicketTypePeer::QUANTITY, $quantity['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(OrderTicketTypePeer::QUANTITY, $quantity, $comparison);
	}

	/**
	 * Filter the query by a related TicketType object
	 *
	 * @param     TicketType|PropelCollection $ticketType The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    OrderTicketTypeQuery The current query, for fluid interface
	 */
	public function filterByTicketType($ticketType, $comparison = null)
	{
		if ($ticketType instanceof TicketType) {
			return $this
				->addUsingAlias(OrderTicketTypePeer::TYPEID, $ticketType->getid(), $comparison);
		} elseif ($ticketType instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(OrderTicketTypePeer::TYPEID, $ticketType->toKeyValue('PrimaryKey', 'id'), $comparison);
		} else {
			throw new PropelException('filterByTicketType() only accepts arguments of type TicketType or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the TicketType relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    OrderTicketTypeQuery The current query, for fluid interface
	 */
	public function joinTicketType($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('TicketType');

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
			$this->addJoinObject($join, 'TicketType');
		}

		return $this;
	}

	/**
	 * Use the TicketType relation TicketType object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    TicketTypeQuery A secondary query class using the current class as primary query
	 */
	public function useTicketTypeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinTicketType($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'TicketType', 'TicketTypeQuery');
	}

	/**
	 * Filter the query by a related Order object
	 *
	 * @param     Order|PropelCollection $order The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    OrderTicketTypeQuery The current query, for fluid interface
	 */
	public function filterByOrder($order, $comparison = null)
	{
		if ($order instanceof Order) {
			return $this
				->addUsingAlias(OrderTicketTypePeer::ORDERID, $order->getid(), $comparison);
		} elseif ($order instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(OrderTicketTypePeer::ORDERID, $order->toKeyValue('PrimaryKey', 'id'), $comparison);
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
	 * @return    OrderTicketTypeQuery The current query, for fluid interface
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
	 * @param     OrderTicketType $orderTicketType Object to remove from the list of results
	 *
	 * @return    OrderTicketTypeQuery The current query, for fluid interface
	 */
	public function prune($orderTicketType = null)
	{
		if ($orderTicketType) {
			$this->addUsingAlias(OrderTicketTypePeer::ID, $orderTicketType->getid(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseOrderTicketTypeQuery