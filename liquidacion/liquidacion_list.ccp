<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\liquidacion" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="SandBeach" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="Connection1" dataSource="fichas, propiedades, alquileres, fichaspropiedades" activeCollection="TableParameters" name="fichas_fichaspropiedades1" pageSizeLimit="100" wizardCaption=" Fichas,fichaspropiedades,propiedades Lista de" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No hay registros">
			<Components>
				<Sorter id="27" visible="True" name="Sorter_fichas_idficha" column="fichas.idficha" wizardCaption="Idficha" wizardSortingType="SimpleDir" wizardControl="fichas_idficha" wizardAddNbsp="False" PathID="fichas_fichaspropiedades1Sorter_fichas_idficha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="28" visible="True" name="Sorter_nombre" column="nombre" wizardCaption="Nombre" wizardSortingType="SimpleDir" wizardControl="nombre" wizardAddNbsp="False" PathID="fichas_fichaspropiedades1Sorter_nombre">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="29" visible="True" name="Sorter_propiedades_direccion" column="propiedades.direccion" wizardCaption="Direccion" wizardSortingType="SimpleDir" wizardControl="propiedades_direccion" wizardAddNbsp="False" PathID="fichas_fichaspropiedades1Sorter_propiedades_direccion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="30" visible="True" name="Sorter_propiedades_localidad" column="propiedades.localidad" wizardCaption="Localidad" wizardSortingType="SimpleDir" wizardControl="propiedades_localidad" wizardAddNbsp="False" PathID="fichas_fichaspropiedades1Sorter_propiedades_localidad">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="31" visible="True" name="Sorter_propiedades_telefono" column="propiedades.telefono" wizardCaption="Telefono" wizardSortingType="SimpleDir" wizardControl="propiedades_telefono" wizardAddNbsp="False" PathID="fichas_fichaspropiedades1Sorter_propiedades_telefono">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Label id="32" fieldSourceType="DBColumn" dataType="Integer" html="False" name="fichas_idficha" fieldSource="fichas_idficha" wizardCaption="Idficha" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="fichas_fichaspropiedades1fichas_idficha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="33" fieldSourceType="DBColumn" dataType="Text" html="False" name="nombre" fieldSource="nombre" wizardCaption="Nombre" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="fichas_fichaspropiedades1nombre" visible="Yes" hrefType="Page" urlType="Relative" preserveParameters="GET" hrefSource="liquidacion.ccp">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<LinkParameters>
						<LinkParameter id="40" sourceType="DataField" name="idpropiedad" source="propiedades_idpropiedad"/>
						<LinkParameter id="44" sourceType="DataField" name="idalquiler" source="idalquiler"/>
					</LinkParameters>
				</Link>
				<Label id="34" fieldSourceType="DBColumn" dataType="Text" html="False" name="propiedades_direccion" fieldSource="propiedades_direccion" wizardCaption="Direccion" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="fichas_fichaspropiedades1propiedades_direccion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="35" fieldSourceType="DBColumn" dataType="Text" html="False" name="propiedades_localidad" fieldSource="propiedades_localidad" wizardCaption="Localidad" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="fichas_fichaspropiedades1propiedades_localidad">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="36" fieldSourceType="DBColumn" dataType="Text" html="False" name="propiedades_telefono" fieldSource="propiedades_telefono" wizardCaption="Telefono" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="fichas_fichaspropiedades1propiedades_telefono">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="37" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="TextButtons" wizardFirst="True" wizardFirstText="|&amp;lt;" wizardPrev="True" wizardPrevText="&amp;lt;&amp;lt;" wizardNext="True" wizardNextText="&amp;gt;&amp;gt;" wizardLast="True" wizardLastText="&amp;gt;|" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="de" wizardPageSize="True" wizardImagesScheme="Sandbeach">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="52" conditionType="Parameter" useIsNull="True" field="alquileres.idalquiler" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="Or" parameterSource="s_idalquiler" leftBrackets="0" rightBrackets="0"/>
				<TableParameter id="61" conditionType="Parameter" useIsNull="False" field="fichas.nombre" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="Or" parameterSource="s_nombre"/>
</TableParameters>
			<JoinTables>
				<JoinTable id="3" tableName="fichas" schemaName="dbo" posLeft="10" posTop="10" posWidth="144" posHeight="180"/>
				<JoinTable id="5" tableName="propiedades" schemaName="dbo" posLeft="787" posTop="20" posWidth="121" posHeight="180"/>
				<JoinTable id="41" tableName="alquileres" schemaName="dbo" posLeft="268" posTop="6" posWidth="158" posHeight="180"/>
				<JoinTable id="53" tableName="fichaspropiedades" schemaName="dbo" posLeft="214" posTop="199" posWidth="108" posHeight="104"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="57" tableLeft="propiedades" tableRight="alquileres" fieldLeft="propiedades.idpropiedad" fieldRight="alquileres.idpropiedad" joinType="inner" conditionType="Equal"/>
				<JoinTable2 id="58" tableLeft="fichas" tableRight="fichaspropiedades" fieldLeft="fichas.idficha" fieldRight="fichaspropiedades.idficha" joinType="inner" conditionType="Equal"/>
				<JoinTable2 id="59" tableLeft="propiedades" tableRight="fichaspropiedades" fieldLeft="propiedades.idpropiedad" fieldRight="fichaspropiedades.idpropiedad" joinType="inner" conditionType="Equal"/>
			</JoinLinks>
			<Fields>
				<Field id="8" tableName="fichas" fieldName="nombre"/>
				<Field id="11" tableName="propiedades" fieldName="propiedades.direccion" alias="propiedades_direccion"/>
				<Field id="12" tableName="propiedades" fieldName="propiedades.telefono" alias="propiedades_telefono"/>
				<Field id="13" tableName="propiedades" fieldName="propiedades.localidad" alias="propiedades_localidad"/>
				<Field id="18" tableName="fichas" fieldName="fichas.idficha" alias="fichas_idficha"/>
				<Field id="39" tableName="propiedades" fieldName="propiedades.idpropiedad" alias="propiedades_idpropiedad"/>
				<Field id="43" tableName="alquileres" fieldName="alquileres.idalquiler" alias="alquileres_idalquiler"/>
				<Field id="56" tableName="fichaspropiedades" fieldName="fichaspropiedades.*"/>
				<Field id="60" tableName="alquileres" fieldName="alquileres.idpropiedad" alias="alquileres_idpropiedad"/>
</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="19" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="fichas_fichaspropiedades" wizardCaption=" Fichas Fichaspropiedades Buscar" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="liquidacion_list.ccp" PathID="fichas_fichaspropiedades" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions">
			<Components>
				<Button id="20" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Buscar" PathID="fichas_fichaspropiedadesButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="21" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="s_fichas_idficha" wizardCaption="Idficha" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" PathID="fichas_fichaspropiedadess_fichas_idficha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="23" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_propiedades_direccion" wizardCaption="Direccion" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" PathID="fichas_fichaspropiedadess_propiedades_direccion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="22" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_nombre" wizardCaption="Nombre" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" PathID="fichas_fichaspropiedadess_nombre">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="51" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="s_idalquiler" PathID="fichas_fichaspropiedadess_idalquiler">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
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
		<IncludePage id="50" name="Header" PathID="Header" page="../Header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="liquidacion_list.php" forShow="True" url="liquidacion_list.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
