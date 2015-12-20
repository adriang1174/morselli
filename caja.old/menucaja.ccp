<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\caja" secured="False" urlType="Relative" isIncluded="True" SSLAccess="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="SandBeach" wizardThemeVersion="3.0" isService="False" needGeneration="0">
	<Components>
		<Menu id="4" secured="False" sourceType="Table" returnValueType="Number" connection="Connection1" name="Menu1" menuType="Horizontal" dataSource="menucaja" idField="idmenu" parentIdField="menu_id_parent" menuSourceType="DataSource" PathID="menucajaMenu1" wizardTheme="SandBeach" wizardThemeVersion="3.0">
			<Components>
				<Link id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Database" urlType="Relative" preserveParameters="GET" name="ItemLink" hrefSource="menu_link" fieldSource="menu_name" PathID="menucajaMenu1ItemLink" wizardTheme="SandBeach" wizardThemeVersion="3.0">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</Link>
			</Components>
			<Events/>
			<TableParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes>
				<Attribute id="6" name="Target" sourceType="Expression" source="&quot;&quot;"/>
				<Attribute id="7" name="Title" sourceType="Expression" source="&quot;&quot;"/>
			</Attributes>
			<MenuItems/>
			<Features/>
		</Menu>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="menucaja.php" forShow="True" url="menucaja.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="menucaja_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="BeforeInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="3"/>
			</Actions>
		</Event>
	</Events>
</Page>
