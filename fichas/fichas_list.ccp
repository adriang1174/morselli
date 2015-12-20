<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\fichas" secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="SandBeach" wizardThemeVersion="3.0" needGeneration="0" accessDeniedPage="../accesodenegado/accesodenegado.ccp" isService="False">
	<Components>
		<IncludePage id="101" name="Header" page="../Header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="fichasSearch" returnPage="./fichas_list.ccp" wizardCaption=" Fichas Buscar" wizardOrientation="Vertical" wizardFormMethod="post" PathID="fichasSearch">
			<Components>
				<TextBox id="4" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Palabra clave" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" PathID="fichasSearchs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Buscar" PathID="fichasSearchButton_DoSearch">
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
		<Grid id="6" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="20" name="fichas" connection="Connection1" pageSizeLimit="100" wizardCaption=" Fichas Lista de" wizardGridType="Tabular" wizardAllowSorting="True" wizardSortingType="SimpleDir" wizardUsePageScroller="True" wizardAllowInsert="True" wizardAltRecord="False" wizardRecordSeparator="False" wizardAltRecordType="Controls" dataSource="SELECT fichas.idficha, tipodocumentos.idtipodocumento AS tipodocumentos_idtipodocumento, estadocivil.desestadocivil, fichas.nombre,
fichas.direccion, fichas.localidad, fichas.codigopostal, fichas.telefono, fichas.celular, fichas.fechanac, fichas.provincia,
fichas.email, idtipocontribuyente, fichas.actividad, fichas.observaciones, fichas.cuit, fichas.nrodocumento, fichas.nacionalidad,
fichas.nupcias, fichas.conyuge, fichas.padre, fichas.madre 
FROM (fichas LEFT JOIN tipodocumentos ON
fichas.idtipodocumento = tipodocumentos.idtipodocumento) LEFT JOIN estadocivil ON
fichas.idestadocivil = estadocivil.idestadocivil
WHERE ( fichas.idtipodocumento LIKE '%{s_keyword}%'
OR fichas.nombre LIKE '%{s_keyword}%'
OR fichas.direccion LIKE '%{s_keyword}%'
OR fichas.localidad LIKE '%{s_keyword}%'
OR fichas.codigopostal LIKE '%{s_keyword}%'
OR fichas.telefono LIKE '%{s_keyword}%'
OR fichas.celular LIKE '%{s_keyword}%'
OR fichas.provincia LIKE '%{s_keyword}%'
OR fichas.email LIKE '%{s_keyword}%'
OR fichas.actividad LIKE '%{s_keyword}%'
OR fichas.observaciones LIKE '%{s_keyword}%'
OR fichas.cuit LIKE '%{s_keyword}%'
OR fichas.nrodocumento LIKE '%{s_keyword}%'
OR fichas.nacionalidad LIKE '%{s_keyword}%'
OR fichas.nupcias LIKE '%{s_keyword}%'
OR fichas.conyuge LIKE '%{s_keyword}%'
OR fichas.padre LIKE '%{s_keyword}%'
OR fichas.madre LIKE '%{s_keyword}%' 
OR cast(fichas.idficha as varchar) like '%{s_keyword}%')  " PathID="fichas" activeCollection="TableParameters">
			<Components>
				<Sorter id="32" visible="True" name="Sorter_idficha" column="idficha" wizardCaption="Idficha" wizardSortingType="SimpleDir" wizardControl="idficha" wizardAddNbsp="False" PathID="fichasSorter_idficha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="35" visible="True" name="Sorter_nombre" column="nombre" wizardCaption="Nombre" wizardSortingType="SimpleDir" wizardControl="nombre" wizardAddNbsp="False" PathID="fichasSorter_nombre">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="39" visible="True" name="Sorter_telefono" column="telefono" wizardCaption="Telefono" wizardSortingType="SimpleDir" wizardControl="telefono" wizardAddNbsp="False" PathID="fichasSorter_telefono">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="40" visible="True" name="Sorter_celular" column="celular" wizardCaption="Celular" wizardSortingType="SimpleDir" wizardControl="celular" wizardAddNbsp="False" PathID="fichasSorter_celular">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="36" visible="True" name="Sorter_direccion" column="direccion" wizardCaption="Direccion" wizardSortingType="SimpleDir" wizardControl="direccion" wizardAddNbsp="False" PathID="fichasSorter_direccion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="37" visible="True" name="Sorter_localidad" column="localidad" wizardCaption="Localidad" wizardSortingType="SimpleDir" wizardControl="localidad" wizardAddNbsp="False" PathID="fichasSorter_localidad">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="43" visible="True" name="Sorter_email" column="email" wizardCaption="Email" wizardSortingType="SimpleDir" wizardControl="email" wizardAddNbsp="False" PathID="fichasSorter_email">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="48" visible="True" name="Sorter_nrodocumento" column="nrodocumento" wizardCaption="Nrodocumento" wizardSortingType="SimpleDir" wizardControl="nrodocumento" wizardAddNbsp="False" PathID="fichasSorter_nrodocumento">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="47" visible="True" name="Sorter_cuit" column="cuit" wizardCaption="Cuit" wizardSortingType="SimpleDir" wizardControl="cuit" wizardAddNbsp="False" PathID="fichasSorter_cuit">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Link id="55" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="idficha" fieldSource="idficha" wizardCaption="Idficha" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardAddNbsp="True" wizardAlign="right" hrefSource="fichas_maint.ccp" PathID="fichasidficha">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="56" sourceType="DataField" format="yyyy-mm-dd" name="idficha" source="idficha"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="62" fieldSourceType="DBColumn" dataType="Text" html="False" name="nombre" fieldSource="nombre" wizardCaption="Nombre" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardAddNbsp="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="70" fieldSourceType="DBColumn" dataType="Text" html="False" name="telefono" fieldSource="telefono" wizardCaption="Telefono" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardAddNbsp="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="72" fieldSourceType="DBColumn" dataType="Text" html="False" name="celular" fieldSource="celular" wizardCaption="Celular" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardAddNbsp="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="64" fieldSourceType="DBColumn" dataType="Text" html="False" name="direccion" fieldSource="direccion" wizardCaption="Direccion" wizardSize="50" wizardMaxLength="128" wizardIsPassword="False" wizardAddNbsp="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="66" fieldSourceType="DBColumn" dataType="Text" html="False" name="localidad" fieldSource="localidad" wizardCaption="Localidad" wizardSize="40" wizardMaxLength="40" wizardIsPassword="False" wizardAddNbsp="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="78" fieldSourceType="DBColumn" dataType="Text" html="False" name="email" fieldSource="email" wizardCaption="Email" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardAddNbsp="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="88" fieldSourceType="DBColumn" dataType="Text" html="False" name="nrodocumento" fieldSource="nrodocumento" wizardCaption="Nrodocumento" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardAddNbsp="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="86" fieldSourceType="DBColumn" dataType="Text" html="False" name="cuit" fieldSource="cuit" wizardCaption="Cuit" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardAddNbsp="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="12" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="fichas_Insert" hrefSource="./fichas_maint.ccp" removeParameters="idficha" wizardThemeItem="NavigatorLink" wizardDefaultValue="Agregar Nuevo" PathID="fichasfichas_Insert">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</Link>
				<Navigator id="99" size="10" type="Simple" name="Navigator" wizardFirst="True" wizardPrev="True" wizardFirstText="|&lt;" wizardPrevText="&lt;&lt;" wizardNextText="&gt;&gt;" wizardLastText="&gt;|" wizardNext="True" wizardLast="True" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="True" wizardOfText="de" wizardImagesScheme="Sandbeach" pageSizes="1;5;10;25;50" PathID="fichasNavigator">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="13" conditionType="Parameter" useIsNull="False" field="fichas.idtipodocumento" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="1" leftBrackets="1"/>
				<TableParameter id="14" conditionType="Parameter" useIsNull="False" field="fichas.nombre" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="2"/>
				<TableParameter id="15" conditionType="Parameter" useIsNull="False" field="fichas.direccion" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="3"/>
				<TableParameter id="16" conditionType="Parameter" useIsNull="False" field="fichas.localidad" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="4"/>
				<TableParameter id="17" conditionType="Parameter" useIsNull="False" field="fichas.codigopostal" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="5"/>
				<TableParameter id="18" conditionType="Parameter" useIsNull="False" field="fichas.telefono" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="6"/>
				<TableParameter id="19" conditionType="Parameter" useIsNull="False" field="fichas.celular" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="7"/>
				<TableParameter id="20" conditionType="Parameter" useIsNull="False" field="fichas.provincia" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="8"/>
				<TableParameter id="21" conditionType="Parameter" useIsNull="False" field="fichas.email" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="9"/>
				<TableParameter id="23" conditionType="Parameter" useIsNull="False" field="fichas.actividad" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="11"/>
				<TableParameter id="24" conditionType="Parameter" useIsNull="False" field="fichas.observaciones" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="12"/>
				<TableParameter id="25" conditionType="Parameter" useIsNull="False" field="fichas.cuit" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="13"/>
				<TableParameter id="26" conditionType="Parameter" useIsNull="False" field="fichas.nrodocumento" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="14"/>
				<TableParameter id="27" conditionType="Parameter" useIsNull="False" field="fichas.nacionalidad" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="15"/>
				<TableParameter id="28" conditionType="Parameter" useIsNull="False" field="fichas.nupcias" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="16"/>
				<TableParameter id="29" conditionType="Parameter" useIsNull="False" field="fichas.conyuge" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="17"/>
				<TableParameter id="30" conditionType="Parameter" useIsNull="False" field="fichas.padre" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="18"/>
				<TableParameter id="31" conditionType="Parameter" useIsNull="False" field="fichas.madre" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="19" rightBrackets="1"/>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks>
			</JoinLinks>
			<Fields>
			</Fields>
			<SPParameters/>
			<SQLParameters>
<SQLParameter id="105" parameterType="URL" variable="s_keyword" dataType="Text" parameterSource="s_keyword" designDefaultValue="20"/>
</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<IncludePage id="102" name="Footer" page="../Footer.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="fichas_list.php" forShow="True" url="fichas_list.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="103" groupID="1"/>
		<Group id="104" groupID="2"/>
	</SecurityGroups>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
