<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\propiedades" secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="SandBeach" wizardThemeVersion="3.0" needGeneration="0" isService="False">
	<Components>
		<IncludePage id="22" name="Header" parentType="Page" page="../Header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="propiedadesimpuestosSearch" returnPage="./propiedadesimpu_list.ccp" wizardCaption=" Propiedadesimpuestos Buscar" wizardOrientation="Vertical" wizardFormMethod="post" PathID="propiedadesimpuestosSearch">
			<Components>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Buscar" PathID="propiedadesimpuestosSearchButton_DoSearch">
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
		<Grid id="5" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="20" name="propiedadesimpuestos" connection="Connection1" pageSizeLimit="100" wizardCaption=" Propiedadesimpuestos Lista de" wizardGridType="Tabular" wizardAllowSorting="True" wizardSortingType="SimpleDir" wizardUsePageScroller="True" wizardAllowInsert="True" wizardAltRecord="False" wizardRecordSeparator="False" wizardAltRecordType="Controls" dataSource="propiedadesimpuestos, propiedades , impuestos " PathID="propiedadesimpuestos">
			<Components>
				<Sorter id="13" visible="True" name="Sorter_direccion" column="direccion" wizardCaption="Direccion" wizardSortingType="SimpleDir" wizardControl="direccion" wizardAddNbsp="False" PathID="propiedadesimpuestosSorter_direccion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="14" visible="True" name="Sorter_nombreimpuesto" column="nombreimpuesto" wizardCaption="Nombreimpuesto" wizardSortingType="SimpleDir" wizardControl="nombreimpuesto" wizardAddNbsp="False" PathID="propiedadesimpuestosSorter_nombreimpuesto">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Link id="16" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="direccion" fieldSource="direccion" wizardCaption="Direccion" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardAddNbsp="True" hrefSource="./propiedadesimpu_maint.ccp" rowNumber="1" PathID="propiedadesimpuestosdireccion">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="17" sourceType="DataField" format="yyyy-mm-dd" name="idimpuesto" source="propiedadesimpuestos_idimpuesto"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="19" fieldSourceType="DBColumn" dataType="Text" html="False" name="nombreimpuesto" fieldSource="nombreimpuesto" wizardCaption="Nombreimpuesto" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardAddNbsp="True" parentName="propiedadesimpuestos" rowNumber="1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="11" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="propiedadesimpuestos_Insert" hrefSource="./propiedadesimpu_maint.ccp" removeParameters="idimpuesto" wizardThemeItem="NavigatorLink" wizardDefaultValue="Agregar Nuevo" PathID="propiedadesimpuestospropiedadesimpuestos_Insert">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</Link>
				<Navigator id="20" size="10" type="Simple" name="Navigator" wizardFirst="True" wizardPrev="True" wizardFirstText="|&lt;" wizardPrevText="&lt;&lt;" wizardNextText="&gt;&gt;" wizardLastText="&gt;|" wizardNext="True" wizardLast="True" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="True" wizardOfText="de" wizardImagesScheme="Sandbeach" pageSizes="1;5;10;25;50" PathID="propiedadesimpuestosNavigator">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
			</Components>
			<Events/>
			<TableParameters/>
			<JoinTables>
				<JoinTable id="6" tableName="propiedadesimpuestos" posWidth="-1" posHeight="-1" posLeft="-1" posRight="-1"/>
				<JoinTable id="7" tableName="propiedades" posWidth="-1" posHeight="-1" posLeft="-1" posRight="-1"/>
				<JoinTable id="9" tableName="impuestos" posWidth="-1" posHeight="-1" posLeft="-1" posRight="-1"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="8" tableLeft="propiedadesimpuestos" fieldLeft="propiedadesimpuestos.idpropiedad" tableRight="propiedades" fieldRight="propiedades.idpropiedad" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="10" tableLeft="propiedadesimpuestos" fieldLeft="propiedadesimpuestos.idimpuesto" tableRight="impuestos" fieldRight="impuestos.idimpuesto" conditionType="Equal" joinType="left"/>
			</JoinLinks>
			<Fields>
				<Field id="12" tableName="propiedadesimpuestos" fieldName="propiedadesimpuestos.idimpuesto" alias="propiedadesimpuestos_idimpuesto"/>
				<Field id="15" tableName="propiedades" fieldName="propiedades.direccion"/>
				<Field id="18" tableName="impuestos" fieldName="impuestos.nombreimpuesto"/>
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
		<CodeFile id="Code" language="PHPTemplates" name="propiedadesimpu_list.php" forShow="True" url="propiedadesimpu_list.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="21" groupID="1"/>
	</SecurityGroups>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
