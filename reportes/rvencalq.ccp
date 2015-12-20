<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\reportes" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="SandBeach" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<IncludePage id="2" name="Header" PathID="Header" page="../Header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Report id="3" secured="False" enablePrint="False" showMode="Web" sourceType="SQL" returnValueType="Number" linesPerWebPage="40" linesPerPhysicalPage="50" connection="Connection1" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="select f.idficha,f.nombre as inquilino,a.idalquiler as contrato, c.idcuota,c.ano,c.mes,m.simbolo,c.importe
	from cuotas c
	join alquileres a on(c.idalquiler = a.idalquiler)
	join fichasalquileres fa on(fa.idalquiler = c.idalquiler)
	join fichas f on(fa.idficha = f.idficha)
	join monedas m on(a.idmoneda = m.idmoneda)
where fechapago is null
and fechavencimiento between getdate() and getdate() + {period}
and idtipocuota = 1" name="Report1" pageSizeLimit="100" wizardCaption=" Report1 " wizardLayoutType="GroupLeftAbove">
			<Components>
				<Section id="5" visible="True" lines="0" name="Report_Header" wizardSectionType="ReportHeader">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="6" visible="True" lines="1" name="Page_Header" wizardSectionType="PageHeader">
					<Components>
						<Sorter id="24" visible="True" name="Sorter_idcuota" column="idcuota" wizardCaption="Idcuota" wizardSortingType="SimpleDir" wizardControl="idcuota">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Sorter>
						<Sorter id="26" visible="True" name="Sorter_ano" column="ano" wizardCaption="Ano" wizardSortingType="SimpleDir" wizardControl="ano">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Sorter>
						<Sorter id="28" visible="True" name="Sorter_mes" column="mes" wizardCaption="Mes" wizardSortingType="SimpleDir" wizardControl="mes">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Sorter>
						<Sorter id="30" visible="True" name="Sorter_importe" column="importe" wizardCaption="Importe" wizardSortingType="SimpleDir" wizardControl="importe">
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
				<Section id="8" visible="True" lines="1" name="inquilino_Header">
					<Components>
						<ReportLabel id="17" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="inquilino" fieldSource="inquilino" wizardCaption="inquilino" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" PathID="Report1inquilino_Headerinquilino">
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
				<Section id="10" visible="True" lines="1" name="contrato_Header">
					<Components>
						<ReportLabel id="18" fieldSourceType="DBColumn" dataType="Integer" html="False" hideDuplicates="False" resetAt="Report" name="contrato" fieldSource="contrato" wizardCaption="contrato" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" wizardAlign="right" PathID="Report1contrato_Headercontrato">
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
				<Section id="11" visible="True" lines="1" name="Detail">
					<Components>
						<ReportLabel id="25" fieldSourceType="DBColumn" dataType="Integer" html="False" hideDuplicates="False" resetAt="Report" name="idcuota" fieldSource="idcuota" wizardCaption="idcuota" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" wizardAlign="right" PathID="Report1Detailidcuota">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="27" fieldSourceType="DBColumn" dataType="Integer" html="False" hideDuplicates="False" resetAt="Report" name="ano" fieldSource="ano" wizardCaption="ano" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" wizardAlign="right" PathID="Report1Detailano">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="29" fieldSourceType="DBColumn" dataType="Integer" html="False" hideDuplicates="False" resetAt="Report" name="mes" fieldSource="mes" wizardCaption="mes" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" wizardAlign="right" PathID="Report1Detailmes">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="31" fieldSourceType="DBColumn" dataType="Float" html="False" hideDuplicates="False" resetAt="Report" name="importe" fieldSource="importe" wizardCaption="importe" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" wizardAlign="right" PathID="Report1Detailimporte">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="32" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="simbolo" PathID="Report1Detailsimbolo" fieldSource="simbolo">
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
				<Section id="12" visible="True" lines="1" name="contrato_Footer">
					<Components>
						<ReportLabel id="19" fieldSourceType="DBColumn" dataType="Float" html="False" hideDuplicates="False" resetAt="contrato" name="Sum_importe1" fieldSource="importe" summarised="True" function="Sum" wizardCaption="Importe" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardPrefix="Sum: " wizardAddNbsp="False" wizardAlign="right" wizardVAlign="baseline" PathID="Report1contrato_FooterSum_importe1">
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
				<Section id="13" visible="True" lines="1" name="inquilino_Footer">
					<Components>
						<ReportLabel id="20" fieldSourceType="DBColumn" dataType="Float" html="False" hideDuplicates="False" resetAt="inquilino" name="Sum_importe" fieldSource="importe" summarised="True" function="Sum" wizardCaption="Importe" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardPrefix="Sum: " wizardAddNbsp="False" wizardAlign="right" wizardVAlign="baseline" PathID="Report1inquilino_FooterSum_importe">
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
				<Section id="14" visible="True" lines="1" name="Report_Footer" wizardSectionType="ReportFooter">
					<Components>
						<Panel id="15" visible="True" name="NoRecords" wizardNoRecords="No hay registros">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Panel>
						<ReportLabel id="23" fieldSourceType="DBColumn" dataType="Float" html="False" hideDuplicates="False" resetAt="Report" name="TotalSum_importe" fieldSource="importe" summarised="True" function="Sum" wizardCaption="Importe" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardPrefix="Sum: " wizardAddNbsp="False" wizardAlign="right" wizardVAlign="baseline" PathID="Report1Report_FooterTotalSum_importe">
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
				<Section id="16" visible="True" lines="1" name="Page_Footer" wizardSectionType="PageFooter" pageBreakAfter="True">
					<Components>
						<Navigator id="21" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="TextButtons" wizardFirst="True" wizardFirstText="|&lt;" wizardPrev="True" wizardPrevText="&lt;&lt;" wizardNext="True" wizardNextText="&gt;&gt;" wizardLast="True" wizardLastText="&gt;|" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="de" wizardImagesScheme="Sandbeach">
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
				<SQLParameter id="4" variable="period" parameterType="URL" defaultValue="30" dataType="Integer" parameterSource="period"/>
			</SQLParameters>
			<ReportGroups>
				<ReportGroup id="7" name="inquilino" field="inquilino" sqlField="inquilino" sortOrder="asc"/>
				<ReportGroup id="9" name="contrato" field="contrato" sqlField="contrato" sortOrder="asc"/>
			</ReportGroups>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Report>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="rvencalq_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="rvencalq.php" forShow="True" url="rvencalq.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
