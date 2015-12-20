<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\fichas" secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="SandBeach" wizardThemeVersion="3.0" needGeneration="0" isService="False">
	<Components>
		<IncludePage id="30" name="Header" page="../Header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Connection1" name="fichas" dataSource="fichas" errorSummator="Error" wizardCaption="Agregar/Editar Fichas " wizardFormMethod="post" returnPage="fichas_maint.ccp" pasteAsReplace="pasteAsReplace" PathID="fichas">
			<Components>
				<TextBox id="9" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="nombre" fieldSource="nombre" required="True" caption="Nombre" wizardCaption="Nombre" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" PathID="fichasnombre">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="10" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="direccion" fieldSource="direccion" required="True" caption="Direccion" wizardCaption="Direccion" wizardSize="50" wizardMaxLength="128" wizardIsPassword="False" PathID="fichasdireccion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="11" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="localidad" fieldSource="localidad" required="True" caption="Localidad" wizardCaption="Localidad" wizardSize="40" wizardMaxLength="40" wizardIsPassword="False" PathID="fichaslocalidad" defaultValue="&quot;C.A.B.A.&quot;">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="17" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="provincia" fieldSource="provincia" required="False" caption="Provincia" wizardCaption="Provincia" wizardSize="40" wizardMaxLength="40" wizardIsPassword="False" PathID="fichasprovincia" sourceType="Table" connection="Connection1" dataSource="provincias" boundColumn="idprovincia" textColumn="desprovincia" defaultValue="3">
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
				<TextBox id="12" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="codigopostal" fieldSource="codigopostal" required="False" caption="Codigopostal" wizardCaption="Codigopostal" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" PathID="fichascodigopostal">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="13" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="telefono" fieldSource="telefono" required="True" caption="Telefono" wizardCaption="Telefono" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" PathID="fichastelefono">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="14" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="celular" fieldSource="celular" required="False" caption="Celular" wizardCaption="Celular" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" PathID="fichascelular">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="18" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="email" caption="Email" fieldSource="email" required="False" PathID="fichasemail">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="20" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="actividad" fieldSource="actividad" required="False" caption="Actividad" wizardCaption="Actividad" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" PathID="fichasactividad">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="7" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" returnValueType="Number" name="idtipodocumento" fieldSource="idtipodocumento" required="True" caption="Idtipodocumento" wizardCaption="Idtipodocumento" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardEmptyCaption="Seleccionar Valor" connection="Connection1" dataSource="tipodocumentos" boundColumn="idtipodocumento" textColumn="destipodocumento" PathID="fichasidtipodocumento" defaultValue="1">
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
				<ListBox id="19" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="tipocont" fieldSource="idtipocontribuyente" required="True" caption="Tipocont" wizardCaption="Tipocont" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" sourceType="Table" connection="Connection1" dataSource="tipocontribuyente" boundColumn="idtipocontribuyente" textColumn="descripcion" PathID="fichastipocont" defaultValue="1">
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
				<TextBox id="23" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="nrodocumento" fieldSource="nrodocumento" required="True" caption="Nrodocumento" wizardCaption="Nrodocumento" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" PathID="fichasnrodocumento">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="22" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="cuit" fieldSource="cuit" required="False" caption="Cuit" wizardCaption="Cuit" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" PathID="fichascuit">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="15" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="fechanac" fieldSource="fechanac" required="False" caption="Fechanac" wizardCaption="Fechanac" wizardSize="10" wizardMaxLength="100" wizardIsPassword="False" PathID="fichasfechanac">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="16" name="DatePicker_fechanac" control="fechanac" wizardSatellite="True" wizardControl="fechanac" wizardDatePickerType="Image" wizardPicture="Styles/SandBeach/Images/DatePicker.gif" style="../Styles/SandBeach/Style.css" PathID="fichasDatePicker_fechanac">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<ListBox id="24" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="nacionalidad" fieldSource="nacionalidad" required="False" caption="Nacionalidad" wizardCaption="Nacionalidad" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" PathID="fichasnacionalidad" sourceType="Table" connection="Connection1" dataSource="nacionalidad" boundColumn="idnacionalidad" textColumn="desnacionalidad">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="38" tableName="nacionalidad" schemaName="dbo" posLeft="10" posTop="10" posWidth="107" posHeight="88"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
				</ListBox>
				<ListBox id="8" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" returnValueType="Number" name="idestadocivil" fieldSource="idestadocivil" required="True" caption="Idestadocivil" wizardCaption="Idestadocivil" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardEmptyCaption="Seleccionar Valor" connection="Connection1" dataSource="estadocivil" boundColumn="idestadocivil" textColumn="desestadocivil" PathID="fichasidestadocivil" defaultValue="2">
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
				<ListBox id="25" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="nupcias" fieldSource="nupcias" required="False" caption="Nupcias" wizardCaption="Nupcias" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" PathID="fichasnupcias" sourceType="Table" connection="Connection1" dataSource="nupcias" boundColumn="idnupcias" textColumn="desnupcias">
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
				<TextBox id="26" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="conyuge" fieldSource="conyuge" required="False" caption="Conyuge" wizardCaption="Conyuge" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" PathID="fichasconyuge">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="27" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="padre" fieldSource="padre" required="False" caption="Padre" wizardCaption="Padre" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" PathID="fichaspadre">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="28" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="madre" fieldSource="madre" required="False" caption="Madre" wizardCaption="Madre" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" PathID="fichasmadre">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextArea id="21" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="observaciones" fieldSource="observaciones" required="False" caption="Observaciones" wizardCaption="Observaciones" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" PathID="fichasobservaciones">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Agregar" PathID="fichasButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Enviar" PathID="fichasButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="5" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Borrar" PathID="fichasButton_Delete">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="34" message="Ud. se dispone a eliminar esta Ficha. Esta operación no puede deshacerse, confirme si está seguro.-"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events>
				<Event name="BeforeDelete" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="39"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="6" conditionType="Parameter" useIsNull="False" field="idficha" parameterSource="idficha" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
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
		<Panel id="35" visible="True" name="Panel1" pasteAsReplace="pasteAsReplace" PathID="Panel1">
			<Components>
				<Link id="36" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Link1" hrefSource="../propiedades/propiedades_list_ficha.php" wizardUseTemplateBlock="False" PathID="Panel1Link1">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="37" sourceType="URL" format="yyyy-mm-dd" name="idficha" source="idficha"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
			</Components>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
		<IncludePage id="31" name="Footer" page="../Footer.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="fichas_maint.php" forShow="True" url="fichas_maint.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="fichas_maint_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="29" groupID="1"/>
	</SecurityGroups>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
