<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="Connection1" dataSource="fichas" activeCollection="TableParameters" name="fichas" pageSizeLimit="100" wizardCaption=" Fichas Lista de" wizardAllowInsert="False">
			<Components>
				<Label id="28" fieldSourceType="DBColumn" dataType="Integer" html="False" name="idficha" fieldSource="idficha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="29" fieldSourceType="DBColumn" dataType="Text" html="False" name="nombre" fieldSource="nombre">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="30" conditionType="Parameter" useIsNull="False" field="nombre" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="And" parameterSource="nombre"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="27" tableName="fichas" posLeft="10" posTop="10" posWidth="144" posHeight="180"/>
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
		<CodeFile id="Code" language="PHPTemplates" name="fichaautofill.php" forShow="True" url="fichaautofill.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
