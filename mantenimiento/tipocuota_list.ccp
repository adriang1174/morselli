<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\mantenimiento" secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="SandBeach" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="20" name="tipocuota" connection="Connection1" pageSizeLimit="100" wizardCaption=" Tipocuota Lista de" wizardGridType="Tabular" wizardAllowSorting="True" wizardSortingType="SimpleDir" wizardUsePageScroller="True" wizardAllowInsert="True" wizardAltRecord="False" wizardRecordSeparator="False" wizardAltRecordType="Controls" dataSource="tipocuota">
			<Components>
				<Link id="4" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="tipocuota_Insert" hrefSource="tipocuota_maint.ccp" removeParameters="idtipocuota" wizardThemeItem="NavigatorLink" wizardDefaultValue="Agregar Nuevo" PathID="tipocuotatipocuota_Insert">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</Link>
				<Sorter id="5" visible="True" name="Sorter_idtipocuota" column="idtipocuota" wizardCaption="Idtipocuota" wizardSortingType="SimpleDir" wizardControl="idtipocuota" wizardAddNbsp="False" PathID="tipocuotaSorter_idtipocuota">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="6" visible="True" name="Sorter_descripcion" column="descripcion" wizardCaption="Descripcion" wizardSortingType="SimpleDir" wizardControl="descripcion" wizardAddNbsp="False" PathID="tipocuotaSorter_descripcion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="7" visible="True" name="Sorter_tipomovimientoliq" column="tipomovimientoliq" wizardCaption="Tipomovimientoliq" wizardSortingType="SimpleDir" wizardControl="tipomovimientoliq" wizardAddNbsp="False" PathID="tipocuotaSorter_tipomovimientoliq">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="8" visible="True" name="Sorter_tipomovimientopag" column="tipomovimientopag" wizardCaption="Tipomovimientopag" wizardSortingType="SimpleDir" wizardControl="tipomovimientopag" wizardAddNbsp="False" PathID="tipocuotaSorter_tipomovimientopag">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="9" visible="True" name="Sorter_porcentaje" column="porcentaje" wizardCaption="Porcentaje" wizardSortingType="SimpleDir" wizardControl="porcentaje" wizardAddNbsp="False" PathID="tipocuotaSorter_porcentaje">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Link id="11" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="idtipocuota" fieldSource="idtipocuota" wizardCaption="Idtipocuota" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardAddNbsp="True" wizardAlign="right" hrefSource="tipocuota_maint.ccp" PathID="tipocuotaidtipocuota">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="12" sourceType="DataField" format="yyyy-mm-dd" name="idtipocuota" source="idtipocuota"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="14" fieldSourceType="DBColumn" dataType="Text" html="False" name="descripcion" fieldSource="descripcion" wizardCaption="Descripcion" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardAddNbsp="True" PathID="tipocuotadescripcion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="16" fieldSourceType="DBColumn" dataType="Text" html="False" name="tipomovimientoliq" fieldSource="tipomovimientoliq" wizardCaption="Tipomovimientoliq" wizardSize="2" wizardMaxLength="2" wizardIsPassword="False" wizardAddNbsp="True" PathID="tipocuotatipomovimientoliq">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="18" fieldSourceType="DBColumn" dataType="Text" html="False" name="tipomovimientopag" fieldSource="tipomovimientopag" wizardCaption="Tipomovimientopag" wizardSize="2" wizardMaxLength="2" wizardIsPassword="False" wizardAddNbsp="True" PathID="tipocuotatipomovimientopag">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="20" fieldSourceType="DBColumn" dataType="Float" html="False" name="porcentaje" fieldSource="porcentaje" wizardCaption="Porcentaje" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardAddNbsp="True" wizardAlign="right" PathID="tipocuotaporcentaje">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="21" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardFirst="True" wizardPrev="True" wizardFirstText="|&lt;" wizardPrevText="&lt;&lt;" wizardNextText="&gt;&gt;" wizardLastText="&gt;|" wizardNext="True" wizardLast="True" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="True" wizardOfText="de" wizardImagesScheme="Sandbeach">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Hide-Show Component" actionCategory="General" id="22" action="Hide" conditionType="Parameter" dataType="Integer" condition="LessThan" name1="TotalPages" sourceType1="SpecialValue" name2="2" sourceType2="Expression"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Navigator>
			</Components>
			<Events/>
			<TableParameters/>
			<JoinTables>
				<JoinTable id="3" tableName="tipocuota" posWidth="-1" posHeight="-1" posLeft="-1" posRight="-1"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="10" tableName="tipocuota" fieldName="idtipocuota"/>
				<Field id="13" tableName="tipocuota" fieldName="descripcion"/>
				<Field id="15" tableName="tipocuota" fieldName="tipomovimientoliq"/>
				<Field id="17" tableName="tipocuota" fieldName="tipomovimientopag"/>
				<Field id="19" tableName="tipocuota" fieldName="porcentaje"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<IncludePage id="24" name="Header" PathID="Header" page="../Header.ccp">
<Components/>
<Events/>
<Features/>
</IncludePage>
</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="tipocuota_list_events.php" forShow="False" comment="//" codePage="windows-1252"/>
<CodeFile id="Code" language="PHPTemplates" name="tipocuota_list.php" forShow="True" url="tipocuota_list.php" comment="//" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups>
		<Group id="23" groupID="1"/>
	</SecurityGroups>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
