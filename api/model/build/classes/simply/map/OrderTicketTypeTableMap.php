<?php



/**
 * This class defines the structure of the 'orderTicketType' table.
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
class OrderTicketTypeTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'simply.map.OrderTicketTypeTableMap';

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
		$this->setName('orderTicketType');
		$this->setPhpName('OrderTicketType');
		$this->setClassname('OrderTicketType');
		$this->setPackage('simply');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'id', 'INTEGER', true, null, null);
		$this->addForeignKey('TYPEID', 'typeId', 'INTEGER', 'ticketType', 'ID', false, null, null);
		$this->addForeignKey('ORDERID', 'orderId', 'INTEGER', 'order', 'ID', false, null, null);
		$this->addColumn('QUANTITY', 'quantity', 'INTEGER', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('TicketType', 'TicketType', RelationMap::MANY_TO_ONE, array('typeId' => 'id', ), null, null);
		$this->addRelation('Order', 'Order', RelationMap::MANY_TO_ONE, array('orderId' => 'id', ), null, null);
	} // buildRelations()

} // OrderTicketTypeTableMap
