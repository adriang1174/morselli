<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\hipotecas" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="SandBeach" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="Connection1" dataSource="fichas, propiedades, hipotecas, fichaspropiedades" name="alquileres_fichas_fichasp" pageSizeLimit="100" wizardCaption=" Alquileres,fichas,fichaspropiedades,propiedades Lista de" wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No hay registros" activeCollection="TableParameters">
			<Components>
				<Label id="20" fieldSourceType="DBColumn" dataType="Integer" html="False" name="idhipoteca" fieldSource="hipotecas.idhipoteca" wizardCaption="Idalquiler" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="alquileres_fichas_fichaspidhipoteca">
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
				<TableParameter id="73" conditionType="Parameter" useIsNull="False" field="hipotecas.idhipoteca" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="idhipoteca" leftBrackets="0" rightBrackets="0"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="4" tableName="fichas" schemaName="dbo" posLeft="547" posTop="9" posWidth="144" posHeight="180"/>
				<JoinTable id="8" tableName="propiedades" schemaName="dbo" posLeft="155" posTop="143" posWidth="121" posHeight="180"/>
				<JoinTable id="69" tableName="hipotecas" schemaName="dbo" posLeft="372" posTop="65" posWidth="115" posHeight="180"/>
				<JoinTable id="74" tableName="fichaspropiedades" schemaName="dbo" posLeft="137" posTop="10" posWidth="108" posHeight="104"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="78" tableLeft="propiedades" tableRight="hipotecas" fieldLeft="propiedades.idpropiedad" fieldRight="hipotecas.idpropiedad" joinType="inner" conditionType="Equal"/>
				<JoinTable2 id="79" tableLeft="fichas" tableRight="fichaspropiedades" fieldLeft="fichas.idficha" fieldRight="fichaspropiedades.idficha" joinType="inner" conditionType="Equal"/>
				<JoinTable2 id="80" tableLeft="propiedades" tableRight="fichaspropiedades" fieldLeft="propiedades.idpropiedad" fieldRight="fichaspropiedades.idpropiedad" joinType="inner" conditionType="Equal"/>
			</JoinLinks>
			<Fields>
				<Field id="18" tableName="propiedades" fieldName="propiedades.direccion" alias="propiedades_direccion"/>
				<Field id="19" tableName="fichas" fieldName="nombre"/>
				<Field id="72" tableName="hipotecas" fieldName="hipotecas.*"/>
				<Field id="77" tableName="fichaspropiedades" fieldName="fichaspropiedades.*"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Grid id="29" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="30" connection="Connection1" dataSource="SELECT fechavencimiento, ano, mes ,sum(importe) as importe
FROM cuotas
WHERE ( fechapago is null )
AND idhipoteca = {idhipoteca}
AND ( idtipocuota = 4 ) 
group by  fechavencimiento, ano, mes
ORDER BY fechavencimiento, ano, mes" activeCollection="TableParameters" name="cuotas" pageSizeLimit="100" wizardCaption=" Cuotas Lista de" wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No hay registros" orderBy="fechavencimiento, ano, mes">
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
								<Action actionName="Custom Code" actionCategory="General" id="81" eventType="Server"/>
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
						<LinkParameter id="60" sourceType="URL" name="idhipoteca" source="idhipoteca"/>
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
				<Hidden id="63" fieldSourceType="DBColumn" dataType="Text" name="idhipoteca" PathID="cuotasidhipoteca">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="64" fieldSourceType="DBColumn" dataType="Text" html="False" name="lblidhipoteca" PathID="cuotaslblidhipoteca">
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
				<TableParameter id="32" conditionType="Parameter" useIsNull="False" field="idhipoteca" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="idhipoteca"/>
				<TableParameter id="44" conditionType="Expression" useIsNull="False" field="idtipocuota" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="And" expression="idtipocuota = 4" parameterSource="1"/>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="82" parameterType="URL" variable="idhipoteca" dataType="Integer" parameterSource="idhipoteca" defaultValue="0" designDefaultValue="371"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<IncludePage id="49" name="Header" PathID="Header" page="../Header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Grid id="83" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="30" connection="Connection1" dataSource="SELECT fechavencimiento, ano, mes ,sum(importe) as importe
FROM cuotas
WHERE ( fechapago is not null )
AND idhipoteca = {idhipoteca}
AND ( idtipocuota = 4 ) 
group by  fechavencimiento, ano, mes
ORDER BY fechavencimiento, ano, mes" activeCollection="TableParameters" name="cuotas1" pageSizeLimit="100" wizardCaption=" Cuotas Lista de" wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No hay registros" orderBy="fechavencimiento, ano, mes">
			<Components>
				<Label id="84" fieldSourceType="DBColumn" dataType="Date" html="False" name="fechavencimiento" fieldSource="fechavencimiento" wizardCaption="Fechavencimiento" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="cuotas1fechavencimiento" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="85" fieldSourceType="DBColumn" dataType="Text" html="False" name="importe" fieldSource="importe" wizardCaption="Importe" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="cuotas1importe">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="86"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="87" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="TextButtons" wizardFirst="True" wizardFirstText="|&amp;lt;" wizardPrev="True" wizardPrevText="&amp;lt;&amp;lt;" wizardNext="True" wizardNextText="&amp;gt;&amp;gt;" wizardLast="True" wizardLastText="&amp;gt;|" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="de" wizardPageSize="False" wizardImagesScheme="Sandbeach">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="88" fieldSourceType="DBColumn" dataType="Text" html="False" name="ano" PathID="cuotas1ano" fieldSource="ano">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="89" fieldSourceType="DBColumn" dataType="Text" html="False" name="mes" PathID="cuotas1mes" fieldSource="mes">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="94" fieldSourceType="DBColumn" dataType="Text" name="idhipoteca" PathID="cuotas1idhipoteca">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="95" fieldSourceType="DBColumn" dataType="Text" html="False" name="lblidhipoteca" PathID="cuotas1lblidhipoteca">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="96"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="97" conditionType="Expression" useIsNull="False" field="fechapago" dataType="Date" searchConditionType="IsNull" parameterType="URL" logicOperator="And" expression="fechapago is null" parameterSource="1"/>
				<TableParameter id="98" conditionType="Parameter" useIsNull="False" field="idhipoteca" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="idhipoteca"/>
				<TableParameter id="99" conditionType="Expression" useIsNull="False" field="idtipocuota" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="And" expression="idtipocuota = 4" parameterSource="1"/>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="100" parameterType="URL" variable="idhipoteca" dataType="Integer" parameterSource="idhipoteca" defaultValue="0" designDefaultValue="371"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="pagos.php" forShow="True" url="pagos.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="pagos_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
