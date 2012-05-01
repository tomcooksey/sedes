<?php



/**
 * This class defines the structure of the 'order' table.
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
class OrderTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'simply.map.OrderTableMap';

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
		$this->setName('order');
		$this->setPhpName('Order');
		$this->setClassname('Order');
		$this->setPackage('simply');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'id', 'INTEGER', true, null, null);
		$this->addColumn('WHEN', 'when', 'TIMESTAMP', false, null, null);
		$this->addColumn('FULLNAME', 'fullName', 'VARCHAR', false, 255, null);
		$this->addColumn('EMAIL', 'email', 'VARCHAR', false, 255, null);
		$this->addColumn('PHONE', 'phone', 'VARCHAR', false, 255, null);
		$this->addForeignKey('PERFORMANCEID', 'Performanceid', 'INTEGER', 'performance', 'ID', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('Performance', 'Performance', RelationMap::MANY_TO_ONE, array('performanceId' => 'id', ), null, null);
		$this->addRelation('OrderToSeatOrder', 'OrderSeat', RelationMap::ONE_TO_MANY, array('id' => 'orderId', ), null, null, 'OrderToSeatOrders');
		$this->addRelation('OrderToTicketType', 'OrderTicketType', RelationMap::ONE_TO_MANY, array('id' => 'orderId', ), null, null, 'OrderToTicketTypes');
	} // buildRelations()

} // OrderTableMap
