<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\caja" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="SandBeach" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<IncludePage id="2" name="Headercaja" PathID="Headercaja" page="Header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Record id="3" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Connection1" name="cajaresumen" dataSource="SELECT * 
FROM cajaresumen
WHERE ( convert(varchar,fecha,103) = convert(varchar,'{s_fecha}',103 ) ) " errorSummator="Error" wizardCaption="Agregar/Editar Cajaresumen " wizardFormMethod="post" PathID="cajaresumen" activeCollection="DSQLParameters" parameterTypeListName="ParameterTypeList" customInsertType="Table" customInsert="cajaresumen" customUpdateType="SQL" customUpdate="UPDATE cajaresumen 
SET saldoinicial={saldoinicial}, 
saldoinicialdolar = {saldoinicialdolar}
WHERE  ( convert(varchar,fecha,103) = convert(varchar,'{fecha}',103 ) )" activeTableType="cajaresumen" customDeleteType="SQL" customDelete="delete from cajaresumen
where convert(varchar,fecha,103) = convert(varchar,'{fecha}',103 )">
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
				<TextBox id="10" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="saldoinicial" fieldSource="saldoinicial" required="False" caption="Saldoinicial" wizardCaption="Saldoinicial" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="cajaresumensaldoinicial">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="20"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="14" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="fecha" PathID="cajaresumenfecha" fieldSource="fecha" DBFormat="yyyy-mm-dd HH:nn:ss" required="False" format="dd/mm/yyyy">
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
				</TextBox>
				<TextBox id="29" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="saldoinicialdolar" PathID="cajaresumensaldoinicialdolar" fieldSource="saldoinicialdolar">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
			</Components>
			<Events>
				<Event name="OnValidate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="21"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="27"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="22" conditionType="Expression" useIsNull="False" field="fecha" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" expression="convert(varchar,fecha,103) = convert(varchar,'{s_fecha}',103 )" parameterSource="s_fecha"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="30" variable="s_fecha" parameterType="URL" defaultValue="01/01/1960" dataType="Date" DBFormat="dd/mm/yyyy " parameterSource="s_fecha" format="dd/mm/yyyy"/>
			</SQLParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements>
				<CustomParameter id="31" field="saldoinicial" dataType="Float" parameterType="Control" parameterSource="saldoinicial" omitIfEmpty="True"/>
				<CustomParameter id="32" field="fecha" dataType="Date" parameterType="Control" parameterSource="fecha" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss" omitIfEmpty="True"/>
				<CustomParameter id="33" field="saldoinicialdolar" dataType="Float" parameterType="Control" parameterSource="saldoinicialdolar" omitIfEmpty="True"/>
			</IFormElements>
			<USPParameters/>
			<USQLParameters>
				<SQLParameter id="35" variable="saldoinicial" dataType="Float" parameterType="Control" parameterSource="saldoinicial"/>
				<SQLParameter id="36" variable="fecha" dataType="Date" parameterType="Control" parameterSource="fecha" format="dd/mm/yyyy" DBFormat="dd/mm/yyyy" defaultValue="01/01/1960"/>
				<SQLParameter id="37" variable="saldoinicialdolar" parameterType="Control" defaultValue="0" dataType="Integer" parameterSource="saldoinicialdolar"/>
			</USQLParameters>
			<UConditions>
				<TableParameter id="34" conditionType="Expression" useIsNull="False" searchConditionType="Equal" parameterType="URL" logicOperator="And" expression="convert(varchar,fecha,103) = convert(varchar,'{s_fecha}',103 )"/>
			</UConditions>
			<UFormElements>
				<CustomParameter id="15" field="saldoinicial" dataType="Float" parameterType="Control" parameterSource="saldoinicial" omitIfEmpty="True"/>
				<CustomParameter id="16" field="fecha" dataType="Date" parameterType="Control" parameterSource="fecha" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss" omitIfEmpty="True"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="38" variable="fecha" parameterType="Control" defaultValue="01/01/1960" dataType="Date" DBFormat="dd/mm/yyyy" format="dd/mm/yyyy" parameterSource="fecha"/>
			</DSQLParameters>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
		<Record id="23" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="cajaresumen1" wizardCaption=" Cajaresumen Buscar" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="aperturacaja.ccp" PathID="cajaresumen1">
			<Components>
				<Button id="24" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Buscar" PathID="cajaresumen1Button_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="25" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="s_fecha" wizardCaption="Fecha" wizardSize="10" wizardMaxLength="100" wizardIsPassword="False" PathID="cajaresumen1s_fecha">
					<Components/>
					<Events>
<Event name="OnLoad" type="Client">
<Actions>
<Action actionName="Set Focus" actionCategory="General" id="39"/>
</Actions>
</Event>
</Events>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="26" name="DatePicker_s_fecha" control="s_fecha" wizardSatellite="True" wizardControl="s_fecha" wizardDatePickerType="Image" wizardPicture="../Styles/SandBeach/Images/DatePicker.gif" style="../Styles/SandBeach/Style.css" PathID="cajaresumen1DatePicker_s_fecha">
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
		<CodeFile id="Code" language="PHPTemplates" name="aperturacaja.php" forShow="True" url="aperturacaja.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="aperturacaja_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="BeforeInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="13"/>
			</Actions>
		</Event>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="28"/>
			</Actions>
		</Event>
	</Events>
</Page>
