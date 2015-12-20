<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\reportes" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="SandBeach" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<IncludePage id="2" name="Header" PathID="Header" page="../Header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="fichas" wizardCaption=" Fichas Buscar" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="saldoacree.ccp" PathID="fichas">
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
		<Report id="34" secured="False" enablePrint="False" showMode="Web" sourceType="SQL" returnValueType="Number" linesPerWebPage="40" linesPerPhysicalPage="50" connection="Connection1" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="select h.idhipoteca,m.simbolo,c.importe,c.idcuota 
	from cuotas c
	join hipotecas h on(c.idhipoteca = h.idhipoteca)
	join fichashipotecas fh on(h.idhipoteca = c.idhipoteca)
	join fichas f on(fh.idficha = f.idficha)
	join monedas m on(h.idmoneda = m.idmoneda)
where 
(fh.idficha = {s_idficha} or f.nombre like '%{s_nombre}%')
and fechapago is not null
and fechaliquidacion is null
and idtipocuota in(2,4)
" name="Report2" pageSizeLimit="100" wizardCaption=" Report2 " wizardLayoutType="GroupLeft">
			<Components>
				<Section id="37" visible="True" lines="0" name="Report_Header" wizardSectionType="ReportHeader">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="38" visible="True" lines="1" name="Page_Header" wizardSectionType="PageHeader">
					<Components>
						<Sorter id="59" visible="True" name="Sorter_idcuota" column="idcuota" wizardCaption="Idcuota" wizardSortingType="SimpleDir" wizardControl="idcuota">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Sorter>
						<Sorter id="61" visible="True" name="Sorter_importe" column="importe" wizardCaption="Importe" wizardSortingType="SimpleDir" wizardControl="importe">
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
				<Section id="40" visible="True" lines="0" name="simbolo_Header">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="42" visible="True" lines="0" name="idhipoteca_Header">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="43" visible="True" lines="1" name="Detail">
					<Components>
						<ReportLabel id="57" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="True" resetAt="Report" name="simbolo" fieldSource="simbolo" wizardCaption="simbolo" wizardSize="3" wizardMaxLength="3" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" PathID="Report2Detailsimbolo">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="58" fieldSourceType="DBColumn" dataType="Integer" html="False" hideDuplicates="True" resetAt="Report" name="idhipoteca" fieldSource="idhipoteca" wizardCaption="idhipoteca" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" wizardAlign="right" PathID="Report2Detailidhipoteca">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="60" fieldSourceType="DBColumn" dataType="Integer" html="False" hideDuplicates="False" resetAt="Report" name="idcuota" fieldSource="idcuota" wizardCaption="idcuota" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" wizardAlign="right" PathID="Report2Detailidcuota">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="62" fieldSourceType="DBColumn" dataType="Float" html="False" hideDuplicates="False" resetAt="Report" name="importe" fieldSource="importe" wizardCaption="importe" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" wizardAlign="right" PathID="Report2Detailimporte">
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
				<Section id="44" visible="True" lines="1" name="idhipoteca_Footer">
					<Components>
						<ReportLabel id="49" fieldSourceType="DBColumn" dataType="Integer" html="False" hideDuplicates="False" resetAt="idhipoteca" name="Count_idcuota1" summarised="True" function="Count" wizardCaption="Idcuota" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardPrefix="Count: " wizardAddNbsp="False" wizardAlign="right" wizardVAlign="baseline" PathID="Report2idhipoteca_FooterCount_idcuota1">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="50" fieldSourceType="DBColumn" dataType="Float" html="False" hideDuplicates="False" resetAt="idhipoteca" name="Sum_importe1" fieldSource="importe" summarised="True" function="Sum" wizardCaption="Importe" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardPrefix="Sum: " wizardAddNbsp="False" wizardAlign="right" wizardVAlign="baseline" PathID="Report2idhipoteca_FooterSum_importe1">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="64" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="gope" PathID="Report2idhipoteca_Footergope" fieldSource="idhipoteca">
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
				<Section id="45" visible="True" lines="1" name="simbolo_Footer">
					<Components>
						<ReportLabel id="52" fieldSourceType="DBColumn" dataType="Float" html="False" hideDuplicates="False" resetAt="simbolo" name="Sum_importe" fieldSource="importe" summarised="True" function="Sum" wizardCaption="Importe" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardPrefix="Sum: " wizardAddNbsp="False" wizardAlign="right" wizardVAlign="baseline" PathID="Report2simbolo_FooterSum_importe">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="63" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="gsimbolo" PathID="Report2simbolo_Footergsimbolo" fieldSource="simbolo">
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
				<Section id="46" visible="True" lines="1" name="Report_Footer" wizardSectionType="ReportFooter">
					<Components>
						<Panel id="47" visible="True" name="NoRecords" wizardNoRecords="No hay registros">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Panel>
					</Components>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="48" visible="True" lines="1" name="Page_Footer" wizardSectionType="PageFooter" pageBreakAfter="True">
					<Components>
						<Navigator id="53" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="TextButtons" wizardFirst="True" wizardFirstText="|&lt;" wizardPrev="True" wizardPrevText="&lt;&lt;" wizardNext="True" wizardNextText="&gt;&gt;" wizardLast="True" wizardLastText="&gt;|" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="de" wizardImagesScheme="Sandbeach">
							<Components/>
							<Events>
								<Event name="BeforeShow" type="Server">
									<Actions>
										<Action actionName="Hide-Show Component" actionCategory="General" id="54" action="Hide" conditionType="Parameter" dataType="Integer" condition="LessThan" name1="TotalPages" sourceType1="SpecialValue" name2="2" sourceType2="Expression"/>
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
				<SQLParameter id="35" variable="s_idficha" parameterType="URL" defaultValue="0" dataType="Integer" parameterSource="s_idficha"/>
				<SQLParameter id="36" variable="s_nombre" parameterType="URL" defaultValue="ZZZZZ" dataType="Text" parameterSource="s_nombre"/>
			</SQLParameters>
			<ReportGroups>
				<ReportGroup id="39" name="simbolo" field="simbolo" sqlField="simbolo" sortOrder="asc"/>
				<ReportGroup id="41" name="idhipoteca" field="h.idhipoteca" sqlField="h.idhipoteca" sortOrder="asc"/>
			</ReportGroups>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Report>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="saldoacree_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="saldoacree.php" forShow="True" url="saldoacree.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
