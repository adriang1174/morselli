<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\mantenimiento" secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="SandBeach" wizardThemeVersion="3.0" needGeneration="0" accessDeniedPage="../accesodenegado/accesodenegado.ccp">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="20" name="nupcias" connection="Connection1" pageSizeLimit="100" wizardCaption="{res:CCS_GridFormPrefix} {res:nupcias} {res:CCS_GridFormSuffix}" wizardGridType="Tabular" wizardAllowSorting="True" wizardSortingType="SimpleDir" wizardUsePageScroller="False" wizardAllowInsert="True" wizardAltRecord="False" wizardRecordSeparator="False" wizardAltRecordType="Controls" dataSource="nupcias">
			<Components>
				<Link id="4" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="nupcias_Insert" hrefSource="nupcias_maint.ccp" removeParameters="idnupcias" wizardThemeItem="NavigatorLink" wizardDefaultValue="{res:CCS_InsertLink}" PathID="nupciasnupcias_Insert">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</Link>
				<Sorter id="5" visible="True" name="Sorter_idnupcias" column="idnupcias" wizardCaption="{res:idnupcias}" wizardSortingType="SimpleDir" wizardControl="idnupcias" wizardAddNbsp="False" PathID="nupciasSorter_idnupcias">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="6" visible="True" name="Sorter_desnupcias" column="desnupcias" wizardCaption="{res:desnupcias}" wizardSortingType="SimpleDir" wizardControl="desnupcias" wizardAddNbsp="False" PathID="nupciasSorter_desnupcias">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Link id="8" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="idnupcias" fieldSource="idnupcias" wizardCaption="{res:idnupcias}" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardAddNbsp="True" hrefSource="nupcias_maint.ccp" PathID="nupciasidnupcias">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="9" sourceType="DataField" format="yyyy-mm-dd" name="idnupcias" source="idnupcias"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="11" fieldSourceType="DBColumn" dataType="Text" html="False" name="desnupcias" fieldSource="desnupcias" wizardCaption="{res:desnupcias}" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardAddNbsp="True" PathID="nupciasdesnupcias">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events/>
			<TableParameters/>
			<JoinTables>
				<JoinTable id="3" tableName="nupcias" posWidth="-1" posHeight="-1" posLeft="-1" posRight="-1"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="7" tableName="nupcias" fieldName="idnupcias"/>
				<Field id="10" tableName="nupcias" fieldName="desnupcias"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<IncludePage id="13" name="Header" PathID="Header" page="../Header.ccp">
<Components/>
<Events/>
<Features/>
</IncludePage>
</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="nupcias_list.php" forShow="True" url="nupcias_list.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="12" groupID="1"/>
	</SecurityGroups>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
