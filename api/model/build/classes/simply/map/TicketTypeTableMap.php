<?php



/**
 * This class defines the structure of the 'ticketType' table.
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
class TicketTypeTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'simply.map.TicketTypeTableMap';

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
		$this->setName('ticketType');
		$this->setPhpName('TicketType');
		$this->setClassname('TicketType');
		$this->setPackage('simply');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'id', 'INTEGER', true, null, null);
		$this->addForeignKey('PERFORMANCEID', 'performanceId', 'INTEGER', 'performance', 'ID', false, null, null);
		$this->addColumn('NAME', 'name', 'VARCHAR', false, 255, null);
		$this->addColumn('PRICE', 'price', 'INTEGER', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('Performance', 'Performance', RelationMap::MANY_TO_ONE, array('performanceId' => 'id', ), null, null);
		$this->addRelation('TicketTypeToOrderTicketType', 'OrderTicketType', RelationMap::ONE_TO_MANY, array('id' => 'typeId', ), null, null, 'TicketTypeToOrderTicketTypes');
	} // buildRelations()

} // TicketTypeTableMap
