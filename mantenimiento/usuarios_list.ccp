<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\mantenimiento" secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="SandBeach" wizardThemeVersion="3.0" needGeneration="0" accessDeniedPage="../accesodenegado/accesodenegado.ccp" isService="False">
	<Components>
		<IncludePage id="24" name="Header" parentType="Page" page="../Header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="usuariosSearch" returnPage="./usuarios_list.ccp" wizardCaption=" Usuarios Buscar" wizardOrientation="Vertical" wizardFormMethod="post" PathID="usuariosSearch">
			<Components>
				<TextBox id="4" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Palabra clave" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" PathID="usuariosSearchs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Buscar" PathID="usuariosSearchButton_DoSearch">
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
		<Grid id="6" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="20" name="usuarios" connection="Connection1" pageSizeLimit="100" wizardCaption=" Usuarios Lista de" wizardGridType="Tabular" wizardAllowSorting="True" wizardSortingType="SimpleDir" wizardUsePageScroller="True" wizardAllowInsert="True" wizardAltRecord="False" wizardRecordSeparator="False" wizardAltRecordType="Controls" dataSource="usuarios, usuariosgrupo " PathID="usuarios">
			<Components>
				<Sorter id="12" visible="True" name="Sorter_iduser" column="iduser" wizardCaption="Iduser" wizardSortingType="SimpleDir" wizardControl="iduser" wizardAddNbsp="False" PathID="usuariosSorter_iduser">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="13" visible="True" name="Sorter_grupodesc" column="grupodesc" wizardCaption="Grupodesc" wizardSortingType="SimpleDir" wizardControl="grupodesc" wizardAddNbsp="False" PathID="usuariosSorter_grupodesc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="14" visible="True" name="Sorter_user" column="[user]" wizardCaption="User" wizardSortingType="SimpleDir" wizardControl="user" wizardAddNbsp="False" PathID="usuariosSorter_user">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Link id="16" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="iduser" fieldSource="iduser" wizardCaption="Iduser" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardAddNbsp="True" wizardAlign="right" hrefSource="usuarios_maint.ccp" rowNumber="1" PathID="usuariosiduser">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="17" sourceType="DataField" format="yyyy-mm-dd" name="iduser" source="iduser"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="19" fieldSourceType="DBColumn" dataType="Text" html="False" name="grupodesc" fieldSource="grupodesc" wizardCaption="Grupodesc" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardAddNbsp="True" parentName="usuarios" rowNumber="1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="21" fieldSourceType="DBColumn" dataType="Text" html="False" name="user" fieldSource="user" wizardCaption="User" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardAddNbsp="True" parentName="usuarios" rowNumber="1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="10" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="usuarios_Insert" hrefSource="./usuarios_maint.ccp" removeParameters="iduser" wizardThemeItem="NavigatorLink" wizardDefaultValue="Agregar Nuevo" PathID="usuariosusuarios_Insert">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</Link>
				<Navigator id="22" size="10" type="Simple" name="Navigator" wizardFirst="True" wizardPrev="True" wizardFirstText="|&lt;" wizardPrevText="&lt;&lt;" wizardNextText="&gt;&gt;" wizardLastText="&gt;|" wizardNext="True" wizardLast="True" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="True" wizardOfText="de" wizardImagesScheme="Sandbeach" pageSizes="1;5;10;25;50" PathID="usuariosNavigator">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="11" conditionType="Parameter" useIsNull="False" field="usuarios.[user]" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="1"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="7" tableName="usuarios" posWidth="-1" posHeight="-1" posLeft="-1" posRight="-1"/>
				<JoinTable id="8" tableName="usuariosgrupo" posWidth="-1" posHeight="-1" posLeft="-1" posRight="-1"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="9" tableLeft="usuarios" fieldLeft="usuarios.idgrupo" tableRight="usuariosgrupo" fieldRight="usuariosgrupo.idgrupo" conditionType="Equal" joinType="left"/>
			</JoinLinks>
			<Fields>
				<Field id="15" tableName="usuarios" fieldName="usuarios.iduser"/>
				<Field id="18" tableName="usuariosgrupo" fieldName="usuariosgrupo.grupodesc"/>
				<Field id="20" tableName="usuarios" fieldName="usuarios.[user]"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<IncludePage id="25" name="Footer" parentType="Page" page="../Footer.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="usuarios_list.php" forShow="True" url="usuarios_list.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="23" groupID="1"/>
	</SecurityGroups>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
