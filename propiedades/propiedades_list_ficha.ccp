<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\propiedades" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="SandBeach" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<IncludePage id="2" name="Header" PathID="Header" page="../Header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Grid id="3" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="Connection1" dataSource="propiedades, fichaspropiedades, tipopropiedades" activeCollection="TableParameters" name="fichaspropiedades_propied" orderBy="fichaspropiedades.idpropiedad" pageSizeLimit="100" wizardCaption=" Fichaspropiedades,propiedades,tipopropiedades Lista de" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No hay registros">
			<Components>
				<Sorter id="19" visible="True" name="Sorter_duenoporcentaje" column="duenoporcentaje" wizardCaption="Duenoporcentaje" wizardSortingType="SimpleDir" wizardControl="duenoporcentaje" wizardAddNbsp="False" PathID="fichaspropiedades_propiedSorter_duenoporcentaje">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="20" visible="True" name="Sorter_propiedades_idpropiedad" column="propiedades.idpropiedad" wizardCaption="Idpropiedad" wizardSortingType="SimpleDir" wizardControl="propiedades_idpropiedad" wizardAddNbsp="False" PathID="fichaspropiedades_propiedSorter_propiedades_idpropiedad">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="21" visible="True" name="Sorter_direccion" column="direccion" wizardCaption="Direccion" wizardSortingType="SimpleDir" wizardControl="direccion" wizardAddNbsp="False" PathID="fichaspropiedades_propiedSorter_direccion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="22" visible="True" name="Sorter_localidad" column="localidad" wizardCaption="Localidad" wizardSortingType="SimpleDir" wizardControl="localidad" wizardAddNbsp="False" PathID="fichaspropiedades_propiedSorter_localidad">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="23" visible="True" name="Sorter_telefono" column="telefono" wizardCaption="Telefono" wizardSortingType="SimpleDir" wizardControl="telefono" wizardAddNbsp="False" PathID="fichaspropiedades_propiedSorter_telefono">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="24" visible="True" name="Sorter_destipopropiedad" column="destipopropiedad" wizardCaption="Destipopropiedad" wizardSortingType="SimpleDir" wizardControl="destipopropiedad" wizardAddNbsp="False" PathID="fichaspropiedades_propiedSorter_destipopropiedad">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Label id="25" fieldSourceType="DBColumn" dataType="Float" html="False" name="duenoporcentaje" fieldSource="duenoporcentaje" wizardCaption="Duenoporcentaje" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="fichaspropiedades_propiedduenoporcentaje">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="26" fieldSourceType="DBColumn" dataType="Integer" html="False" name="propiedades_idpropiedad" fieldSource="propiedades_idpropiedad" wizardCaption="Idpropiedad" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="fichaspropiedades_propiedpropiedades_idpropiedad" visible="Yes" hrefType="Page" urlType="Relative" preserveParameters="GET" hrefSource="propiedades_maint.php">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<LinkParameters>
						<LinkParameter id="34" sourceType="DataField" name="idpropiedad" source="propiedades_idpropiedad"/>
					</LinkParameters>
				</Link>
				<Label id="27" fieldSourceType="DBColumn" dataType="Text" html="False" name="direccion" fieldSource="direccion" wizardCaption="Direccion" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="fichaspropiedades_propieddireccion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="28" fieldSourceType="DBColumn" dataType="Text" html="False" name="localidad" fieldSource="localidad" wizardCaption="Localidad" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="fichaspropiedades_propiedlocalidad">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="29" fieldSourceType="DBColumn" dataType="Text" html="False" name="telefono" fieldSource="telefono" wizardCaption="Telefono" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="fichaspropiedades_propiedtelefono">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="30" fieldSourceType="DBColumn" dataType="Text" html="False" name="destipopropiedad" fieldSource="destipopropiedad" wizardCaption="Destipopropiedad" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="fichaspropiedades_propieddestipopropiedad">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="31" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="TextButtons" wizardFirst="True" wizardFirstText="|&amp;lt;" wizardPrev="True" wizardPrevText="&amp;lt;&amp;lt;" wizardNext="True" wizardNextText="&amp;gt;&amp;gt;" wizardLast="True" wizardLastText="&amp;gt;|" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="de" wizardPageSize="True" wizardImagesScheme="Sandbeach">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="32" fieldSourceType="DBColumn" dataType="Text" html="False" name="Label1" PathID="fichaspropiedades_propiedLabel1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="35" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Link1" PathID="fichaspropiedades_propiedLink1" hrefSource="propiedades_maint.ccp" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="36" sourceType="URL" format="yyyy-mm-dd" name="idficha" source="idficha"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="37" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Link2" PathID="fichaspropiedades_propiedLink2" hrefSource="../fichas/fichas_list.ccp" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="38" sourceType="URL" format="yyyy-mm-dd" name="idficha" source="idficha"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="33"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="18" conditionType="Parameter" useIsNull="False" field="fichaspropiedades.idficha" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="idficha"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="4" tableName="propiedades" schemaName="dbo" posLeft="10" posTop="10" posWidth="121" posHeight="180"/>
				<JoinTable id="5" tableName="fichaspropiedades" schemaName="dbo" posLeft="220" posTop="2" posWidth="108" posHeight="104"/>
				<JoinTable id="11" tableName="tipopropiedades" schemaName="dbo" posLeft="213" posTop="109" posWidth="113" posHeight="88"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="6" tableLeft="propiedades" tableRight="fichaspropiedades" fieldLeft="propiedades.idpropiedad" fieldRight="fichaspropiedades.idpropiedad" joinType="inner" conditionType="Equal"/>
				<JoinTable2 id="12" tableLeft="propiedades" tableRight="tipopropiedades" fieldLeft="propiedades.idtipopropiedad" fieldRight="tipopropiedades.idtipopropiedad" joinType="inner" conditionType="Equal"/>
			</JoinLinks>
			<Fields>
				<Field id="7" tableName="propiedades" fieldName="propiedades.idpropiedad" alias="propiedades_idpropiedad"/>
				<Field id="10" tableName="propiedades" fieldName="direccion"/>
				<Field id="14" tableName="tipopropiedades" fieldName="destipopropiedad"/>
				<Field id="15" tableName="propiedades" fieldName="localidad"/>
				<Field id="16" tableName="propiedades" fieldName="telefono"/>
				<Field id="17" tableName="fichaspropiedades" fieldName="duenoporcentaje"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="propiedades_list_ficha_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="propiedades_list_ficha.php" forShow="True" url="propiedades_list_ficha.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
