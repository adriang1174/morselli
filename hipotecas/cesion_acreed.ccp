<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\hipotecas" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="SandBeach" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<IncludePage id="2" name="Header" PathID="Header" page="../Header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="hipotecas" wizardCaption=" Hipotecas Buscar" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="cesion_acreed.ccp" PathID="hipotecas">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Buscar" PathID="hipotecasButton_DoSearch" returnPage="cesion_acreed.ccp">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="idhipoteca" wizardCaption="Idhipoteca" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" PathID="hipotecasidhipoteca">
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
		<Grid id="6" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="Connection1" dataSource="hipotecas, Monedas, propiedades" activeCollection="TableParameters" name="hipoteca" pageSizeLimit="100" wizardCaption=" Monedas,hipotecas,propiedades Lista de" wizardGridType="Columnar" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No hay registros" pasteActions="pasteActions">
			<Components>
				<Label id="22" fieldSourceType="DBColumn" dataType="Integer" html="False" name="idhipoteca" fieldSource="idhipoteca" wizardCaption="Idhipoteca" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="hipotecaidhipoteca">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="24" fieldSourceType="DBColumn" dataType="Float" html="False" name="montohipoteca" fieldSource="montohipoteca" wizardCaption="Montohipoteca" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="hipotecamontohipoteca">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="25" fieldSourceType="DBColumn" dataType="Date" html="False" name="fechainicio" fieldSource="fechainicio" wizardCaption="Fechainicio" wizardSize="10" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="hipotecafechainicio">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="26" fieldSourceType="DBColumn" dataType="Date" html="False" name="fechafin" fieldSource="fechafin" wizardCaption="Fechafin" wizardSize="10" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="hipotecafechafin">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="27" fieldSourceType="DBColumn" dataType="Text" html="False" name="direccion" fieldSource="direccion" wizardCaption="Direccion" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="hipotecadireccion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="23" fieldSourceType="DBColumn" dataType="Text" html="False" name="simbolo" fieldSource="simbolo" wizardCaption="Simbolo" wizardSize="3" wizardMaxLength="3" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="hipotecasimbolo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="111"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="8" conditionType="Parameter" useIsNull="False" field="hipotecas.idhipoteca" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="idhipoteca"/>
				<TableParameter id="109" conditionType="Expression" useIsNull="False" field="hipotecas.idestado" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" expression="hipotecas.idestado = 1" parameterSource="idestado"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="7" tableName="hipotecas" posLeft="10" posTop="10" posWidth="115" posHeight="180"/>
				<JoinTable id="9" tableName="Monedas" schemaName="dbo" posLeft="146" posTop="10" posWidth="95" posHeight="104"/>
				<JoinTable id="13" tableName="propiedades" schemaName="dbo" posLeft="223" posTop="114" posWidth="121" posHeight="180"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="10" tableLeft="hipotecas" tableRight="Monedas" fieldLeft="hipotecas.idmoneda" fieldRight="Monedas.idmoneda" joinType="inner" conditionType="Equal"/>
				<JoinTable2 id="14" tableLeft="hipotecas" tableRight="propiedades" fieldLeft="hipotecas.idpropiedad" fieldRight="propiedades.idpropiedad" joinType="inner" conditionType="Equal"/>
			</JoinLinks>
			<Fields>
				<Field id="15" tableName="propiedades" fieldName="direccion"/>
				<Field id="16" tableName="hipotecas" fieldName="idhipoteca"/>
				<Field id="17" tableName="hipotecas" fieldName="montohipoteca"/>
				<Field id="18" tableName="hipotecas" fieldName="fechainicio"/>
				<Field id="19" tableName="hipotecas" fieldName="fechafin"/>
				<Field id="21" tableName="Monedas" fieldName="simbolo"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Grid id="28" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="Connection1" dataSource="fichaspropiedades, fichas, hipotecas, tipodocumentos" activeCollection="TableParameters" name="deudores" pageSizeLimit="100" wizardCaption=" Fichas,fichaspropiedades,hipotecas,tipodocumentos Lista de" wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No hay registros" pasteActions="pasteActions">
			<Components>
				<Label id="45" fieldSourceType="DBColumn" dataType="Text" html="False" name="nombre" fieldSource="nombre" wizardCaption="Nombre" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="deudoresnombre">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="47" fieldSourceType="DBColumn" dataType="Text" html="False" name="nrodocumento" fieldSource="nrodocumento" wizardCaption="Nrodocumento" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="deudoresnrodocumento">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="48" fieldSourceType="DBColumn" dataType="Float" html="False" name="duenoporcentaje" fieldSource="duenoporcentaje" wizardCaption="Duenoporcentaje" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="deudoresduenoporcentaje">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="49" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="TextButtons" wizardFirst="True" wizardFirstText="|&amp;lt;" wizardPrev="True" wizardPrevText="&amp;lt;&amp;lt;" wizardNext="True" wizardNextText="&amp;gt;&amp;gt;" wizardLast="True" wizardLastText="&amp;gt;|" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="de" wizardPageSize="True" wizardImagesScheme="Sandbeach">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="46" fieldSourceType="DBColumn" dataType="Text" html="False" name="destipodocumento" fieldSource="destipodocumento" wizardCaption="Destipodocumento" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="deudoresdestipodocumento">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="112"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="34" conditionType="Parameter" useIsNull="False" field="hipotecas.idhipoteca" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="idhipoteca"/>
				<TableParameter id="35" conditionType="Expression" useIsNull="False" searchConditionType="Equal" parameterType="URL" logicOperator="And" expression="hipotecas.idestado = 1"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="29" tableName="fichaspropiedades" posLeft="10" posTop="10" posWidth="108" posHeight="104"/>
				<JoinTable id="30" tableName="fichas" schemaName="dbo" posLeft="217" posTop="30" posWidth="144" posHeight="180"/>
				<JoinTable id="32" tableName="hipotecas" schemaName="dbo" posLeft="440" posTop="33" posWidth="115" posHeight="180"/>
				<JoinTable id="39" tableName="tipodocumentos" schemaName="dbo" posLeft="576" posTop="10" posWidth="119" posHeight="88"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="31" tableLeft="fichaspropiedades" tableRight="fichas" fieldLeft="fichaspropiedades.idficha" fieldRight="fichas.idficha" joinType="inner" conditionType="Equal"/>
				<JoinTable2 id="33" tableLeft="hipotecas" tableRight="fichaspropiedades" fieldLeft="hipotecas.idpropiedad" fieldRight="fichaspropiedades.idpropiedad" joinType="inner" conditionType="Equal"/>
				<JoinTable2 id="40" tableLeft="fichas" tableRight="tipodocumentos" fieldLeft="fichas.idtipodocumento" fieldRight="tipodocumentos.idtipodocumento" joinType="inner" conditionType="Equal"/>
			</JoinLinks>
			<Fields>
				<Field id="36" tableName="fichaspropiedades" fieldName="duenoporcentaje"/>
				<Field id="38" tableName="hipotecas" fieldName="hipotecas.*"/>
				<Field id="42" tableName="tipodocumentos" fieldName="destipodocumento"/>
				<Field id="43" tableName="fichas" fieldName="nombre"/>
				<Field id="44" tableName="fichas" fieldName="nrodocumento"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Grid id="50" secured="False" sourceType="Procedure" returnValueType="Number" defaultPageSize="10" connection="Connection1" resultSetType="parameter" dataSource="sp_deuda_hipoteca;1" name="deuda" pageSizeLimit="100" wizardCaption=" Grid1 Lista de" wizardGridType="Columnar" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No hay registros">
			<Components>
				<Label id="53" fieldSourceType="DBColumn" dataType="Text" html="False" name="deuda" fieldSource="deuda" wizardCaption="Deuda" wizardSize="15" wizardMaxLength="15" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="deudadeuda">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="54" fieldSourceType="DBColumn" dataType="Text" html="False" name="liquidacionp" fieldSource="liquidacionp" wizardCaption="Liquidacionp" wizardSize="15" wizardMaxLength="15" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="deudaliquidacionp">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="55" fieldSourceType="DBColumn" dataType="Text" html="False" name="honorarios" fieldSource="honorarios" wizardCaption="Honorarios" wizardSize="15" wizardMaxLength="15" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="deudahonorarios">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="56" fieldSourceType="DBColumn" dataType="Text" html="False" name="Label1" PathID="deudaLabel1">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="115" eventType="Server"/>
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
						<Action actionName="Custom Code" actionCategory="General" id="113" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<SPParameters>
				<SPParameter id="51" parameterName="@RETURN_VALUE" parameterSource="RETURN_VALUE" parameterType="URL" direction="ReturnValue" dataType="Int" dataSize="0" scale="0" precision="10"/>
				<SPParameter id="52" parameterName="@idhipoteca" parameterSource="idhipoteca" parameterType="URL" direction="Input" dataType="Int" dataSize="0" scale="0" precision="10"/>
			</SPParameters>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Grid id="57" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="Connection1" dataSource="fichashipotecas, fichas, tipodocumentos" activeCollection="TableParameters" name="acreedores" pageSizeLimit="100" wizardCaption=" Fichas,fichashipotecas,tipodocumentos Lista de" wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No hay registros" pasteActions="pasteActions">
			<Components>
				<Label id="70" fieldSourceType="DBColumn" dataType="Text" html="False" name="nombre" fieldSource="nombre" wizardCaption="Nombre" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="acreedoresnombre">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="72" fieldSourceType="DBColumn" dataType="Text" html="False" name="nrodocumento" fieldSource="nrodocumento" wizardCaption="Nrodocumento" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="acreedoresnrodocumento">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="73" fieldSourceType="DBColumn" dataType="Float" html="False" name="porcentajehip" fieldSource="porcentajehip" wizardCaption="Porcentajehip" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="acreedoresporcentajehip">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="74" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="TextButtons" wizardFirst="True" wizardFirstText="|&amp;lt;" wizardPrev="True" wizardPrevText="&amp;lt;&amp;lt;" wizardNext="True" wizardNextText="&amp;gt;&amp;gt;" wizardLast="True" wizardLastText="&amp;gt;|" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="de" wizardPageSize="True" wizardImagesScheme="Sandbeach">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="71" fieldSourceType="DBColumn" dataType="Text" html="False" name="destipodocumento" fieldSource="destipodocumento" wizardCaption="Destipodocumento" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="acreedoresdestipodocumento">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="79" fieldSourceType="DBColumn" dataType="Text" name="idhipoteca" PathID="acreedoresidhipoteca">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="80"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="69" conditionType="Parameter" useIsNull="False" field="fichashipotecas.idhipoteca" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="idhipoteca"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="58" tableName="fichashipotecas" posLeft="10" posTop="10" posWidth="95" posHeight="136"/>
				<JoinTable id="59" tableName="fichas" schemaName="dbo" posLeft="126" posTop="10" posWidth="144" posHeight="180"/>
				<JoinTable id="61" tableName="tipodocumentos" schemaName="dbo" posLeft="417" posTop="10" posWidth="119" posHeight="88"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="60" tableLeft="fichashipotecas" tableRight="fichas" fieldLeft="fichashipotecas.idficha" fieldRight="fichas.idficha" joinType="inner" conditionType="Equal"/>
				<JoinTable2 id="62" tableLeft="fichas" tableRight="tipodocumentos" fieldLeft="fichas.idtipodocumento" fieldRight="tipodocumentos.idtipodocumento" joinType="inner" conditionType="Equal"/>
			</JoinLinks>
			<Fields>
				<Field id="65" tableName="tipodocumentos" fieldName="destipodocumento"/>
				<Field id="66" tableName="fichas" fieldName="nombre"/>
				<Field id="67" tableName="fichas" fieldName="nrodocumento"/>
				<Field id="68" tableName="fichashipotecas" fieldName="porcentajehip"/>
				<Field id="75" tableName="fichashipotecas" fieldName="fichashipotecas.idficha" alias="fichashipotecas_idficha"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<EditableGrid id="81" urlType="Relative" secured="False" emptyRows="1" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" sourceType="Table" defaultPageSize="10" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Connection1" dataSource="fichashipotecascesion" activeCollection="TableParameters" name="fichashipotecascesion" pageSizeLimit="100" wizardCaption=" Fichashipotecas Lista de" wizardGridType="Tabular" wizardAltRecord="False" wizardRecordSeparator="False" wizardNoRecords="No hay registros" PathID="fichashipotecascesion" deleteControl="CheckBox_Delete" activeTableType="customUpdate" customInsertType="Table" customInsert="fichashipotecascesion" customUpdateType="Table" customUpdate="fichashipotecascesion">
			<Components>
				<TextBox id="82" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="idficha" fieldSource="idficha" required="True" caption="Idficha" wizardCaption="Idficha" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="fichashipotecascesionidficha">
					<Components/>
					<Events>
						<Event name="OnChange" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="83"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="84" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="porcentajehip" fieldSource="porcentajehip" required="False" caption="Porcentajehip" wizardCaption="Porcentajehip" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="fichashipotecascesionporcentajehip">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<CheckBox id="85" visible="Dynamic" fieldSourceType="CodeExpression" dataType="Boolean" name="CheckBox_Delete" checkedValue="true" uncheckedValue="false" wizardCaption="Borrar" wizardAddNbsp="True" PathID="fichashipotecascesionCheckBox_Delete">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<Button id="86" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Submit" operation="Submit" wizardCaption="Enviar" PathID="fichashipotecascesionButton_Submit">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="87" fieldSourceType="DBColumn" dataType="Text" name="errorAjax" PathID="fichashipotecascesionerrorAjax">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="88" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="nombre" PathID="fichashipotecascesionnombre">
					<Components/>
					<Events>
						<Event name="OnChange" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="89"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="90" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="nrodocumento" PathID="fichashipotecascesionnrodocumento">
					<Components/>
					<Events>
						<Event name="OnChange" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="91"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</TextBox>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="92"/>
					</Actions>
				</Event>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="93"/>
					</Actions>
				</Event>
				<Event name="OnValidate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="94"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="95" conditionType="Parameter" useIsNull="False" field="idhipoteca" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="idhipoteca"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="105" tableName="fichashipotecascesion" posLeft="10" posTop="10" posWidth="95" posHeight="136"/>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<PKFields>
			</PKFields>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements>
				<CustomParameter id="99" field="idficha" dataType="Integer" parameterType="Control" parameterSource="idficha"/>
				<CustomParameter id="100" field="porcentajehip" dataType="Float" parameterType="Control" parameterSource="porcentajehip"/>
				<CustomParameter id="101" field="idhipoteca" dataType="Integer" parameterType="URL" omitIfEmpty="True" parameterSource="idhipoteca"/>
			</IFormElements>
			<USPParameters/>
			<USQLParameters/>
			<UConditions>
				<TableParameter id="102" conditionType="Parameter" useIsNull="False" field="idhipoteca" dataType="Integer" parameterType="DataSourceColumn" parameterSource="idhipoteca" searchConditionType="Equal" logicOperator="And"/>
				<TableParameter id="63" conditionType="Parameter" useIsNull="False" field="idficha" dataType="Integer" parameterType="DataSourceColumn" parameterSource="idficha" searchConditionType="Equal" logicOperator="And"/>
			</UConditions>
			<UFormElements>
				<CustomParameter id="103" field="idficha" dataType="Integer" parameterType="Control" parameterSource="idficha"/>
				<CustomParameter id="104" field="porcentajehip" dataType="Float" parameterType="Control" parameterSource="porcentajehip"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</EditableGrid>
		<Record id="106" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="Cesion" actionPage="cesion_acreed" errorSummator="Error" wizardFormMethod="post" PathID="Cesion" returnPage="cesion.php">
			<Components>
				<Label id="107" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="exito" PathID="Cesionexito" html="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Button id="108" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" PathID="CesionButton_Insert" operation="Insert" wizardCaption="Agregar">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="114"/>
					</Actions>
				</Event>
			</Events>
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
		<CodeFile id="Events" language="PHPTemplates" name="cesion_acreed_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="cesion_acreed.php" forShow="True" url="cesion_acreed.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
