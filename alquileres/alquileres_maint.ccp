<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\alquileres" secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="SandBeach" wizardThemeVersion="3.0" needGeneration="0" isService="False">
	<Components>
		<IncludePage id="18" name="Header" parentType="Page" page="../Header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Connection1" name="alquileres" dataSource="alquileres" errorSummator="Error" wizardCaption="Agregar/Editar Alquileres " wizardFormMethod="post" returnPage="../alquileres_list.ccp" PathID="alquileres">
			<Components>
				<ListBox id="7" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" returnValueType="Number" name="idpropiedad" fieldSource="idpropiedad" required="True" caption="Idpropiedad" wizardCaption="Idpropiedad" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardEmptyCaption="Seleccionar Valor" connection="Connection1" dataSource="propiedades" boundColumn="idpropiedad" textColumn="direccion" PathID="alquileresidpropiedad">
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
				<ListBox id="8" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" returnValueType="Number" name="idestado" fieldSource="idestado" required="True" caption="Idestado" wizardCaption="Idestado" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardEmptyCaption="Seleccionar Valor" connection="Connection1" dataSource="estados" boundColumn="idestado" textColumn="descripcion" PathID="alquileresidestado">
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
				<TextBox id="9" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="fechainicio" fieldSource="fechainicio" required="False" caption="Fechainicio" wizardCaption="Fechainicio" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" PathID="alquileresfechainicio">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="10" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="fechafin" fieldSource="fechafin" required="False" caption="Fechafin" wizardCaption="Fechafin" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" PathID="alquileresfechafin">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="11" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="ano1" fieldSource="ano1" required="False" caption="Ano1" wizardCaption="Ano1" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" PathID="alquileresano1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="12" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="ano2" fieldSource="ano2" required="False" caption="Ano2" wizardCaption="Ano2" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" PathID="alquileresano2">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="13" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="ano3" fieldSource="ano3" required="False" caption="Ano3" wizardCaption="Ano3" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" PathID="alquileresano3">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="14" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="porcentajehonorarios" fieldSource="porcentajehonorarios" required="False" caption="Porcentajehonorarios" wizardCaption="Porcentajehonorarios" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" PathID="alquileresporcentajehonorarios">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="15" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="vto" fieldSource="vto" required="False" caption="Vto" wizardCaption="Vto" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" PathID="alquileresvto">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="16" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="acuerdo" fieldSource="acuerdo" required="False" caption="Acuerdo" wizardCaption="Acuerdo" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" PathID="alquileresacuerdo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Agregar" PathID="alquileresButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Enviar" PathID="alquileresButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="5" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Borrar" PathID="alquileresButton_Delete">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="6" conditionType="Parameter" useIsNull="False" field="idalquiler" parameterSource="idalquiler" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
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
		<IncludePage id="19" name="Footer" parentType="Page" page="../Footer.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="alquileres_maint.php" forShow="True" url="alquileres_maint.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="17" groupID="1"/>
	</SecurityGroups>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
