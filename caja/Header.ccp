<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\caja" secured="False" urlType="Relative" isIncluded="True" SSLAccess="False" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0" wizardTheme="SandBeachMenu" wizardThemeVersion="3.0" isService="False" PathID="Header">
	<Components>
		<Menu id="4" secured="False" sourceType="Table" returnValueType="Number" connection="Connection1" name="Menu1" menuType="Horizontal" dataSource="menucaja" idField="idmenu" parentIdField="menu_id_parent" menuSourceType="DataSource" PathID="HeaderMenu1" wizardTheme="SandBeach" wizardThemeVersion="3.0">
			<Components>
				<Link id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Database" urlType="Relative" preserveParameters="GET" name="ItemLink" hrefSource="menu_link" fieldSource="menu_name" PathID="HeaderMenu1ItemLink" wizardTheme="SandBeach" wizardThemeVersion="3.0">
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
				<Attribute id="6" name="Target" sourceType="DataField" source="target"/>
				<Attribute id="7" name="Title" sourceType="Expression" source="&quot;&quot;"/>
			</Attributes>
			<MenuItems/>
			<Features/>
		</Menu>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="Header.php" forShow="True" url="Header.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="OnLoad" type="Client">
			<Actions>
				<Action actionName="CCT Generate Menu" actionCategory="CCT" id="3"/>
			</Actions>
		</Event>
	</Events>
</Page>
