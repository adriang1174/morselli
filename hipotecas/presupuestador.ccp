<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\hipotecas" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="SandBeach" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<IncludePage id="2" name="Header" PathID="Header" page="../Header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Record id="4" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="gastosescribaniaSearch" wizardCaption=" Gastosescribania Buscar" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="presupuestador.ccp" PathID="gastosescribaniaSearch">
			<Components>
				<Button id="5" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Buscar" PathID="gastosescribaniaSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<ListBox id="6" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="s_jurisdiccion" wizardCaption="Jurisdiccion" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardEmptyCaption="Seleccionar Valor" PathID="gastosescribaniaSearchs_jurisdiccion" connection="Connection1" _valueOfList="Provincia" _nameOfList="Provincia" dataSource="Capital;Capital;Provincia;Provincia" required="True">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<TextBox id="12" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="operacion" PathID="gastosescribaniaSearchoperacion" required="True">
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
		<Report id="15" secured="False" enablePrint="False" showMode="Web" sourceType="SQL" returnValueType="Number" linesPerWebPage="40" linesPerPhysicalPage="50" connection="Connection1" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="SELECT 
idgastoescribania,
descripcion,
case when importecomp &gt; 0 and importecomp &lt; 1 then
	importecomp * {operacion}
else
	importecomp
end as importecomp,
case when importecomp &gt; 0 and importecomp &lt; 1 then
	importecomp
else
	0
end as porcentajecomp,
case when importevend &gt; 0 and importevend &lt; 1 then
	importevend * {operacion}
else
	importevend
end as importevend,
case when importevend &gt; 0 and importevend &lt; 1 then
	importevend
else
	0
end as porcentajevend,
jurisdiccion
FROM gastosescribania
WHERE jurisdiccion = '{s_jurisdiccion}' " name="Report1" orderBy="idgastoescribania" pageSizeLimit="100" wizardCaption=" Report1 " wizardLayoutType="Tabular">
			<Components>
				<Section id="18" visible="True" lines="0" name="Report_Header" wizardSectionType="ReportHeader">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="19" visible="True" lines="1" name="Page_Header" wizardSectionType="PageHeader">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Section>
				<Section id="20" visible="True" lines="1" name="Detail">
					<Components>
						<ReportLabel id="26" fieldSourceType="DBColumn" dataType="Text" html="False" hideDuplicates="False" resetAt="Report" name="descripcion" fieldSource="descripcion" wizardCaption="descripcion" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" PathID="Report1Detaildescripcion">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="27" fieldSourceType="DBColumn" dataType="Float" html="False" hideDuplicates="False" resetAt="Report" name="importevend" fieldSource="importevend" wizardCaption="importevend" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" wizardAlign="right" PathID="Report1Detailimportevend" format="$0.00">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="28" fieldSourceType="DBColumn" dataType="Float" html="False" hideDuplicates="False" resetAt="Report" name="porcentajevend" fieldSource="porcentajevend" wizardCaption="porcentajevend" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" wizardAlign="right" PathID="Report1Detailporcentajevend" format="0.00%" emptyValue=" ">
							<Components/>
							<Events>
								<Event name="BeforeShow" type="Server">
									<Actions>
										<Action actionName="Custom Code" actionCategory="General" id="32"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="29" fieldSourceType="DBColumn" dataType="Float" html="False" hideDuplicates="False" resetAt="Report" name="importecomp" fieldSource="importecomp" wizardCaption="importecomp" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" wizardAlign="right" PathID="Report1Detailimportecomp" format="$0.00">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="30" fieldSourceType="DBColumn" dataType="Float" html="False" hideDuplicates="False" resetAt="Report" name="porcentajecomp" fieldSource="porcentajecomp" wizardCaption="porcentajecomp" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="False" wizardAlign="right" PathID="Report1Detailporcentajecomp" format="0.00%" emptyValue=" ">
							<Components/>
							<Events>
								<Event name="BeforeShow" type="Server">
									<Actions>
										<Action actionName="Custom Code" actionCategory="General" id="31"/>
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
				<Section id="21" visible="True" lines="1" name="Report_Footer" wizardSectionType="ReportFooter">
					<Components>
						<Panel id="22" visible="True" name="NoRecords" wizardNoRecords="No hay registros">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Panel>
						<ReportLabel id="24" fieldSourceType="DBColumn" dataType="Float" html="False" hideDuplicates="False" resetAt="Report" name="TotalSum_importevend" fieldSource="importevend" summarised="True" function="Sum" wizardCaption="Importevend" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardPrefix="Sum: " wizardAddNbsp="False" wizardAlign="right" wizardVAlign="baseline" PathID="Report1Report_FooterTotalSum_importevend" format="$0.00">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</ReportLabel>
						<ReportLabel id="25" fieldSourceType="DBColumn" dataType="Float" html="False" hideDuplicates="False" resetAt="Report" name="TotalSum_importecomp" fieldSource="importecomp" summarised="True" function="Sum" wizardCaption="Importecomp" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardPrefix="Sum: " wizardAddNbsp="False" wizardAlign="right" wizardVAlign="baseline" PathID="Report1Report_FooterTotalSum_importecomp" format="$0.00">
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
				<Section id="23" visible="True" lines="0" name="Page_Footer" wizardSectionType="PageFooter" pageBreakAfter="True">
					<Components/>
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
				<SQLParameter id="16" variable="s_jurisdiccion" parameterType="URL" dataType="Text" parameterSource="s_jurisdiccion" designDefaultValue="Capital"/>
				<SQLParameter id="17" variable="operacion" parameterType="URL" defaultValue="0" dataType="Text" parameterSource="operacion" designDefaultValue="100000"/>
			</SQLParameters>
			<ReportGroups/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Report>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="presupuestador_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="presupuestador.php" forShow="True" url="presupuestador.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
