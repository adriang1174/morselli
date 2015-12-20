<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\caja" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="SandBeach" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<IncludePage id="2" name="Headercaja" PathID="Headercaja" page="Headercaja.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Connection1" name="movimientoscaja" dataSource="movimientoscaja" errorSummator="Error" wizardCaption="Agregar/Editar Movimientoscaja " wizardFormMethod="post" PathID="movimientoscaja" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" removeParameters="idmovimiento">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Agregar" PathID="movimientoscajaButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="5" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Enviar" PathID="movimientoscajaButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="6" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Borrar" PathID="movimientoscajaButton_Delete">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<ListBox id="8" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="idmoneda" fieldSource="idmoneda" required="True" caption="Idmoneda" wizardCaption="Idmoneda" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="movimientoscajaidmoneda" sourceType="Table" connection="Connection1" dataSource="Monedas" boundColumn="idmoneda" textColumn="descripcion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="15" tableName="Monedas" schemaName="dbo" posLeft="10" posTop="10" posWidth="95" posHeight="104"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
				</ListBox>
				<ListBox id="10" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="idcodgasto" fieldSource="idcodgasto" required="True" caption="Idcodgasto" wizardCaption="Idcodgasto" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="movimientoscajaidcodgasto" sourceType="Table" connection="Connection1" dataSource="codigosgastos" boundColumn="idcodgasto" textColumn="descripcion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
				</ListBox>
				<TextBox id="11" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="numero" fieldSource="numero" required="False" caption="Numero" wizardCaption="Numero" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="movimientoscajanumero">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="12" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="importe" fieldSource="importe" required="True" caption="Importe" wizardCaption="Importe" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="movimientoscajaimporte">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="13" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="fecha" fieldSource="fecha" required="False" caption="Fecha" wizardCaption="Fecha" wizardSize="10" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="movimientoscajafecha" DBFormat="yyyymmdd HH:nn:ss" format="dd/mm/yyyy HH:nn:ss">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="16"/>
							</Actions>
						</Event>
						<Event name="OnValidate" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="43"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="14" name="DatePicker_fecha" control="fecha" wizardSatellite="True" wizardControl="fecha" wizardDatePickerType="Image" wizardPicture="../Styles/SandBeach/Images/DatePicker.gif" style="../Styles/SandBeach/Style.css" PathID="movimientoscajaDatePicker_fecha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<Hidden id="9" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="tipomovimiento" fieldSource="tipomovimiento" required="True" caption="Tipomovimiento" wizardCaption="Tipomovimiento" wizardSize="2" wizardMaxLength="2" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="movimientoscajatipomovimiento">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="17"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="OnValidate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="19"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="41"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="7" conditionType="Parameter" useIsNull="False" field="idmovimiento" parameterSource="idmovimiento" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="44" tableName="movimientoscaja" posLeft="10" posTop="10" posWidth="120" posHeight="180"/>
			</JoinTables>
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
		<Grid id="20" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="10" connection="Connection1" dataSource="SELECT idmovimiento,m.idmoneda,mo.simbolo,c.idcuota,c.idhipoteca,c.idalquiler,m.idcodgasto,tipomovimiento,fecha,numero,m.importe,
case when c.idcuota is not null then
		t.descripcion
else
		--case when tipomovimiento = 'C' then
		--	'Ingreso manual'
		--     when tipomovimiento = 'D' then
		--	'Egreso manual'
		--end 
	g.descripcion		
end as descripcion,
case when tipomovimiento = 'C' then
		m.importe
else
		null
end as importec,
case when tipomovimiento = 'D' then
		m.importe
else
		null
end as imported
FROM movimientoscaja m left join
cuotas c on(m.idcuota = c.idcuota)
left join tipocuota t on(c.idtipocuota = t.idtipocuota)
left join codigosgastos g on(g.idcodgasto = m.idcodgasto)
left join monedas mo on(mo.idmoneda = m.idmoneda)
WHERE fecha &gt;= '{fecha}' and fecha &lt; dateadd(d,1,'{fecha}')
ORDER BY fecha" activeCollection="SQLParameters" name="movimientoscaja1" orderBy="fecha" pageSizeLimit="100" wizardCaption=" Movimientoscaja Lista de" wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No hay registros" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" parameterTypeListName="ParameterTypeList">
			<Components>
				<Link id="23" fieldSourceType="DBColumn" dataType="Integer" html="False" name="idmovimiento" fieldSource="idmovimiento" wizardCaption="Idmovimiento" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="movimientoscaja1idmovimiento" visible="Yes" hrefType="Page" urlType="Relative" preserveParameters="GET" hrefSource="egresocaja.php">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<LinkParameters>
						<LinkParameter id="42" sourceType="DataField" name="idmovimiento" source="idmovimiento"/>
					</LinkParameters>
				</Link>
				<Label id="24" fieldSourceType="DBColumn" dataType="Text" html="False" name="fecha" fieldSource="fecha" wizardCaption="Fecha" wizardSize="10" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="movimientoscaja1fecha" DBFormat="yyyy-mm-dd HH:nn:ss">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="25" fieldSourceType="DBColumn" dataType="Text" html="False" name="numero" fieldSource="numero" wizardCaption="Numero" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="movimientoscaja1numero">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="26" fieldSourceType="DBColumn" dataType="Text" html="False" name="idmoneda" fieldSource="simbolo" wizardCaption="Idmoneda" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="movimientoscaja1idmoneda">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="28" fieldSourceType="DBColumn" dataType="Integer" html="False" name="idcodgasto" fieldSource="idcodgasto" wizardCaption="Idcodgasto" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="movimientoscaja1idcodgasto">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="30" fieldSourceType="DBColumn" dataType="Float" html="False" name="importe" fieldSource="importe" wizardCaption="Importe" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="movimientoscaja1importe">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Navigator id="31" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="TextButtons" wizardFirst="True" wizardFirstText="|&amp;lt;" wizardPrev="True" wizardPrevText="&amp;lt;&amp;lt;" wizardNext="True" wizardNextText="&amp;gt;&amp;gt;" wizardLast="True" wizardLastText="&amp;gt;|" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="de" wizardPageSize="False" wizardImagesScheme="Sandbeach">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="32" fieldSourceType="DBColumn" dataType="Text" html="False" name="importec" PathID="movimientoscaja1importec" fieldSource="importec">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="33" fieldSourceType="DBColumn" dataType="Text" html="False" name="imported" PathID="movimientoscaja1imported" fieldSource="imported">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="29" fieldSourceType="DBColumn" dataType="Text" html="False" name="tipomovimiento" fieldSource="tipomovimiento" wizardCaption="Tipomovimiento" wizardSize="2" wizardMaxLength="2" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="movimientoscaja1tipomovimiento">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="34" fieldSourceType="DBColumn" dataType="Text" html="False" name="descripcion" PathID="movimientoscaja1descripcion" fieldSource="descripcion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="27" fieldSourceType="DBColumn" dataType="Integer" html="False" name="idcuota" fieldSource="idcuota" wizardCaption="Idcuota" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="movimientoscaja1idcuota">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="45" fieldSourceType="DBColumn" dataType="Text" html="False" name="dia" PathID="movimientoscaja1dia">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="46"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="40"/>
					</Actions>
				</Event>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="47"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="22" conditionType="Parameter" useIsNull="False" field="fecha" dataType="Date" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="fecha"/>
			</TableParameters>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="35" parameterType="URL" variable="fecha" dataType="Text" parameterSource="fecha" designDefaultValue="20091020"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="36" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="buscafecha" wizardCaption=" Cajaresumen Buscar" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="egresocaja.ccp" PathID="buscafecha">
			<Components>
				<Button id="37" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Buscar" PathID="buscafechaButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="38" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="fecha" wizardCaption="Fecha" wizardSize="10" wizardMaxLength="100" wizardIsPassword="False" PathID="buscafechafecha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="39" name="DatePicker_s_fecha" control="fecha" wizardSatellite="True" wizardControl="s_fecha" wizardDatePickerType="Image" wizardPicture="../Styles/SandBeach/Images/DatePicker.gif" style="../Styles/SandBeach/Style.css" PathID="buscafechaDatePicker_s_fecha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
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
		<Grid id="48" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="20" connection="Connection1" dataSource="nupcias" name="nupcias" pageSizeLimit="100" wizardCaption="{res:CCS_GridFormPrefix} {res:nupcias} {res:CCS_GridFormSuffix}" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="True" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="{res:CCS_NoRecords}">
<Components>
<Link id="50" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="nupcias_Insert" hrefSource="egresocaja.ccp" removeParameters="idnupcias" wizardThemeItem="FooterA" wizardDefaultValue="{res:CCS_InsertLink}" wizardUseTemplateBlock="False" PathID="nupciasnupcias_Insert">
<Components/>
<Events/>
<LinkParameters/>
<Attributes/>
<Features/>
</Link>
<Sorter id="51" visible="True" name="Sorter_idnupcias" column="idnupcias" wizardCaption="{res:idnupcias}" wizardSortingType="SimpleDir" wizardControl="idnupcias" wizardAddNbsp="False" PathID="nupciasSorter_idnupcias">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Sorter>
<Sorter id="52" visible="True" name="Sorter_desnupcias" column="desnupcias" wizardCaption="{res:desnupcias}" wizardSortingType="SimpleDir" wizardControl="desnupcias" wizardAddNbsp="False" PathID="nupciasSorter_desnupcias">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Sorter>
<Link id="53" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="idnupcias" fieldSource="idnupcias" wizardCaption="{res:idnupcias}" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" hrefSource="egresocaja.ccp" wizardThemeItem="GridA" PathID="nupciasidnupcias">
<Components/>
<Events/>
<LinkParameters>
<LinkParameter id="54" sourceType="DataField" format="yyyy-mm-dd" name="idnupcias" source="idnupcias"/>
</LinkParameters>
<Attributes/>
<Features/>
</Link>
<Label id="56" fieldSourceType="DBColumn" dataType="Text" html="False" name="desnupcias" fieldSource="desnupcias" wizardCaption="{res:desnupcias}" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="nupciasdesnupcias">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
</Components>
<Events/>
<TableParameters/>
<JoinTables/>
<JoinLinks/>
<Fields>
<Field id="49" tableName="nupcias" fieldName="idnupcias"/>
<Field id="55" tableName="nupcias" fieldName="desnupcias"/>
</Fields>
<SPParameters/>
<SQLParameters/>
<SecurityGroups/>
<Attributes/>
<Features/>
</Grid>
<Record id="57" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Connection1" name="nupcias1" dataSource="nupcias" errorSummator="Error" wizardCaption="{res:CCS_RecordFormPrefix} {res:nupcias} {res:CCS_RecordFormSuffix}" wizardFormMethod="post" PathID="nupcias1">
<Components>
<Button id="58" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="{res:CCS_Insert}" PathID="nupcias1Button_Insert">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Button>
<Button id="59" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="{res:CCS_Update}" PathID="nupcias1Button_Update">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Button>
<Button id="60" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="{res:CCS_Delete}" PathID="nupcias1Button_Delete">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Button>
<TextBox id="62" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="idnupcias" fieldSource="idnupcias" required="True" caption="{res:idnupcias}" wizardCaption="{res:idnupcias}" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="nupcias1idnupcias">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<TextBox id="63" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="desnupcias" fieldSource="desnupcias" required="True" caption="{res:desnupcias}" wizardCaption="{res:desnupcias}" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="nupcias1desnupcias">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
</Components>
<Events/>
<TableParameters>
<TableParameter id="61" conditionType="Parameter" useIsNull="False" field="idnupcias" parameterSource="idnupcias" dataType="Text" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
</TableParameters>
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
</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="egresocaja_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="egresocaja.php" forShow="True" url="egresocaja.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="BeforeInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="18"/>
			</Actions>
		</Event>
	</Events>
</Page>
