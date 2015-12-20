<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\fichas" secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="SandBeach" wizardThemeVersion="3.0" needGeneration="0" isService="False">
	<Components>
		<IncludePage id="31" name="Header" parentType="Page" page="../Header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="fichasalquileresSearch" returnPage="./fichasalquilere_list.ccp" wizardCaption=" Fichasalquileres Buscar" wizardOrientation="Vertical" wizardFormMethod="post" PathID="fichasalquileresSearch">
			<Components>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Buscar" PathID="fichasalquileresSearchButton_DoSearch">
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
		<Grid id="5" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="20" name="fichasalquileres" connection="Connection1" pageSizeLimit="100" wizardCaption=" Fichasalquileres Lista de" wizardGridType="Tabular" wizardAllowSorting="True" wizardSortingType="SimpleDir" wizardUsePageScroller="True" wizardAllowInsert="True" wizardAltRecord="False" wizardRecordSeparator="False" wizardAltRecordType="Controls" dataSource="fichasalquileres, fichas , alquileres " PathID="fichasalquileres">
			<Components>
				<Sorter id="13" visible="True" name="Sorter_idtipodocumento" column="idtipodocumento" wizardCaption="Idtipodocumento" wizardSortingType="SimpleDir" wizardControl="idtipodocumento" wizardAddNbsp="False" PathID="fichasalquileresSorter_idtipodocumento">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="14" visible="True" name="Sorter_fechainicio" column="fechainicio" wizardCaption="Fechainicio" wizardSortingType="SimpleDir" wizardControl="fechainicio" wizardAddNbsp="False" PathID="fichasalquileresSorter_fechainicio">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="15" visible="True" name="Sorter_porcentajealq" column="porcentajealq" wizardCaption="Porcentajealq" wizardSortingType="SimpleDir" wizardControl="porcentajealq" wizardAddNbsp="False" PathID="fichasalquileresSorter_porcentajealq">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="16" visible="True" name="Sorter_inquilino" column="inquilino" wizardCaption="Inquilino" wizardSortingType="SimpleDir" wizardControl="inquilino" wizardAddNbsp="False" PathID="fichasalquileresSorter_inquilino">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="17" visible="True" name="Sorter_propietario" column="propietario" wizardCaption="Propietario" wizardSortingType="SimpleDir" wizardControl="propietario" wizardAddNbsp="False" PathID="fichasalquileresSorter_propietario">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Link id="19" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="idtipodocumento" fieldSource="idtipodocumento" wizardCaption="Idtipodocumento" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardAddNbsp="True" hrefSource="./fichasalquilere_maint.ccp" rowNumber="1" PathID="fichasalquileresidtipodocumento">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="20" sourceType="DataField" format="yyyy-mm-dd" name="idalquiler" source="fichasalquileres_idalquiler"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="22" fieldSourceType="DBColumn" dataType="Text" html="False" name="fechainicio" fieldSource="fechainicio" wizardCaption="Fechainicio" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardAddNbsp="True" parentName="fichasalquileres" rowNumber="1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="24" fieldSourceType="DBColumn" dataType="Float" html="False" name="porcentajealq" fieldSource="porcentajealq" wizardCaption="Porcentajealq" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardAddNbsp="True" wizardAlign="right" parentName="fichasalquileres" rowNumber="1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="26" fieldSourceType="DBColumn" dataType="Boolean" html="False" name="inquilino" fieldSource="inquilino" wizardCaption="Inquilino" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" wizardAddNbsp="True" parentName="fichasalquileres" rowNumber="1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="28" fieldSourceType="DBColumn" dataType="Boolean" html="False" name="propietario" fieldSource="propietario" wizardCaption="Propietario" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" wizardAddNbsp="True" parentName="fichasalquileres" rowNumber="1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="11" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="fichasalquileres_Insert" hrefSource="./fichasalquilere_maint.ccp" removeParameters="idalquiler" wizardThemeItem="NavigatorLink" wizardDefaultValue="Agregar Nuevo" PathID="fichasalquileresfichasalquileres_Insert">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</Link>
				<Navigator id="29" size="10" type="Simple" name="Navigator" wizardFirst="True" wizardPrev="True" wizardFirstText="|&lt;" wizardPrevText="&lt;&lt;" wizardNextText="&gt;&gt;" wizardLastText="&gt;|" wizardNext="True" wizardLast="True" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="True" wizardOfText="de" wizardImagesScheme="Sandbeach" pageSizes="1;5;10;25;50" PathID="fichasalquileresNavigator">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
			</Components>
			<Events/>
			<TableParameters/>
			<JoinTables>
				<JoinTable id="6" tableName="fichasalquileres" posWidth="-1" posHeight="-1" posLeft="-1" posRight="-1"/>
				<JoinTable id="7" tableName="fichas" posWidth="-1" posHeight="-1" posLeft="-1" posRight="-1"/>
				<JoinTable id="9" tableName="alquileres" posWidth="-1" posHeight="-1" posLeft="-1" posRight="-1"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="8" tableLeft="fichasalquileres" fieldLeft="fichasalquileres.idficha" tableRight="fichas" fieldRight="fichas.idficha" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="10" tableLeft="fichasalquileres" fieldLeft="fichasalquileres.idalquiler" tableRight="alquileres" fieldRight="alquileres.idalquiler" conditionType="Equal" joinType="left"/>
			</JoinLinks>
			<Fields>
				<Field id="12" tableName="fichasalquileres" fieldName="fichasalquileres.idalquiler" alias="fichasalquileres_idalquiler"/>
				<Field id="18" tableName="fichas" fieldName="fichas.idtipodocumento"/>
				<Field id="21" tableName="alquileres" fieldName="alquileres.fechainicio"/>
				<Field id="23" tableName="fichasalquileres" fieldName="fichasalquileres.porcentajealq"/>
				<Field id="25" tableName="fichasalquileres" fieldName="fichasalquileres.inquilino"/>
				<Field id="27" tableName="fichasalquileres" fieldName="fichasalquileres.propietario"/>
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
		<CodeFile id="Code" language="PHPTemplates" name="fichasalquilere_list.php" forShow="True" url="fichasalquilere_list.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="30" groupID="1"/>
	</SecurityGroups>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
