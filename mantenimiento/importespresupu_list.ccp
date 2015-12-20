<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\mantenimiento" secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="SandBeach" wizardThemeVersion="3.0" needGeneration="0" isService="False">
	<Components>
		<IncludePage id="28" name="Header" parentType="Page" page="../Header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="importespresupuestoSearch" returnPage="./importespresupu_list.ccp" wizardCaption=" Importespresupuesto Buscar" wizardOrientation="Vertical" wizardFormMethod="post" PathID="importespresupuestoSearch">
			<Components>
				<TextBox id="4" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Palabra clave" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" PathID="importespresupuestoSearchs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Buscar" PathID="importespresupuestoSearchButton_DoSearch">
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
		<Grid id="6" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="20" name="importespresupuesto" connection="Connection1" pageSizeLimit="100" wizardCaption=" Importespresupuesto Lista de" wizardGridType="Tabular" wizardAllowSorting="True" wizardSortingType="SimpleDir" wizardUsePageScroller="True" wizardAllowInsert="True" wizardAltRecord="False" wizardRecordSeparator="False" wizardAltRecordType="Controls" dataSource="importespresupuesto" PathID="importespresupuesto">
			<Components>
				<Sorter id="10" visible="True" name="Sorter_iditem" column="iditem" wizardCaption="Iditem" wizardSortingType="SimpleDir" wizardControl="iditem" wizardAddNbsp="False" PathID="importespresupuestoSorter_iditem">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="11" visible="True" name="Sorter_desitem" column="desitem" wizardCaption="Desitem" wizardSortingType="SimpleDir" wizardControl="desitem" wizardAddNbsp="False" PathID="importespresupuestoSorter_desitem">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="12" visible="True" name="Sorter_orden" column="orden" wizardCaption="Orden" wizardSortingType="SimpleDir" wizardControl="orden" wizardAddNbsp="False" PathID="importespresupuestoSorter_orden">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="13" visible="True" name="Sorter_importe" column="importe" wizardCaption="Importe" wizardSortingType="SimpleDir" wizardControl="importe" wizardAddNbsp="False" PathID="importespresupuestoSorter_importe">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="14" visible="True" name="Sorter_esporcentaje" column="esporcentaje" wizardCaption="Esporcentaje" wizardSortingType="SimpleDir" wizardControl="esporcentaje" wizardAddNbsp="False" PathID="importespresupuestoSorter_esporcentaje">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Link id="16" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="iditem" fieldSource="iditem" wizardCaption="Iditem" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardAddNbsp="True" wizardAlign="right" hrefSource="./importespresupu_maint.ccp" rowNumber="1" PathID="importespresupuestoiditem">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="17" sourceType="DataField" format="yyyy-mm-dd" name="iditem" source="iditem"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="19" fieldSourceType="DBColumn" dataType="Text" html="False" name="desitem" fieldSource="desitem" wizardCaption="Desitem" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" wizardAddNbsp="True" parentName="importespresupuesto" rowNumber="1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="21" fieldSourceType="DBColumn" dataType="Integer" html="False" name="orden" fieldSource="orden" wizardCaption="Orden" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardAddNbsp="True" wizardAlign="right" parentName="importespresupuesto" rowNumber="1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="23" fieldSourceType="DBColumn" dataType="Float" html="False" name="importe" fieldSource="importe" wizardCaption="Importe" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardAddNbsp="True" wizardAlign="right" parentName="importespresupuesto" rowNumber="1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="25" fieldSourceType="DBColumn" dataType="Integer" html="False" name="esporcentaje" fieldSource="esporcentaje" wizardCaption="Esporcentaje" wizardSize="4" wizardMaxLength="4" wizardIsPassword="False" wizardAddNbsp="True" wizardAlign="right" parentName="importespresupuesto" rowNumber="1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="8" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="importespresupuesto_Insert" hrefSource="./importespresupu_maint.ccp" removeParameters="iditem" wizardThemeItem="NavigatorLink" wizardDefaultValue="Agregar Nuevo" PathID="importespresupuestoimportespresupuesto_Insert">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</Link>
				<Navigator id="26" size="10" type="Simple" name="Navigator" wizardFirst="True" wizardPrev="True" wizardFirstText="|&lt;" wizardPrevText="&lt;&lt;" wizardNextText="&gt;&gt;" wizardLastText="&gt;|" wizardNext="True" wizardLast="True" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="True" wizardOfText="de" wizardImagesScheme="Sandbeach" pageSizes="1;5;10;25;50" PathID="importespresupuestoNavigator">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="9" conditionType="Parameter" useIsNull="False" field="desitem" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="1"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="7" tableName="importespresupuesto" posWidth="-1" posHeight="-1" posLeft="-1" posRight="-1"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="15" tableName="importespresupuesto" fieldName="iditem"/>
				<Field id="18" tableName="importespresupuesto" fieldName="desitem"/>
				<Field id="20" tableName="importespresupuesto" fieldName="orden"/>
				<Field id="22" tableName="importespresupuesto" fieldName="importe"/>
				<Field id="24" tableName="importespresupuesto" fieldName="esporcentaje"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<IncludePage id="29" name="Footer" parentType="Page" page="../Footer.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="importespresupu_list.php" forShow="True" url="importespresupu_list.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="27" groupID="1"/>
	</SecurityGroups>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
