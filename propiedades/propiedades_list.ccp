<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\propiedades" secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="SandBeach" wizardThemeVersion="3.0" needGeneration="0" isService="False">
	<Components>
		<IncludePage id="52" name="Header" page="../Header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="propiedadesSearch" returnPage="./propiedades_list.ccp" wizardCaption=" Propiedades Buscar" wizardOrientation="Vertical" wizardFormMethod="post" PathID="propiedadesSearch">
			<Components>
				<TextBox id="4" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Palabra clave" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" PathID="propiedadesSearchs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Buscar" PathID="propiedadesSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
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
		<IncludePage id="53" name="Footer" page="../Footer.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Grid id="6" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="20" name="propiedades" connection="Connection1" pageSizeLimit="100" wizardCaption=" Propiedades Lista de" wizardGridType="Tabular" wizardAllowSorting="True" wizardSortingType="SimpleDir" wizardUsePageScroller="True" wizardAllowInsert="True" wizardAltRecord="False" wizardRecordSeparator="False" wizardAltRecordType="Controls" dataSource="propiedades, tipopropiedades " PathID="propiedades" activeCollection="TableParameters">
			<Components>
				<Sorter id="19" visible="True" name="Sorter_idpropiedad" column="idpropiedad" wizardCaption="Idpropiedad" wizardSortingType="SimpleDir" wizardControl="idpropiedad" wizardAddNbsp="False" PathID="propiedadesSorter_idpropiedad">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="20" visible="True" name="Sorter_destipopropiedad" column="destipopropiedad" wizardCaption="Destipopropiedad" wizardSortingType="SimpleDir" wizardControl="destipopropiedad" wizardAddNbsp="False" PathID="propiedadesSorter_destipopropiedad">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="21" visible="True" name="Sorter_direccion" column="direccion" wizardCaption="Direccion" wizardSortingType="SimpleDir" wizardControl="direccion" wizardAddNbsp="False" PathID="propiedadesSorter_direccion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="22" visible="True" name="Sorter_localidad" column="localidad" wizardCaption="Localidad" wizardSortingType="SimpleDir" wizardControl="localidad" wizardAddNbsp="False" PathID="propiedadesSorter_localidad">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="23" visible="True" name="Sorter_telefono" column="telefono" wizardCaption="Telefono" wizardSortingType="SimpleDir" wizardControl="telefono" wizardAddNbsp="False" PathID="propiedadesSorter_telefono">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="24" visible="True" name="Sorter_codigopostal" column="codigopostal" wizardCaption="Codigopostal" wizardSortingType="SimpleDir" wizardControl="codigopostal" wizardAddNbsp="False" PathID="propiedadesSorter_codigopostal">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="25" visible="True" name="Sorter_estado" column="estado" wizardCaption="Estado" wizardSortingType="SimpleDir" wizardControl="estado" wizardAddNbsp="False" PathID="propiedadesSorter_estado">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="26" visible="True" name="Sorter_entre" column="entre" wizardCaption="Entre" wizardSortingType="SimpleDir" wizardControl="entre" wizardAddNbsp="False" PathID="propiedadesSorter_entre">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="27" visible="True" name="Sorter_administ" column="administ" wizardCaption="Administ" wizardSortingType="SimpleDir" wizardControl="administ" wizardAddNbsp="False" PathID="propiedadesSorter_administ">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Link id="30" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="idpropiedad" fieldSource="idpropiedad" wizardCaption="Idpropiedad" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardAddNbsp="True" wizardAlign="right" hrefSource="propiedades_maint.ccp" PathID="propiedadesidpropiedad" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="31" sourceType="DataField" format="yyyy-mm-dd" name="idpropiedad" source="idpropiedad"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="33" fieldSourceType="DBColumn" dataType="Text" html="False" name="destipopropiedad" fieldSource="destipopropiedad" wizardCaption="Destipopropiedad" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardAddNbsp="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="35" fieldSourceType="DBColumn" dataType="Text" html="False" name="direccion" fieldSource="direccion" wizardCaption="Direccion" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardAddNbsp="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="37" fieldSourceType="DBColumn" dataType="Text" html="False" name="localidad" fieldSource="localidad" wizardCaption="Localidad" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardAddNbsp="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="39" fieldSourceType="DBColumn" dataType="Text" html="False" name="telefono" fieldSource="telefono" wizardCaption="Telefono" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardAddNbsp="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="41" fieldSourceType="DBColumn" dataType="Text" html="False" name="codigopostal" fieldSource="codigopostal" wizardCaption="Codigopostal" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardAddNbsp="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="43" fieldSourceType="DBColumn" dataType="Text" html="False" name="estado" fieldSource="estado" wizardCaption="Estado" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardAddNbsp="True">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="55"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="45" fieldSourceType="DBColumn" dataType="Text" html="False" name="entre" fieldSource="entre" wizardCaption="Entre" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardAddNbsp="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="47" fieldSourceType="DBColumn" dataType="Text" html="False" name="administ" fieldSource="administ" wizardCaption="Administ" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardAddNbsp="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="50" size="10" type="Simple" name="Navigator" wizardFirst="True" wizardPrev="True" wizardFirstText="|&lt;" wizardPrevText="&lt;&lt;" wizardNextText="&gt;&gt;" wizardLastText="&gt;|" wizardNext="True" wizardLast="True" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="True" wizardOfText="de" wizardImagesScheme="Sandbeach" pageSizes="1;5;10;25;50" PathID="propiedadesNavigator">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="11" conditionType="Parameter" useIsNull="False" field="propiedades.direccion" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="1" leftBrackets="1"/>
				<TableParameter id="12" conditionType="Parameter" useIsNull="False" field="propiedades.localidad" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="2"/>
				<TableParameter id="13" conditionType="Parameter" useIsNull="False" field="propiedades.telefono" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="3"/>
				<TableParameter id="14" conditionType="Parameter" useIsNull="False" field="propiedades.codigopostal" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="4"/>
				<TableParameter id="16" conditionType="Parameter" useIsNull="False" field="propiedades.entre" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="6"/>
				<TableParameter id="17" conditionType="Parameter" useIsNull="False" field="propiedades.administ" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="7"/>
				<TableParameter id="54" conditionType="Parameter" useIsNull="False" field="tipopropiedades.destipopropiedad" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="Or" parameterSource="s_keyword"/>
				<TableParameter id="18" conditionType="Parameter" useIsNull="False" field="propiedades.cantocup" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="8" rightBrackets="1"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="7" tableName="propiedades" posWidth="121" posHeight="180" posLeft="10" posRight="-1" posTop="10"/>
				<JoinTable id="8" tableName="tipopropiedades" posWidth="113" posHeight="88" posLeft="152" posRight="-1" posTop="10"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="9" tableLeft="propiedades" fieldLeft="propiedades.idtipopropiedad" tableRight="tipopropiedades" fieldRight="tipopropiedades.idtipopropiedad" conditionType="Equal" joinType="left"/>
			</JoinLinks>
			<Fields>
				<Field id="29" tableName="propiedades" fieldName="propiedades.idpropiedad"/>
				<Field id="32" tableName="tipopropiedades" fieldName="tipopropiedades.destipopropiedad"/>
				<Field id="34" tableName="propiedades" fieldName="propiedades.direccion"/>
				<Field id="36" tableName="propiedades" fieldName="propiedades.localidad"/>
				<Field id="38" tableName="propiedades" fieldName="propiedades.telefono"/>
				<Field id="40" tableName="propiedades" fieldName="propiedades.codigopostal"/>
				<Field id="42" tableName="propiedades" fieldName="propiedades.estado"/>
				<Field id="44" tableName="propiedades" fieldName="propiedades.entre"/>
				<Field id="46" tableName="propiedades" fieldName="propiedades.administ"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="propiedades_list.php" forShow="True" url="propiedades_list.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="propiedades_list_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="51" groupID="1"/>
	</SecurityGroups>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
