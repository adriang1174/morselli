<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\hipotecas" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="SandBeach" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<IncludePage id="2" name="Header" PathID="Header" page="../Header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="All" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Connection1" name="hipotecas" dataSource="hipotecas" errorSummator="Error" wizardCaption="Agregar/Editar Hipotecas " wizardFormMethod="post" PathID="hipotecas" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="ISPParameters" parameterTypeListName="ParameterTypeList" returnPage="renovacion_hipo.ccp">
			<Components>
				<TextBox id="4" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="montohipoteca" fieldSource="montohipoteca" required="False" caption="Montohipoteca" wizardCaption="Montohipoteca" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" PathID="hipotecasmontohipoteca">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="fechainicio" fieldSource="fechainicio" required="False" caption="Fechainicio" wizardCaption="Fechainicio" wizardSize="10" wizardMaxLength="100" wizardIsPassword="False" PathID="hipotecasfechainicio" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="6"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="7" name="DatePicker_fechainicio" control="fechainicio" wizardSatellite="True" wizardControl="fechainicio" wizardDatePickerType="Image" wizardPicture="Styles/SandBeach/Images/DatePicker.gif" style="../Styles/SandBeach/Style.css" PathID="hipotecasDatePicker_fechainicio">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<Button id="8" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Agregar" PathID="hipotecasButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="9" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Enviar" PathID="hipotecasButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="10" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Borrar" PathID="hipotecasButton_Delete">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="11" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" returnValueType="Number" name="idestado" fieldSource="idestado" required="True" caption="Idestado" wizardCaption="Idestado" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardEmptyCaption="Seleccionar Valor" connection="Connection1" dataSource="estados" boundColumn="idestado" textColumn="descripcion" PathID="hipotecasidestado" defaultValue="1">
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
				<Hidden id="12" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" returnValueType="Number" name="idpropiedad" fieldSource="idpropiedad" required="True" caption="Idpropiedad" wizardCaption="Idpropiedad" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardEmptyCaption="Seleccionar Valor" connection="Connection1" dataSource="propiedades" boundColumn="idpropiedad" textColumn="direccion" PathID="hipotecasidpropiedad">
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
				<Label id="13" fieldSourceType="DBColumn" dataType="Text" html="False" name="data_prop" PathID="hipotecasdata_prop">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="14"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="data_deudor" PathID="hipotecasdata_deudor">
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
				</Label>
				<TextBox id="17" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="fechafin" fieldSource="fechafin" required="False" caption="Fechafin" wizardCaption="Fechafin" wizardSize="10" wizardMaxLength="100" wizardIsPassword="False" PathID="hipotecasfechafin" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="18"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="19" name="DatePicker_fechafin" control="fechafin" wizardSatellite="True" wizardControl="fechafin" wizardDatePickerType="Image" wizardPicture="Styles/SandBeach/Images/DatePicker.gif" style="../Styles/SandBeach/Style.css" PathID="hipotecasDatePicker_fechafin">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<ListBox id="20" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="ListBox1" wizardEmptyCaption="Seleccionar Valor" PathID="hipotecasListBox1" fieldSource="idmoneda" connection="Connection1" dataSource="Monedas" boundColumn="idmoneda" textColumn="descripcion">
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
				<Label id="35" fieldSourceType="DBColumn" dataType="Text" html="False" name="data_hipo" PathID="hipotecasdata_hipo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="36" fieldSourceType="DBColumn" dataType="Text" html="False" name="data_acreedor" PathID="hipotecasdata_acreedor">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="37"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<TextBox id="39" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="idhipoteca" PathID="hipotecasidhipoteca" fieldSource="idhipoteca">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="40" fieldSourceType="DBColumn" dataType="Text" name="idhipotecaold" PathID="hipotecasidhipotecaold">
<Components/>
<Events>
<Event name="BeforeShow" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="41"/>
</Actions>
</Event>
</Events>
<Attributes/>
<Features/>
</Hidden>
</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="23"/>
					</Actions>
				</Event>
				<Event name="AfterInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="38"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="28" conditionType="Parameter" useIsNull="False" field="idhipoteca" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="idhipoteca"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="22" tableName="hipotecas" posLeft="10" posTop="10" posWidth="115" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<ISPParameters>
				<SPParameter id="Key36" parameterName="@RETURN_VALUE" parameterSource="RETURN_VALUE" dataType="Int" parameterType="URL" dataSize="0" direction="ReturnValue" scale="0" precision="10"/>
				<SPParameter id="Key37" parameterName="@idhipotecarenov" parameterSource="s_idhipoteca" dataType="Int" parameterType="URL" dataSize="0" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key38" parameterName="@idmoneda" parameterSource="ListBox1" dataType="Int" parameterType="Form" dataSize="0" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key39" parameterName="@idpropiedad" parameterSource="idpropiedad" dataType="Int" parameterType="Form" dataSize="0" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key40" parameterName="@idestado" parameterSource="idestado" dataType="Int" parameterType="Form" dataSize="0" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key41" parameterName="@fechainicio" parameterSource="fechainicio" dataType="VarChar" parameterType="Form" dataSize="0" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key42" parameterName="@fechafin" parameterSource="fechafin" dataType="VarChar" parameterType="Form" dataSize="0" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key43" parameterName="@montohipoteca" parameterSource="montohipoteca" dataType="Numeric" parameterType="Form" dataSize="0" direction="Input" scale="2" precision="12"/>
			</ISPParameters>
			<ISQLParameters/>
			<IFormElements>
				<CustomParameter id="29" field="montohipoteca" dataType="Text" parameterType="Control" parameterSource="montohipoteca"/>
				<CustomParameter id="30" field="fechainicio" dataType="Text" parameterType="Control" parameterSource="fechainicio" format="dd/mm/yyyy" DBFormat="yyyymmdd"/>
				<CustomParameter id="31" field="idestado" dataType="Integer" parameterType="Control" parameterSource="idestado"/>
				<CustomParameter id="32" field="idpropiedad" dataType="Integer" parameterType="Control" parameterSource="idpropiedad"/>
				<CustomParameter id="33" field="fechafin" dataType="Text" parameterType="Control" parameterSource="fechafin" format="dd/mm/yyyy" DBFormat="yyyymmdd"/>
				<CustomParameter id="34" field="idmoneda" dataType="Text" parameterType="Control" parameterSource="ListBox1"/>
			</IFormElements>
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
		<Record id="24" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="hipotecas1" wizardCaption=" Hipotecas Buscar" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="renovacion_hipo.ccp" PathID="hipotecas1">
			<Components>
				<Button id="25" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Buscar" PathID="hipotecas1Button_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="26" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="s_idhipoteca" wizardCaption="Idhipoteca" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" PathID="hipotecas1s_idhipoteca">
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
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="renovacion_hipo_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="renovacion_hipo.php" forShow="True" url="renovacion_hipo.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="BeforeShow" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="27"/>
			</Actions>
		</Event>
	</Events>
</Page>
