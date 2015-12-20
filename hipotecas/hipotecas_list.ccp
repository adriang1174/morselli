<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\hipotecas" secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="SandBeach" wizardThemeVersion="3.0" needGeneration="0" isService="False">
	<Components>
		<IncludePage id="35" name="Header" page="../Header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="hipotecasSearch" returnPage="./hipotecas_list.ccp" wizardCaption=" Hipotecas Buscar" wizardOrientation="Vertical" wizardFormMethod="post" PathID="hipotecasSearch">
			<Components>
				<TextBox id="4" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="idhipoteca" wizardCaption="Palabra clave" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" PathID="hipotecasSearchidhipoteca">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Buscar" PathID="hipotecasSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="51" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_nombre" PathID="hipotecasSearchs_nombre">
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
		<Grid id="6" secured="True" sourceType="SQL" returnValueType="Number" defaultPageSize="20" name="hipotecas" connection="Connection1" pageSizeLimit="100" wizardCaption=" Hipotecas Lista de" wizardGridType="Tabular" wizardAllowSorting="True" wizardSortingType="SimpleDir" wizardUsePageScroller="True" wizardAllowInsert="True" wizardAltRecord="False" wizardRecordSeparator="False" wizardAltRecordType="Controls" dataSource="SELECT hipotecas.idhipoteca, propiedades.direccion, estados.descripcion AS estados_descripcion, hipotecas.montohipoteca, hipotecas.fechainicio,
hipotecas.fechafin, hipotecas.idpropiedad AS hipotecas_idpropiedad, simbolo 
FROM ((hipotecas LEFT JOIN propiedades ON
hipotecas.idpropiedad = propiedades.idpropiedad) LEFT JOIN estados ON
hipotecas.idestado = estados.idestado) INNER JOIN Monedas ON
hipotecas.idmoneda = Monedas.idmoneda
WHERE hipotecas.idhipoteca = {idhipoteca} 
or  hipotecas.idhipoteca in(
							select distinct idhipoteca 
							from hipotecas h join propiedades p on(h.idpropiedad = p.idpropiedad)
							join fichaspropiedades fp on(fp.idpropiedad = p.idpropiedad)
							join fichas f on(fp.idficha = f.idficha)
							where f.nombre like '%{s_nombre}%' and '{s_nombre}' &lt;&gt; ''
							)" PathID="hipotecas" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList">
			<Components>
				<Sorter id="14" visible="True" name="Sorter_idhipoteca" column="idhipoteca" wizardCaption="Idhipoteca" wizardSortingType="SimpleDir" wizardControl="idhipoteca" wizardAddNbsp="False" PathID="hipotecasSorter_idhipoteca">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="15" visible="True" name="Sorter_direccion" column="direccion" wizardCaption="Direccion" wizardSortingType="SimpleDir" wizardControl="direccion" wizardAddNbsp="False" PathID="hipotecasSorter_direccion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="16" visible="True" name="Sorter_descripcion" column="descripcion" wizardCaption="Descripcion" wizardSortingType="SimpleDir" wizardControl="descripcion" wizardAddNbsp="False" PathID="hipotecasSorter_descripcion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="17" visible="True" name="Sorter_montohipoteca" column="montohipoteca" wizardCaption="Montohipoteca" wizardSortingType="SimpleDir" wizardControl="montohipoteca" wizardAddNbsp="False" PathID="hipotecasSorter_montohipoteca">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="18" visible="True" name="Sorter_fechainicio" column="fechainicio" wizardCaption="Fechainicio" wizardSortingType="SimpleDir" wizardControl="fechainicio" wizardAddNbsp="False" PathID="hipotecasSorter_fechainicio">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="19" visible="True" name="Sorter_fechafin" column="fechafin" wizardCaption="Fechafin" wizardSortingType="SimpleDir" wizardControl="fechafin" wizardAddNbsp="False" PathID="hipotecasSorter_fechafin">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Link id="21" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="idhipoteca" fieldSource="idhipoteca" wizardCaption="Idhipoteca" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardAddNbsp="True" wizardAlign="right" hrefSource="hipotecas_maint.php" PathID="hipotecasidhipoteca" wizardUseTemplateBlock="False">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="43"/>
							</Actions>
						</Event>
					</Events>
					<LinkParameters>
						<LinkParameter id="22" sourceType="DataField" format="yyyy-mm-dd" name="idhipoteca" source="idhipoteca"/>
						<LinkParameter id="38" sourceType="DataField" name="idpropiedad" source="hipotecas_idpropiedad"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="24" fieldSourceType="DBColumn" dataType="Text" html="False" name="direccion" fieldSource="direccion" wizardCaption="Direccion" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardAddNbsp="True" visible="Yes" hrefType="Page" urlType="Relative" preserveParameters="GET" PathID="hipotecasdireccion" hrefSource="hipotecas_maint.php" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<LinkParameters>
						<LinkParameter id="39" sourceType="DataField" name="idpropiedad" source="hipotecas_idpropiedad"/>
						<LinkParameter id="40" sourceType="DataField" name="idhipoteca" source="idhipoteca"/>
					</LinkParameters>
				</Label>
				<Label id="26" fieldSourceType="DBColumn" dataType="Text" html="False" name="descripcion" fieldSource="descripcion" wizardCaption="Descripcion" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardAddNbsp="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="28" fieldSourceType="DBColumn" dataType="Text" html="False" name="montohipoteca" fieldSource="montohipoteca" wizardCaption="Montohipoteca" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardAddNbsp="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="30" fieldSourceType="DBColumn" dataType="Date" html="False" name="fechainicio" fieldSource="fechainicio" wizardCaption="Fechainicio" wizardSize="10" wizardMaxLength="100" wizardIsPassword="False" wizardAddNbsp="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="32" fieldSourceType="DBColumn" dataType="Date" html="False" name="fechafin" fieldSource="fechafin" wizardCaption="Fechafin" wizardSize="10" wizardMaxLength="100" wizardIsPassword="False" wizardAddNbsp="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="33" size="10" type="Simple" name="Navigator" wizardFirst="True" wizardPrev="True" wizardFirstText="|&lt;" wizardPrevText="&lt;&lt;" wizardNextText="&gt;&gt;" wizardLastText="&gt;|" wizardNext="True" wizardLast="True" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="True" wizardOfText="de" wizardImagesScheme="Sandbeach" pageSizes="1;5;10;25;50" PathID="hipotecasNavigator">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="41" fieldSourceType="DBColumn" dataType="Text" html="False" name="idhipotecaRO" PathID="hipotecasidhipotecaRO" fieldSource="idhipoteca">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="42"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="48" fieldSourceType="DBColumn" dataType="Text" html="False" name="simbolo" PathID="hipotecassimbolo" fieldSource="simbolo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="13" conditionType="Parameter" useIsNull="False" field="hipotecas.idhipoteca" dataType="Integer" logicOperator="Or" searchConditionType="Equal" parameterType="URL" orderNumber="1" parameterSource="idhipoteca"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="7" tableName="hipotecas" posWidth="115" posHeight="180" posLeft="10" posRight="-1" posTop="10"/>
				<JoinTable id="8" tableName="propiedades" posWidth="121" posHeight="180" posLeft="238" posRight="-1" posTop="131"/>
				<JoinTable id="10" tableName="estados" posWidth="95" posHeight="104" posLeft="21" posRight="-1" posTop="200"/>
				<JoinTable id="44" tableName="Monedas" schemaName="dbo" posLeft="423" posTop="62" posWidth="95" posHeight="104"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="9" tableLeft="hipotecas" fieldLeft="hipotecas.idpropiedad" tableRight="propiedades" fieldRight="propiedades.idpropiedad" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="11" tableLeft="hipotecas" fieldLeft="hipotecas.idestado" tableRight="estados" fieldRight="estados.idestado" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="45" tableLeft="hipotecas" tableRight="Monedas" fieldLeft="hipotecas.idmoneda" fieldRight="Monedas.idmoneda" joinType="inner" conditionType="Equal"/>
			</JoinLinks>
			<Fields>
				<Field id="20" tableName="hipotecas" fieldName="hipotecas.idhipoteca"/>
				<Field id="23" tableName="propiedades" fieldName="propiedades.direccion"/>
				<Field id="25" tableName="estados" fieldName="estados.descripcion" alias="estados_descripcion"/>
				<Field id="27" tableName="hipotecas" fieldName="hipotecas.montohipoteca"/>
				<Field id="29" tableName="hipotecas" fieldName="hipotecas.fechainicio"/>
				<Field id="31" tableName="hipotecas" fieldName="hipotecas.fechafin"/>
				<Field id="37" tableName="hipotecas" fieldName="hipotecas.idpropiedad" alias="hipotecas_idpropiedad"/>
				<Field id="47" tableName="Monedas" fieldName="simbolo"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
<SQLParameter id="49" parameterType="URL" variable="idhipoteca" dataType="Integer" parameterSource="idhipoteca" defaultValue="0"/>
<SQLParameter id="50" variable="s_nombre" parameterType="URL" dataType="Text" parameterSource="s_nombre"/>
</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<IncludePage id="36" name="Footer" page="../Footer.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="hipotecas_list.php" forShow="True" url="hipotecas_list.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="hipotecas_list_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="34" groupID="1"/>
	</SecurityGroups>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
