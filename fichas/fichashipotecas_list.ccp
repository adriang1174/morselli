<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\fichas" secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="SandBeach" wizardThemeVersion="3.0" needGeneration="0" isService="False">
	<Components>
		<IncludePage id="31" name="Header" parentType="Page" page="../Header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="fichashipotecasSearch" returnPage="./fichashipotecas_list.ccp" wizardCaption=" Fichashipotecas Buscar" wizardOrientation="Vertical" wizardFormMethod="post" PathID="fichashipotecasSearch">
			<Components>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Buscar" PathID="fichashipotecasSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events/>
			<TableParameters/>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions/>
			<UFormElements/>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
		<Grid id="5" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="20" name="fichashipotecas" connection="Connection1" pageSizeLimit="100" wizardCaption=" Fichashipotecas Lista de" wizardGridType="Tabular" wizardAllowSorting="True" wizardSortingType="SimpleDir" wizardUsePageScroller="True" wizardAllowInsert="True" wizardAltRecord="False" wizardRecordSeparator="False" wizardAltRecordType="Controls" dataSource="fichashipotecas, hipotecas , fichas " PathID="fichashipotecas">
			<Components>
				<Sorter id="13" visible="True" name="Sorter_montohipoteca" column="montohipoteca" wizardCaption="Montohipoteca" wizardSortingType="SimpleDir" wizardControl="montohipoteca" wizardAddNbsp="False" PathID="fichashipotecasSorter_montohipoteca">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="14" visible="True" name="Sorter_idtipodocumento" column="idtipodocumento" wizardCaption="Idtipodocumento" wizardSortingType="SimpleDir" wizardControl="idtipodocumento" wizardAddNbsp="False" PathID="fichashipotecasSorter_idtipodocumento">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="15" visible="True" name="Sorter_porcentajehip" column="porcentajehip" wizardCaption="Porcentajehip" wizardSortingType="SimpleDir" wizardControl="porcentajehip" wizardAddNbsp="False" PathID="fichashipotecasSorter_porcentajehip">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="16" visible="True" name="Sorter_acreedor" column="acreedor" wizardCaption="Acreedor" wizardSortingType="SimpleDir" wizardControl="acreedor" wizardAddNbsp="False" PathID="fichashipotecasSorter_acreedor">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="17" visible="True" name="Sorter_deudor" column="deudor" wizardCaption="Deudor" wizardSortingType="SimpleDir" wizardControl="deudor" wizardAddNbsp="False" PathID="fichashipotecasSorter_deudor">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Link id="19" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="montohipoteca" fieldSource="montohipoteca" wizardCaption="Montohipoteca" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardAddNbsp="True" hrefSource="./fichashipotecas_maint.ccp" rowNumber="1" PathID="fichashipotecasmontohipoteca">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="20" sourceType="DataField" format="yyyy-mm-dd" name="idficha" source="fichashipotecas_idficha"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="22" fieldSourceType="DBColumn" dataType="Text" html="False" name="idtipodocumento" fieldSource="idtipodocumento" wizardCaption="Idtipodocumento" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardAddNbsp="True" parentName="fichashipotecas" rowNumber="1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="24" fieldSourceType="DBColumn" dataType="Float" html="False" name="porcentajehip" fieldSource="porcentajehip" wizardCaption="Porcentajehip" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardAddNbsp="True" wizardAlign="right" parentName="fichashipotecas" rowNumber="1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="26" fieldSourceType="DBColumn" dataType="Boolean" html="False" name="acreedor" fieldSource="acreedor" wizardCaption="Acreedor" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" wizardAddNbsp="True" parentName="fichashipotecas" rowNumber="1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="28" fieldSourceType="DBColumn" dataType="Boolean" html="False" name="deudor" fieldSource="deudor" wizardCaption="Deudor" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" wizardAddNbsp="True" parentName="fichashipotecas" rowNumber="1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="11" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="fichashipotecas_Insert" hrefSource="./fichashipotecas_maint.ccp" removeParameters="idficha" wizardThemeItem="NavigatorLink" wizardDefaultValue="Agregar Nuevo" PathID="fichashipotecasfichashipotecas_Insert">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</Link>
				<Navigator id="29" size="10" type="Simple" name="Navigator" wizardFirst="True" wizardPrev="True" wizardFirstText="|&lt;" wizardPrevText="&lt;&lt;" wizardNextText="&gt;&gt;" wizardLastText="&gt;|" wizardNext="True" wizardLast="True" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="True" wizardOfText="de" wizardImagesScheme="Sandbeach" pageSizes="1;5;10;25;50" PathID="fichashipotecasNavigator">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
			</Components>
			<Events/>
			<TableParameters/>
			<JoinTables>
				<JoinTable id="6" tableName="fichashipotecas" posWidth="-1" posHeight="-1" posLeft="-1" posRight="-1"/>
				<JoinTable id="7" tableName="hipotecas" posWidth="-1" posHeight="-1" posLeft="-1" posRight="-1"/>
				<JoinTable id="9" tableName="fichas" posWidth="-1" posHeight="-1" posLeft="-1" posRight="-1"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="8" tableLeft="fichashipotecas" fieldLeft="fichashipotecas.idhipoteca" tableRight="hipotecas" fieldRight="hipotecas.idhipoteca" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="10" tableLeft="fichashipotecas" fieldLeft="fichashipotecas.idficha" tableRight="fichas" fieldRight="fichas.idficha" conditionType="Equal" joinType="left"/>
			</JoinLinks>
			<Fields>
				<Field id="12" tableName="fichashipotecas" fieldName="fichashipotecas.idficha" alias="fichashipotecas_idficha"/>
				<Field id="18" tableName="hipotecas" fieldName="hipotecas.montohipoteca"/>
				<Field id="21" tableName="fichas" fieldName="fichas.idtipodocumento"/>
				<Field id="23" tableName="fichashipotecas" fieldName="fichashipotecas.porcentajehip"/>
				<Field id="25" tableName="fichashipotecas" fieldName="fichashipotecas.acreedor"/>
				<Field id="27" tableName="fichashipotecas" fieldName="fichashipotecas.deudor"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<IncludePage id="32" name="Footer" parentType="Page" page="../Footer.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="fichashipotecas_list.php" forShow="True" url="fichashipotecas_list.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="30" groupID="1"/>
	</SecurityGroups>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
