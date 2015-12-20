<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\caja" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="SandBeach" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<IncludePage id="2" name="Headercaja" PathID="Headercaja" page="Header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Record id="3" sourceType="SQL" urlType="Relative" secured="False" allowInsert="False" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Connection1" name="cajaresumen" dataSource="SELECT * 
FROM cajaresumen
WHERE ( convert(varchar,fecha,103) = convert(varchar,'{s_fecha}' ,103) ) " errorSummator="Error" wizardCaption="Agregar/Editar Cajaresumen " wizardFormMethod="post" PathID="cajaresumen" activeCollection="USQLParameters" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" parameterTypeListName="ParameterTypeList" customUpdateType="SQL" customUpdate="update cajaresumen
set saldofinal = {saldofinal},
saldofinaldolar = {saldofinaldolar}
where convert(varchar,fecha,103)= convert(varchar,'{fecha}',103)">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Agregar" PathID="cajaresumenButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="5" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Enviar" PathID="cajaresumenButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="6" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Borrar" PathID="cajaresumenButton_Delete">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="8" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="fecha" fieldSource="fecha" required="True" caption="Fecha" wizardCaption="Fecha" wizardSize="10" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="cajaresumenfecha" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="14" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="10" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="saldoinicial" fieldSource="saldoinicial" required="False" caption="Saldoinicial" wizardCaption="Saldoinicial" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="cajaresumensaldoinicial">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="11" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="totalingresos" fieldSource="totalingresos" required="False" caption="Totalingresos" wizardCaption="Totalingresos" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="cajaresumentotalingresos">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="12" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="totalegresos" fieldSource="totalegresos" required="False" caption="Totalegresos" wizardCaption="Totalegresos" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="cajaresumentotalegresos">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="13" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="saldofinal" fieldSource="saldofinal" required="False" caption="Saldofinal" wizardCaption="Saldofinal" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="cajaresumensaldofinal">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="33" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="saldoinicialdolar" PathID="cajaresumensaldoinicialdolar" fieldSource="saldoinicialdolar">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="34" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="totalingresosdolar" PathID="cajaresumentotalingresosdolar" fieldSource="totalingresosdolar">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="35" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="totalegresosdolar" PathID="cajaresumentotalegresosdolar" fieldSource="totalegresosdolar">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="36" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="saldofinaldolar" PathID="cajaresumensaldofinaldolar" fieldSource="saldofinaldolar">
					<Components/>

					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="17" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="OnValidate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="20" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="32" conditionType="Expression" useIsNull="False" field="fecha" dataType="Date" searchConditionType="Equal" parameterType="URL" logicOperator="And" format="dd/mm/yyyy" expression="convert(varchar,fecha,103) = convert(varchar,'{s_fecha}' ,103)" parameterSource="s_fecha"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="37" parameterType="URL" variable="s_fecha" dataType="Date" format="dd/mm/yyyy" parameterSource="s_fecha" defaultValue="01/01/1960" DBFormat="dd/mm/yyyy"/>
			</SQLParameters>
			<JoinTables>
				<JoinTable id="38" tableName="cajaresumen" posLeft="10" posTop="10" posWidth="138" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="27" fieldName="*"/>
			</Fields>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters>
				<SQLParameter id="48" variable="saldofinal" parameterType="Control" defaultValue="0" dataType="Integer" parameterSource="saldofinal"/>
				<SQLParameter id="49" variable="saldofinaldolar" parameterType="Control" defaultValue="0" dataType="Integer" parameterSource="saldofinaldolar"/>
				<SQLParameter id="50" variable="fecha" parameterType="Control" defaultValue="01/01/1960" dataType="Date" DBFormat="dd/mm/yyyy" format="dd/mm/yyyy" parameterSource="fecha"/>
			</USQLParameters>
			<UConditions/>
			<UFormElements>
				<CustomParameter id="39" field="fecha" dataType="Date" parameterType="Control" parameterSource="fecha" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss"/>
				<CustomParameter id="40" field="saldoinicial" dataType="Float" parameterType="Control" parameterSource="saldoinicial"/>
				<CustomParameter id="41" field="totalingresos" dataType="Float" parameterType="Control" parameterSource="totalingresos"/>
				<CustomParameter id="42" field="totalegresos" dataType="Float" parameterType="Control" parameterSource="totalegresos"/>
				<CustomParameter id="43" field="saldofinal" dataType="Float" parameterType="Control" parameterSource="saldofinal"/>
				<CustomParameter id="44" field="saldoinicialdolar" dataType="Integer" parameterType="Control" parameterSource="saldoinicialdolar"/>
				<CustomParameter id="45" field="totalingresosdolar" dataType="Integer" parameterType="Control" parameterSource="totalingresosdolar"/>
				<CustomParameter id="46" field="totalegresosdolar" dataType="Integer" parameterType="Control" parameterSource="totalegresosdolar"/>
				<CustomParameter id="47" field="saldofinaldolar" dataType="Integer" parameterType="Control" parameterSource="saldofinaldolar"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
		<Record id="28" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="cajaresumen1" wizardCaption=" Cajaresumen Buscar" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="cierrecaja.ccp" PathID="cajaresumen1">
			<Components>
				<Button id="29" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Buscar" PathID="cajaresumen1Button_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="30" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="s_fecha" wizardCaption="Fecha" wizardSize="10" wizardMaxLength="100" wizardIsPassword="False" PathID="cajaresumen1s_fecha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="31" name="DatePicker_s_fecha" control="s_fecha" wizardSatellite="True" wizardControl="s_fecha" wizardDatePickerType="Image" wizardPicture="../Styles/SandBeach/Images/DatePicker.gif" style="../Styles/SandBeach/Style.css" PathID="cajaresumen1DatePicker_s_fecha">
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
		<CodeFile id="Events" language="PHPTemplates" name="cierrecaja_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="cierrecaja.php" forShow="True" url="cierrecaja.php" comment="//" codePage="windows-1252"/>
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
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="21"/>
			</Actions>
		</Event>
	</Events>
</Page>
