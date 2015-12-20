<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\mantenimiento" secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="SandBeach" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Grid id="7" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="20" name="gastosescribania" connection="Connection1" pageSizeLimit="100" wizardCaption=" Gastosescribania Lista de" wizardGridType="Tabular" wizardAllowSorting="True" wizardSortingType="SimpleDir" wizardUsePageScroller="True" wizardAllowInsert="True" wizardAltRecord="False" wizardRecordSeparator="False" wizardAltRecordType="Controls" dataSource="gastosescribania" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions">
			<Components>
				<Link id="9" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="gastosescribania_Insert" hrefSource="gastosescribani_maint.ccp" removeParameters="idgastoescribania" wizardThemeItem="NavigatorLink" wizardDefaultValue="Agregar Nuevo" PathID="gastosescribaniagastosescribania_Insert">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</Link>
				<Sorter id="13" visible="True" name="Sorter_descripcion" column="descripcion" wizardCaption="Descripcion" wizardSortingType="SimpleDir" wizardControl="descripcion" wizardAddNbsp="False" PathID="gastosescribaniaSorter_descripcion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="14" visible="True" name="Sorter_importecomp" column="importecomp" wizardCaption="Importecomp" wizardSortingType="SimpleDir" wizardControl="importecomp" wizardAddNbsp="False" PathID="gastosescribaniaSorter_importecomp">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="15" visible="True" name="Sorter_importevend" column="importevend" wizardCaption="Importevend" wizardSortingType="SimpleDir" wizardControl="importevend" wizardAddNbsp="False" PathID="gastosescribaniaSorter_importevend">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="16" visible="True" name="Sorter_jurisdiccion" column="jurisdiccion" wizardCaption="Jurisdiccion" wizardSortingType="SimpleDir" wizardControl="jurisdiccion" wizardAddNbsp="False" PathID="gastosescribaniaSorter_jurisdiccion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Link id="21" fieldSourceType="DBColumn" dataType="Text" html="False" name="descripcion" fieldSource="descripcion" wizardCaption="Descripcion" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardAddNbsp="True" PathID="gastosescribaniadescripcion" visible="Yes" hrefType="Page" urlType="Relative" preserveParameters="GET" hrefSource="gastosescribani_maint.ccp" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<LinkParameters>
						<LinkParameter id="32" sourceType="DataField" name="idgastoescribania" source="idgastoescribania"/>
					</LinkParameters>
				</Link>
				<Label id="23" fieldSourceType="DBColumn" dataType="Float" html="False" name="importecomp" fieldSource="importecomp" wizardCaption="Importecomp" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardAddNbsp="True" wizardAlign="right" PathID="gastosescribaniaimportecomp">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="25" fieldSourceType="DBColumn" dataType="Float" html="False" name="importevend" fieldSource="importevend" wizardCaption="Importevend" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardAddNbsp="True" wizardAlign="right" PathID="gastosescribaniaimportevend">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="27" fieldSourceType="DBColumn" dataType="Text" html="False" name="jurisdiccion" fieldSource="jurisdiccion" wizardCaption="Jurisdiccion" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardAddNbsp="True" PathID="gastosescribaniajurisdiccion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="28" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardFirst="True" wizardPrev="True" wizardFirstText="|&lt;" wizardPrevText="&lt;&lt;" wizardNextText="&gt;&gt;" wizardLastText="&gt;|" wizardNext="True" wizardLast="True" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="True" wizardOfText="de" wizardImagesScheme="Sandbeach">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Hide-Show Component" actionCategory="General" id="29" action="Hide" conditionType="Parameter" dataType="Integer" condition="LessThan" name1="TotalPages" sourceType1="SpecialValue" name2="2" sourceType2="Expression"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Navigator>
				<Hidden id="18" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="idgastoescribania" fieldSource="idgastoescribania" wizardCaption="Idgastoescribania" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardAddNbsp="True" wizardAlign="right" hrefSource="gastosescribani_maint.ccp" PathID="gastosescribaniaidgastoescribania">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="19" sourceType="DataField" format="yyyy-mm-dd" name="idgastoescribania" source="idgastoescribania"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="10" conditionType="Parameter" useIsNull="False" field="descripcion" parameterSource="s_descripcion" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="1"/>
				<TableParameter id="11" conditionType="Parameter" useIsNull="False" field="jurisdiccion" parameterSource="s_jurisdiccion" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="2"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="8" tableName="gastosescribania" posWidth="-1" posHeight="-1" posLeft="-1" posRight="-1"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="17" tableName="gastosescribania" fieldName="idgastoescribania"/>
				<Field id="20" tableName="gastosescribania" fieldName="descripcion"/>
				<Field id="22" tableName="gastosescribania" fieldName="importecomp"/>
				<Field id="24" tableName="gastosescribania" fieldName="importevend"/>
				<Field id="26" tableName="gastosescribania" fieldName="jurisdiccion"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<IncludePage id="31" name="Header" PathID="Header" page="../Header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="gastosescribani_list_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="gastosescribani_list.php" forShow="True" url="gastosescribani_list.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="33" groupID="1"/>
		<Group id="34" groupID="2"/>
	</SecurityGroups>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
