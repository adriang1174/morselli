<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\liquidacionh" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="SandBeach" wizardThemeVersion="3.0" needGeneration="0" wizardSortingType="SimpleDir" pasteActions="pasteActions">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="100" connection="Connection1" dataSource="select c.idalquiler,f.idficha,f.nombre,c.idcuota,c.mes,c.ano,t.descripcion,c.fechavencimiento,c.fechaaviso,simbolo,sum(c.importe) as importe,sum(c2.importe) as punitorios
from cuotas c
left join cuotas c2 on(c.ano=c2.ano and c.mes=c2.mes and c.idalquiler = c2.idalquiler and c2.idtipocuota = 9)
join hipotecas h on c.idhipoteca = h.idhipoteca
join tipocuota t on t.idtipocuota = c.idtipocuota
join monedas m on h.idmoneda = m.idmoneda
join fichas f on c.idalquiler = f.idficha
where
c.idhipoteca = {idhipoteca}
--and fechavencimiento &lt; getdate()
and c.fechapago is not null
and c.fechaliquidacion is null
and c.idtipocuota = 4
and h.idestado in(1,6,7) 
group by c.idalquiler,f.idficha,f.nombre,c.idcuota,c.mes,c.ano,t.descripcion,c.fechavencimiento,c.fechaaviso,simbolo
order by c.ano,c.mes,f.nombre
" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" name="Grid1" orderBy="fechavencimiento" pageSizeLimit="100" wizardCaption=" Grid1 Lista de" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No hay registros" wizardAllowSorting="True" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions">
			<Components>
				<Sorter id="5" visible="True" name="Sorter_mes" column="mes" wizardCaption="Mes" wizardSortingType="SimpleDir" wizardControl="mes" wizardAddNbsp="False" PathID="Grid1Sorter_mes">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="6" visible="True" name="Sorter_ano" column="ano" wizardCaption="Ano" wizardSortingType="SimpleDir" wizardControl="ano" wizardAddNbsp="False" PathID="Grid1Sorter_ano">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="7" visible="True" name="Sorter_fechavencimiento" column="fechavencimiento" wizardCaption="Fechavencimiento" wizardSortingType="SimpleDir" wizardControl="fechavencimiento" wizardAddNbsp="False" PathID="Grid1Sorter_fechavencimiento">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="8" visible="True" name="Sorter_importe" column="importe" wizardCaption="Importe" wizardSortingType="SimpleDir" wizardControl="importe" wizardAddNbsp="False" PathID="Grid1Sorter_importe">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="9" visible="True" name="Sorter_fechaaviso" column="fechaaviso" wizardCaption="Fechaaviso" wizardSortingType="SimpleDir" wizardControl="fechaaviso" wizardAddNbsp="False" PathID="Grid1Sorter_fechaaviso">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Label id="10" fieldSourceType="DBColumn" dataType="Integer" html="False" name="mes" fieldSource="mes" wizardCaption="Mes" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="Grid1mes">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="11" fieldSourceType="DBColumn" dataType="Integer" html="False" name="ano" fieldSource="ano" wizardCaption="Ano" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="Grid1ano">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="12" fieldSourceType="DBColumn" dataType="Date" html="False" name="fechavencimiento" fieldSource="fechavencimiento" wizardCaption="Fechavencimiento" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="Grid1fechavencimiento" DBFormat="yyyy-mm-dd HH:nn:ss" format="dd/mm/yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="13" fieldSourceType="DBColumn" dataType="Float" html="False" name="importe" fieldSource="importe" wizardCaption="Importe" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="Grid1importe">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="64" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="14" fieldSourceType="DBColumn" dataType="Text" html="False" name="nombre" fieldSource="nombre" wizardCaption="Fechaaviso" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="Grid1nombre">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<CheckBox id="21" visible="Yes" fieldSourceType="DBColumn" dataType="Boolean" name="liquida" PathID="Grid1liquida" checkedValue="1" uncheckedValue="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<Hidden id="23" fieldSourceType="DBColumn" dataType="Integer" name="idcuota" PathID="Grid1idcuota" fieldSource="idcuota">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Button id="24" urlType="Relative" enableValidation="True" isDefault="False" name="Button1" PathID="Grid1Button1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="53" fieldSourceType="DBColumn" dataType="Text" name="idhipoteca" PathID="Grid1idhipoteca">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Link id="59" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Link2" PathID="Grid1Link2" hrefSource="cuota_maint.php" wizardUseTemplateBlock="False" removeParameters="idcuota">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="60" sourceType="URL" format="yyyy-mm-dd" name="idhipoteca" source="idhipoteca"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="61" fieldSourceType="DBColumn" dataType="Text" html="False" name="tipocuota" PathID="Grid1tipocuota" fieldSource="descripcion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Sorter id="62" visible="True" name="Sorter_descripcion" wizardSortingType="SimpleDir" PathID="Grid1Sorter_descripcion" wizardCaption="Tipo de cuota" column="descripcion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Label id="63" fieldSourceType="DBColumn" dataType="Text" html="False" name="simbolo" PathID="Grid1simbolo" fieldSource="simbolo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="65" fieldSourceType="DBColumn" dataType="Float" html="False" name="punitorios" PathID="Grid1punitorios" fieldSource="punitorios">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="66" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="67" fieldSourceType="DBColumn" dataType="Text" html="False" name="simbolop" PathID="Grid1simbolop" fieldSource="simbolo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="68" fieldSourceType="DBColumn" dataType="Text" name="idalquiler" PathID="Grid1idalquiler" fieldSource="idalquiler">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="54" fieldSourceType="DBColumn" dataType="Integer" name="idficha" PathID="Grid1idficha" fieldSource="idficha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="52" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="17" conditionType="Parameter" useIsNull="False" field="idficha" parameterSource="s_idficha" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
				<TableParameter id="18" conditionType="Parameter" useIsNull="False" field="nombre" parameterSource="s_nombre" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="2"/>
			</TableParameters>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="4" variable="idhipoteca" parameterType="URL" defaultValue="0" dataType="Integer" parameterSource="idhipoteca" designDefaultValue="1"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="15" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="Grid2" wizardCaption=" Grid1 Buscar" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="liquidacion.ccp" PathID="Grid2">
			<Components>
				<Button id="16" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Buscar" PathID="Grid2Button_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="55" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="idhipoteca" PathID="Grid2idhipoteca">
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
		<IncludePage id="25" name="Header" PathID="Header" page="../Header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Grid id="69" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="100" connection="Connection1" dataSource="select c.idalquiler,f.nombre,c.idcuota,c.mes,c.ano,t.descripcion,c.fechavencimiento,c.fechaaviso,simbolo,sum(c.importe) as importe,sum(c2.importe) as punitorios
from cuotas c
left join cuotas c2 on(c.ano=c2.ano and c.mes=c2.mes and c.idalquiler = c2.idalquiler and c2.idtipocuota = 9)
join hipotecas h on c.idhipoteca = h.idhipoteca
join tipocuota t on t.idtipocuota = c.idtipocuota
join monedas m on h.idmoneda = m.idmoneda
join fichas f on c.idalquiler = f.idficha
where
c.idhipoteca = {idhipoteca}
--and fechavencimiento &lt; getdate()
and c.fechapago is not null
and c.fechaliquidacion is not null
and c.idtipocuota = 4
and h.idestado in(1,6,7) 
group by c.idalquiler,f.nombre,c.idcuota,c.mes,c.ano,t.descripcion,c.fechavencimiento,c.fechaaviso,simbolo
order by c.ano,c.mes,f.nombre
" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" name="Grid3" orderBy="fechavencimiento" pageSizeLimit="100" wizardCaption=" Grid1 Lista de" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No hay registros" wizardAllowSorting="True" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions">
			<Components>
				<Sorter id="70" visible="True" name="Sorter_mes" column="mes" wizardCaption="Mes" wizardSortingType="SimpleDir" wizardControl="mes" wizardAddNbsp="False" PathID="Grid3Sorter_mes">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="71" visible="True" name="Sorter_ano" column="ano" wizardCaption="Ano" wizardSortingType="SimpleDir" wizardControl="ano" wizardAddNbsp="False" PathID="Grid3Sorter_ano">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="72" visible="True" name="Sorter_fechavencimiento" column="fechavencimiento" wizardCaption="Fechavencimiento" wizardSortingType="SimpleDir" wizardControl="fechavencimiento" wizardAddNbsp="False" PathID="Grid3Sorter_fechavencimiento">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="73" visible="True" name="Sorter_importe" column="importe" wizardCaption="Importe" wizardSortingType="SimpleDir" wizardControl="importe" wizardAddNbsp="False" PathID="Grid3Sorter_importe">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="74" visible="True" name="Sorter_fechaaviso" column="fechaaviso" wizardCaption="Fechaaviso" wizardSortingType="SimpleDir" wizardControl="fechaaviso" wizardAddNbsp="False" PathID="Grid3Sorter_fechaaviso">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Label id="75" fieldSourceType="DBColumn" dataType="Integer" html="False" name="mes" fieldSource="mes" wizardCaption="Mes" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="Grid3mes">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="76" fieldSourceType="DBColumn" dataType="Integer" html="False" name="ano" fieldSource="ano" wizardCaption="Ano" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="Grid3ano">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="77" fieldSourceType="DBColumn" dataType="Date" html="False" name="fechavencimiento" fieldSource="fechavencimiento" wizardCaption="Fechavencimiento" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="Grid3fechavencimiento" DBFormat="yyyy-mm-dd HH:nn:ss" format="dd/mm/yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="78" fieldSourceType="DBColumn" dataType="Float" html="False" name="importe" fieldSource="importe" wizardCaption="Importe" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="Grid3importe">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="79" id_oncopy="79"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="80" fieldSourceType="DBColumn" dataType="Text" html="False" name="nombre" fieldSource="nombre" wizardCaption="Fechaaviso" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="Grid3nombre">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="84" fieldSourceType="DBColumn" dataType="Text" name="idhipoteca" PathID="Grid3idhipoteca">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="85" fieldSourceType="DBColumn" dataType="Text" name="idficha" PathID="Grid3idficha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="88" fieldSourceType="DBColumn" dataType="Text" html="False" name="tipocuota" PathID="Grid3tipocuota" fieldSource="descripcion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Sorter id="89" visible="True" name="Sorter_descripcion" wizardSortingType="SimpleDir" PathID="Grid3Sorter_descripcion" wizardCaption="Tipo de cuota" column="descripcion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Label id="90" fieldSourceType="DBColumn" dataType="Text" html="False" name="simbolo" PathID="Grid3simbolo" fieldSource="simbolo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="91" fieldSourceType="DBColumn" dataType="Float" html="False" name="punitorios" PathID="Grid3punitorios" fieldSource="punitorios">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="92" id_oncopy="92"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="93" fieldSourceType="DBColumn" dataType="Text" html="False" name="simbolop" PathID="Grid3simbolop" fieldSource="simbolo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="82" fieldSourceType="DBColumn" dataType="Integer" name="idcuota" PathID="Grid3idcuota" fieldSource="idcuota">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="94" fieldSourceType="DBColumn" dataType="Text" name="idalquiler" PathID="Grid3idalquiler" fieldSource="idalquiler">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="95" id_oncopy="95"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="92" conditionType="Parameter" useIsNull="False" field="idficha" parameterSource="s_idficha" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
				<TableParameter id="93" conditionType="Parameter" useIsNull="False" field="nombre" parameterSource="s_nombre" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="2"/>
			</TableParameters>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="94" variable="idhipoteca" parameterType="URL" defaultValue="0" dataType="Integer" parameterSource="idhipoteca" designDefaultValue="1"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="liquidacion.php" forShow="True" url="liquidacion.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="liquidacion_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
