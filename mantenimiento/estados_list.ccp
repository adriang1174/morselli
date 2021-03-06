<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\mantenimiento" secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="SandBeach" wizardThemeVersion="3.0" needGeneration="0" accessDeniedPage="../accesodenegado/accesodenegado.ccp" isService="False">
	<Components>
		<IncludePage id="22" name="Header" parentType="Page" page="../Header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="estadosSearch" returnPage="./estados_list.ccp" wizardCaption=" Estados Buscar" wizardOrientation="Vertical" wizardFormMethod="post" PathID="estadosSearch">
			<Components>
				<TextBox id="4" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Palabra clave" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" PathID="estadosSearchs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Buscar" PathID="estadosSearchButton_DoSearch">
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
		<Grid id="6" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="20" name="estados" connection="Connection1" pageSizeLimit="100" wizardCaption=" Estados Lista de" wizardGridType="Tabular" wizardAllowSorting="True" wizardSortingType="SimpleDir" wizardUsePageScroller="True" wizardAllowInsert="True" wizardAltRecord="False" wizardRecordSeparator="False" wizardAltRecordType="Controls" dataSource="estadospropiedades" PathID="estados">
			<Components>
				<Sorter id="10" visible="True" name="Sorter_idestado" column="idestado" wizardCaption="Idestado" wizardSortingType="SimpleDir" wizardControl="idestado" wizardAddNbsp="False" PathID="estadosSorter_idestado">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="11" visible="True" name="Sorter_descripcion" column="descripcion" wizardCaption="Descripcion" wizardSortingType="SimpleDir" wizardControl="descripcion" wizardAddNbsp="False" PathID="estadosSorter_descripcion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="12" visible="True" name="Sorter_activo" column="activo" wizardCaption="Activo" wizardSortingType="SimpleDir" wizardControl="activo" wizardAddNbsp="False" PathID="estadosSorter_activo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Link id="14" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="idestado" fieldSource="idestado" wizardCaption="Idestado" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardAddNbsp="True" wizardAlign="right" hrefSource="estados_maint.ccp" rowNumber="1" PathID="estadosidestado">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="15" sourceType="DataField" format="yyyy-mm-dd" name="idestado" source="idestado"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="False" name="descripcion" fieldSource="descripcion" wizardCaption="Descripcion" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardAddNbsp="True" parentName="estados" rowNumber="1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="19" fieldSourceType="DBColumn" dataType="Boolean" html="False" name="activo" fieldSource="activo" wizardCaption="Activo" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" wizardAddNbsp="True" parentName="estados" rowNumber="1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="8" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="estados_Insert" hrefSource="./estados_maint.ccp" removeParameters="idestado" wizardThemeItem="NavigatorLink" wizardDefaultValue="Agregar Nuevo" PathID="estadosestados_Insert">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</Link>
				<Navigator id="20" size="10" type="Simple" name="Navigator" wizardFirst="True" wizardPrev="True" wizardFirstText="|&lt;" wizardPrevText="&lt;&lt;" wizardNextText="&gt;&gt;" wizardLastText="&gt;|" wizardNext="True" wizardLast="True" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="True" wizardOfText="de" wizardImagesScheme="Sandbeach" pageSizes="1;5;10;25;50" PathID="estadosNavigator">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="9" conditionType="Parameter" useIsNull="False" field="descripcion" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="1"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="7" tableName="estados" posWidth="-1" posHeight="-1" posLeft="-1" posRight="-1"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="13" tableName="estados" fieldName="idestado"/>
				<Field id="16" tableName="estados" fieldName="descripcion"/>
				<Field id="18" tableName="estados" fieldName="activo"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<IncludePage id="23" name="Footer" parentType="Page" page="../Footer.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="estados_list.php" forShow="True" url="estados_list.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="21" groupID="1"/>
	</SecurityGroups>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
