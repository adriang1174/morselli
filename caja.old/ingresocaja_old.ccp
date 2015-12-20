<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\caja" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="SandBeach" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<IncludePage id="2" name="menucaja" PathID="menucaja" page="menucaja.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Connection1" name="movimientoscaja" dataSource="movimientoscaja" errorSummator="Error" wizardCaption="Agregar/Editar Movimientoscaja " wizardFormMethod="post" PathID="movimientoscaja" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions">
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
				<TextBox id="13" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="fecha" fieldSource="fecha" required="False" caption="Fecha" wizardCaption="Fecha" wizardSize="10" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="movimientoscajafecha" DBFormat="yyyymmdd">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="16"/>
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
				<Link id="23" fieldSourceType="DBColumn" dataType="Integer" html="False" name="idmovimiento" fieldSource="idmovimiento" wizardCaption="Idmovimiento" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="movimientoscaja1idmovimiento" visible="Yes" hrefType="Page" urlType="Relative" preserveParameters="GET" hrefSource="ingresocaja.php">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<LinkParameters>
						<LinkParameter id="42" sourceType="DataField" name="idmovimiento" source="idmovimiento"/>
					</LinkParameters>
				</Link>
				<Label id="24" fieldSourceType="DBColumn" dataType="Date" html="False" name="fecha" fieldSource="fecha" wizardCaption="Fecha" wizardSize="10" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="movimientoscaja1fecha">
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
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="40"/>
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
		<Record id="36" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="buscafecha" wizardCaption=" Cajaresumen Buscar" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="ingresocaja.ccp" PathID="buscafecha">
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
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="ingresocaja_old_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="ingresocaja_old.php" forShow="True" url="ingresocaja_old.php" comment="//" codePage="windows-1252"/>
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
