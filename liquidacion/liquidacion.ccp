<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\liquidacion" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="SandBeach" wizardThemeVersion="3.0" needGeneration="0" wizardSortingType="SimpleDir">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="200" connection="Connection1" dataSource="select c.idcuota,c.mes,c.ano,t.descripcion,t.idtipocuota,c.fechavencimiento,c.fechaaviso,c.fechaliquidacion,simbolo,sum(c.importe) as importe
from cuotas c
join alquileres a on c.idalquiler = a.idalquiler
join tipocuota t on t.idtipocuota = c.idtipocuota
join monedas m on a.idmoneda = m.idmoneda,
(select distinct ano,mes from cuotas where fechapago is not null and fechaliquidacion is null 
and  idalquiler = {idalquiler}
) c1
where
c.idalquiler = {idalquiler} 
and c.ano=c1.ano
and c.mes = c1.mes
and c.idtipocuota = 1
and fechaliquidacion is null
--and a.idestado in(1,6,7) 
group by c.idcuota,c.mes,c.ano,t.descripcion,t.idtipocuota,fechavencimiento,fechaaviso,fechaliquidacion,simbolo
order by c.ano,c.mes,t.idtipocuota

" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" name="Grid1" orderBy="fechavencimiento" pageSizeLimit="500" wizardCaption=" Grid1 Lista de" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No hay registros" wizardAllowSorting="True" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions">
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
				<Label id="14" fieldSourceType="DBColumn" dataType="Date" html="False" name="fechaaviso" fieldSource="fechaaviso" wizardCaption="Fechaaviso" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="Grid1fechaaviso">
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
				<Label id="51" fieldSourceType="DBColumn" dataType="Text" html="False" name="nombrefichacontrato" PathID="Grid1nombrefichacontrato">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="54" fieldSourceType="DBColumn" dataType="Text" name="idficha" PathID="Grid1idficha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Link id="59" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Link2" PathID="Grid1Link2" hrefSource="cuota_maint.php" wizardUseTemplateBlock="False" removeParameters="idcuota">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="60" sourceType="URL" format="yyyy-mm-dd" name="idalquiler" source="idalquiler"/>
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
				<Hidden id="53" fieldSourceType="DBColumn" dataType="Text" name="idalquiler" PathID="Grid1idalquiler" html="False">
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
				<SQLParameter id="4" variable="idalquiler" parameterType="URL" defaultValue="0" dataType="Integer" parameterSource="idalquiler" designDefaultValue="108"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="15" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="Grid2" wizardCaption=" Grid1 Buscar" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="liquidacion.ccp" PathID="Grid2" pasteActions="pasteActions">
			<Components>
				<Button id="16" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Buscar" PathID="Grid2Button_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="55" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="idalquiler" PathID="Grid2idalquiler">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="22" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_nombre" wizardCaption="Nombre" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" PathID="Grid2s_nombre">
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
		<Grid id="65" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="200" connection="Connection1" dataSource="select c.idcuota,c.mes,c.ano,t.descripcion,t.idtipocuota,c.fechavencimiento,c.fechaaviso,c.fechaliquidacion,simbolo,sum(c.importe) as importe
from cuotas c
join alquileres a on c.idalquiler = a.idalquiler
join tipocuota t on t.idtipocuota = c.idtipocuota
join monedas m on a.idmoneda = m.idmoneda,
(select distinct ano,mes from cuotas where fechapago is not null and fechaliquidacion is not null and idalquiler = {idalquiler} 
) c1
where
c.idalquiler = {idalquiler} 
and c.ano=c1.ano
and c.mes = c1.mes
and c.idtipocuota = 1
and fechaliquidacion is not null
--and a.idestado in(1,6,7) 
group by c.idcuota,c.mes,c.ano,t.descripcion,t.idtipocuota,fechavencimiento,fechaaviso,fechaliquidacion,simbolo
order by c.ano,c.mes,t.idtipocuota" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" name="Grid3" orderBy="fechavencimiento" pageSizeLimit="500" wizardCaption=" Grid1 Lista de" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No hay registros" wizardAllowSorting="True" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions">
			<Components>
				<Sorter id="66" visible="True" name="Sorter_mes" column="mes" wizardCaption="Mes" wizardSortingType="SimpleDir" wizardControl="mes" wizardAddNbsp="False" PathID="Grid3Sorter_mes">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="67" visible="True" name="Sorter_ano" column="ano" wizardCaption="Ano" wizardSortingType="SimpleDir" wizardControl="ano" wizardAddNbsp="False" PathID="Grid3Sorter_ano">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="68" visible="True" name="Sorter_fechavencimiento" column="fechavencimiento" wizardCaption="Fechavencimiento" wizardSortingType="SimpleDir" wizardControl="fechavencimiento" wizardAddNbsp="False" PathID="Grid3Sorter_fechavencimiento">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="69" visible="True" name="Sorter_importe" column="importe" wizardCaption="Importe" wizardSortingType="SimpleDir" wizardControl="importe" wizardAddNbsp="False" PathID="Grid3Sorter_importe">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="70" visible="True" name="Sorter_fechaaviso" column="fechaaviso" wizardCaption="Fechaaviso" wizardSortingType="SimpleDir" wizardControl="fechaaviso" wizardAddNbsp="False" PathID="Grid3Sorter_fechaaviso">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Label id="71" fieldSourceType="DBColumn" dataType="Integer" html="False" name="mes" fieldSource="mes" wizardCaption="Mes" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="Grid3mes">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="72" fieldSourceType="DBColumn" dataType="Integer" html="False" name="ano" fieldSource="ano" wizardCaption="Ano" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="Grid3ano">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="73" fieldSourceType="DBColumn" dataType="Date" html="False" name="fechavencimiento" fieldSource="fechavencimiento" wizardCaption="Fechavencimiento" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="Grid3fechavencimiento" DBFormat="yyyy-mm-dd HH:nn:ss" format="dd/mm/yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="74" fieldSourceType="DBColumn" dataType="Float" html="False" name="importe" fieldSource="importe" wizardCaption="Importe" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="Grid3importe">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="75"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="76" fieldSourceType="DBColumn" dataType="Date" html="False" name="fechaaviso" fieldSource="fechaaviso" wizardCaption="Fechaaviso" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="Grid3fechaaviso">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="80" fieldSourceType="DBColumn" dataType="Text" html="False" name="nombrefichacontrato" PathID="Grid3nombrefichacontrato">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="82" fieldSourceType="DBColumn" dataType="Text" name="idficha" PathID="Grid3idficha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="85" fieldSourceType="DBColumn" dataType="Text" html="False" name="tipocuota" PathID="Grid3tipocuota" fieldSource="descripcion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Sorter id="86" visible="True" name="Sorter_descripcion" wizardSortingType="SimpleDir" PathID="Grid3Sorter_descripcion" wizardCaption="Tipo de cuota" column="descripcion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Label id="87" fieldSourceType="DBColumn" dataType="Text" html="False" name="simbolo" PathID="Grid3simbolo" fieldSource="simbolo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="78" fieldSourceType="DBColumn" dataType="Integer" name="idcuota" PathID="Grid3idcuota" fieldSource="idcuota">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="92" fieldSourceType="DBColumn" dataType="Text" html="False" name="fechaliquidacion" PathID="Grid3fechaliquidacion" fieldSource="fechaliquidacion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="98" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Link1" PathID="Grid3Link1" hrefSource="liquida-reimp.php" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="101" sourceType="DataField" name="idcuota" source="idcuota"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Hidden id="81" fieldSourceType="DBColumn" dataType="Text" name="idalquiler" PathID="Grid3idalquiler" html="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="88"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="89" conditionType="Parameter" useIsNull="False" field="idficha" parameterSource="s_idficha" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
				<TableParameter id="90" conditionType="Parameter" useIsNull="False" field="nombre" parameterSource="s_nombre" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="2"/>
			</TableParameters>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="91" variable="idalquiler" parameterType="URL" defaultValue="0" dataType="Integer" parameterSource="idalquiler"/>
				<SQLParameter id="102" variable="s_nombre" parameterType="URL" dataType="Text" parameterSource="s_nombre" designDefaultValue="durand"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Link id="96" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Link1" PathID="Link1" hrefSource="liquidacion.ccp" wizardUseTemplateBlock="False" removeParameters="verliq">
			<Components/>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="97"/>
					</Actions>
				</Event>
			</Events>
			<LinkParameters/>
			<Attributes/>
			<Features/>
		</Link>
		<Grid id="103" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="10" connection="Connection1" dataSource="SELECT alquileres.idalquiler,propiedades.direccion,fichas.nombre 
FROM alquileres INNER JOIN (propiedades INNER JOIN (fichaspropiedades INNER JOIN fichas ON
fichaspropiedades.idficha = fichas.idficha) ON
propiedades.idpropiedad = fichaspropiedades.idpropiedad) ON
alquileres.idpropiedad = propiedades.idpropiedad
WHERE alquileres.idalquiler = {idalquiler}
OR (fichas.nombre LIKE '%{s_nombre}%' AND ( '{s_nombre}' &lt;&gt; '' ) )" activeCollection="TableParameters" name="Grid4" orderBy="idalquiler" pageSizeLimit="100" wizardCaption=" Grid4 Lista de" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No hay registros">
<Components>
<Sorter id="116" visible="True" name="Sorter_idalquiler" column="idalquiler" wizardCaption="Idalquiler" wizardSortingType="SimpleDir" wizardControl="idalquiler" wizardAddNbsp="False" PathID="Grid4Sorter_idalquiler">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Sorter>
<Sorter id="117" visible="True" name="Sorter_nombre" column="nombre" wizardCaption="Nombre" wizardSortingType="SimpleDir" wizardControl="nombre" wizardAddNbsp="False" PathID="Grid4Sorter_nombre">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Sorter>
<Sorter id="118" visible="True" name="Sorter_direccion" column="direccion" wizardCaption="Direccion" wizardSortingType="SimpleDir" wizardControl="direccion" wizardAddNbsp="False" PathID="Grid4Sorter_direccion">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Sorter>
<Link id="119" fieldSourceType="DBColumn" dataType="Integer" html="False" name="idalquiler" fieldSource="idalquiler" wizardCaption="Idalquiler" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="Grid4idalquiler" visible="Yes" hrefType="Page" urlType="Relative" preserveParameters="GET" hrefSource="liquidacion.ccp">
<Components/>
<Events/>
<Attributes/>
<Features/>
<LinkParameters>
<LinkParameter id="123" sourceType="DataField" name="idalquiler" source="idalquiler"/>
</LinkParameters>
</Link>
<Label id="120" fieldSourceType="DBColumn" dataType="Text" html="False" name="nombre" fieldSource="nombre" wizardCaption="Nombre" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="Grid4nombre">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="121" fieldSourceType="DBColumn" dataType="Text" html="False" name="direccion" fieldSource="direccion" wizardCaption="Direccion" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="Grid4direccion">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Navigator id="122" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Centered" wizardFirst="True" wizardFirstText="Inicio" wizardPrev="True" wizardPrevText="Anterior" wizardNext="True" wizardNextText="Siguiente" wizardLast="True" wizardLastText="Final" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="de" wizardPageSize="True" wizardImagesScheme="Sandbeach">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Navigator>
</Components>
<Events/>
<TableParameters>
<TableParameter id="111" conditionType="Parameter" useIsNull="False" field="alquileres.idalquiler" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="idalquiler"/>
<TableParameter id="112" conditionType="Parameter" useIsNull="False" field="fichas.nombre" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="And" parameterSource="s_nombre"/>
<TableParameter id="113" conditionType="Expression" useIsNull="False" searchConditionType="Equal" parameterType="URL" logicOperator="And" expression="{s_nombre} &lt;&gt; ''"/>
</TableParameters>
<JoinTables/>
<JoinLinks/>
<Fields/>
<SPParameters/>
<SQLParameters>
<SQLParameter id="114" parameterType="URL" variable="idalquiler" dataType="Integer" parameterSource="idalquiler" defaultValue="0"/>
<SQLParameter id="115" parameterType="URL" variable="s_nombre" dataType="Text" parameterSource="s_nombre" designDefaultValue="durand"/>
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
	<Events>
		<Event name="BeforeShow" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="95"/>
			</Actions>
		</Event>
	</Events>
</Page>
