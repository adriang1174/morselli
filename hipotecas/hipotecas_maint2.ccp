<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\hipotecas" secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="SandBeach" wizardThemeVersion="3.0" needGeneration="0" isService="False" pasteActions="pasteActions">
	<Components>
		<IncludePage id="15" name="Header" page="../Header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Connection1" name="hipotecas" dataSource="hipotecas" errorSummator="Error" wizardCaption="Agregar/Editar Hipotecas " wizardFormMethod="post" PathID="hipotecas" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters">
			<Components>
				<TextBox id="9" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="montohipoteca" fieldSource="montohipoteca" required="False" caption="Montohipoteca" wizardCaption="Montohipoteca" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" PathID="hipotecasmontohipoteca">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="10" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="fechainicio" fieldSource="fechainicio" required="False" caption="Fechainicio" wizardCaption="Fechainicio" wizardSize="10" wizardMaxLength="100" wizardIsPassword="False" PathID="hipotecasfechainicio" format="dd/mm/yyyy" DBFormat="yyyymmdd">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="53" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="11" name="DatePicker_fechainicio" control="fechainicio" wizardSatellite="True" wizardControl="fechainicio" wizardDatePickerType="Image" wizardPicture="Styles/SandBeach/Images/DatePicker.gif" style="../Styles/SandBeach/Style.css" PathID="hipotecasDatePicker_fechainicio">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Agregar" PathID="hipotecasButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Enviar" PathID="hipotecasButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="5" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Borrar" PathID="hipotecasButton_Delete">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="8" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" returnValueType="Number" name="idestado" fieldSource="idestado" required="True" caption="Idestado" wizardCaption="Idestado" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardEmptyCaption="Seleccionar Valor" connection="Connection1" dataSource="estados" boundColumn="idestado" textColumn="descripcion" PathID="hipotecasidestado" defaultValue="1">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="7" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" returnValueType="Number" name="idpropiedad" fieldSource="idpropiedad" required="True" caption="Idpropiedad" wizardCaption="Idpropiedad" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardEmptyCaption="Seleccionar Valor" connection="Connection1" dataSource="propiedades" boundColumn="idpropiedad" textColumn="direccion" PathID="hipotecasidpropiedad">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="False" name="data_prop" PathID="hipotecasdata_prop">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="18" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="21" fieldSourceType="DBColumn" dataType="Text" html="False" name="data_deudor" PathID="hipotecasdata_deudor">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="45" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<TextBox id="12" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="fechafin" fieldSource="fechafin" required="False" caption="Fechafin" wizardCaption="Fechafin" wizardSize="10" wizardMaxLength="100" wizardIsPassword="False" PathID="hipotecasfechafin" format="dd/mm/yyyy" DBFormat="yyyymmdd">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="54" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="13" name="DatePicker_fechafin" control="fechafin" wizardSatellite="True" wizardControl="fechafin" wizardDatePickerType="Image" wizardPicture="Styles/SandBeach/Images/DatePicker.gif" style="../Styles/SandBeach/Style.css" PathID="hipotecasDatePicker_fechafin">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<ListBox id="58" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="ListBox1" wizardEmptyCaption="Seleccionar Valor" PathID="hipotecasListBox1" fieldSource="idmoneda" connection="Connection1" dataSource="Monedas" boundColumn="idmoneda" textColumn="descripcion">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="20" conditionType="Parameter" useIsNull="False" field="idhipoteca" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="idhipoteca"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="19" tableName="hipotecas" posLeft="10" posTop="10" posWidth="115" posHeight="180"/>
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
		<IncludePage id="16" name="Footer" page="../Footer.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<EditableGrid id="22" urlType="Relative" secured="False" emptyRows="1" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" sourceType="Table" defaultPageSize="10" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Connection1" dataSource="fichashipotecas" activeCollection="UConditions" name="fichashipotecas" pageSizeLimit="100" wizardCaption=" Fichashipotecas Lista de" wizardGridType="Tabular" wizardAltRecord="False" wizardRecordSeparator="False" wizardNoRecords="No hay registros" PathID="fichashipotecas" deleteControl="CheckBox_Delete" customInsertType="Table" activeTableType="customUpdate" customInsert="fichashipotecas" customUpdateType="Table" customUpdate="fichashipotecas">
			<Components>
				<TextBox id="29" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="idficha" fieldSource="idficha" required="True" caption="Idficha" wizardCaption="Idficha" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="fichashipotecasidficha">
					<Components/>
					<Events>
						<Event name="OnChange" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="48"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="30" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="porcentajehip" fieldSource="porcentajehip" required="False" caption="Porcentajehip" wizardCaption="Porcentajehip" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="fichashipotecasporcentajehip">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<CheckBox id="31" visible="Dynamic" fieldSourceType="CodeExpression" dataType="Boolean" name="CheckBox_Delete" checkedValue="true" uncheckedValue="false" wizardCaption="Borrar" wizardAddNbsp="True" PathID="fichashipotecasCheckBox_Delete">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<Button id="32" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Submit" operation="Submit" wizardCaption="Enviar" PathID="fichashipotecasButton_Submit">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="33" fieldSourceType="DBColumn" dataType="Text" name="errorAjax" PathID="fichashipotecaserrorAjax">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="34" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="nombre" PathID="fichashipotecasnombre">
					<Components/>
					<Events>
						<Event name="OnChange" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="49"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="35" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="nrodocumento" PathID="fichashipotecasnrodocumento">
					<Components/>
					<Events>
						<Event name="OnChange" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="50"/>
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
						<Action actionName="Custom Code" actionCategory="General" id="46"/>
					</Actions>
				</Event>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="51"/>
					</Actions>
				</Event>
				<Event name="OnValidate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="56"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="26" conditionType="Parameter" useIsNull="False" field="idhipoteca" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="idhipoteca"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="23" tableName="fichashipotecas" posLeft="10" posTop="10" posWidth="95" posHeight="136"/>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<PKFields>
				<PKField id="27" tableName="fichashipotecas" fieldName="idhipoteca" dataType="Integer"/>
				<PKField id="28" tableName="fichashipotecas" fieldName="idficha" dataType="Integer"/>
			</PKFields>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements>
				<CustomParameter id="59" field="idficha" dataType="Integer" parameterType="Control" parameterSource="idficha"/>
				<CustomParameter id="60" field="porcentajehip" dataType="Float" parameterType="Control" parameterSource="porcentajehip"/>
				<CustomParameter id="61" field="idhipoteca" dataType="Integer" parameterType="URL" omitIfEmpty="True" parameterSource="idhipoteca"/>
			</IFormElements>
			<USPParameters/>
			<USQLParameters/>
			<UConditions>
				<TableParameter id="62" conditionType="Parameter" useIsNull="False" field="idhipoteca" dataType="Integer" parameterType="DataSourceColumn" parameterSource="idhipoteca" searchConditionType="Equal" logicOperator="And"/>
				<TableParameter id="63" conditionType="Parameter" useIsNull="False" field="idficha" dataType="Integer" parameterType="DataSourceColumn" parameterSource="idficha" searchConditionType="Equal" logicOperator="And"/>
				<TableParameter id="64" conditionType="Parameter" useIsNull="False" field="idhipoteca" dataType="Integer" parameterType="URL" searchConditionType="Equal" logicOperator="And" parameterSource="idhipoteca"/>
			</UConditions>
			<UFormElements>
				<CustomParameter id="65" field="idficha" dataType="Integer" parameterType="Control" parameterSource="idficha"/>
				<CustomParameter id="66" field="porcentajehip" dataType="Float" parameterType="Control" parameterSource="porcentajehip"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</EditableGrid>
		<Grid id="36" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="Connection1" dataSource="fichashipotecas" name="fichashipotecasRO" pageSizeLimit="100" wizardCaption=" Fichashipotecas Lista de" wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No hay registros">
			<Components>
				<Label id="37" fieldSourceType="DBColumn" dataType="Integer" html="False" name="idficha" fieldSource="idficha" wizardCaption="Idficha" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="fichashipotecasROidficha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="38" fieldSourceType="DBColumn" dataType="Float" html="False" name="porcentajehip" fieldSource="porcentajehip" wizardCaption="Porcentajehip" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="fichashipotecasROporcentajehip">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="39" fieldSourceType="DBColumn" dataType="Text" html="False" name="nombre" PathID="fichashipotecasROnombre">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="40" fieldSourceType="DBColumn" dataType="Text" html="False" name="nrodocumento" PathID="fichashipotecasROnrodocumento">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="47"/>
					</Actions>
				</Event>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="52"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="67" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="generacuotas" actionPage="hipotecas_maint" errorSummator="Error" wizardFormMethod="post" PathID="generacuotas" connection="Connection1" returnPage="hipotecas_maint2.ccp" parameterTypeListName="ParameterTypeList" activeCollection="ISPParameters" customInsertType="Procedure" customInsert="SP_GENERA_CUOTAS_HIPOTECA;1" dataSource="anohipoteca">
			<Components>
				<Button id="70" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" PathID="generacuotasButton_Insert" operation="Insert" wizardCaption="Agregar" returnPage="hipotecas_maint2.ccp">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="71" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" PathID="generacuotasButton_Update" operation="Update" wizardCaption="Enviar">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Label id="72" fieldSourceType="DBColumn" dataType="Text" html="False" name="exito" PathID="generacuotasexito">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events/>
			<TableParameters/>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters>
				<SPParameter id="Key74" parameterName="@RETURN_VALUE" parameterSource="RETURN_VALUE" dataType="Int" parameterType="URL" dataSize="0" direction="ReturnValue" scale="0" precision="10"/>
				<SPParameter id="Key75" parameterName="@idhipoteca" parameterSource="idhipoteca" dataType="Int" parameterType="URL" dataSize="0" direction="Input" scale="0" precision="10" defaultValue="1"/>
			</ISPParameters>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters>
				<SPParameter id="Key74" parameterName="@RETURN_VALUE" parameterSource="RETURN_VALUE" dataType="Int" parameterType="URL" dataSize="0" direction="ReturnValue" scale="0" precision="10"/>
				<SPParameter id="Key75" parameterName="@idhipoteca" parameterSource="idhipoteca" dataType="Int" parameterType="URL" dataSize="0" direction="Input" scale="0" precision="10"/>
			</USPParameters>
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
		<CodeFile id="Events" language="PHPTemplates" name="hipotecas_maint2_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="hipotecas_maint2.php" forShow="True" url="hipotecas_maint2.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="14" groupID="1"/>
	</SecurityGroups>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="BeforeShow" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="55"/>
			</Actions>
		</Event>
	</Events>
</Page>
