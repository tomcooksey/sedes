<?php



/**
 * This class defines the structure of the 'venue' table.
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
class VenueTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'simply.map.VenueTableMap';

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
		$this->setName('venue');
		$this->setPhpName('Venue');
		$this->setClassname('Venue');
		$this->setPackage('simply');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'id', 'INTEGER', true, null, null);
		$this->addColumn('NAME', 'name', 'VARCHAR', false, 255, null);
		$this->addColumn('ADDRESS', 'address', 'VARCHAR', false, 255, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('VenueToShow', 'Performance', RelationMap::ONE_TO_MANY, array('id' => 'venueId', ), null, null, 'VenueToShows');
		$this->addRelation('VenueToRow', 'Row', RelationMap::ONE_TO_MANY, array('id' => 'venueId', ), null, null, 'VenueToRows');
	} // buildRelations()

} // VenueTableMap
