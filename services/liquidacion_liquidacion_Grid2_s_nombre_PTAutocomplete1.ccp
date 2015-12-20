<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="Connection1" dataSource="fichas" activeCollection="TableParameters" name="fichas" pageSizeLimit="100" wizardCaption=" Fichas Lista de">
			<Components>
				<Label id="38" fieldSourceType="DBColumn" dataType="Text" html="False" name="nombre" fieldSource="nombre">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="37" conditionType="Parameter" useIsNull="False" field="nombre" dataType="Text" logicOperator="And" searchConditionType="BeginsWith" parameterType="Form" parameterSource="s_nombre"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="34" tableName="fichas" posLeft="10" posTop="10" posWidth="144" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="36" tableName="fichas" fieldName="nombre"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="liquidacion_liquidacion_Grid2_s_nombre_PTAutocomplete1.php" forShow="True" url="liquidacion_liquidacion_Grid2_s_nombre_PTAutocomplete1.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
