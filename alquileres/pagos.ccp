<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\alquileres" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="SandBeach" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="Connection1" dataSource="alquileres, fichas, propiedades, fichasalquileres" name="alquileres_fichas_fichasp" pageSizeLimit="100" wizardCaption=" Alquileres,fichas,fichaspropiedades,propiedades Lista de" wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No hay registros" activeCollection="TableParameters">
			<Components>
				<Label id="20" fieldSourceType="DBColumn" dataType="Integer" html="False" name="idalquiler" fieldSource="idalquiler" wizardCaption="Idalquiler" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="alquileres_fichas_fichaspidalquiler">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="21" fieldSourceType="DBColumn" dataType="Date" html="False" name="fechainicio" fieldSource="fechainicio" wizardCaption="Fechainicio" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="alquileres_fichas_fichaspfechainicio" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="22" fieldSourceType="DBColumn" dataType="Date" html="False" name="fechafin" fieldSource="fechafin" wizardCaption="Fechafin" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="alquileres_fichas_fichaspfechafin" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="23" fieldSourceType="DBColumn" dataType="Text" html="False" name="nombre" fieldSource="nombre" wizardCaption="Nombre" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="alquileres_fichas_fichaspnombre">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="24" fieldSourceType="DBColumn" dataType="Integer" html="False" name="idpropiedad" fieldSource="idpropiedad" wizardCaption="Idpropiedad" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="alquileres_fichas_fichaspidpropiedad">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="25" fieldSourceType="DBColumn" dataType="Integer" html="False" name="idficha" fieldSource="idficha" wizardCaption="Idficha" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="alquileres_fichas_fichaspidficha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="27" fieldSourceType="DBColumn" dataType="Text" html="False" name="propiedades_direccion" fieldSource="propiedades_direccion" wizardCaption="Direccion" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="alquileres_fichas_fichasppropiedades_direccion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="28" conditionType="Parameter" useIsNull="False" field="alquileres.idpropiedad" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="idpropiedad" leftBrackets="0" rightBrackets="0"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="3" tableName="alquileres" schemaName="dbo" posLeft="22" posTop="20" posWidth="158" posHeight="180"/>
				<JoinTable id="4" tableName="fichas" schemaName="dbo" posLeft="547" posTop="9" posWidth="144" posHeight="180"/>
				<JoinTable id="8" tableName="propiedades" schemaName="dbo" posLeft="224" posTop="101" posWidth="121" posHeight="180"/>
				<JoinTable id="45" tableName="fichasalquileres" schemaName="dbo" posLeft="353" posTop="1" posWidth="95" posHeight="120"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="10" tableLeft="alquileres" tableRight="propiedades" fieldLeft="alquileres.idpropiedad" fieldRight="propiedades.idpropiedad" joinType="inner" conditionType="Equal"/>
				<JoinTable2 id="46" tableLeft="alquileres" tableRight="fichasalquileres" fieldLeft="alquileres.idalquiler" fieldRight="fichasalquileres.idalquiler" joinType="inner" conditionType="Equal"/>
				<JoinTable2 id="47" tableLeft="fichas" tableRight="fichasalquileres" fieldLeft="fichas.idficha" fieldRight="fichasalquileres.idficha" joinType="inner" conditionType="Equal"/>
			</JoinLinks>
			<Fields>
				<Field id="12" tableName="alquileres" fieldName="alquileres.idalquiler" alias="alquileres_idalquiler"/>
				<Field id="16" tableName="alquileres" fieldName="fechainicio"/>
				<Field id="17" tableName="alquileres" fieldName="fechafin"/>
				<Field id="18" tableName="propiedades" fieldName="propiedades.direccion" alias="propiedades_direccion"/>
				<Field id="19" tableName="fichas" fieldName="nombre"/>
				<Field id="48" tableName="fichasalquileres" fieldName="fichasalquileres.*"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Grid id="29" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="30" connection="Connection1" dataSource="cuotas" activeCollection="TableParameters" name="cuotas" pageSizeLimit="100" wizardCaption=" Cuotas Lista de" wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No hay registros" orderBy="fechavencimiento, ano, mes">
			<Components>
				<Label id="39" fieldSourceType="DBColumn" dataType="Date" html="False" name="fechavencimiento" fieldSource="fechavencimiento" wizardCaption="Fechavencimiento" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="cuotasfechavencimiento" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="40" fieldSourceType="DBColumn" dataType="Text" html="False" name="importe" fieldSource="importe" wizardCaption="Importe" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="cuotasimporte">
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
				<Navigator id="43" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="TextButtons" wizardFirst="True" wizardFirstText="|&amp;lt;" wizardPrev="True" wizardPrevText="&amp;lt;&amp;lt;" wizardNext="True" wizardNextText="&amp;gt;&amp;gt;" wizardLast="True" wizardLastText="&amp;gt;|" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="de" wizardPageSize="False" wizardImagesScheme="Sandbeach">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="50" fieldSourceType="DBColumn" dataType="Text" html="False" name="ano" PathID="cuotasano" fieldSource="ano">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="51" fieldSourceType="DBColumn" dataType="Text" html="False" name="mes" PathID="cuotasmes" fieldSource="mes">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="53" fieldSourceType="DBColumn" dataType="Text" name="idcuota" PathID="cuotasidcuota" fieldSource="idcuota">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<CheckBox id="58" visible="Yes" fieldSourceType="DBColumn" dataType="Boolean" name="paga" PathID="cuotaspaga">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<Link id="59" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Link2" PathID="cuotasLink2" hrefSource="cuota_maint.ccp" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="60" sourceType="URL" name="idalquiler" source="idalquiler"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Button id="62" urlType="Relative" enableValidation="True" isDefault="False" name="Button1" PathID="cuotasButton1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="63" fieldSourceType="DBColumn" dataType="Text" name="idalquiler" PathID="cuotasidalquiler">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="64" fieldSourceType="DBColumn" dataType="Text" html="False" name="lblidalquiler" PathID="cuotaslblidalquiler">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="65" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="31" conditionType="Expression" useIsNull="False" field="fechapago" dataType="Date" searchConditionType="IsNull" parameterType="URL" logicOperator="And" expression="fechapago is null" parameterSource="1"/>
				<TableParameter id="32" conditionType="Parameter" useIsNull="False" field="idalquiler" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="idalquiler"/>
				<TableParameter id="44" conditionType="Expression" useIsNull="False" field="idtipocuota" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="And" expression="idtipocuota = 1" parameterSource="1"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="30" tableName="cuotas" schemaName="dbo" posLeft="10" posTop="10" posWidth="134" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="33" tableName="cuotas" fieldName="idalquiler"/>
				<Field id="34" tableName="cuotas" fieldName="fechavencimiento"/>
				<Field id="35" tableName="cuotas" fieldName="importe" alias="importe" isExpression="False"/>
				<Field id="54" tableName="cuotas" fieldName="idcuota" isExpression="False"/>
				<Field id="55" tableName="cuotas" fieldName="ano" isExpression="False"/>
				<Field id="56" tableName="cuotas" fieldName="mes" isExpression="False"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<IncludePage id="49" name="Header" PathID="Header" page="../Header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Grid id="67" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="30" connection="Connection1" dataSource="SELECT c1.idalquiler, c1.fechavencimiento, c1.ano, c1.mes, c1.fechapago, c1.importe AS importe, isnull(c2.importe,0) as ivacom, isnull(c3.importe,0) as otros
FROM cuotas c1
left join ( select idalquiler,ano,mes,sum(importe) as importe
            from cuotas
		where idalquiler = {idalquiler} and idtipocuota in(3,7)
		and fechapago is not null
	    group by  idalquiler,ano,mes
	   ) c2 on( c1.ano = c2.ano and c1.mes = c2.mes and c2.idalquiler = c1.idalquiler)
left join ( select idalquiler,ano,mes,sum(importe) as importe
            from cuotas
		where idalquiler = {idalquiler} and idtipocuota in(8)
		and fechapago is not null
	    group by  idalquiler,ano,mes
	   ) c3 on( c1.ano = c3.ano and c1.mes = c3.mes and c3.idalquiler = c1.idalquiler)
WHERE ( c1.fechapago is not null  )
AND c1.idalquiler = {idalquiler}
AND ( c1.idtipocuota = 1 ) 
ORDER BY c1.fechavencimiento, c1.ano, c1.mes

" activeCollection="TableParameters" name="cuotaspagadas" pageSizeLimit="100" wizardCaption=" Cuotas Lista de" wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No hay registros" orderBy="fechavencimiento, ano, mes">
			<Components>
				<Label id="68" fieldSourceType="DBColumn" dataType="Date" html="False" name="fechavencimiento" fieldSource="fechapago" wizardCaption="Fechavencimiento" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="cuotaspagadasfechavencimiento" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="69" fieldSourceType="DBColumn" dataType="Text" html="False" name="importe" fieldSource="importe" wizardCaption="Importe" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="cuotaspagadasimporte">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="70" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="71" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="TextButtons" wizardFirst="True" wizardFirstText="|&amp;lt;" wizardPrev="True" wizardPrevText="&amp;lt;&amp;lt;" wizardNext="True" wizardNextText="&amp;gt;&amp;gt;" wizardLast="True" wizardLastText="&amp;gt;|" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="de" wizardPageSize="False" wizardImagesScheme="Sandbeach">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="72" fieldSourceType="DBColumn" dataType="Text" html="False" name="ano" PathID="cuotaspagadasano" fieldSource="ano">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="73" fieldSourceType="DBColumn" dataType="Text" html="False" name="mes" PathID="cuotaspagadasmes" fieldSource="mes">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="82" fieldSourceType="DBColumn" dataType="Text" name="idalquiler" PathID="cuotaspagadasidalquiler">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="83" fieldSourceType="DBColumn" dataType="Text" html="False" name="lblidalquiler" PathID="cuotaspagadaslblidalquiler">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="101" fieldSourceType="DBColumn" dataType="Text" html="False" name="ivacom" PathID="cuotaspagadasivacom" fieldSource="ivacom">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="103" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="102" fieldSourceType="DBColumn" dataType="Text" html="False" name="otros" PathID="cuotaspagadasotros" fieldSource="otros">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="104" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="105" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Link1" PathID="cuotaspagadasLink1" hrefSource="recibo-reimp.php" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="106" sourceType="URL" format="yyyy-mm-dd" name="idalquiler" source="idalquiler"/>
						<LinkParameter id="107" sourceType="DataField" format="yyyy-mm-dd" name="ano" source="ano"/>
						<LinkParameter id="108" sourceType="DataField" format="yyyy-mm-dd" name="mes" source="mes"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="84" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="85" conditionType="Expression" useIsNull="False" field="fechapago" dataType="Date" searchConditionType="IsNull" parameterType="URL" logicOperator="And" expression="fechapago is not null" parameterSource="1"/>
				<TableParameter id="86" conditionType="Parameter" useIsNull="False" field="idalquiler" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="idalquiler"/>
				<TableParameter id="87" conditionType="Expression" useIsNull="False" field="idtipocuota" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="And" expression="idtipocuota in( 1,3,8)" parameterSource="1"/>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="100" parameterType="URL" variable="idalquiler" dataType="Integer" parameterSource="idalquiler" defaultValue="0"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Link id="96" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Link1" PathID="Link1" hrefSource="pagos.ccp" wizardUseTemplateBlock="False" removeParameters="verpagos">
			<Components/>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="98" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<LinkParameters/>
			<Attributes/>
			<Features/>
		</Link>
		<Link id="109" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Link2" PathID="Link2" hrefSource="mostrar_impuestos.ccp" wizardUseTemplateBlock="False">
			<Components/>
			<Events/>
			<LinkParameters/>
			<Attributes/>
			<Features/>
		</Link>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="pagos.php" forShow="True" url="pagos.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="pagos_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="BeforeShow" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="99"/>
			</Actions>
		</Event>
	</Events>
</Page>
