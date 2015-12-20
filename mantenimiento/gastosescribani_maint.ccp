<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\mantenimiento" secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="SandBeach" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Connection1" name="gastosescribania" dataSource="gastosescribania" errorSummator="Error" wizardCaption="Agregar/Editar Gastosescribania " wizardFormMethod="post" returnPage="gastosescribani_list.ccp" PathID="gastosescribania">
			<Components>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Agregar" PathID="gastosescribaniaButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Enviar" PathID="gastosescribaniaButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="5" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Borrar" PathID="gastosescribaniaButton_Delete">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="descripcion" fieldSource="descripcion" required="False" caption="Descripcion" wizardCaption="Descripcion" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" PathID="gastosescribaniadescripcion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="8" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="importecomp" fieldSource="importecomp" required="False" caption="Importecomp" wizardCaption="Importecomp" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" PathID="gastosescribaniaimportecomp">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="9" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="importevend" fieldSource="importevend" required="False" caption="Importevend" wizardCaption="Importevend" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" PathID="gastosescribaniaimportevend">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="10" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="jurisdiccion" fieldSource="jurisdiccion" required="False" caption="Jurisdiccion" wizardCaption="Jurisdiccion" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" PathID="gastosescribaniajurisdiccion" sourceType="ListOfValues" connection="Connection1" _valueOfList="Provincia" _nameOfList="Provincia" dataSource="Capital;Capital;Provincia;Provincia">
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
				</ListBox>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="6" conditionType="Parameter" useIsNull="False" field="idgastoescribania" parameterSource="idgastoescribania" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
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
		<IncludePage id="12" name="Header" PathID="Header" page="../Header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="gastosescribani_maint.php" forShow="True" url="gastosescribani_maint.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="13" groupID="1"/>
		<Group id="14" groupID="2"/>
	</SecurityGroups>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
