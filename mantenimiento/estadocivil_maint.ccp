<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\mantenimiento" secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="SandBeach" wizardThemeVersion="3.0" needGeneration="0" accessDeniedPage="../accesodenegado/accesodenegado.ccp" isService="False">
	<Components>
		<IncludePage id="9" name="Header" parentType="Page" page="../Header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Connection1" name="estadocivil" dataSource="estadocivil" errorSummator="Error" wizardCaption="Agregar/Editar Estadocivil " wizardFormMethod="post" returnPage="estadocivil_list.ccp" PathID="estadocivil">
			<Components>
				<TextBox id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="desestadocivil" fieldSource="desestadocivil" required="True" caption="Desestadocivil" wizardCaption="Desestadocivil" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" PathID="estadocivildesestadocivil">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Agregar" PathID="estadocivilButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Enviar" PathID="estadocivilButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="6" conditionType="Parameter" useIsNull="False" field="idestadocivil" parameterSource="idestadocivil" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
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
		<IncludePage id="10" name="Footer" parentType="Page" page="../Footer.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="estadocivil_maint.php" forShow="True" url="estadocivil_maint.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="8" groupID="1"/>
	</SecurityGroups>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
