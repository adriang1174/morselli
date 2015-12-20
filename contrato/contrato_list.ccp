<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\contrato" secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="SandBeach" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="Connection1" dataSource="alquileres, propiedades, tipopropiedades" activeCollection="TableParameters" name="alquileres_propiedades_ti1" orderBy="idalquiler" pageSizeLimit="100" wizardCaption=" Alquileres,propiedades,tipopropiedades Lista de" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No hay registros" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions">
			<Components>
				<Sorter id="21" visible="True" name="Sorter_idalquiler" column="idalquiler" wizardCaption="Idalquiler" wizardSortingType="SimpleDir" wizardControl="idalquiler" wizardAddNbsp="False" PathID="alquileres_propiedades_ti1Sorter_idalquiler">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="22" visible="True" name="Sorter_fechainicio" column="fechainicio" wizardCaption="Fechainicio" wizardSortingType="SimpleDir" wizardControl="fechainicio" wizardAddNbsp="False" PathID="alquileres_propiedades_ti1Sorter_fechainicio">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="23" visible="True" name="Sorter_fechafin" column="fechafin" wizardCaption="Fechafin" wizardSortingType="SimpleDir" wizardControl="fechafin" wizardAddNbsp="False" PathID="alquileres_propiedades_ti1Sorter_fechafin">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="25" visible="True" name="Sorter_direccion" column="direccion" wizardCaption="Direccion" wizardSortingType="SimpleDir" wizardControl="direccion" wizardAddNbsp="False" PathID="alquileres_propiedades_ti1Sorter_direccion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="26" visible="True" name="Sorter_localidad" column="localidad" wizardCaption="Localidad" wizardSortingType="SimpleDir" wizardControl="localidad" wizardAddNbsp="False" PathID="alquileres_propiedades_ti1Sorter_localidad">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="27" visible="True" name="Sorter_destipopropiedad" column="destipopropiedad" wizardCaption="Destipopropiedad" wizardSortingType="SimpleDir" wizardControl="destipopropiedad" wizardAddNbsp="False" PathID="alquileres_propiedades_ti1Sorter_destipopropiedad">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Label id="28" fieldSourceType="DBColumn" dataType="Integer" html="False" name="idalquiler" fieldSource="idalquiler" wizardCaption="Idalquiler" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="alquileres_propiedades_ti1idalquiler">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="29" fieldSourceType="DBColumn" dataType="Date" html="False" name="fechainicio" fieldSource="fechainicio" wizardCaption="Fechainicio" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="alquileres_propiedades_ti1fechainicio">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="30" fieldSourceType="DBColumn" dataType="Date" html="False" name="fechafin" fieldSource="fechafin" wizardCaption="Fechafin" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="alquileres_propiedades_ti1fechafin">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="32" fieldSourceType="DBColumn" dataType="Text" html="False" name="direccion" fieldSource="direccion" wizardCaption="Direccion" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="alquileres_propiedades_ti1direccion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="33" fieldSourceType="DBColumn" dataType="Text" html="False" name="localidad" fieldSource="localidad" wizardCaption="Localidad" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="alquileres_propiedades_ti1localidad">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="34" fieldSourceType="DBColumn" dataType="Text" html="False" name="destipopropiedad" fieldSource="destipopropiedad" wizardCaption="Destipopropiedad" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="alquileres_propiedades_ti1destipopropiedad">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="35" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="TextButtons" wizardFirst="True" wizardFirstText="|&amp;lt;" wizardPrev="True" wizardPrevText="&amp;lt;&amp;lt;" wizardNext="True" wizardNextText="&amp;gt;&amp;gt;" wizardLast="True" wizardLastText="&amp;gt;|" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="de" wizardPageSize="True" wizardImagesScheme="Sandbeach">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Hidden id="31" fieldSourceType="DBColumn" dataType="Integer" html="False" name="propiedades_idpropiedad" fieldSource="propiedades_idpropiedad" wizardCaption="Idpropiedad" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="alquileres_propiedades_ti1propiedades_idpropiedad">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Link id="36" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Link1" PathID="alquileres_propiedades_ti1Link1" hrefSource="contrato.php" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="37" sourceType="DataField" format="yyyy-mm-dd" name="idalquiler" source="idalquiler"/>
						<LinkParameter id="38" sourceType="DataField" format="yyyy-mm-dd" name="idpropiedad" source="propiedades_idpropiedad"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="20" conditionType="Parameter" useIsNull="False" field="alquileres.idalquiler" dataType="Integer" logicOperator="Or" searchConditionType="Equal" parameterType="URL" orderNumber="1" parameterSource="s_idalquiler"/>
				<TableParameter id="41" conditionType="Parameter" useIsNull="False" field="propiedades.direccion" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="Or" parameterSource="s_direccion"/>
</TableParameters>
			<JoinTables>
				<JoinTable id="3" tableName="alquileres" schemaName="dbo" posLeft="10" posTop="10" posWidth="158" posHeight="180"/>
				<JoinTable id="4" tableName="propiedades" schemaName="dbo" posLeft="267" posTop="3" posWidth="121" posHeight="180"/>
				<JoinTable id="6" tableName="tipopropiedades" schemaName="dbo" posLeft="499" posTop="3" posWidth="113" posHeight="88"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="5" tableLeft="alquileres" tableRight="propiedades" fieldLeft="alquileres.idpropiedad" fieldRight="propiedades.idpropiedad" joinType="inner" conditionType="Equal"/>
				<JoinTable2 id="7" tableLeft="propiedades" tableRight="tipopropiedades" fieldLeft="propiedades.idtipopropiedad" fieldRight="tipopropiedades.idtipopropiedad" joinType="inner" conditionType="Equal"/>
			</JoinLinks>
			<Fields>
				<Field id="10" tableName="tipopropiedades" fieldName="destipopropiedad"/>
				<Field id="11" tableName="propiedades" fieldName="direccion"/>
				<Field id="12" tableName="propiedades" fieldName="localidad"/>
				<Field id="13" tableName="alquileres" fieldName="fechainicio"/>
				<Field id="14" tableName="alquileres" fieldName="fechafin"/>
				<Field id="15" tableName="alquileres" fieldName="idalquiler"/>
				<Field id="16" tableName="propiedades" fieldName="propiedades.idpropiedad" alias="propiedades_idpropiedad"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="17" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="alquileres_propiedades_ti" wizardCaption=" Alquileres Propiedades Ti Buscar" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="contrato_list.ccp" PathID="alquileres_propiedades_ti">
			<Components>
				<Button id="18" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Buscar" PathID="alquileres_propiedades_tiButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="19" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="s_idalquiler" wizardCaption="Idalquiler" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" PathID="alquileres_propiedades_tis_idalquiler">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="40" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_direccion" PathID="alquileres_propiedades_tis_direccion">
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
		<IncludePage id="39" name="Header" PathID="Header" page="../Header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="contrato_list.php" forShow="True" url="contrato_list.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
