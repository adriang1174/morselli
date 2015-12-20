<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\mantenimiento" secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="SandBeach" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Connection1" name="tipocuota" dataSource="tipocuota" errorSummator="Error" wizardCaption="Agregar/Editar Tipocuota " wizardFormMethod="post" returnPage="tipocuota_list.ccp" PathID="tipocuota">
			<Components>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Agregar" PathID="tipocuotaButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Enviar" PathID="tipocuotaButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="5" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Borrar" PathID="tipocuotaButton_Delete">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="idtipocuota" fieldSource="idtipocuota" required="True" caption="Idtipocuota" wizardCaption="Idtipocuota" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" PathID="tipocuotaidtipocuota">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="8" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="descripcion" fieldSource="descripcion" required="True" caption="Descripcion" wizardCaption="Descripcion" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" PathID="tipocuotadescripcion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="9" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="tipomovimientoliq" fieldSource="tipomovimientoliq" required="True" caption="Tipomovimientoliq" wizardCaption="Tipomovimientoliq" wizardSize="2" wizardMaxLength="2" wizardIsPassword="False" PathID="tipocuotatipomovimientoliq" sourceType="ListOfValues" connection="Connection1" _valueOfList="D" _nameOfList="D" dataSource="C;C;D;D" boundColumn="1" textColumn="2">
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
</TextBox>
<TextBox id="10" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="tipomovimientopag" fieldSource="tipomovimientopag" required="True" caption="Tipomovimientopag" wizardCaption="Tipomovimientopag" wizardSize="2" wizardMaxLength="2" wizardIsPassword="False" PathID="tipocuotatipomovimientopag" sourceType="Table">
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
</TextBox>
<TextBox id="11" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="porcentaje" fieldSource="porcentaje" required="False" caption="Porcentaje" wizardCaption="Porcentaje" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" PathID="tipocuotaporcentaje">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="6" conditionType="Parameter" useIsNull="False" field="idtipocuota" parameterSource="idtipocuota" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
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
		<IncludePage id="13" name="Header" PathID="Header" page="../Header.ccp">
<Components/>
<Events/>
<Features/>
</IncludePage>
</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="tipocuota_maint.php" forShow="True" url="tipocuota_maint.php" comment="//" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups>
		<Group id="12" groupID="1"/>
	</SecurityGroups>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
