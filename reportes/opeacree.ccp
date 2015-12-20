<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\reportes" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="SandBeach" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<IncludePage id="2" name="Header" PathID="Header" page="../Header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="fichas" wizardCaption=" Fichas Buscar" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="opeacree.ccp" PathID="fichas">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Buscar" PathID="fichasButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="s_idficha" wizardCaption="Idficha" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" PathID="fichass_idficha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="6" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_nombre" wizardCaption="Nombre" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" PathID="fichass_nombre">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
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
		<Report id="7" secured="False" enablePrint="False" showMode="Web" sourceType="SQL" returnValueType="Number" linesPerWebPage="40" linesPerPhysicalPage="50" connection="Connection1" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="select h.idhipoteca,h.fechainicio,h.fechafin,f2.nombre as deudor, 
	case when h.fechafin &lt; getdate() then
		'Histórico'
	else
		'Vigente'
	end as tipooperacion, m.simbolo,
	h.montohipoteca	,
	sum(importe) as importe
	from hipotecas h 
	join cuotas c on(h.idhipoteca = c.idhipoteca)
	join fichaspropiedades fp on(h.idpropiedad = fp.idpropiedad)
	join fichashipotecas fh on(h.idhipoteca = h.idhipoteca)
	join monedas m on(h.idmoneda = m.idmoneda)
	left join fichas f on(fh.idficha = f.idficha)
	left join fichas f2 on(fp.idficha = f2.idficha)
where (fh.idficha = {s_idficha} and f.nombre like '%{s_nombre}%')
group by h.idhipoteca,h.fechainicio,h.fechafin,f2.nombre ,
	case when h.fechafin &lt; getdate() then
		'Histórico'
	else
		'Vigente'
	end ,m.simbolo,
	h.montohipoteca
order by h.fechafin desc" name="Report1" pageSizeLimit="100" wizardCaption=" Report1 " wizardLayoutType="Tabular">
			<Components>
				<Section id="10" visible="True" lines="0" name="Report_Header" wizardSectionType="ReportHeader">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="11" visible="True" lines="1" name="Page_Header" wizardSectionType="PageHeader">
					<Components>
						<Sorter id="23" visible="True" name="Sorter_idhipoteca" column="idhipoteca" wizardCaption="Idhipoteca" wizardSortingType="SimpleDir" wizardControl="idhipoteca">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Sorter>
						<Sorter id="25" visible="True" name="Sorter_fechainicio" column="fechainicio" wizardCaption="Fechainicio" wizardSortingType="SimpleDir" wizardControl="fechainicio">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Sorter>
						<Sorter id="27" visible="True" name="Sorter_fechafin" column="fechafin" wizardCaption="Fechafin" wizardSortingType="SimpleDir" wizardControl="fechafin">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Sorter>
						<Sorter id="29" visible="True" name="Sorter_deudor" column="deudor" wizardCaption="Deudor" wizardSortingType="SimpleDir" wizardControl="deudor">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Sorter>
						<Sorter id="31" visible="True" name="Sorter_tipooperacion" column="tipooperacion" wizardCaption="Tipooperacion" wizardSortingType="SimpleDir" wizardControl="tipooperacion">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Sorter>
						<Sorter id="33" visible="True" name="Sorter_montohipoteca" column="montohipoteca" wizardCaption="Montohipoteca" wizardSortingType="SimpleDir" wizardControl="montohipoteca">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Sorter>
					</Components>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="12" visible="True" lines="1" name="Detail">
					<Components>
						<ReportLabel id="24" fieldSourceType="DBColumn" dataType="Integer" html="False" hideDuplicates="False" resetAt="Report" name="idhipoteca" fieldSource="idhipoteca" wizardCaption="idhipoteca" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" wizardAlign="right" PathID="Report1Detailidhipoteca">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="26" fieldSourceType="DBColumn" dataType="Date" html="False" hideDuplicates="False" resetAt="Report" name="fechainicio" fieldSource="fechainicio" wizardCaption="fechainicio" wizardSize="10" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" PathID="Report1Detailfechainicio">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="28" fieldSourceType="DBColumn" dataType="Date" html="False" hideDuplicates="False" resetAt="Report" name="fechafin" fieldSource="fechafin" wizardCaption="fechafin" wizardSize="10" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" PathID="Report1Detailfechafin">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="30" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="deudor" fieldSource="deudor" wizardCaption="deudor" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" PathID="Report1Detaildeudor">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="32" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="tipooperacion" fieldSource="tipooperacion" wizardCaption="tipooperacion" wizardSize="9" wizardMaxLength="9" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" PathID="Report1Detailtipooperacion">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="34" fieldSourceType="DBColumn" dataType="Float" html="False" hideDuplicates="False" resetAt="Report" name="montohipoteca" fieldSource="montohipoteca" wizardCaption="montohipoteca" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" wizardAlign="right" PathID="Report1Detailmontohipoteca">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="35" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="simbolo" PathID="Report1Detailsimbolo" fieldSource="simbolo">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="36" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="importe" PathID="Report1Detailimporte" fieldSource="importe">
<Components/>
<Events>
<Event name="BeforeShow" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="37"/>
</Actions>
</Event>
</Events>
<Attributes/>
<Features/>
</ReportLabel>
</Components>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="13" visible="True" lines="1" name="Report_Footer" wizardSectionType="ReportFooter">
					<Components>
						<Panel id="14" visible="True" name="NoRecords" wizardNoRecords="No hay registros">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Panel>
						<ReportLabel id="18" fieldSourceType="DBColumn" dataType="Integer" html="False" hideDuplicates="False" resetAt="Report" name="TotalCount_idhipoteca" summarised="True" function="Count" wizardCaption="Idhipoteca" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardPrefix="Count: " wizardAddNbsp="False" wizardAlign="right" wizardVAlign="baseline" PathID="Report1Report_FooterTotalCount_idhipoteca">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="19" fieldSourceType="DBColumn" dataType="Float" html="False" hideDuplicates="False" resetAt="Report" name="TotalSum_montohipoteca" fieldSource="montohipoteca" summarised="True" function="Sum" wizardCaption="Montohipoteca" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardPrefix="Sum: " wizardAddNbsp="False" wizardAlign="right" wizardVAlign="baseline" PathID="Report1Report_FooterTotalSum_montohipoteca">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="20" fieldSourceType="DBColumn" dataType="Float" html="False" hideDuplicates="False" resetAt="Report" name="TotalMin_montohipoteca" fieldSource="montohipoteca" format="#.00" summarised="True" function="Min" wizardCaption="Montohipoteca" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardPrefix="Min: " wizardAddNbsp="False" wizardAlign="right" wizardVAlign="baseline" wizardSatellite="True" wizardControl="TotalSum_montohipoteca" PathID="Report1Report_FooterTotalMin_montohipoteca">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="21" fieldSourceType="DBColumn" dataType="Float" html="False" hideDuplicates="False" resetAt="Report" name="TotalMax_montohipoteca" fieldSource="montohipoteca" format="#.00" summarised="True" function="Max" wizardCaption="Montohipoteca" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardPrefix="Max: " wizardAddNbsp="False" wizardAlign="right" wizardVAlign="baseline" wizardSatellite="True" wizardControl="TotalSum_montohipoteca" PathID="Report1Report_FooterTotalMax_montohipoteca">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="22" fieldSourceType="DBColumn" dataType="Float" html="False" hideDuplicates="False" resetAt="Report" name="TotalAvg_montohipoteca" fieldSource="montohipoteca" summarised="True" function="Avg" wizardCaption="Montohipoteca" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardPrefix="Avg: " wizardAddNbsp="False" wizardAlign="right" wizardVAlign="baseline" wizardSatellite="True" wizardControl="TotalSum_montohipoteca" PathID="Report1Report_FooterTotalAvg_montohipoteca">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
					</Components>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="15" visible="True" lines="1" name="Page_Footer" wizardSectionType="PageFooter" pageBreakAfter="True">
					<Components>
						<Navigator id="16" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="TextButtons" wizardFirst="True" wizardFirstText="|&lt;" wizardPrev="True" wizardPrevText="&lt;&lt;" wizardNext="True" wizardNextText="&gt;&gt;" wizardLast="True" wizardLastText="&gt;|" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="de" wizardImagesScheme="Sandbeach">
							<Components/>
							<Events>
								<Event name="BeforeShow" type="Server">
									<Actions>
										<Action actionName="Hide-Show Component" actionCategory="General" id="17" action="Hide" conditionType="Parameter" dataType="Integer" condition="LessThan" name1="TotalPages" sourceType1="SpecialValue" name2="2" sourceType2="Expression"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
						</Navigator>
					</Components>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
			</Components>
			<Events/>
			<TableParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="8" variable="s_idficha" parameterType="URL" defaultValue="0" dataType="Integer" parameterSource="s_idficha"/>
				<SQLParameter id="9" variable="s_nombre" parameterType="URL" dataType="Text" parameterSource="s_nombre" defaultValue="ZZZZZ"/>
			</SQLParameters>
			<ReportGroups/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Report>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="opeacree_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="opeacree.php" forShow="True" url="opeacree.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
