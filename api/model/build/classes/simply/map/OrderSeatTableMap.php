<?php



/**
 * This class defines the structure of the 'orderSeat' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.simply.map
 */
class OrderSeatTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'simply.map.OrderSeatTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
		// attributes
		$this->setName('orderSeat');
		$this->setPhpName('OrderSeat');
		$this->setClassname('OrderSeat');
		$this->setPackage('simply');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'id', 'INTEGER', true, null, null);
		$this->addForeignKey('SEATID', 'seatId', 'INTEGER', 'seat', 'ID', false, null, null);
		$this->addForeignKey('ORDERID', 'orderId', 'INTEGER', 'order', 'ID', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('Seat', 'Seat', RelationMap::MANY_TO_ONE, array('seatId' => 'id', ), null, null);
		$this->addRelation('Order', 'Order', RelationMap::MANY_TO_ONE, array('orderId' => 'id', ), null, null);
	} // buildRelations()

} // OrderSeatTableMap
