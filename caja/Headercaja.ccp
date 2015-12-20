<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\caja" secured="False" urlType="Relative" isIncluded="True" SSLAccess="False" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0" wizardTheme="SandBeach" wizardThemeVersion="3.0" isService="False" PathID="Header">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" name="JSMenu" wizardTheme="Sandbeach" wizardThemeType="File" connection="Connection1" PathID="HeaderJSMenu" dataSource="menucaja">
			<Components>
				<Label id="4" fieldSourceType="DBColumn" dataType="Text" html="False" name="Menu_Id" fieldSource="idmenu">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="5" fieldSourceType="DBColumn" dataType="Text" html="False" name="Menu_Caption" fieldSource="menu_name">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="CCT Convert To JS String" actionCategory="CCT" id="6"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="7" fieldSourceType="DBColumn" dataType="Text" html="False" name="Menu_Url" fieldSource="menu_link">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="CCT Convert To JS String" actionCategory="CCT" id="8"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="10" fieldSourceType="DBColumn" dataType="Text" html="False" name="Menu_Id_Parent" fieldSource="menu_id_parent">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="11" fieldSourceType="DBColumn" dataType="Text" html="False" name="Menu_Width" defaultValue="170">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="12" fieldSourceType="DBColumn" dataType="Text" html="False" name="Menu_Icon">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="9" fieldSourceType="DBColumn" dataType="Text" html="False" name="Menu_Id_Root">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events/>
			<TableParameters/>
			<JoinTables>
				<JoinTable id="13" tableName="menucaja" schemaName="dbo" posLeft="10" posTop="10" posWidth="105" posHeight="120"/>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="Headercaja_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="Headercaja.php" forShow="True" url="Headercaja.php" comment="//" codePage="windows-1252"/>
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
