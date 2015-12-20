<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\alquileres" secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="SandBeach" wizardThemeVersion="3.0" needGeneration="0" isService="False">
	<Components>
		<IncludePage id="57" name="Header" parentType="Page" page="../Header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="alquileresSearch" returnPage="./alquileres_list.ccp" wizardCaption=" Alquileres Buscar" wizardOrientation="Vertical" wizardFormMethod="post" PathID="alquileresSearch">
			<Components>
				<TextBox id="4" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Palabra clave" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" PathID="alquileresSearchs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Buscar" PathID="alquileresSearchButton_DoSearch">
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
		<Grid id="6" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="20" name="alquileres" connection="Connection1" pageSizeLimit="100" wizardCaption=" Alquileres Lista de" wizardGridType="Tabular" wizardAllowSorting="True" wizardSortingType="SimpleDir" wizardUsePageScroller="True" wizardAllowInsert="True" wizardAltRecord="False" wizardRecordSeparator="False" wizardAltRecordType="Controls" dataSource="alquileres, propiedades , estados " PathID="alquileres">
			<Components>
				<Sorter id="21" visible="True" name="Sorter_idalquiler" column="idalquiler" wizardCaption="Idalquiler" wizardSortingType="SimpleDir" wizardControl="idalquiler" wizardAddNbsp="False" PathID="alquileresSorter_idalquiler">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="22" visible="True" name="Sorter_direccion" column="direccion" wizardCaption="Direccion" wizardSortingType="SimpleDir" wizardControl="direccion" wizardAddNbsp="False" PathID="alquileresSorter_direccion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="23" visible="True" name="Sorter_descripcion" column="descripcion" wizardCaption="Descripcion" wizardSortingType="SimpleDir" wizardControl="descripcion" wizardAddNbsp="False" PathID="alquileresSorter_descripcion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="24" visible="True" name="Sorter_fechainicio" column="fechainicio" wizardCaption="Fechainicio" wizardSortingType="SimpleDir" wizardControl="fechainicio" wizardAddNbsp="False" PathID="alquileresSorter_fechainicio">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="25" visible="True" name="Sorter_fechafin" column="fechafin" wizardCaption="Fechafin" wizardSortingType="SimpleDir" wizardControl="fechafin" wizardAddNbsp="False" PathID="alquileresSorter_fechafin">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="26" visible="True" name="Sorter_ano1" column="ano1" wizardCaption="Ano1" wizardSortingType="SimpleDir" wizardControl="ano1" wizardAddNbsp="False" PathID="alquileresSorter_ano1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="27" visible="True" name="Sorter_ano2" column="ano2" wizardCaption="Ano2" wizardSortingType="SimpleDir" wizardControl="ano2" wizardAddNbsp="False" PathID="alquileresSorter_ano2">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="28" visible="True" name="Sorter_ano3" column="ano3" wizardCaption="Ano3" wizardSortingType="SimpleDir" wizardControl="ano3" wizardAddNbsp="False" PathID="alquileresSorter_ano3">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="29" visible="True" name="Sorter_porcentajehonorarios" column="porcentajehonorarios" wizardCaption="Porcentajehonorarios" wizardSortingType="SimpleDir" wizardControl="porcentajehonorarios" wizardAddNbsp="False" PathID="alquileresSorter_porcentajehonorarios">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="30" visible="True" name="Sorter_vto" column="vto" wizardCaption="Vto" wizardSortingType="SimpleDir" wizardControl="vto" wizardAddNbsp="False" PathID="alquileresSorter_vto">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="31" visible="True" name="Sorter_acuerdo" column="acuerdo" wizardCaption="Acuerdo" wizardSortingType="SimpleDir" wizardControl="acuerdo" wizardAddNbsp="False" PathID="alquileresSorter_acuerdo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Link id="33" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="idalquiler" fieldSource="idalquiler" wizardCaption="Idalquiler" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardAddNbsp="True" wizardAlign="right" hrefSource="./alquileres_maint.ccp" rowNumber="1" PathID="alquileresidalquiler">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="34" sourceType="DataField" format="yyyy-mm-dd" name="idalquiler" source="idalquiler"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="36" fieldSourceType="DBColumn" dataType="Text" html="False" name="direccion" fieldSource="direccion" wizardCaption="Direccion" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardAddNbsp="True" parentName="alquileres" rowNumber="1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="38" fieldSourceType="DBColumn" dataType="Text" html="False" name="descripcion" fieldSource="descripcion" wizardCaption="Descripcion" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardAddNbsp="True" parentName="alquileres" rowNumber="1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="40" fieldSourceType="DBColumn" dataType="Text" html="False" name="fechainicio" fieldSource="fechainicio" wizardCaption="Fechainicio" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardAddNbsp="True" parentName="alquileres" rowNumber="1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="42" fieldSourceType="DBColumn" dataType="Text" html="False" name="fechafin" fieldSource="fechafin" wizardCaption="Fechafin" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardAddNbsp="True" parentName="alquileres" rowNumber="1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="44" fieldSourceType="DBColumn" dataType="Text" html="False" name="ano1" fieldSource="ano1" wizardCaption="Ano1" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardAddNbsp="True" parentName="alquileres" rowNumber="1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="46" fieldSourceType="DBColumn" dataType="Text" html="False" name="ano2" fieldSource="ano2" wizardCaption="Ano2" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardAddNbsp="True" parentName="alquileres" rowNumber="1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="48" fieldSourceType="DBColumn" dataType="Text" html="False" name="ano3" fieldSource="ano3" wizardCaption="Ano3" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardAddNbsp="True" parentName="alquileres" rowNumber="1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="50" fieldSourceType="DBColumn" dataType="Text" html="False" name="porcentajehonorarios" fieldSource="porcentajehonorarios" wizardCaption="Porcentajehonorarios" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardAddNbsp="True" parentName="alquileres" rowNumber="1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="52" fieldSourceType="DBColumn" dataType="Text" html="False" name="vto" fieldSource="vto" wizardCaption="Vto" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardAddNbsp="True" parentName="alquileres" rowNumber="1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="54" fieldSourceType="DBColumn" dataType="Text" html="False" name="acuerdo" fieldSource="acuerdo" wizardCaption="Acuerdo" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardAddNbsp="True" parentName="alquileres" rowNumber="1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="12" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="alquileres_Insert" hrefSource="./alquileres_maint.ccp" removeParameters="idalquiler" wizardThemeItem="NavigatorLink" wizardDefaultValue="Agregar Nuevo" PathID="alquileresalquileres_Insert">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</Link>
				<Navigator id="55" size="10" type="Simple" name="Navigator" wizardFirst="True" wizardPrev="True" wizardFirstText="|&lt;" wizardPrevText="&lt;&lt;" wizardNextText="&gt;&gt;" wizardLastText="&gt;|" wizardNext="True" wizardLast="True" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="True" wizardOfText="de" wizardImagesScheme="Sandbeach" pageSizes="1;5;10;25;50" PathID="alquileresNavigator">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="13" conditionType="Parameter" useIsNull="False" field="alquileres.fechainicio" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="1" leftBrackets="1"/>
				<TableParameter id="14" conditionType="Parameter" useIsNull="False" field="alquileres.fechafin" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="2"/>
				<TableParameter id="15" conditionType="Parameter" useIsNull="False" field="alquileres.ano1" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="3"/>
				<TableParameter id="16" conditionType="Parameter" useIsNull="False" field="alquileres.ano2" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="4"/>
				<TableParameter id="17" conditionType="Parameter" useIsNull="False" field="alquileres.ano3" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="5"/>
				<TableParameter id="18" conditionType="Parameter" useIsNull="False" field="alquileres.porcentajehonorarios" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="6"/>
				<TableParameter id="19" conditionType="Parameter" useIsNull="False" field="alquileres.vto" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="7"/>
				<TableParameter id="20" conditionType="Parameter" useIsNull="False" field="alquileres.acuerdo" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="8" rightBrackets="1"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="7" tableName="alquileres" posWidth="-1" posHeight="-1" posLeft="-1" posRight="-1"/>
				<JoinTable id="8" tableName="propiedades" posWidth="-1" posHeight="-1" posLeft="-1" posRight="-1"/>
				<JoinTable id="10" tableName="estados" posWidth="-1" posHeight="-1" posLeft="-1" posRight="-1"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="9" tableLeft="alquileres" fieldLeft="alquileres.idpropiedad" tableRight="propiedades" fieldRight="propiedades.idpropiedad" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="11" tableLeft="alquileres" fieldLeft="alquileres.idestado" tableRight="estados" fieldRight="estados.idestado" conditionType="Equal" joinType="left"/>
			</JoinLinks>
			<Fields>
				<Field id="32" tableName="alquileres" fieldName="alquileres.idalquiler"/>
				<Field id="35" tableName="propiedades" fieldName="propiedades.direccion"/>
				<Field id="37" tableName="estados" fieldName="estados.descripcion"/>
				<Field id="39" tableName="alquileres" fieldName="alquileres.fechainicio"/>
				<Field id="41" tableName="alquileres" fieldName="alquileres.fechafin"/>
				<Field id="43" tableName="alquileres" fieldName="alquileres.ano1"/>
				<Field id="45" tableName="alquileres" fieldName="alquileres.ano2"/>
				<Field id="47" tableName="alquileres" fieldName="alquileres.ano3"/>
				<Field id="49" tableName="alquileres" fieldName="alquileres.porcentajehonorarios"/>
				<Field id="51" tableName="alquileres" fieldName="alquileres.vto"/>
				<Field id="53" tableName="alquileres" fieldName="alquileres.acuerdo"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<IncludePage id="58" name="Footer" parentType="Page" page="../Footer.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="alquileres_list.php" forShow="True" url="alquileres_list.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="56" groupID="1"/>
	</SecurityGroups>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
