<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\propiedades" secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="SandBeach" wizardThemeVersion="3.0" needGeneration="0" isService="False" pasteActions="pasteActions">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="All" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Connection1" name="propiedades" dataSource="propiedades" errorSummator="Error" wizardCaption="Agregar/Editar Propiedades " wizardFormMethod="post" returnPage="propiedades_maint.ccp" PathID="propiedades" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customInsertType="Procedure" parameterTypeListName="ParameterTypeList" customInsert="SP_GUARDA_PROPIEDAD;1" activeCollection="DSPParameters" customUpdateType="Procedure" customUpdate="SP_GUARDA_PROPIEDAD;1" customDeleteType="Procedure" customDelete="SP_BORRA_PROPIEDAD;1">
			<Components>
				<TextBox id="8" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="direccion" fieldSource="direccion" required="False" caption="Direccion" wizardCaption="Direccion" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" PathID="propiedadesdireccion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="9" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="localidad" fieldSource="localidad" required="False" caption="Localidad" wizardCaption="Localidad" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" PathID="propiedadeslocalidad" defaultValue="&quot;C.A.B.A.&quot;">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Agregar" PathID="propiedadesButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Enviar" PathID="propiedadesButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="5" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Borrar" PathID="propiedadesButton_Delete">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="22" message="Se dispone a Eliminar la Propiedad, confirme si esta seguro. Esta Operción no puede deshacerse."/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="10" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="telefono" fieldSource="telefono" required="False" caption="Telefono" wizardCaption="Telefono" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" PathID="propiedadestelefono">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="11" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="codigopostal" fieldSource="codigopostal" required="False" caption="Codigopostal" wizardCaption="Codigopostal" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" PathID="propiedadescodigopostal">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="7" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" returnValueType="Number" name="idtipopropiedad" fieldSource="idtipopropiedad" required="True" caption="Idtipopropiedad" wizardCaption="Idtipopropiedad" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardEmptyCaption="Seleccionar Valor" connection="Connection1" dataSource="tipopropiedades" boundColumn="idtipopropiedad" textColumn="destipopropiedad" PathID="propiedadesidtipopropiedad">
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
				<TextBox id="15" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="cantocup" fieldSource="cantocup" required="False" caption="Cantocup" wizardCaption="Cantocup" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" PathID="propiedadescantocup">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="20" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="estado" PathID="propiedadesestado" fieldSource="estado" sourceType="Table" connection="Connection1" dataSource="estadospropiedades" boundColumn="idestado" textColumn="descripcion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="83" tableName="estadospropiedades" schemaName="dbo" posLeft="10" posTop="10" posWidth="95" posHeight="104"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
				</ListBox>
				<TextBox id="14" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="administ" fieldSource="administ" required="False" caption="Administ" wizardCaption="Administ" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" PathID="propiedadesadminist">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="41" fieldSourceType="DBColumn" dataType="Integer" name="idficha" PathID="propiedadesidficha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="43" fieldSourceType="DBColumn" dataType="Integer" name="idpropiedad" PathID="propiedadesidpropiedad" fieldSource="idpropiedad">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="42"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="6" conditionType="Parameter" useIsNull="False" field="idpropiedad" parameterSource="idpropiedad" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters>
				<SPParameter id="Key54" parameterName="@RETURN_VALUE" parameterSource="RETURN_VALUE" dataType="Int" parameterType="URL" dataSize="0" direction="ReturnValue" scale="0" precision="10"/>
				<SPParameter id="Key55" parameterName="@idficha" parameterSource="idficha" dataType="Int" parameterType="Form" dataSize="0" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key56" parameterName="@idpropiedad" parameterSource="idpropiedad" dataType="Int" parameterType="Form" dataSize="0" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key57" parameterName="@idtipopropiedad" parameterSource="idtipopropiedad" dataType="Int" parameterType="Form" dataSize="0" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key58" parameterName="@direccion" parameterSource="direccion" dataType="VarChar" parameterType="Form" dataSize="50" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key59" parameterName="@localidad" parameterSource="localidad" dataType="VarChar" parameterType="Form" dataSize="50" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key60" parameterName="@telefono" parameterSource="telefono" dataType="VarChar" parameterType="Form" dataSize="50" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key61" parameterName="@codigopostal" parameterSource="codigopostal" dataType="VarChar" parameterType="Form" dataSize="20" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key62" parameterName="@entre" parameterSource="entre" dataType="VarChar" parameterType="Form" dataSize="50" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key63" parameterName="@cantocup" parameterSource="cantocup" dataType="Char" parameterType="Form" dataSize="20" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key64" parameterName="@estado" parameterSource="estado" dataType="Char" parameterType="Form" dataSize="20" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key65" parameterName="@administ" parameterSource="administ" dataType="Char" parameterType="Form" dataSize="20" direction="Input" scale="0" precision="10"/>
			</ISPParameters>
			<ISQLParameters/>
			<IFormElements>
				<CustomParameter id="44" field="direccion" dataType="Text" parameterType="Control" parameterSource="direccion"/>
				<CustomParameter id="45" field="localidad" dataType="Text" parameterType="Control" parameterSource="localidad"/>
				<CustomParameter id="46" field="telefono" dataType="Text" parameterType="Control" parameterSource="telefono"/>
				<CustomParameter id="47" field="codigopostal" dataType="Text" parameterType="Control" parameterSource="codigopostal"/>
				<CustomParameter id="48" field="idtipopropiedad" dataType="Integer" parameterType="Control" parameterSource="idtipopropiedad"/>
				<CustomParameter id="49" field="cantocup" dataType="Text" parameterType="Control" parameterSource="cantocup"/>
				<CustomParameter id="50" field="estado" dataType="Text" parameterType="Control" parameterSource="estado"/>
				<CustomParameter id="51" field="administ" dataType="Text" parameterType="Control" parameterSource="administ"/>
				<CustomParameter id="52" field="idpropiedad" dataType="Integer" parameterType="Control" parameterSource="idpropiedad"/>
			</IFormElements>
			<USPParameters>
				<SPParameter id="Key63" parameterName="@RETURN_VALUE" parameterSource="RETURN_VALUE" dataType="Int" parameterType="URL" dataSize="0" direction="ReturnValue" scale="0" precision="10"/>
				<SPParameter id="Key64" parameterName="@idficha" parameterSource="idficha" dataType="Int" parameterType="Form" dataSize="0" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key65" parameterName="@idpropiedad" parameterSource="idpropiedad" dataType="Int" parameterType="Form" dataSize="0" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key66" parameterName="@idtipopropiedad" parameterSource="idtipopropiedad" dataType="Int" parameterType="Form" dataSize="0" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key67" parameterName="@direccion" parameterSource="direccion" dataType="VarChar" parameterType="Form" dataSize="50" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key68" parameterName="@localidad" parameterSource="localidad" dataType="VarChar" parameterType="Form" dataSize="50" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key69" parameterName="@telefono" parameterSource="telefono" dataType="VarChar" parameterType="Form" dataSize="50" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key70" parameterName="@codigopostal" parameterSource="codigopostal" dataType="VarChar" parameterType="Form" dataSize="20" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key71" parameterName="@entre" parameterSource="entre" dataType="Char" parameterType="Form" dataSize="20" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key72" parameterName="@cantocup" parameterSource="cantocup" dataType="Char" parameterType="Form" dataSize="10" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key73" parameterName="@estado" parameterSource="estado" dataType="Char" parameterType="Form" dataSize="10" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key74" parameterName="@administ" parameterSource="administ" dataType="Char" parameterType="Form" dataSize="10" direction="Input" scale="0" precision="10"/>
			</USPParameters>
			<USQLParameters/>
			<UConditions/>
			<UFormElements>
				<CustomParameter id="53" field="direccion" dataType="Text" parameterType="Control" parameterSource="direccion"/>
				<CustomParameter id="54" field="localidad" dataType="Text" parameterType="Control" parameterSource="localidad"/>
				<CustomParameter id="55" field="telefono" dataType="Text" parameterType="Control" parameterSource="telefono"/>
				<CustomParameter id="56" field="codigopostal" dataType="Text" parameterType="Control" parameterSource="codigopostal"/>
				<CustomParameter id="57" field="idtipopropiedad" dataType="Integer" parameterType="Control" parameterSource="idtipopropiedad"/>
				<CustomParameter id="58" field="cantocup" dataType="Text" parameterType="Control" parameterSource="cantocup"/>
				<CustomParameter id="59" field="estado" dataType="Text" parameterType="Control" parameterSource="estado"/>
				<CustomParameter id="60" field="administ" dataType="Text" parameterType="Control" parameterSource="administ"/>
				<CustomParameter id="61" field="idpropiedad" dataType="Integer" parameterType="Control" parameterSource="idpropiedad"/>
			</UFormElements>
			<DSPParameters>
				<SPParameter id="Key63" parameterName="@RETURN_VALUE" parameterSource="RETURN_VALUE" dataType="Int" parameterType="URL" dataSize="0" direction="ReturnValue" scale="0" precision="10"/>
				<SPParameter id="Key64" parameterName="@idpropiedad" parameterSource="idpropiedad" dataType="Int" parameterType="Form" dataSize="0" direction="Input" scale="0" precision="10"/>
			</DSPParameters>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
		<EditableGrid id="23" urlType="Relative" secured="False" emptyRows="1" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="All" sourceType="Table" defaultPageSize="30" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Connection1" dataSource="fichaspropiedades" name="fichaspropiedades" pageSizeLimit="100" wizardCaption=" Fichaspropiedades Lista de" wizardGridType="Tabular" wizardAltRecord="False" wizardRecordSeparator="False" wizardNoRecords="No hay registros" PathID="fichaspropiedades" deleteControl="CheckBox_Delete" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="UConditions" customInsertType="Table" activeTableType="customUpdate" customInsert="fichaspropiedades" customUpdateType="Table" customUpdate="fichaspropiedades">
			<Components>
				<TextBox id="27" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="duenoporcentaje" fieldSource="duenoporcentaje" required="True" caption="Duenoporcentaje" wizardCaption="Duenoporcentaje" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="fichaspropiedadesduenoporcentaje">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<CheckBox id="28" visible="Dynamic" fieldSourceType="CodeExpression" dataType="Boolean" name="CheckBox_Delete" checkedValue="true" uncheckedValue="false" wizardCaption="Borrar" wizardAddNbsp="True" PathID="fichaspropiedadesCheckBox_Delete">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<Button id="29" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Submit" operation="Submit" wizardCaption="Enviar" PathID="fichaspropiedadesButton_Submit">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="35" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="nombre" PathID="fichaspropiedadesnombre">
					<Components/>
					<Events>
						<Event name="OnChange" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="66"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="36" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="nrodocumento" PathID="fichaspropiedadesnrodocumento">
					<Components/>
					<Events>
						<Event name="OnChange" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="67"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="68" fieldSourceType="DBColumn" dataType="Text" name="errorAjax" PathID="fichaspropiedadeserrorAjax">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="69" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="idficha" PathID="fichaspropiedadesidficha" fieldSource="idficha">
					<Components/>
					<Events>
						<Event name="OnChange" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="70"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="73" fieldSourceType="DBColumn" dataType="Text" name="idpropiedad" PathID="fichaspropiedadesidpropiedad">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeBuildUpdate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="40"/>
					</Actions>
				</Event>
				<Event name="OnValidate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="62" id_oncopy="62"/>
					</Actions>
				</Event>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="71"/>
					</Actions>
				</Event>
				<Event name="BeforeBuildInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="72"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="74"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="64" conditionType="Parameter" useIsNull="False" field="idpropiedad" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="-1" parameterSource="idpropiedad"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="24" tableName="fichaspropiedades" posLeft="10" posTop="10" posWidth="108" posHeight="104"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="32" tableName="fichaspropiedades" fieldName="idpropiedad"/>
				<Field id="33" tableName="fichaspropiedades" fieldName="idficha"/>
				<Field id="34" tableName="fichaspropiedades" fieldName="duenoporcentaje"/>
			</Fields>
			<PKFields>
				<PKField id="30" tableName="fichaspropiedades" fieldName="idpropiedad" dataType="Integer"/>
				<PKField id="31" tableName="fichaspropiedades" fieldName="idficha" dataType="Integer"/>
			</PKFields>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements>
				<CustomParameter id="37" field="idficha" dataType="Integer" parameterType="Control" parameterSource="idficha"/>
				<CustomParameter id="38" field="duenoporcentaje" dataType="Float" parameterType="Control" parameterSource="duenoporcentaje"/>
				<CustomParameter id="39" field="idpropiedad" dataType="Integer" parameterType="Form" parameterSource="idpropiedad" omitIfEmpty="True"/>
			</IFormElements>
			<USPParameters/>
			<USQLParameters/>
			<UConditions>
				<TableParameter id="75" conditionType="Parameter" useIsNull="False" field="idpropiedad" dataType="Integer" parameterType="DataSourceColumn" parameterSource="idpropiedad" searchConditionType="Equal" logicOperator="And"/>
				<TableParameter id="76" conditionType="Parameter" useIsNull="False" field="idficha" dataType="Integer" parameterType="DataSourceColumn" parameterSource="idficha" searchConditionType="Equal" logicOperator="And"/>
			</UConditions>
			<UFormElements>
				<CustomParameter id="78" field="duenoporcentaje" dataType="Float" parameterType="Control" parameterSource="duenoporcentaje"/>
				<CustomParameter id="79" field="idficha" dataType="Integer" parameterType="Control" parameterSource="idficha"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</EditableGrid>
		<IncludePage id="80" name="Header" PathID="Header" page="../Header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Link id="81" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Link1" PathID="Link1" hrefSource="../contrato/contrato.ccp" wizardUseTemplateBlock="False">
			<Components/>
			<Events/>
			<LinkParameters>
				<LinkParameter id="82" sourceType="URL" format="yyyy-mm-dd" name="idpropiedad" source="idpropiedad"/>
			</LinkParameters>
			<Attributes/>
			<Features/>
		</Link>
		<Link id="84" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Link2" PathID="Link2" hrefSource="../hipotecas/hipotecas_maint.ccp" wizardUseTemplateBlock="False">
			<Components/>
			<Events/>
			<LinkParameters>
				<LinkParameter id="85" sourceType="URL" format="yyyy-mm-dd" name="idpropiedad" source="idpropiedad"/>
			</LinkParameters>
			<Attributes/>
			<Features/>
		</Link>
		<Grid id="86" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="Connection1" dataSource="alquileres, Monedas" name="contratos" pageSizeLimit="100" wizardCaption=" Alquileres Lista de" wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No hay registros" activeCollection="TableParameters">
			<Components>
				<Link id="87" fieldSourceType="DBColumn" dataType="Integer" html="False" name="idalquiler" fieldSource="idalquiler" wizardCaption="Idalquiler" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="contratosidalquiler" visible="Yes" hrefType="Page" urlType="Relative" preserveParameters="None" hrefSource="../contrato/contrato.ccp">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<LinkParameters>
						<LinkParameter id="100" sourceType="DataField" name="idalquiler" source="idalquiler"/>
						<LinkParameter id="101" sourceType="DataField" name="idpropiedad" source="idpropiedad"/>
</LinkParameters>
				</Link>
				<Label id="88" fieldSourceType="DBColumn" dataType="Integer" html="False" name="moneda" fieldSource="simbolo" wizardCaption="Idmoneda" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="contratosmoneda">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="90" fieldSourceType="DBColumn" dataType="Date" html="False" name="fechainicio" fieldSource="fechainicio" wizardCaption="Fechainicio" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="contratosfechainicio">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="91" fieldSourceType="DBColumn" dataType="Date" html="False" name="fechafin" fieldSource="fechafin" wizardCaption="Fechafin" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="contratosfechafin">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="92" fieldSourceType="DBColumn" dataType="Float" html="False" name="porcentajehonorarios" fieldSource="porcentajehonorarios" wizardCaption="Porcentajehonorarios" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="contratosporcentajehonorarios">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="93" fieldSourceType="DBColumn" dataType="Integer" html="False" name="vto" fieldSource="vto" wizardCaption="Vto" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="contratosvto">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="94" fieldSourceType="DBColumn" dataType="Text" html="False" name="acuerdo" fieldSource="acuerdo" wizardCaption="Acuerdo" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="contratosacuerdo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="95" fieldSourceType="DBColumn" dataType="Integer" html="False" name="idpropiedad" fieldSource="idpropiedad" wizardCaption="Idpropiedad" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="contratosidpropiedad">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="99" conditionType="Parameter" useIsNull="False" field="alquileres.idpropiedad" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="idpropiedad"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="96" tableName="alquileres" posLeft="10" posTop="10" posWidth="158" posHeight="180"/>
				<JoinTable id="97" tableName="Monedas" schemaName="dbo" posLeft="227" posTop="10" posWidth="95" posHeight="104"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="98" tableLeft="alquileres" tableRight="Monedas" fieldLeft="alquileres.idmoneda" fieldRight="Monedas.idmoneda" joinType="inner" conditionType="Equal"/>
			</JoinLinks>
			<Fields/>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="propiedades_maint.php" forShow="True" url="propiedades_maint.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="propiedades_maint_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="16" groupID="1"/>
	</SecurityGroups>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
