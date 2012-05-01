<?php



/**
 * This class defines the structure of the 'performance' table.
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
class PerformanceTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'simply.map.PerformanceTableMap';

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
		$this->setName('performance');
		$this->setPhpName('Performance');
		$this->setClassname('Performance');
		$this->setPackage('simply');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'id', 'INTEGER', true, null, null);
		$this->addForeignKey('SHOWID', 'showId', 'INTEGER', 'show', 'ID', false, null, null);
		$this->addForeignKey('VENUEID', 'venueId', 'INTEGER', 'venue', 'ID', false, null, null);
		$this->addColumn('NAME', 'name', 'TIMESTAMP', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('Show', 'Show', RelationMap::MANY_TO_ONE, array('showId' => 'id', ), null, null);
		$this->addRelation('Venue', 'Venue', RelationMap::MANY_TO_ONE, array('venueId' => 'id', ), null, null);
		$this->addRelation('PerformanceToTicketType', 'TicketType', RelationMap::ONE_TO_MANY, array('id' => 'performanceId', ), null, null, 'PerformanceToTicketTypes');
		$this->addRelation('PerformanceToAvailability', 'SeatAvailability', RelationMap::ONE_TO_MANY, array('id' => 'performanceId', ), null, null, 'PerformanceToAvailabilitys');
		$this->addRelation('PerformanceToOrder', 'Order', RelationMap::ONE_TO_MANY, array('id' => 'performanceId', ), null, null, 'PerformanceToOrders');
	} // buildRelations()

} // PerformanceTableMap
