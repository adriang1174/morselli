<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\contrato" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="SandBeach" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<IncludePage id="2" name="Header" PathID="Header" page="../Header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="All" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Connection1" name="alquileres" dataSource="alquileres" errorSummator="Error" wizardCaption="Agregar/Editar Alquileres " wizardFormMethod="post" PathID="alquileres" customDeleteType="Procedure" parameterTypeListName="ParameterTypeList" customDelete="SP_BORRA_CONTRATO;1" activeCollection="TableParameters" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" returnPage="contrato.ccp">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Agregar" PathID="alquileresButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="5" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Enviar" PathID="alquileresButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="6" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Borrar" PathID="alquileresButton_Delete" removeParameters="porcentajehonorarios;fechainicio;fechafin;acuerdo;vto;ano1;ano2;ano3;idalquiler;idestado">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="8" fieldSourceType="DBColumn" dataType="Integer" name="idpropiedad" fieldSource="idpropiedad" required="True" caption="Idpropiedad" wizardCaption="Idpropiedad" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="alquileresidpropiedad" visible="Yes">
<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
<Hidden id="9" fieldSourceType="DBColumn" dataType="Integer" name="idestado" fieldSource="idestado" required="False" caption="Idestado" wizardCaption="Idestado" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="alquileresidestado" visible="Yes" defaultValue="1">
<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
<TextBox id="10" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="fechainicio" fieldSource="fechainicio" required="True" caption="Fechainicio" wizardCaption="Fechainicio" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="alquileresfechainicio" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="173"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="15" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="porcentajehonorarios" fieldSource="porcentajehonorarios" required="True" caption="Porcentajehonorarios" wizardCaption="Porcentajehonorarios" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="alquileresporcentajehonorarios">
					<Components/>
					<Events>
						<Event name="OnValidate" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="180"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="17" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="acuerdo" fieldSource="acuerdo" required="False" caption="Acuerdo" wizardCaption="Acuerdo" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="alquileresacuerdo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Label id="18" fieldSourceType="DBColumn" dataType="Text" html="False" name="data_prop" PathID="alquileresdata_prop">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="168"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<DatePicker id="52" name="DatePicker_fechainicio1" PathID="alquileresDatePicker_fechainicio1" control="fechainicio" wizardDatePickerType="Image" wizardPicture="../Styles/SandBeach/Images/DatePicker.gif" style="../Styles/SandBeach/Style.css">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<TextBox id="11" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="fechafin" fieldSource="fechafin" required="True" caption="Fechafin" wizardCaption="Fechafin" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="alquileresfechafin" DBFormat="yyyy-mm-dd HH:nn:ss" format="dd/mm/yyyy">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="174"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="53" name="DatePicker_fechafin1" PathID="alquileresDatePicker_fechafin1" control="fechafin" wizardDatePickerType="Image" wizardPicture="../Styles/SandBeach/Images/DatePicker.gif" style="../Styles/SandBeach/Style.css">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<ListBox id="16" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="vto" fieldSource="vto" required="True" caption="Vto" wizardCaption="Vto" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="alquileresvto" sourceType="Table" connection="Connection1" dataSource="vencimientos" boundColumn="id" textColumn="descripcion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="76" tableName="vencimientos" schemaName="dbo" posLeft="10" posTop="10" posWidth="95" posHeight="88"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
				</ListBox>
				<ListBox id="169" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="idmoneda" wizardEmptyCaption="Seleccionar Valor" PathID="alquileresidmoneda" fieldSource="idmoneda" connection="Connection1" dataSource="Monedas" boundColumn="idmoneda" textColumn="descripcion" required="True">
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
				<TextBox id="179" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="idalquiler" PathID="alquileresidalquiler" fieldSource="idalquiler">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="54"/>
					</Actions>
				</Event>
				<Event name="AfterExecuteInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="81"/>
					</Actions>
				</Event>
				<Event name="AfterInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="82"/>
					</Actions>
				</Event>
				<Event name="BeforeExecuteInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="83"/>
					</Actions>
				</Event>
				<Event name="BeforeBuildInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="84"/>
					</Actions>
				</Event>
				<Event name="BeforeInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="87"/>
					</Actions>
				</Event>
				<Event name="OnValidate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="88"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="7" conditionType="Parameter" useIsNull="False" field="idalquiler" parameterSource="idalquiler" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="86" parameterType="URL" variable="idalquiler" dataType="Integer" parameterSource="idalquiler" defaultValue="0" designDefaultValue="1"/>
			</SQLParameters>
			<JoinTables>
				<JoinTable id="170" tableName="alquileres" posLeft="10" posTop="10" posWidth="158" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<ISPParameters>
				<SPParameter id="Key85" parameterName="@RETURN_VALUE" parameterSource="RETURN_VALUE" dataType="Int" parameterType="URL" dataSize="0" direction="ReturnValue" scale="0" precision="10"/>
				<SPParameter id="Key86" parameterName="@idalquiler" parameterSource="idalquiler" dataType="Int" parameterType="Form" dataSize="0" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key87" parameterName="@idficha" parameterSource="idFicha" dataType="Int" parameterType="Form" dataSize="0" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key88" parameterName="@idpropiedad" parameterSource="idpropiedad" dataType="Int" parameterType="Form" dataSize="0" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key89" parameterName="@fechainicio" parameterSource="fechainicio" dataType="Text" parameterType="Form" dataSize="0" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key90" parameterName="@fechafin" parameterSource="fechafin" dataType="Text" parameterType="Form" dataSize="0" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key91" parameterName="@ano1" parameterSource="ano1" dataType="Int" parameterType="Form" dataSize="0" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key92" parameterName="@ano2" parameterSource="ano2" dataType="Int" parameterType="Form" dataSize="0" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key93" parameterName="@ano3" parameterSource="ano3" dataType="Int" parameterType="Form" dataSize="0" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key94" parameterName="@ano4" parameterSource="ano4" dataType="Int" parameterType="Form" dataSize="0" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key95" parameterName="@ano5" parameterSource="ano5" dataType="Int" parameterType="Form" dataSize="0" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key96" parameterName="@porcentajehonorarios" parameterSource="porcentajehonorarios" dataType="Decimal" parameterType="Form" dataSize="0" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key97" parameterName="@vencimiento" parameterSource="vto" dataType="Int" parameterType="Form" dataSize="0" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key98" parameterName="@acuerdo" parameterSource="acuerdo" dataType="Char" parameterType="Form" dataSize="30" direction="Input" scale="0" precision="10"/>
			</ISPParameters>
			<ISQLParameters/>
			<IFormElements>
				<CustomParameter id="55" field="idpropiedad" dataType="Integer" parameterType="Control" parameterSource="idpropiedad"/>
				<CustomParameter id="56" field="idestado" dataType="Integer" parameterType="Control" parameterSource="idestado"/>
				<CustomParameter id="57" field="fechainicio" dataType="Text" parameterType="Control" parameterSource="fechainicio"/>
				<CustomParameter id="58" field="fechafin" dataType="Text" parameterType="Control" parameterSource="fechafin"/>
				<CustomParameter id="59" field="ano1" dataType="Text" parameterType="Control" parameterSource="ano1"/>
				<CustomParameter id="60" field="ano2" dataType="Text" parameterType="Control" parameterSource="ano2"/>
				<CustomParameter id="61" field="ano3" dataType="Text" parameterType="Control" parameterSource="ano3"/>
				<CustomParameter id="62" field="porcentajehonorarios" dataType="Text" parameterType="Control" parameterSource="porcentajehonorarios"/>
				<CustomParameter id="63" field="vto" dataType="Text" parameterType="Control" parameterSource="vto"/>
				<CustomParameter id="64" field="acuerdo" dataType="Text" parameterType="Control" parameterSource="acuerdo"/>
			</IFormElements>
			<USPParameters>
				<SPParameter id="Key90" parameterName="@RETURN_VALUE" parameterSource="RETURN_VALUE" dataType="Int" parameterType="URL" dataSize="0" direction="ReturnValue" scale="0" precision="10"/>
				<SPParameter id="Key91" parameterName="@idalquiler" parameterSource="idalquiler" dataType="Int" parameterType="URL" dataSize="0" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key92" parameterName="@idficha" parameterSource="idFicha" dataType="Int" parameterType="URL" dataSize="0" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key93" parameterName="@idpropiedad" parameterSource="idpropiedad" dataType="Int" parameterType="Form" dataSize="0" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key94" parameterName="@fechainicio" parameterSource="fechainicio" dataType="Text" parameterType="Form" dataSize="0" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key95" parameterName="@fechafin" parameterSource="fechafin" dataType="Text" parameterType="Form" dataSize="0" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key96" parameterName="@ano1" parameterSource="ano1" dataType="Int" parameterType="Form" dataSize="0" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key97" parameterName="@ano2" parameterSource="ano2" dataType="Int" parameterType="Form" dataSize="0" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key98" parameterName="@ano3" parameterSource="ano3" dataType="Int" parameterType="Form" dataSize="0" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key99" parameterName="@ano4" parameterSource="ano4" dataType="Int" parameterType="Form" dataSize="0" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key100" parameterName="@ano5" parameterSource="ano5" dataType="Int" parameterType="Form" dataSize="0" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key101" parameterName="@porcentajehonorarios" parameterSource="porcentajehonorarios" dataType="Decimal" parameterType="Form" dataSize="0" direction="Input" scale="0" precision="2"/>
				<SPParameter id="Key102" parameterName="@vencimiento" parameterSource="vto" dataType="Int" parameterType="Form" dataSize="0" direction="Input" scale="0" precision="10"/>
				<SPParameter id="Key103" parameterName="@acuerdo" parameterSource="acuerdo" dataType="Char" parameterType="Form" dataSize="30" direction="Input" scale="0" precision="10"/>
			</USPParameters>
			<USQLParameters/>
			<UConditions/>
			<UFormElements>
				<CustomParameter id="65" field="idpropiedad" dataType="Integer" parameterType="Control" parameterSource="idpropiedad"/>
				<CustomParameter id="66" field="idestado" dataType="Integer" parameterType="Control" parameterSource="idestado"/>
				<CustomParameter id="67" field="fechainicio" dataType="Text" parameterType="Control" parameterSource="fechainicio"/>
				<CustomParameter id="68" field="fechafin" dataType="Text" parameterType="Control" parameterSource="fechafin"/>
				<CustomParameter id="69" field="ano1" dataType="Text" parameterType="Control" parameterSource="ano1"/>
				<CustomParameter id="70" field="ano2" dataType="Text" parameterType="Control" parameterSource="ano2"/>
				<CustomParameter id="71" field="ano3" dataType="Text" parameterType="Control" parameterSource="ano3"/>
				<CustomParameter id="72" field="porcentajehonorarios" dataType="Text" parameterType="Control" parameterSource="porcentajehonorarios"/>
				<CustomParameter id="73" field="vto" dataType="Text" parameterType="Control" parameterSource="vto"/>
				<CustomParameter id="74" field="acuerdo" dataType="Text" parameterType="Control" parameterSource="acuerdo"/>
			</UFormElements>
			<DSPParameters>
				<SPParameter id="Key76" parameterName="@RETURN_VALUE" parameterSource="RETURN_VALUE" dataType="Int" parameterType="URL" dataSize="0" direction="ReturnValue" scale="0" precision="10"/>
				<SPParameter id="Key77" parameterName="@idalquiler" parameterSource="idalquiler" dataType="Int" parameterType="Form" dataSize="0" direction="Input" scale="0" precision="10"/>
			</DSPParameters>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
		<EditableGrid id="92" urlType="Relative" secured="False" emptyRows="1" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" sourceType="Table" defaultPageSize="5" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Connection1" dataSource="anocontratoalquiler" name="anocontratoalquiler" pageSizeLimit="100" wizardCaption=" Anocontratoalquiler Lista de" wizardGridType="Tabular" wizardAltRecord="False" wizardRecordSeparator="False" wizardNoRecords="No hay registros" PathID="anocontratoalquiler" deleteControl="CheckBox_Delete" activeCollection="IFormElements" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customInsertType="Table" activeTableType="anocontratoalquiler" customInsert="anocontratoalquiler" customUpdateType="Table" customUpdate="anocontratoalquiler">
			<Components>
				<TextBox id="96" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="ano" fieldSource="ano" required="True" caption="Ano" wizardCaption="Ano" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="anocontratoalquilerano">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="97" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="meses" fieldSource="meses" required="True" caption="Meses" wizardCaption="Meses" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="anocontratoalquilermeses">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="98" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="monto" fieldSource="monto" required="True" caption="Monto" wizardCaption="Monto" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="anocontratoalquilermonto">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<CheckBox id="99" visible="Dynamic" fieldSourceType="CodeExpression" dataType="Boolean" name="CheckBox_Delete" checkedValue="true" uncheckedValue="false" wizardCaption="Borrar" wizardAddNbsp="True" PathID="anocontratoalquilerCheckBox_Delete">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<Button id="100" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Submit" operation="Submit" wizardCaption="Enviar" PathID="anocontratoalquilerButton_Submit">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="135" fieldSourceType="DBColumn" dataType="Text" name="idalquiler" PathID="anocontratoalquileridalquiler" visible="Yes">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="120"/>
					</Actions>
				</Event>
				<Event name="BeforeBuildInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="123"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="119" conditionType="Parameter" useIsNull="False" field="idalquiler" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="idalquiler"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="118" tableName="anocontratoalquiler" posLeft="10" posTop="10" posWidth="95" posHeight="120"/>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<PKFields>
				<PKField id="93" tableName="anocontratoalquiler" fieldName="idalquiler" dataType="Integer"/>
				<PKField id="94" tableName="anocontratoalquiler" fieldName="ano" dataType="Integer"/>
			</PKFields>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements>
				<CustomParameter id="124" field="ano" dataType="Integer" parameterType="Control" parameterSource="ano"/>
				<CustomParameter id="125" field="meses" dataType="Integer" parameterType="Control" parameterSource="meses"/>
				<CustomParameter id="126" field="monto" dataType="Float" parameterType="Control" parameterSource="monto"/>
				<CustomParameter id="127" field="idalquiler" dataType="Integer" parameterType="Form" parameterSource="idalquiler" omitIfEmpty="True"/>
			</IFormElements>
			<USPParameters/>
			<USQLParameters/>
			<UConditions>
				<TableParameter id="128" conditionType="Parameter" useIsNull="False" field="idalquiler" dataType="Integer" parameterType="DataSourceColumn" parameterSource="idalquiler" searchConditionType="Equal" logicOperator="And"/>
				<TableParameter id="129" conditionType="Parameter" useIsNull="False" field="ano" dataType="Integer" parameterType="DataSourceColumn" parameterSource="ano" searchConditionType="Equal" logicOperator="And"/>
				<TableParameter id="130" conditionType="Parameter" useIsNull="False" field="idalquiler" dataType="Integer" parameterType="URL" parameterSource="idalquiler" searchConditionType="Equal" logicOperator="And"/>
			</UConditions>
			<UFormElements>
				<CustomParameter id="131" field="ano" dataType="Integer" parameterType="Control" parameterSource="ano"/>
				<CustomParameter id="132" field="meses" dataType="Integer" parameterType="Control" parameterSource="meses"/>
				<CustomParameter id="133" field="monto" dataType="Float" parameterType="Control" parameterSource="monto"/>
				<CustomParameter id="134" field="idalquiler" dataType="Integer" parameterType="Form" parameterSource="idalquiler" omitIfEmpty="True"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</EditableGrid>
		<Grid id="101" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="5" connection="Connection1" dataSource="anocontratoalquiler" activeCollection="TableParameters" name="anocontratoalquilerRO" orderBy="ano" pageSizeLimit="100" wizardCaption=" Anocontratoalquiler Lista de" wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No hay registros">
			<Components>
				<Label id="104" fieldSourceType="DBColumn" dataType="Integer" html="False" name="ano" fieldSource="ano" wizardCaption="Ano" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="anocontratoalquilerROano">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="105" fieldSourceType="DBColumn" dataType="Integer" html="False" name="meses" fieldSource="meses" wizardCaption="Meses" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="anocontratoalquilerROmeses">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="106" fieldSourceType="DBColumn" dataType="Float" html="False" name="monto" fieldSource="monto" wizardCaption="Monto" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="anocontratoalquilerROmonto">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="121"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="103" conditionType="Parameter" useIsNull="False" field="idalquiler" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="idalquiler"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="102" tableName="anocontratoalquiler" posLeft="10" posTop="10" posWidth="95" posHeight="120"/>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<EditableGrid id="107" urlType="Relative" secured="False" emptyRows="1" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" sourceType="Table" defaultPageSize="5" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Connection1" dataSource="fichasalquileres" activeCollection="UFormElements" name="fichasalquileres" pageSizeLimit="100" wizardCaption=" Fichasalquileres Lista de" wizardGridType="Tabular" wizardAltRecord="False" wizardRecordSeparator="False" wizardNoRecords="No hay registros" PathID="fichasalquileres" deleteControl="CheckBox_Delete" customInsertType="Table" activeTableType="fichasalquileres" customInsert="fichasalquileres" customUpdateType="Table" customUpdate="fichasalquileres">
			<Components>
				<TextBox id="114" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="idficha" fieldSource="idficha" required="True" caption="Idficha" wizardCaption="Idficha" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="fichasalquileresidficha">
					<Components/>
					<Events>
						<Event name="OnChange" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="139" eventType="Client"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="115" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="porcentajealq" fieldSource="porcentajealq" required="False" caption="Porcentajealq" wizardCaption="Porcentajealq" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="fichasalquileresporcentajealq">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<CheckBox id="116" visible="Dynamic" fieldSourceType="CodeExpression" dataType="Boolean" name="CheckBox_Delete" checkedValue="true" uncheckedValue="false" wizardCaption="Borrar" wizardAddNbsp="True" PathID="fichasalquileresCheckBox_Delete">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<Button id="117" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Submit" operation="Submit" wizardCaption="Enviar" PathID="fichasalquileresButton_Submit">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="136" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="nombre" PathID="fichasalquileresnombre">
					<Components/>
					<Events>
						<Event name="OnChange" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="141" eventType="Client"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="137" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="nrodocumento" PathID="fichasalquileresnrodocumento">
					<Components/>
					<Events>
						<Event name="OnChange" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="142" eventType="Client"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="138" fieldSourceType="DBColumn" dataType="Text" name="errorAjax" PathID="fichasalquilereserrorAjax">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="122" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="140" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="OnValidate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="143" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="111" conditionType="Parameter" useIsNull="False" field="idalquiler" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="idalquiler"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="108" tableName="fichasalquileres" posLeft="10" posTop="10" posWidth="95" posHeight="120"/>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<PKFields>
				<PKField id="112" tableName="fichasalquileres" fieldName="idficha" dataType="Integer"/>
				<PKField id="113" tableName="fichasalquileres" fieldName="idalquiler" dataType="Integer"/>
			</PKFields>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements>
				<CustomParameter id="144" field="idficha" dataType="Integer" parameterType="Control" parameterSource="idficha"/>
				<CustomParameter id="145" field="porcentajealq" dataType="Float" parameterType="Control" parameterSource="porcentajealq"/>
				<CustomParameter id="146" field="idalquiler" dataType="Integer" parameterType="URL" omitIfEmpty="True" parameterSource="idalquiler"/>
			</IFormElements>
			<USPParameters/>
			<USQLParameters/>
			<UConditions>
				<TableParameter id="147" conditionType="Parameter" useIsNull="False" field="idficha" dataType="Integer" parameterType="DataSourceColumn" parameterSource="idficha" searchConditionType="Equal" logicOperator="And"/>
				<TableParameter id="148" conditionType="Parameter" useIsNull="False" field="idalquiler" dataType="Integer" parameterType="DataSourceColumn" parameterSource="idalquiler" searchConditionType="Equal" logicOperator="And"/>
				<TableParameter id="149" conditionType="Parameter" useIsNull="False" field="idalquiler" dataType="Integer" parameterType="URL" parameterSource="idalquiler" searchConditionType="Equal" logicOperator="And"/>
			</UConditions>
			<UFormElements>
				<CustomParameter id="150" field="idficha" dataType="Integer" parameterType="Control" parameterSource="idficha"/>
				<CustomParameter id="151" field="porcentajealq" dataType="Float" parameterType="Control" parameterSource="porcentajealq"/>
				<CustomParameter id="152" field="idalquiler" dataType="Integer" parameterType="URL" omitIfEmpty="True" parameterSource="idalquiler"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</EditableGrid>
		<Record id="153" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="generacuotas" actionPage="contrato" errorSummator="Error" wizardFormMethod="post" PathID="generacuotas" customUpdateType="Procedure" connection="Connection1" customUpdate="SP_GENERA_CUOTAS_ALQUILER;1" customInsertType="Procedure" customInsert="SP_GENERA_CUOTAS_ALQUILER;1" dataSource="cuotas" pasteActions="pasteActions">
			<Components>
				<Button id="155" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" PathID="generacuotasButton_Update" operation="Update" wizardCaption="Enviar" returnPage="contrato.ccp">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="175"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Label id="156" fieldSourceType="DBColumn" dataType="Text" html="False" name="exito" PathID="generacuotasexito">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Button id="178" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" PathID="generacuotasButton_Insert" operation="Insert" wizardCaption="Agregar" returnPage="contrato.ccp">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="157"/>
					</Actions>
				</Event>
				<Event name="OnValidate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="176"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters/>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="177" tableName="cuotas" schemaName="dbo" posLeft="10" posTop="10" posWidth="134" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<ISPParameters>
				<SPParameter id="Key157" parameterName="@RETURN_VALUE" parameterSource="RETURN_VALUE" dataType="Int" parameterType="URL" dataSize="0" direction="ReturnValue" scale="0" precision="10"/>
				<SPParameter id="Key158" parameterName="@idalquiler" parameterSource="idalquiler" dataType="Int" parameterType="URL" dataSize="0" direction="Input" scale="0" precision="10"/>
			</ISPParameters>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters>
				<SPParameter id="Key157" parameterName="@RETURN_VALUE" parameterSource="RETURN_VALUE" dataType="Int" parameterType="URL" dataSize="0" direction="ReturnValue" scale="0" precision="10"/>
				<SPParameter id="Key158" parameterName="@idalquiler" parameterSource="idalquiler" dataType="Int" parameterType="URL" dataSize="0" direction="Input" scale="0" precision="10"/>
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
		<Grid id="158" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="Connection1" dataSource="fichasalquileres" name="fichasalquileresRO" pageSizeLimit="100" wizardCaption=" Fichasalquileres Lista de" wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No hay registros" activeCollection="TableParameters">
			<Components>
				<Label id="159" fieldSourceType="DBColumn" dataType="Integer" html="False" name="idficha" fieldSource="idficha" wizardCaption="Idficha" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="fichasalquileresROidficha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="161" fieldSourceType="DBColumn" dataType="Float" html="False" name="porcentajealq" fieldSource="porcentajealq" wizardCaption="Porcentajealq" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="fichasalquileresROporcentajealq">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="164" fieldSourceType="DBColumn" dataType="Text" html="False" name="nombre" PathID="fichasalquileresROnombre">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="165" fieldSourceType="DBColumn" dataType="Text" html="False" name="nrodocumento" PathID="fichasalquileresROnrodocumento">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="166"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="167"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="163" conditionType="Parameter" useIsNull="False" field="idalquiler" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="idalquiler"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="162" tableName="fichasalquileres" posLeft="10" posTop="10" posWidth="95" posHeight="120"/>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="contrato_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="contrato.php" forShow="True" url="contrato.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="BeforeShow" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="172"/>
			</Actions>
		</Event>
	</Events>
</Page>
